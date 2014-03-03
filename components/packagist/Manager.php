<?php
namespace schmunk42\packaii\components\packagist;

use dosamigos\packagist\Package;
use dosamigos\packagist\Packagist;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Manager handles installed extensions information.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package schmunk42\packaii\components\packagist
 */
class Manager extends Component
{
	/**
	 * @var string the cache key name to store installed package data
	 */
	public $cacheKey = 'schmunk42/yii2-package-browser:package-data';
	/**
	 * @var bool whether to automatically refresh cache each time we
	 */
	public $refreshCache = true;
	/**
	 * @var string|null the github username to use to access readme files
	 */
	public $gitHubUsername = null;
	/**
	 * @var string|null the github password to use to access readme files
	 */
	public $gitHubPassword = null;
	/**
	 * @var array the installed packages
	 */
	private $_installed_packages = [];
	/**
	 * @var string the composer lock path
	 */
	private $_composer_lock_path;
	/**
	 * @var string the composer lock contents
	 */
	private $_composer_lock_contents;
	/**
	 * @var Packagist
	 */
	private $_packagist;

	/**
	 * Sets the composer lock file path
	 * @param string $composer_path
	 */
	public function setComposerLockPath($composer_path)
	{
		$this->_composer_lock_path = $composer_path;
	}

	/**
	 * @return string the composer lock full file path
	 */
	public function getComposerLockPath()
	{
		if ($this->_composer_lock_path == null) {
			$this->_composer_lock_path = \Yii::getAlias('@root') . '/composer.lock';
		}
		return $this->_composer_lock_path;
	}

	/**
	 * Returns the composer lock file contents
	 * @param bool $json whether to return json decoded object or raw contents
	 * @return \StdClass|string
	 */
	public function getComposerLockContents($json = true)
	{
		if ($this->_composer_lock_contents == null) {
			$path = $this->getComposerLockPath();
			if (file_exists($path)) {
				$this->_composer_lock_contents = file_get_contents($path);
			}
		}
		return $json && $this->_composer_lock_contents != null
			? Json::decode($this->_composer_lock_contents, false)
			: $this->_composer_lock_contents;
	}

	/**
	 * Returns the composer lock file hash
	 * @return string|null
	 */
	public function getComposerLockHash()
	{
		$lockContents = $this->getComposerLockContents();

		return is_object($lockContents) ? $lockContents->hash : null;
	}

	/**
	 * @return int the total number of installed packages
	 */
	public function getInstalledPackagesCount()
	{
		return count($this->getInstalledPackages());
	}

	/**
	 * @return int the total number of dev packages installed
	 */
	public function getDevPackagesCount()
	{
		return count($this->getRequiredDevPackageNames());
	}

	/**
	 * @return int thte total number of required packages installed
	 */
	public function getRequiredPackagesCount()
	{
		return count($this->getRequiredPackageNames());
	}


	/**
	 * Returns an array of installed packages
	 * @return Package[] the installed packages
	 */
	public function getInstalledPackages()
	{
		if (empty($this->_installed_packages)) {

			$lockContents = $this->getComposerLockContents();

			if (is_object($lockContents) && isset($lockContents->packages)) {

				$packages = $lockContents->packages;
				foreach ($packages as $package) {
					$this->_installed_packages[$package->name] = $package;
				}

				foreach ($this->_installed_packages as &$package) {
					foreach ($this->getRequiredPackageNames() as $name => $version) {
						if (strcasecmp($package->name, $name) === 0) {
							// TODO: should we set the versions too ?
                            // TODO: The labels are of the wrong color, green => required, blue => installed as dependecy
							$package->isRequired = true;
						}
					}
					foreach ($this->getRequiredDevPackageNames() as $name => $version) {
						if (strcasecmp($package->name, $name) === 0) {
							// TODO: should we set the versions too ?
							$package->isRequiredDev = true;
						}
					}
				}

				if ($this->refreshCache) {
					$this->updateCache();
				}
			}
		}
		return $this->_installed_packages;
	}

	/**
	 * Returns installed package detailed info. This method can be called even before [[getInstalledPackages()]]
	 * @param string $name the name of the package
	 * @return \StdClass|null the package info, null if none found
	 */
	public function getInstalledPackageDetail($name)
	{
		$packages = \Yii::$app->cache->get($this->cacheKey)
			? unserialize(\Yii::$app->cache->get($this->cacheKey))
			: $this->getInstalledPackages();
		return ArrayHelper::getValue($packages, $name);
	}

	/**
	 * Returns the json decoded string readme information. The information is returned as an object with the following
	 * attributes:
	 *
	 * - name
	 * - path
	 * - sha
	 * - size
	 * - url
	 * - html_url
	 * - git_url
	 * - type
	 * - content
	 * - encoding
	 * - _links
	 *   - self
	 *   - git
	 *   - html
	 *
	 * @param \StdClass $package it must be one of the packages returned by [[getInstalledPackages()]] function
	 * @return array readme information.
	 */
	public function getInstalledPackageReadme(&$package)
	{
		try
		{
			if (!isset($package->packagistInfo)) {
				$info = $this->getPackagistClient()->package($package->name)->getResponse()->getBody();
				$this->getInstalledPackages();
				$package->packagistInfo = $this->_installed_packages[$package->name]->packagistInfo = $info;
				$this->updateCache();
			}
			$readme = $package->packagistInfo->getReadme($this->gitHubUsername, $this->gitHubPassword);

		} catch( \Exception $e) {
			$readme = null;
		}
		return $readme;
	}

	/**
	 * Retrieves package information using Packagist API
	 * @param $name
	 * @return \dosamigos\packagist\Package
	 */
	public function getPackageDetail($name)
	{
		return $this->getPackagistClient()->package($name)->getResponse()->getBody();
	}

	/**
	 * Returns the package readme information. Best specifying the github username and password to avoid reaching
	 * api request limits.
	 * @param $package
	 * @return array
	 */
	public function getPackageReadme(&$package)
	{
		try {
			$readme = $package->getReadme($this->gitHubUsername, $this->gitHubPassword);
		} catch (\Exception $e) {
			$readme = null;
		}
		return $readme;
	}

	/**
	 * Updates cache with latest installed
	 */
	public function updateCache()
	{
		$refresh = $this->refreshCache;
		$this->refreshCache = false;
		\Yii::$app->cache->set($this->cacheKey, serialize($this->getInstalledPackages()));
		$this->refreshCache = $refresh;
	}

	/**
	 * @return array the require package names
	 */
	public function getRequiredPackageNames()
	{
		return $this->getInstalledPackageValueByKey('require');
	}

	/**
	 * @return array the require-dev package names
	 */
	public function getRequiredDevPackageNames()
	{
		return $this->getInstalledPackageValueByKey('require-dev');
	}

	/**
	 * Returns a packagist client
	 * @return Packagist
	 */
	public function getPackagistClient()
	{
		if ($this->_packagist === null) {
			$this->_packagist = new Packagist();
		}
		return $this->_packagist;
	}

	/**
	 * Checks whether a package is installed or not
	 * @param string $name the package name
	 * @return bool
	 */
	public function getIsInstalled($name)
	{
		return $this->getInstalledPackageDetail($name) !== null;
	}

	/**
	 * Returns a package value by key
	 * @param string $key the key name
	 * @return array
	 */
	protected function getInstalledPackageValueByKey($key)
	{
		$required = [];
		foreach ($this->getInstalledPackages() as $package) {
			$required = ArrayHelper::merge($required, (isset($package->$key) ? $package->$key : []));
		}
		return $required;
	}

}
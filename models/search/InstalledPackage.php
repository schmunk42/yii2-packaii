<?php
namespace schmunk42\packaii\models\search;


use dosamigos\arrayquery\ArrayQuery;
use yii\data\ArrayDataProvider;
/**
 *
 * Installed model is used to query and display installed packages
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
class InstalledPackage extends Base
{
	public $version;
	public $source;
	public $dist;
	public $require;
	public $requireDev;
	public $suggest;
	public $bin;
	public $autoload;
	public $notificationUrl;
	public $license;
	public $authors;
	public $homepage;
	public $keywords;
	public $extra;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[
				[
					'name',
					'version',
					'source',
					'dist',
					'require',
					'requireDev',
					'suggest',
					'bin',
					'type',
					'time',
					'autoload',
					'notificationUrl',
					'license',
					'authors',
					'description',
					'homepage',
					'keywords',
					'extra'
				],
				'safe'
			],
		];
	}

	/**
	 * Returns data provider with filled models. Filter applied if needed.
	 * @param array $params
	 * @param array $models
	 * @return \yii\data\ArrayDataProvider
	 */
	public function search($params, $models)
	{

		$dataProvider = new ArrayDataProvider([
			'allModels' => $models,
			'pagination' => [
				'pageSize' => 50,
			],
			'sort' => [
				'attributes' => [], // to be specified
			],
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		if(!empty($this->name))
		{
			$query = new ArrayQuery($models);
			$dataProvider->allModels = $query
				->addCondition('name', 'like ' . $this->name)
				->find();
		}

		return $dataProvider;
	}
}
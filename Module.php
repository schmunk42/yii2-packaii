<?php

namespace schmunk42\packaii;


use schmunk42\packaii\components\packagist\Manager;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'schmunk42\packaii\controllers';

	public $gitHubUsername;

	public $gitHubPassword;

	private $_manager;

    public function init()
    {
        parent::init();
    }

	public function getManager()
	{
		if($this->_manager === null) {
			$this->_manager = new Manager(
				['gitHubUsername' => $this->gitHubUsername, 'gitHubPassword' => $this->gitHubPassword]
			);
		}
		return $this->_manager;
	}
}


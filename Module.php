<?php

namespace schmunk42\packaii;


use Behat\Mink\Exception\Exception;
use schmunk42\packaii\components\packagist\Manager;
use yii\base\BootstrapInterface;
use yii\helpers\Html;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = 'schmunk42\packaii\controllers';

    public $gitHubUsername;

    public $gitHubPassword;

    private $_manager;
    private $_messages = [];

    /**
     * Register module as `packaii`
     * @param \yii\base\Application $app
     */
    public function bootstrap($app){
        $app->setModule(
            'packaii',
            [
                'class' => 'schmunk42\packaii\Module'
            ]
        );
    }

    public function init()
    {
        parent::init();
        // auto-configure alias @root, if not set in config
        if (\Yii::getAlias('@root',false) === false) {
            \Yii::setAlias('@root', __DIR__.'/../../..');
        }
        $this->validateSettings();
    }

    public function getManager()
    {
        if ($this->_manager === null) {
            $this->_manager = new Manager(
                ['gitHubUsername' => $this->gitHubUsername, 'gitHubPassword' => $this->gitHubPassword]
            );
        }
        return $this->_manager;
    }

    public function hasMessages()
    {
        return (count($this->_messages) > 0);
    }

    public function getMessages()
    {
        return $this->_messages;
    }

    private function validateSettings()
    {
        if (!$this->gitHubUsername || !$this->gitHubPassword) {
            $this->_messages[] =
                [
                    'type'    => 'warning',
                    'message' => '<strong>Important</strong> <p>In order to avoid github calls limitations, it is recommended
					that you configure <strong>Packaii::gitHubUsernanme</strong> and <strong>Packaii::gitHubPassword</strong>
					module on your config file.</p> <br> More information on ' .
                        Html::a(
                            'GitHub Developer',
                            'https://developer.github.com/changes/2012-10-14-rate-limit-changes/'
                        )
                ];
        }

        try {
            if (!is_file(\Yii::getAlias('@root') . '/composer.json')) {
                $this->_messages[] =
                    [
                        'type'    => 'danger',
                        'message' => '<p>File <code>composer.json</code> not found under <code>@root</code> alias.</p>'
                    ];
            }
        } catch (\yii\base\Exception $e) {
            $this->_messages[] =
                [
                    'type'    => 'danger',
                    'message' => '<p>Please specify a <code>@root</code> alias in your application configuration</p>'
                ];
        }
    }
}
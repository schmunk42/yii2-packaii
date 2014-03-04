<?php

namespace schmunk42\packaii\panels;


use \Yii;
use yii\debug\Panel;
use yii\log\Logger;

/**
 * PackaiiPanel displays a managing composer packages UI on the debugger panel.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package app\panels
 */
class PackaiiPanel extends Panel
{

	/**
	 * @inheritdoc
	 */
	public function getName()
	{
		return 'Packaii';
	}

	/**
	 * @inheritdoc
	 */
	public function getSummary()
	{
		return \Yii::$app->view->render('@vendor/schmunk42/yii2-packaii/views/panels/summary');
	}

	/**
	 * @inheritdoc
	 */
	public function getDetail()
	{
		return \Yii::$app->view->render('@vendor/schmunk42/yii2-packaii/views/panels/detail');
	}

	/**
	 * @inheritdoc
	 */
	public function save()
	{
		return [];
	}
}
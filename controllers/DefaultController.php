<?php

namespace schmunk42\packaii\controllers;

use dosamigos\pjaxfilter\PjaxFilter;
use schmunk42\packaii\models\search\InstalledPackage;
use schmunk42\packaii\models\search\Package;
use yii\web\Controller;

class DefaultController extends Controller
{

//	public function behaviors()
//	{
////		return [
////			'pjax' => [
////				'class' => PjaxFilter::className(),
////				'actions' => ['*' => ['url' => ['index']]],
////				'exclude' => ['index', 'detail']
////			]
////		];
//	}

	public function actionIndex()
	{
		$installedModel = new InstalledPackage();
		$dataProvider = $installedModel->search([], $this->module->manager->getInstalledPackages());

		$packageModel = new Package();
		$packagistDataProvider = $packageModel->search([], []);

		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'packagistDataProvider' => $packagistDataProvider
		]);
	}

	public function actionSearchInstalled()
	{
		$searchModel = new InstalledPackage();
		$dataProvider = $searchModel->search($_GET, $this->module->manager->getInstalledPackages());

		return $this->renderPartial('_package_list', ['dataProvider' => $dataProvider]);
	}

	public function actionSearchPackagist()
	{
		try {
			$packageModel = new Package();
			$dataProvider = $packageModel->search($_GET, []);
		} catch (Exception $e) {
			die($e);
		}


		return $this->renderPartial('_package_list', ['dataProvider' => $dataProvider]);
	}

	public function actionDetail($name)
	{
		$model = $this->module->manager->getInstalledPackageDetail($name);
		$version = \Yii::$app->getRequest()->getQueryParam('version');
		if ($model == null) {
			$model = $this->module->manager->getPackageDetail($name);
			$readme = $this->module->manager->getPackageReadme($model);
			$view = '_packagist_detail';
		} else {
			$readme = $this->module->manager->getInstalledPackageReadme($model);
			$view = '_detail';
		}
		if ($readme == null) {
			return $this->renderpartial('_alert', [
				'type' => 'warning',
				'message' => 'Package README file not available for <strong>' . $name . '</strong>'
			]);
		}
		return $this->renderPartial($view, ['model' => $model, 'readme' => $readme, 'version' => $version]);
	}

}

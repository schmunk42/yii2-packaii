<?php

namespace schmunk42\packaii\controllers;

use schmunk42\packaii\models\search\InstalledPackage;
use schmunk42\packaii\models\search\Package;
use yii\web\Controller;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        $installedModel = new InstalledPackage();
		$dataProvider = $installedModel->search([], $this->module->manager->getInstalledPackages());

		$packageModel = new Package();
		$packagistDataProvider = $packageModel->search([], []);

        return $this->render('index', ['dataProvider' => $dataProvider, 'packagistDataProvider' => $packagistDataProvider]);
    }

	public function actionSearchInstalled()
	{
		$searchModel = new InstalledPackage();
		$dataProvider = $searchModel->search($_GET, $this->module->manager->getInstalledPackages());

		return $this->renderPartial('_package_list', ['dataProvider' => $dataProvider]);
	}

	public function actionSearchPackagist()
	{
		$packageModel = new Package();

		$dataProvider = $packageModel->search($_GET, []);

		return $this->renderPartial('_package_list', ['dataProvider' => $dataProvider]);
	}

    public function actionDetail($name)
    {
        $model   = $this->module->manager->getInstalledPackageDetail($name);
		if($model == null) {
			$model = $this->module->manager->getPackageDetail($name);
			$readme = $this->module->manager->getPackageReadme($model);
			$view = '_packagist_detail';
		} else {
			$readme = $this->module->manager->getInstalledPackageReadme($model);
			$view = '_detail';
		}
        echo $this->renderPartial($view, ['model' => $model, 'readme' => $readme]);
    }

}

<?php

namespace schmunk42\packaii\controllers;

use yii\caching\DummyCache;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class DefaultController extends Controller
{
    const CACHE_KEY = 'schmunk42/yii2-package-browser:package-data';

    public function actionIndex($selfupdate = false)
    {
        if ($selfupdate) {
            $this->updatePackages();
            \Yii::$app->session->setFlash('schmunk42.packagii.selfupdate', 'Package definintions updated.');
            $this->redirect(['index']);
        }

        $dataProvider                       = new ArrayDataProvider();
        $dataProvider->allModels            = $this->getData();
        $dataProvider->pagination->pageSize = 50;

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionDetail($packagename)
    {
        $client = new \Packagist\Api\Client();
        $data   = $client->get($packagename);
        echo $this->renderPartial('_detail', ['model' => $data]);
    }

    private function getData()
    {
        $data = \Yii::$app->cache->get(self::CACHE_KEY);
        if ($data === false) {
            $this->updatePackages();
            $data = \Yii::$app->cache->get(self::CACHE_KEY);
        }
        return $data;
    }

    private function updatePackages()
    {
        $client   = new \Packagist\Api\Client();
        $packages = $this->getInstalledPackages();
        $data     = array();
        foreach ($packages AS $package) {
            try {
                $temp       = $package;
                $temp->info = $client->get($package->name);
                $data[]     = $temp;
            } catch (\Exception $e) {
                echo "TODO: Log message";
            }

        }
        \Yii::$app->cache->set(self::CACHE_KEY, $data);
    }


    private function getInstalledPackages()
    {
        $json = file_get_contents(\Yii::getAlias('@root') . '/composer.lock');
        return json_decode($json)->packages;
    }
}

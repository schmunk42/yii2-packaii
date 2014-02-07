<?php

namespace schmunk42\packaii\controllers;

use yii\caching\DummyCache;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class DefaultController extends Controller
{
    const CACHE_KEY = 'schmunk42/yii2-package-browser:package-data';

    public function actionIndex()
    {
        $dataProvider                       = new ArrayDataProvider();
        $dataProvider->allModels            = $this->getData();
        $dataProvider->pagination->pageSize = 50;
        return $this->render('index', ['dataProvider' => $dataProvider]);
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
        $packages = $client->all(['type' => 'yii2-extension']);
        foreach ($packages AS $name) {
            $data[$name] = $client->get($name);
        }
        \Yii::$app->cache->set(self::CACHE_KEY, $data, 60);
    }
}

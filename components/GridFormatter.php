<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 06.02.14
 * Time: 02:26
 */

namespace schmunk42\packaii\components;

use \yii\helpers\Html;

class GridFormatter
{
    public static function name($model, $key, $id)
    {
        $versions = $model->getVersions();
        $latest   = reset($versions);
        if (!$latest || !$latest->getHomepage()) {
            return $model->getName();
        } else {
            return Html::a($model->getName(), $latest->getHomepage());
        }

    }

    public static function description($model, $key, $id)
    {
        $keywords = '';
        $versions = $model->getVersions();
        $latest   = reset($versions);
        if (!$latest) {
            return "<span class='label label-warning'>not released yet</span>";
        }
        foreach ($latest->getKeywords() AS $keyword) {
            $keywords .= "<span class='label label-default'>{$keyword}</span> ";
        }
        return $model->getDescription() . "<br/><span class='label label-primary'>" . array_values(
            $model->getVersions()
        )[0]->getVersion() . "</span> " . $keywords;
    }

    public static function downloads($model, $key, $id)
    {
        return $model->getDownloads()->getTotal();
    }
}
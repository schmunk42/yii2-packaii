<?php

use \yii\helpers\Html;
use \yii\bootstrap\Alert;

$options = isset($options) ? $options : [];
$closeButton = isset($closeButton) ? $closeButton : null;
$appendCss = isset($appendCss) ? $appendCss : null;
$type = isset($type) ? $type : 'info';

Html::addCssClass($options, 'alert-' . $type);

if ($appendCss) {
	Html::addCssClass($options, $appendCss);
}

echo Alert::widget([
	'body' => $message,
	'closeButton' => $closeButton,
	'options' => $options
]);
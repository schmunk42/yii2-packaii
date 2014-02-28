<?php
/**
 *
 * _alert.php
 *
 * Date: 27/02/14
 * Time: 07:19
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
$options = isset($options) ? $options : [];
$closeButton = isset($closeButton) ? $closeButton : null;
$appendCss = isset($appendCss) ? $appendCss : null;
$type = isset($type) ? $type : 'info';

\yii\helpers\Html::addCssClass($options, 'alert-' . $type);
if ($appendCss) {
	\yii\helpers\Html::addCssClass($options, $appendCss);
}

echo \yii\bootstrap\Alert::widget([
	'body' => $message,
	'closeButton' => $closeButton,
	'options' => $options
]);
<?php
 /**
 * 
 * _package_list.php
 *
 * Date: 24/02/14
 * Time: 11:00
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
/* @var \yii\web\View $this */
echo \yii\widgets\ListView::widget(
	[
		'emptyText' => $this->render('_alert', ['type' => 'info', 'message' => 'No results found']),
		'dataProvider' => $dataProvider,
		'itemView' => '/default/_package'
	]
);
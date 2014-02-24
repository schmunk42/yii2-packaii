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
echo \yii\widgets\ListView::widget(
	[
		'dataProvider' => $dataProvider,
		'itemView' => '/default/_package'
	]
);
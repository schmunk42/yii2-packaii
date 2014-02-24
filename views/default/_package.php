<?php
use \yii\helpers\Html;

?>
<b>
	<?= Html::a($model->name, Html::url(['detail', 'name' => $model->name]), ['class' => 'package-link']) ?>
	<?php if(Yii::$app->getModule('packaii')->manager->getIsInstalled($model->name)):?>
	<span class="label label-success">installed</span>
	<?php else:?>
	<span class="label label-default">not installed</span>
	<?php endif;?>
	<?php if (isset($model->isRequired)): ?>
		<span class="label label-warning">required</span>
	<?php endif; ?>
	<?php if (isset($model->isRequiredDev)): ?>
		<span class="label label-important">required</span>
	<?php endif; ?>
</b>

<p>
	<?= $model->description ?>
</p>

<?php
use \Yii;
use \yii\helpers\Html;

$version = property_exists($model, 'version') ? $model->version : null;
?>
<h5>
	<?php if (Yii::$app->getModule('packaii')->manager->getIsInstalled($model->name)): ?>
		<span
			class="label label-<?= isset($model->isRequired) ? 'success' : 'primary' ?>">
			<?= (isset($model->version)) ? $model->version : 'installed' ?>
		</span>
	<?php else: ?>
		<span class="label label-default">not installed</span>
	<?php endif; ?>
	<?php if (isset($model->isRequiredDev)): ?>
		<span class="label label-important">dev</span>
	<?php endif; ?>
	<?=
	Html::a($model->name, Html::url([
		'detail',
		'name' => $model->name,
		'version' => $version
	]), ['class' => 'package-link']) ?>
</h5>
<div>
	<small>
		<?= $model->description ?>
	</small>
</div>
<hr/>
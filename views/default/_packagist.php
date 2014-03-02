<?php
use \yii\widgets\Pjax;
use \yii\helpers\Html;
use \schmunk42\packaii\models\search\Package;

?>
	<p>
		<?= $this->render('_search_form', [
			'id' => 'packagist-search-form',
			'placeholder' => 'Search Packagist',
			'action' => Html::url(['search-packagist']),
			'model' => new Package()
		]); ?>
	</p>
<?php Pjax::begin([ 'formSelector' => '#packagist-search-form']);?>
<?= $this->render('_package_list', ['dataProvider' => $dataProvider]);?>
<?php Pjax::end();
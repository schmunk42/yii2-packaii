<?php
use \yii\helpers\Html;
use \yii\widgets\Pjax;
use \schmunk42\packaii\models\search\InstalledPackage;
?>
	<p>
		<?= $this->render('_search_form', [
			'id' => 'installed-search-form',
			'placeholder' => 'Search Installed',
			'action' => Html::url(['search-installed']),
			'model' => new InstalledPackage()
		]); ?>
	</p>
<?php Pjax::begin([ 'formSelector' => '#installed-search-form']);?>
<?= $this->render('_package_list', ['dataProvider' => $dataProvider]);?>
<?php Pjax::end();

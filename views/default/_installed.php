<?php
/**
 *
 * _installed.php
 *
 * Date: 24/02/14
 * Time: 10:57
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
/* @var \yii\web\View $this */
?>
	<p>
		<?= $this->render('_search_form', [
			'id' => 'installed-search-form',
			'placeholder' => 'Search Installed',
			'action' => \yii\helpers\Html::url(['search-installed']),
			'model' => new \schmunk42\packaii\models\search\InstalledPackage()
		]); ?>
	</p>
<?php \yii\widgets\Pjax::begin([ 'formSelector' => '#installed-search-form']);?>
<?= $this->render('_package_list', ['dataProvider' => $dataProvider]);?>
<?php \yii\widgets\Pjax::end();

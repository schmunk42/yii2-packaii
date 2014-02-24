<?php
 /**
 * 
 * _packagist.php
 *
 * Date: 24/02/14
 * Time: 11:06
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
/* @var \yii\web\View $this */
?>
	<p>
		<?= $this->render('_search_form', [
			'id' => 'packagist-search-form',
			'placeholder' => 'Search Packagist',
			'action' => \yii\helpers\Html::url(['search-packagist']),
			'model' => new \schmunk42\packaii\models\search\Package()
		]); ?>
	</p>
<?php \yii\widgets\Pjax::begin([ 'formSelector' => '#packagist-search-form']);?>
<?= $this->render('_package_list', ['dataProvider' => $dataProvider]);?>
<?php \yii\widgets\Pjax::end();
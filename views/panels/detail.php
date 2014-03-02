<?php
use Yii;
use \yii\helpers\Html;

?>
	<p class="well">
		<?= Yii::$app->getModule('packaii')->manager->getInstalledPackagesCount(); ?> Packages Installed<br>
		<?= Yii::$app->getModule('packaii')->manager->getDevPackagesCount(); ?> Dev-Packages<br>
		Composer Hash: <?= Yii::$app->getModule('packaii')->manager->getComposerLockHash(); ?>
	</p>
	<p>
		<?=
		$this->render('@vendor/schmunk42/yii2-packaii/views/default/_alert', [
				'type' => 'info',
				'message' => '<strong>Packaii</strong> Your composer package toolkit. ' . Html::a('Go to dashboard', ['/packaii'])
			]
		);?>

	</p>
<?php if (!Yii::$app->getModule('packaii')->gitHubUsername || !Yii::$app->getModule('packaii')->gitHubPassword): ?>
	<?=
	$this->render('@vendor/schmunk42/yii2-packaii/views/default/_alert', [
		'type' => 'warning',
		'message' => '<strong>Important</strong> <p>In order to avoid github calls limitations, it is recommended
					that you configure <strong>Packaii::gitHubUsernanme</strong> and <strong>Packaii::gitHubPassword</strong>
					module on your config file.</p> <br> More information on ' .
			Html::a('GitHub Developer', 'https://developer.github.com/changes/2012-10-14-rate-limit-changes/')
	]);?>
<?php endif; ?>
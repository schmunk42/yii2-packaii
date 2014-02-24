<?php
/**
 * @var \yii\web\View $this
 */
?>
<div class="packaii-default-index">
	<h1>Packaii
		<small>composer package browser</small>
	</h1>

	<div class="row">
		<div class="col-md-4">
			<p>
			<?= \yii\bootstrap\Tabs::widget([
				'items' => [
					[
						'label' => 'Installed',
						'content' => $this->render('_installed', ['dataProvider' => $dataProvider])
					],
					[
						'label' => 'Search Packagist',
						'content' => $this->render('_packagist', ['dataProvider' => $packagistDataProvider])
					]
				]
			]);?>
		</div>
		<div class="col-md-8">
			<div style="min-height: 40px">
				<div class="progress progress-striped hide">
					<div class="progress-bar" role="progressbar" style="width: 0%;"></div>
				</div>
			</div>
			<?php \yii\widgets\Pjax::begin([
				'id' => 'detail-panel',
				'linkSelector' => 'a.package-link',
				'timeout' => 10000
			]);?>
			<h2>
				Repository Statistics
                    <span class="pull-right">
                        <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#update-modal">
							Update Application
							<span class="glyphicon glyphicon-download"></span>
						</button>
                    </span>
			</h2>
			<p class="well">
				<?= \Yii::$app->getModule('packaii')->manager->getInstalledPackagesCount(); ?> Packages,
				<?= \Yii::$app->getModule('packaii')->manager->getDevPackagesCount(); ?> Dev-Packages,
				Composer Hash: <?= \Yii::$app->getModule('packaii')->manager->getComposerLockHash(); ?>
			</p>

			<?php \yii\widgets\Pjax::end(); ?>
		</div>
	</div>
</div>
<?php
$this->registerJs(<<<JS
(function($){
	var progress;
	var \$bar = $('.progress-bar');
	$(document).on('pjax:send', function(){
			\$bar.width(0);
			progress = setInterval(function() {
			$('.progress').addClass('active').removeClass('hide');
			if (\$bar.width()>=100) {
				clearInterval(progress);
				$('.progress').removeClass('active');
			} else {
				\$bar.width(\$bar.width()+40);
			}
		}, 800);

	}).on('pjax:complete', function(){
		clearInterval(progress);
		\$bar.width(\$bar.width()+100);
		$('.progress').removeClass('active').addClass("hide");
	});
})(jQuery);
JS
);
<?php
use \yii\bootstrap\Tabs;
use \yii\widgets\Pjax;
use \yii\helpers\Html;

?>
    <div class="">
        <div class="packaii-default-index">
            <h1>Composer packages</h1>

            <div class="row">
                <div class="col-md-3">
                    <p>
                        <?=
                        Tabs::widget(
                            [
                                'items' => [
                                    [
                                        'label'   => 'Installed',
                                        'content' => $this->render('_installed', ['dataProvider' => $dataProvider])
                                    ],
                                    [
                                        'label'   => 'Search Packagist',
                                        'content' => $this->render(
                                                '_packagist',
                                                ['dataProvider' => $packagistDataProvider]
                                            )
                                    ]
                                ]
                            ]
                        );?>
                </div>
                <div class="col-md-9">

                    <div class="progress progress-striped invisible">
                        <div class="progress-bar" role="progressbar" style="width: 0%;"></div>
                    </div>
                    <?php Pjax::begin(
                        [
                            'id'           => 'detail-panel',
                            'linkSelector' => 'a.package-link',
                            'timeout'      => 10000
                        ]
                    );?>
                    <h2>
                        Repository Statistics
                        <!-- TODO: reimplement update modal
                        <span class="pull-right">
                            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#update-modal">
                                Update Application
                                <span class="glyphicon glyphicon-upload"></span>
                            </button>
                        </span>
                        -->
                    </h2>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="well lead">
                                Composer Hash: <?= \Yii::$app->getModule('packaii')->manager->getComposerLockHash(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="well lead">
                                <?= \Yii::$app->getModule('packaii')->manager->getInstalledPackagesCount(); ?> Packages
                            </p>

                        </div>
                        <div class="col-md-6">
                            <p class="well lead">
                                <?= \Yii::$app->getModule('packaii')->manager->getDevPackagesCount(); ?> Dev-Packages
                            </p>
                        </div>
                    </div>
                    <?php if (!\Yii::$app->getModule('packaii')->gitHubUsername || !\Yii::$app->getModule(
                            'packaii'
                        )->gitHubPassword
                    ): ?>
                        <?
                        // TODO - fixme
                        /*$this->render(
                            '_alert',
                            [
                                'type'    => 'warning',
                                'message' => '<strong>Important</strong> <p>In order to avoid github calls limitations, it is recommended
						that you configure <strong>Packaii::gitHubUsernanme</strong> and <strong>Packaii::gitHubPassword</strong>
						module on your config file.</p> <br> More information on ' .
                                    Html::a(
                                        'GitHub Developer',
                                        'https://developer.github.com/changes/2012-10-14-rate-limit-changes/'
                                    )
                            ]
                        );*/?>
                    <?php endif; ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>

<?php
$this->registerJs(
    <<<JS
    (function($){
	var progress;
	var \$bar = $('.progress-bar');
	$(document).on('pjax:send', function(){
			\$bar.width(0);
			progress = setInterval(function() {
			$('.progress').addClass('active').removeClass('invisible');
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
		$('.progress').removeClass('active').addClass("invisible");
	});
})(jQuery);
JS
);
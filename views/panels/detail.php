<?php
use \Yii;
use \yii\helpers\Html;

?>
    <h1>Packaii
        <small>Information</small>
    </h1>
    <p>
        This is the debug status panel of packaii. Please visit the <?= Html::a('Go to dashboard', ['/packaii']) ?> for
        browsing packages.
    </p>

<h2>Status Checks</h2>
<?php if (!Yii::$app->getModule('packaii')->gitHubUsername || !Yii::$app->getModule('packaii')->gitHubPassword): ?>
    <?=
    $this->render(
        '@vendor/schmunk42/yii2-packaii/views/default/_alert',
        [
            'type'    => 'warning',
            'message' => '<strong>Important</strong> <p>In order to avoid github calls limitations, it is recommended
					that you configure <strong>Packaii::gitHubUsernanme</strong> and <strong>Packaii::gitHubPassword</strong>
					module on your config file.</p> <br> More information on ' .
                Html::a('GitHub Developer', 'https://developer.github.com/changes/2012-10-14-rate-limit-changes/')
        ]
    );?>
<?php else: ?>
    <?=
    $this->render(
        '@vendor/schmunk42/yii2-packaii/views/default/_alert',
        [
            'type'    => 'success',
            'message' => 'Everything is running fine.'
        ]
    );?>
<?php endif; ?>
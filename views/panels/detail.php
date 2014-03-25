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
<?php
if (\Yii::$app->getModule('packaii')->hasMessages()):
    foreach (\Yii::$app->getModule('packaii')->getMessages() as $message) {
        echo $this->render(
            '@vendor/schmunk42/yii2-packaii/views/default/_alert',
            $message
        );
    }
else:
    echo $this->render(
        '@vendor/schmunk42/yii2-packaii/views/default/_alert',
        [
            'type'    => 'success',
            'message' => 'Everything is configured correctly.'
        ]
    );
endif;
?>
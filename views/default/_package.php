<?php
use \yii\helpers\Html;
?>
<b>
    <?= Html::a($model->name,'#',['class'=>'package-link','data-packagename'=>$model->name]) ?>
    <span class="label label-success">installed</span>
</b>

<p>
    <?= $model->description ?>
</p>

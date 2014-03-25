<?php
use \yii\helpers\Html;

?>
<form id="<?= $id; ?>" class="form-inline" role="form" action="<?= $action; ?>">
    <div class="input-group">
        <?= Html::activeTextInput($model, 'name', ['class' => 'form-control', 'placeholder' => $placeholder]); ?>
        <span class="input-group-btn">
			<button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>&nbsp;
            </button>
		</span>
    </div>
</form>
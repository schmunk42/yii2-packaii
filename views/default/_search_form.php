<?php
 /**
 * 
 * _search_form.php
 *
 * Date: 24/02/14
 * Time: 11:07
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
?>
<form id="<?=$id;?>" class="form-inline" role="form" action="<?=$action;?>">
	<div class="input-group">
		<?= \yii\helpers\Html::activeTextInput($model, 'name', ['class' => 'form-control', 'placeholder' => $placeholder]);?>
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default">
				<span class="glyphicon glyphicon-search"></span>&nbsp;
			</button>
		</span>
	</div>
</form>
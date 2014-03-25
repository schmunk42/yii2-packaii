<?php
use \yii\helpers\Html;
use \yii\helpers\ArrayHelper;
use \yii\helpers\Markdown;
use \cebe\gravatar\Gravatar;

$version = ArrayHelper::getValue($model->packagistInfo->versions, $version, reset($model->packagistInfo->versions));
?>

<div class="row">
	<div class="col-lg-9">
		<h2>
            <span class="label label-<?= ($model->isRequired)?'success':'primary'?>"><?= $model->version; ?></span> <?= $model->name ?>
		</h2>
		<p class="lead">
            <?= Html::encode($model->description) ?>
			<?php if (isset($model->homepage)): ?>
				<div>
					<span class="glyphicon glyphicon-globe"></span> <?= Html::a($model->homepage, $model->homepage); ?>
				</div>
		    <?php endif; ?>
		</p>

	</div>
</div>

<div class="row">
	<div class="col-lg-9">


		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Readme</h3>
			</div>
			<div class="panel-body">
				<?=
				Markdown::process(
					base64_decode(ArrayHelper::getValue($readme, 'content', '')),
					'gfm'
				); ?>
			</div>
		</div>
	</div>

	<div class="col-md-3">

		<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#update-modal">

			<span class="glyphicon glyphicon-upload"></span>
		</button>
		<button type="submit" class="btn btn-default" data-toggle="modal" data-target="#configure-modal">
			<span class="glyphicon glyphicon-cog"></span>
		</button>
		<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#remove-modal">
			<span class="glyphicon glyphicon-remove"></span>
		</button>


		<h3><span class="label label-<?=
			($model->type == 'yii2-extension') ? 'primary' :
				'info' ?>"><?= $model->type ?></span>
		</h3>

		<p>
			<?= '<span class="label label-default">' . implode("</span><br/><span class='label label-default'>", $version->keywords) . '</span><br/>'; ?>
		</p>
		<?php
		// TODO: WE CANNOT REMOVE isset(), fires error if not defined.
		if (isset($model->authors)): ?>
			<h5>Maintainers</h5>
			<?php
			foreach ($model->authors AS $author) {
				echo "<p>";
				if (isset($author->email)) {
					echo Html::a(
							Gravatar::widget(
							[
								'email' => $author->email,
								'options' => [
									'alt' => (isset($author->name) ? $author->name : '')
								],
								'size' => 32
							]
						),
						(isset($author->homepage) ? $author->homepage : '#')
					);
				}
				echo " " . (isset($author->name) ? $author->name : '');
				echo "</p>";
			}
			?>
		<?php endif; ?>
	</div>
</div>

<!-- Modals -->
<?= $this->render('_modals', ['name' => $model->name]);

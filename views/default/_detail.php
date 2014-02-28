<?php
use \yii\helpers\Html;

$version = \yii\helpers\ArrayHelper::getValue($model->packagistInfo->versions, $version, reset($model->packagistInfo->versions));
?>

<div class="row">
	<div class="col-lg-9">
		<h2>
			<?= $model->name ?>
		</h2>
		<p class="lead">
			<?= $model->description ?>
			<?php if (isset($model->homepage)): ?> d
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
				\yii\helpers\Markdown::process(
					base64_decode(\yii\helpers\ArrayHelper::getValue($readme, 'content', '')),
					'gfm'
				); ?>
			</div>
		</div>
	</div>

	<div class="col-md-3">

		<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#update-modal">
			<?= $model->version; ?>
			<span class="glyphicon glyphicon-download"></span>
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
						\cebe\gravatar\Gravatar::widget(
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

<!-- Modal -->
<div class="modal fade" id="configure-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Configure <?= $model->name ?></h4>
			</div>
			<div class="modal-body">
				<p>
					tbd
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="install-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Install <?= $model->name ?></h4>
			</div>
			<div class="modal-body">
				<p>
					To install this extension please use the following commands
				</p>

				<p>
					<code>
						cd <?= realpath(\Yii::getAlias('@root')) ?><br/>
						composer.phar require <?= $model->name ?>
					</code>
				</p>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Update <?= $model->name ?></h4>
			</div>
			<div class="modal-body">
				<p>
					To update this extension please use the following commands
				</p>

				<p>

					<code>
						cd <?= realpath(\Yii::getAlias('@root')) ?><br/>
						composer.phar update <?= $model->name ?>
					</code>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="remove-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Remove <?= $model->name ?></h4>
			</div>
			<div class="modal-body">
				<p>
					To install this extension please use the following commands
				</p>

				<p>
					<code>
						cd <?= realpath(\Yii::getAlias('@root')) ?><br/>
						edit composer.json
					</code>
				</p>

				<p>
					And update your application
				</p>

				<p>
					<code>
						composer.phar update
					</code>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
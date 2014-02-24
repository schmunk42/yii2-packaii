<?php
use \yii\helpers\Html;
?>
<h2>
	<span class="label label-default"><?= $model->type ?></span>
	<?= $model->name ?>
	<span class="pull-right">
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#install-modal">
			<span class="glyphicon glyphicon-download-alt"></span></button>
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
    </span>
</h2>

<div class="">
	<p>
		<?php # TODO: fix model, return keywords from current version ?>
        <?= '<span class="label label-default">' . implode("</span> <span class='label label-success'>", reset($model->packagistInfo->versions)->keywords) . '</span>'; ?>
	</p>
	<p>
	<!-- Nav tabs -->
	<ul class="nav nav-pills">
		<li class="active">
			<a href="#info-panel" data-toggle="pill">Info</a>
		</li>
		<li>
			<a href="#readme-panel" data-toggle="pill">Readme</a>
		</li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="info-panel">
			<p></p>
			<?php if(isset($model->homepage)):?>
			<p>
				<span class="glyphicon glyphicon-globe"></span> <?=$model->homepage?>
			</p>
			<?php endif;?>
			<p class="lead">
				<?= $model->description ?>
			</p>
			<hr/>
			<h5>Maintainers</h5>
			<?php
            // TODO: remove isset(), $model->author undefined for yiisoft/jquery
			if (isset($model->authors)) foreach ($model->authors AS $author) {
				echo "<p>";
				if(isset($author->email))
				{
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
		</div>
		<div class="tab-pane" id="readme-panel">
			<p></p>
			<p>
				<?= \yii\helpers\Markdown::process(base64_decode(\yii\helpers\ArrayHelper::getValue($readme, 'content', '')), 'gfm');?>
			</p>
		</div>
	</div>
	</p>
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
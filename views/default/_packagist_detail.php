<?php
use \yii\helpers\Html;

?>

<div class="row">
	<div class="col-md-9">
		<h2>
			<?= $model->name ?>
		</h2>

		<p class="lead">
			<?= $model->description ?>
		</p>
	</div>
</div>

<div class="row">
	<div class="col-md-9">
		<div class="row">
			<?php foreach ($model->versions as $version => $info): ?>
				<div class="col-xs-6 col-md-6">
					<div class="well">
						<h4><?= $version ?>
							<small><?= implode(", ", $info->license) ?></small>
						</h4>
						<small><?= $info->time ?></small>

						<?php
						foreach ($info->authors AS $author) {
							echo "<p>";
							echo($author->name ? $author->name : '');
							if ($author->email) {

								echo " <" .
									Html::a(
										$author->email,
										($author->homepage ? $author->homepage : '#')
									)
									. ">";
							}
							echo "</p>";
						}
						?>

						<button type="submit" class="btn btn-success" data-toggle="modal" data-target="#install-modal">
							Install
							<span class="glyphicon glyphicon-download"></span>
						</button>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Readme</h3>
			</div>
			<div class="panel-body">
				<?= \yii\helpers\Markdown::process(base64_decode(\yii\helpers\ArrayHelper::getValue($readme, 'content', '')), 'gfm'); ?>
			</div>
		</div>

	</div>
	<div class="col-md-3">
		<h3>
			<span class="label label-default"><?= $model->type ?></span>
		</h3>

		<p>
			<?= '<span class="label label-default">' . implode("</span> <span class='label label-success'>", reset($model->versions)->keywords) . '</span>'; ?>
		</p>

		<h5>Downloads</h5>

		<p>
			<span class="label label-warning">Overall</span> <?= $model->downloads->total ?> installs<br/>
			<span class="label label-warning">This month</span> <?= $model->downloads->monthly ?> downloads<br/>
			<span class="label label-warning">Today</span> <?= $model->downloads->daily ?> downloads<br/>
		</p>


		<h5>Maintainers</h5>
		<?php
		foreach ($model->maintainers AS $author) {
			echo "<p>";
			if ($author->email) {
				echo Html::a(
					\cebe\gravatar\Gravatar::widget(
						[
							'email' => $author->email,
							'defaultImage' => 'monsterid',
							'options' => [
								'alt' => (isset($author->name) ? $author->name : '')
							],
							'size' => 32
						]
					),
					($author->homepage ? $author->homepage : '#')
				);
			}
			echo " " . ($author->name ? $author->name : '');
			echo "</p>";
		}
		?>
	</div>
</div>


<div class="">

	<hr/>

	<hr/>
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


			<hr/>

			<hr/>
			<h5>Versions</h5>

			<div class="row">

			</div>
			<hr/>
		</div>
		<div class="tab-pane" id="readme-panel">
			<p></p>

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
<div class="modal fade" id="remove-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
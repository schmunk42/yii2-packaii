<?php
use \Yii;
?>

<div class="modal fade" id="configure-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Configure <?= $name ?></h4>
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
				<h4 class="modal-title" id="myModalLabel">Install <?= $name ?></h4>
			</div>
			<div class="modal-body">
				<p>
					To install this extension please use the following commands
				</p>

				<p>
					<code>
						cd <?= realpath(Yii::getAlias('@root')) ?><br/>
						composer.phar require <?= $name ?>
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
				<h4 class="modal-title" id="myModalLabel">Update <?= $name ?></h4>
			</div>
			<div class="modal-body">
				<p>
					To update this extension please use the following commands
				</p>

				<p>

					<code>
						cd <?= realpath(Yii::getAlias('@root')) ?><br/>
						composer.phar update <?= $name ?>
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
				<h4 class="modal-title" id="myModalLabel">Remove <?= $name ?></h4>
			</div>
			<div class="modal-body">
				<p>
					To install this extension please use the following commands
				</p>

				<p>
					<code>
						cd <?= realpath(Yii::getAlias('@root')) ?><br/>
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
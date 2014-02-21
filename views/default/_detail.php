<?php

use \yii\helpers\Html;

?>

<h2>
    <span class="label label-primary"><?= $model->getType() ?></span>
    <?= $model->getName() ?>
    <span class="pull-right">
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#install-modal">
        <span class="glyphicon glyphicon-download-alt"></span></button>
    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#update-modal">
        1.2.34
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

    <p class="lead">
        <?php
        if (isset($model->getVersions()["dev-master"])) {
            foreach ($model->getVersions()["dev-master"]->getKeywords() AS $word) {
                echo "<span class='label label-default'>$word</span> ";
            }
        }
        ?>
    </p>

    <p class="lead">
        <?= $model->getDescription() ?>
    </p>

    <h5>Versions</h5>

    <p>
        <?php

        foreach ($model->getVersions() AS $version) {
            #$activeVersion = ($model->version == $version->getVersion()) ? true : false;
            $activeVersion = false;

            $labelClass = 'label-default';
            if (substr($version->getVersion(), 0, 3) == 'dev') {
                $labelClass = "label-warning";
            }
            # elseif (version_compare($model->version, $version->getVersion()) == -1) {
            #   $labelClass = "label-info";
            #}
            $labelClass = ($activeVersion) ? 'label-primary' : $labelClass;

            echo "<span class='label $labelClass'>";
            echo $version->getVersion();
            echo "</span> ";
        };

        ?>
    </p>


    <h5>Maintainers</h5>

    <p class="lead">
        <?php
        foreach ($model->getMaintainers() AS $person) {
            echo Html::a(
                     \cebe\gravatar\Gravatar::widget(
                                            [
                                            'email'   => $person->getEmail(),
                                            'options' => [
                                                'alt' => $person->getName()
                                            ],
                                            'size'    => 32
                                            ]
                     ),
                         $person->getHomepage()
            );
            echo " " . $person->getName() . " ";
        }
        ?>
    </p>


    <h5>Readme</h5>
    <p>
        tbd
    </p>

    <h5>Debug</h5>
    <pre><?= var_dump($model); ?></pre>
</div>

<!-- Modal -->
<div class="modal fade" id="configure-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Configure <?= $model->getName() ?></h4>
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
                <h4 class="modal-title" id="myModalLabel">Install <?= $model->getName() ?></h4>
            </div>
            <div class="modal-body">
                <p>
                    To install this extension please use the following commands
                </p>

                <p>
                    <code>
                        cd <?= realpath(\Yii::getAlias('@root')) ?><br/>
                        composer.phar require <?= $model->getName() ?>
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
                <h4 class="modal-title" id="myModalLabel">Update <?= $model->getName() ?></h4>
            </div>
            <div class="modal-body">
                <p>
                    To update this extension please use the following commands
                </p>

                <p>

                    <code>
                        cd <?= realpath(\Yii::getAlias('@root')) ?><br/>
                        composer.phar update <?= $model->getName() ?>
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
                <h4 class="modal-title" id="myModalLabel">Remove <?= $model->getName() ?></h4>
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
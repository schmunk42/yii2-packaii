<?php
use \yii\helpers\Html;
use \yii\helpers\Markdown;
use \yii\helpers\ArrayHelper;
use \cebe\gravatar\Gravatar;

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

                            <button type="submit" class="btn btn-success" data-toggle="modal"
                                    data-target="#install-modal">
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
                    <?= Markdown::process(base64_decode(ArrayHelper::getValue($readme, 'content', '')), 'gfm'); ?>
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <h3>
                <span class="label label-default"><?= $model->type ?></span>
            </h3>

            <p>
                <?=
                '<span class="label label-default">' . implode(
                    "</span> <span class='label label-success'>",
                    reset($model->versions)->keywords
                ) . '</span>'; ?>
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
                        Gravatar::widget(
                            [
                                'email'        => $author->email,
                                'defaultImage' => 'monsterid',
                                'options'      => [
                                    'alt' => (isset($author->name) ? $author->name : '')
                                ],
                                'size'         => 32
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


    <!-- Modal -->
<?= $this->render('_modals', ['name' => $model->name]);
<div class="packaii-default-index">
    <h1>Packaii
        <small>composer package browser</small>
    </h1>

    <div class="row">
        <div class="col-md-8">
            <div id="detail-panel">
                <h2>
                    Repository Statistics
                    <span class="pull-right">
                        <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#update-modal">
                            Update Application
                            <span class="glyphicon glyphicon-download"></span>
                        </button>
                    </span>
                </h2>
                <p class="well">
                    14 Packages, 8 Dev-Packages, Composer Hash: 819be91903
                </p>

            </div>
        </div>
        <div class="col-md-4">
            <p>

            <form class="form-inline" role="form">

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <select class="form-control">
                    <option>All</option>
                    <option>Yii 2.0</option>
                    <option>Installed</option>
                </select>
                <button type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </form>
            </p>

            <?=
            \yii\widgets\ListView::widget(
                                 [
                                 'dataProvider' => $dataProvider,
                                 'itemView'     => '_package'
                                 ]
            );
            ?>
        </div>
    </div>
</div>

<?php

// TODO: move to JavaScript Asset/Module/Package

$url = \yii\helpers\Html::url(['detail']);
$js = <<< EOS
    jQuery('A.package-link').click(function(){
            $.ajax({
            url: "{$url}",
            data: {
                //packagename: 'schmunk42/packaii',
                packagename: $(this).data('packagename')
            },
            type: "GET",
            dataType: "html",
            beforeSend: function() {
                $('#detail-panel').fadeOut();
            },
            success: function (data) {
                var result = $('<div />').append(data).find('#showresults').html();
                $('#detail-panel').hide().html(data).fadeIn();
            },
            error: function (xhr, status) {
                alert("Sorry, there was a problem!");
            },
            complete: function (xhr, status) {
                //$('#showresults').slideDown('slow')
            }
        });
    });
EOS;
?>

<?php $this->registerJs($js, \yii\web\View::POS_READY); ?>
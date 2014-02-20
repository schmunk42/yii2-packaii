<div class="packaii-default-index">
    <h1>Packaii <small>composer package browser</small>
    <?= \yii\helpers\Html::a('Selfupdate',['','selfupdate'=>true],['class'=>'btn btn-warning']) ?></h1>

    <div class="row">
        <div class="col-md-8">
            <p>
                <?=
                \yii\grid\GridView::widget(
                                  [
                                  'dataProvider' => $dataProvider,
                                  'columns'      => [
                                      'name'        => [
                                          'class'   => '\yii\grid\Column',
                                          'content' => array(
                                              '\schmunk42\packaii\components\GridFormatter',
                                              'name'
                                          )
                                      ],
                                      'description' => [
                                          'class'   => '\yii\grid\Column',
                                          'content' => array(
                                              '\schmunk42\packaii\components\GridFormatter',
                                              'description'
                                          )
                                      ],
                                      'downloads'   => [
                                          'class'   => '\yii\grid\Column',
                                          'content' => array(
                                              '\schmunk42\packaii\components\GridFormatter',
                                              'downloads'
                                          )
                                      ],
                                  ]
                                  ]
                );
                ?>
            </p>
        </div>
    </div>
</div>

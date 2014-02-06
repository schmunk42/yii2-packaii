<div class="packageBrowser-default-index">
    <h1>Package Browser</h1>

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
                                              '\schmunk42\packageBrowser\components\GridFormatter',
                                              'name'
                                          )
                                      ],
                                      'description' => [
                                          'class'   => '\yii\grid\Column',
                                          'content' => array(
                                              '\schmunk42\packageBrowser\components\GridFormatter',
                                              'description'
                                          )
                                      ],
                                      'downloads'   => [
                                          'class'   => '\yii\grid\Column',
                                          'content' => array(
                                              '\schmunk42\packageBrowser\components\GridFormatter',
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

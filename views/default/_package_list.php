<?php

echo \yii\widgets\ListView::widget(
    [
        // TODO fixme - 'emptyText'    => $this->render('_alert', ['type' => 'info', 'message' => 'No results found']),
        'dataProvider' => $dataProvider,
        'itemView'     => '/default/_package'
    ]
);
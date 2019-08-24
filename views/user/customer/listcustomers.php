<?php

namespace app\views\user\customers;

use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,

]);


?>
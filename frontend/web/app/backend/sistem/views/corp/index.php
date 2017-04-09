<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\backend\sistem\models\CorpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Corps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Corp'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'ACCESS_UNIX:ntext',
            'CORP_NM',
            'ALAMAT:ntext',
            'MAP_LAG',
            // 'MAP_LAT',
            // 'STATUS',
            // 'CREATE_BY',
            // 'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

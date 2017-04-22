<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\hris\models\EmployeDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employe Datas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employe-data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Employe Data', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
            // 'STATUS',
            // 'EMP_ID',
            // 'ACCESS_UNIX',
            // 'OUTLET_CODE',
            // 'EMP_NM_DPN',
            // 'EMP_NM_TGH',
            // 'EMP_NM_BLK',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

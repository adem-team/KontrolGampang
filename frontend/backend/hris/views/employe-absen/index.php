<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\backend\hris\models\EmployeAbsenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employe Absens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employe-absen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Employe Absen', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'TGL',
            // 'TIME',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

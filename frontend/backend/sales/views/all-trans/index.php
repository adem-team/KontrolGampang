<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\backend\master\models\ItemFdiscountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Fdiscounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-fdiscount-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Fdiscount', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // ACCESS_UNIX_STORE, 
			// ACCESS_UNIX_ITEM,
			// OUTLET_CODE,
			'OUTLET_NM',
			// STORE_STT,
			// DATE_START,
			// DATE_END,
			// ITEM_ID,
			'ITEM_NM',
			'SATUAN',
			//'DEFAULT_STOCK',
			// DEFAULT_HARGA,
			// ITEM_STT,
			// STORE_CREARE_BY,STORE_CREARE_AT,STORE_UPDATE_BY, STORE_UPDATE_AT,
			// ITEM_CREARE_BY,ITEM_CREARE_AT, ITEM_UPDATE_BY, ITEM_UPDATE_AT

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

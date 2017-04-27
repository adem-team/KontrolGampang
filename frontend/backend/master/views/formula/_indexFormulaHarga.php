<?php
use yii\helpers\Html;
use kartik\widgets\Select2;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use kartik\widgets\Spinner;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\FileInput;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use yii\web\View;
use frontend\backend\master\models\ItemJual;
use frontend\backend\master\models\ItemJualSearch;

	$searchModel = new ItemJualSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
?>
<div style="min-height:500px; font-family: tahoma ;font-size: 9pt;">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Jual', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
		'id'=>'gv-formula-harga',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID',
            //'CREATE_BY',
            //'CREATE_AT',
            //'UPDATE_BY',
            //'UPDATE_AT',
            // 
            // 'ITEM_ID',
            // 'OUTLET_CODE',
             'PERIODE_TGL1',
             'PERIODE_TGL2',
             'START_TIME',
             'HARGA_JUAL',
			 'STATUS',
            // 'DCRIPT:ntext',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

	

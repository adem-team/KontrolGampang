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
use yii\web\Request;

use frontend\backend\master\models\ItemJual;
use frontend\backend\master\models\ItemJualSearch;

	$searchModel = new ItemJualSearch(['ITEM_ID'=>$paramCariItem]);
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	$bColorHarga='rgba(87,114,111, 1)';

	$gvAttHarga=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No.',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColorHarga,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
		//ITEM NAME
		[
			'attribute'=>'ITEM_ID',
			//'label'=>'Cutomer',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorHarga)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorHarga),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]	
		,//HARI
		[
			'attribute'=>'PERIODE_TGL1',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorHarga)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorHarga),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		]	
		,//HARI
		[
			'attribute'=>'PERIODE_TGL2',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorHarga)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorHarga),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]	
		,//PERIODE_TGL1
		[
			'attribute'=>'HARGA_JUAL',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorHarga)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorHarga),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]	
		,//PERIODE_TGL2
		[
			'attribute'=>'STATUS',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColorHarga)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColorHarga),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),			
		]	
	
	];

	$gvHargaPerStore=GridView::widget([
		'id'=>'gv-harga-per-store',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttHarga,	
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-harga-per-store',
		    ],						  
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>true,
		'bordered'=>true,
		'striped'=>true,
		'autoXlFormat'=>true,
		'export' => false,
		'panel'=>false,
		'toolbar' => false,
		'panel' => [
			//'heading'=>false,
			//'heading'=>tombolBack().'<div style="float:right"> '.tombolCreate().' '.tombolExportExcel().'</div>',  
			//'heading'=>tombolBack().' '.$pageNm,  
			'type'=>'info',
			//'before'=> tombolBack().'<div style="float:right"> '.tombolCreate().' '.tombolExportExcel().'</div>',
			//'before'=> tombolBack(),
			'before'=>false,
			'showFooter'=>false,
		],
		
		'summary'=>false,
		'floatOverflowContainer'=>true,
		'floatHeader'=>true,
	]); 
	
?>
<?=$gvHargaPerStore?>
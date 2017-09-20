<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use kartik\builder\Form;
use yii\helpers\Url;
use yii\data\ArrayDataProvider;

	$headerColor='rgba(128, 179, 178, 1)';

	/*
	 * GRIDVIEW COLUMN
	 * @author ptrnov [ptr.nov@gmail.com]
	 * @since 1.2
	*/	
				
	$attDinamikMenu[]=[	
		'class'=>'kartik\grid\ExpandRowColumn',
		'width'=>'10px',
		'header'=>'<span class="glyphicon glyphicon glyphicon-th-list"></span>',
		'mergeHeader'=>true,
		'allowBatchToggle'=>false,			
		'value'=>function ($model, $key, $index, $column) {
			return GridView::ROW_COLLAPSED;
		},
		'expandOneOnly'=>true,
		'expandIcon'=>'<span class="glyphicon glyphicon-chevron-right"></span>',
		'collapseIcon'=>'<span class="glyphicon glyphicon-chevron-down"></span>',
		'expandTitle'=>'Click Icon',
		'collapseTitle'=>'Click Icon',			
		//'detailUrl'=>'/master/store/expand-detail',
		//'expandRowKey'=>'1',
		'detail'=>function ($model, $key, $index, $column){
			$id=$model['id'];
			$storeId=$model['STORE_ID']	;
			if($id==1){ 
			//== Detail Toko ==
			//$modelToko=Store::find()->where(['STORE_ID'=>])->all();
			return Yii::$app->controller->renderPartial('_detailToko',[
				'storeId'=>$storeId,
				'data'=>$model,
				//'modelToko'=>$modelToko
			]);
			}elseif($id==2){
				//== Detail Prodak==
				return Yii::$app->controller->renderPartial('_detailProduk',[
					'storeId'=>$storeId,
					// 'data'=>$_POST['expandRowKey']
				]);
			}elseif($id==3){
				//== Detail Pelanggan==
				return Yii::$app->controller->renderPartial('_detailPelanggan',[
					'storeId'=>$storeId,
					//'data'=>$_POST['expandRowKey']
				]);
			}elseif($id==4){
				//== Detail Karyawan==
				return Yii::$app->controller->renderPartial('_detailKaryawan',[
					'storeId'=>$storeId,
					//'data'=>$_POST['expandRowKey']
				]);
			}elseif($id==5){
				//== Detail User Operatioal==
				return Yii::$app->controller->renderPartial('_detailUserOps',[
					'storeId'=>$storeId,
					//'data'=>$_POST['expandRowKey']
				]);
			}
			
			
			/* //$searchModelDetail = new AbsenPayrollSearch(['IN_TGL'=>$model['IN_TGL'],'KAR_ID'=>$model['KAR_ID']]);
			$modelPrd=AbsenImportPeriode::find()->where(['TIPE'=>'1','AKTIF'=>'1'])->one();
			$closingParam=['tglStart'=>$modelPrd->TGL_START,'tglEnd'=>$modelPrd->TGL_END];
			//$closingParam=['tglStart'=>'2017-09-08','tglEnd'=>'2017-09-14'];
			$searchModelDetail = new AbsenPayrollSearch($closingParam);
			$dataProviderDetail = $searchModelDetail->searchHeader(['AbsenPayrollSearch'=>['KAR_ID'=>$model['KAR_ID']]]);
			//$dataProviderDetail=$searchModelDetail->searchdetails(Yii::$app->request->queryParams);
			// return Yii::$app->controller->renderPartial('_dailyAbsensiDetail',[
				// 'searchModelDetail'=>$searchModelDetail,
				// 'dataProviderDetail'=>$dataProviderDetail
			// ]);
			return Yii::$app->controller->renderPartial('_dailyAbsensiIndexExpand',[
				'searchModelDetail'=>$searchModelDetail,
				'dataProviderDetail'=>$dataProviderDetail,
				'model'=>$model
			]); */
			//return 'asd';
		},
		'headerOptions'=>[
			'style'=>[
				'text-align'=>'center',
				'width'=>'10px',
				'font-family'=>'verdana, arial, sans-serif',
				'font-size'=>'10pt',
				'background-color'=>$headerColor,
				'color'=>'white',
			]
		],
		'contentOptions'=>[
			'style'=>[
				'text-align'=>'center',
				'width'=>'10px',
				'font-family'=>'tahoma, arial, sans-serif',
				'font-size'=>'10pt',
			]
		],			
	];
	$attDinamikMenu[] =[
		'attribute'=>'TITTLE_NM',
		'filterType'=>true,
		'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
		'hAlign'=>'right',
		'vAlign'=>'middle',
		'header'=>$storeNm,
		'mergeHeader'=>true,
		'format'=>'html',
		'noWrap'=>false,
		'format'=>'raw',
		// 'value'=>function($data) {				
				// return Html::tag('div', $data->STORE_NM, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
		// },
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$headerColor),
		'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),			
	];
	
	/* $attDinamikMenu[] =[
		'attribute'=>'STORE_ID',
		'filterType'=>true,
		'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
		'hAlign'=>'right',
		'vAlign'=>'middle',
		'header'=>'INFO TOKO',
		'mergeHeader'=>true,
		'format'=>'html',
		'noWrap'=>false,
		'format'=>'raw',
		// 'value'=>function($data) {				
				// return Html::tag('div', $data->STORE_NM, ['data-toggle'=>'tooltip','data-placement'=>'left','title'=>'Double click to Outlet Items ','style'=>'cursor:default;']);				
		// },
		'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$headerColor),
		'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),			
	]; */
	
	
	$expandMenu= GridView::widget([
		'id'=>'expand-menu',
		'dataProvider' => $dataProviderMenu,
		//'filterModel' => $searchModelFinger,
		//'filterRowOptions'=>['style'=>'background-color:rgba(97, 211, 96, 0.3); align:center'],				
		'columns' =>$attDinamikMenu,
		'toolbar' => [
			'{export}',
		],
		'panel'=>false,		
		// 'panel'=>[
			// 'heading'=>'<h3 class="panel-title">INFO DATA TOKO</h3>',
			// 'type'=>'default',
			// 'before'=>false,
			// 'footer'=>false,
		// ],
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'expand-menu',
			],
		],
		'bootstrap'=>true,
		'hover'=>true, //cursor select
		'responsive'=>true,
		'bordered'=>true,
		'striped'=>true,
		//'autoXlFormat'=>true,
		'export'=>[//export like view grid --ptr.nov-
			'fontAwesome'=>true,
			'showConfirmAlert'=>false,
			'target'=>GridView::TARGET_BLANK
		],
		'summary'=>false,
		// 'floatHeader'=>true,
		//'floatHeaderOptions'=>['scrollingTop'=>'200'] 
	]);

?>

	<?=$expandMenu?>
    <?php //echo '<div>'.$dscLabel.'</div><div>'.$dscAction.'</div>'?>
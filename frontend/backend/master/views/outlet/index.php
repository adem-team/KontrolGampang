<?php
use yii\helpers\Html;
use kartik\widgets\Select2;
use kartik\grid\GridView;
use kartik\widgets\FileInput;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\Pjax;
use yii\web\View;

use common\models\Locate;
$this->registerCss("
	:link {
		color: #fdfdfd;
	}
	/* mouse over link */
	a:hover {
		color: #5a96e7;
	}
	/* selected link */
	a:active {
		color: blue;
	}
");
 
$this->title = Yii::t('app', 'ESM - Marketing Dashboard');      /* title pada header page */
$this->params['breadcrumbs'][] = $this->title;  
$this->registerJs($this->render('modal_store.js'),View::POS_READY);
echo $this->render('modal_store'); //echo difinition

	$aryStt= [
		  ['STATUS' => 0, 'STT_NM' => 'DISABLE'],		  
		  ['STATUS' => 1, 'STT_NM' => 'ENABLE']
	];	
	$valStt = ArrayHelper::map($aryStt, 'STATUS', 'STT_NM');
	
	$bColor='rgba(87,114,111, 1)';
	$gvAttributeItem=[
		[
			'class'=>'kartik\grid\SerialColumn',
			'contentOptions'=>['class'=>'kartik-sheet-style'],
			'width'=>'10px',
			'header'=>'No',
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','30px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','30px',''),
		],
		//KD_BARCODE
		[
			'attribute'=>'OUTLET_CODE',
			'filterType'=>false,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],
		//OUTLET_NM
		[
			'attribute'=>'OUTLET_NM',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'format'=>'html',
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),
			
		],		
		//PROVINCE
		[
			'attribute'=>'ProvinsiNm',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],		
		//CITY
		[
			'attribute'=>'KotaNm',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],			
		//STORE PIC.
		[
			'attribute'=>'PIC',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','100px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','100px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','100px',''),
			
		],		
		//STORE TLP.
		[
			'attribute'=>'TLP',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],		
		//STORE FAX.
		[
			'attribute'=>'FAX',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],	
		//ALAMAT.
		[
			'attribute'=>'ALAMAT',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','250px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','250px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','250px',''),
			
		],		
		//EXPIRED.
		[
			'attribute'=>'EXPIRED',
			'label'=>'EXPIRED',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'value'=>function($model){
				return $model->EXPIRED . ' days';
			},
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('right','50px',''),
			
		],			
		//CREATE_AT
		/* [
			'attribute'=>'CREATE_AT',
			'filterType'=>GridView::FILTER_DATE,
			'filterWidgetOptions'=>[
				'pluginOptions' =>Yii::$app->gv->gvPliginDate(),
				'layout'=>'{picker}{remove}{input}'
			],
			'filter'=>true,
			'value'=>function($model){
				if ($model->CREATE_AT!=''){
					return $model->CREATE_AT;
				}else{
					return '';
				}
			},
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],
		//CREATE_BY
		[
			'attribute'=>'CREATE_BY',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		],	 */	
		//UPDATE_BY
	/* 	[
			'attribute'=>'UPDATE_BY',
			'filterType'=>true,
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'middle',
			'mergeHeader'=>false,
			'noWrap'=>false,
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50px',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('left','50px',''),
			
		], */
		//'STATUS',
		[
			'attribute'=>'STATUS',
			'filterType'=>GridView::FILTER_SELECT2,
			'filterWidgetOptions'=>[
				'pluginOptions' =>Yii::$app->gv->gvPliginSelect2(),
			],
			'filterInputOptions'=>['placeholder'=>'Select'],
			'filter'=>$valStt,//Yii::$app->gv->gvStatusArray(),
			'filterOptions'=>Yii::$app->gv->gvFilterContainHeader('0','50px'),
			'hAlign'=>'right',
			'vAlign'=>'top',
			'mergeHeader'=>false,
			'noWrap'=>false,
			'format' => 'raw',	
			'value'=>function($model){
				 if ($model->STATUS == 0) {
				  return Html::a('
					<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-close fa-stack-1x" style="color:#0f39ab"></i>
					</span>','',['title'=>'Running']);
				} else if ($model->STATUS == 1) {
				  return Html::a('<span class="fa-stack fa-xl">
					  <i class="fa fa-circle-thin fa-stack-2x"  style="color:#25ca4f"></i>
					  <i class="fa fa-check fa-stack-1x" style="color:#ee0b0b"></i>
					</span>','',['title'=>'Finish']);
				}
			},
			//gvContainHeader($align,$width,$bColor)
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','50',$bColor),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','50','')			
		],
		//ACTION
		[
			'class' => 'kartik\grid\ActionColumn',
			'template' => '{view}{edit}{reminder}{deny}',
			'header'=>'ACTION',
			'dropdown' => true,
			'dropdownOptions'=>[
				'class'=>'pull-right dropdown',
				'style'=>'width:60px;background-color:#E6E6FA'				
			],
			'dropdownButton'=>[
				'label'=>'ACTION',
				'class'=>'btn btn-default btn-xs',
				'style'=>'width:100%;'		
			],
			'buttons' => [
				'view' =>function ($url, $model){
				  return  tombolView($url, $model);
				},
				'edit' =>function($url, $model,$key){
					//if($model->STATUS!=1){ //Jika sudah close tidak bisa di edit.
						return  tombolReview($url, $model);
					//}					
				},
				'deny' =>function($url, $model,$key){
					return  tombolDeny($url, $model);
				}

			],
			'headerOptions'=>Yii::$app->gv->gvContainHeader('center','10px',$bColor,'#ffffff'),
			'contentOptions'=>Yii::$app->gv->gvContainBody('center','10px',''),
		]
	];

	$gvStore=GridView::widget([
		'id'=>'gv-store',
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns'=>$gvAttributeItem,				
		'pjax'=>true,
		'pjaxSettings'=>[
			'options'=>[
				'enablePushState'=>false,
				'id'=>'gv-store',
		    ],						  
		],
		'hover'=>true, //cursor select
		'responsive'=>true,
		'responsiveWrap'=>true,
		'bordered'=>true,
		'striped'=>true,
		'autoXlFormat'=>true,
		'export' => false,
		'panel'=>[''],
		'toolbar' => [
			''
		],
		'summary'=>false,
		'panel' => [
			//'heading'=>false,
			'heading'=>'
				<span class="fa-stack fa-sm">
				  <i class="fa fa-circle-thin fa-stack-2x" style="color:#25ca4f"></i>
				  <i class="fa fa-television fa-stack-1x"></i>
				</span> List Outlet'.'   <div style="float:right">'. tombolReqStore().'</div>',  
			'type'=>'info',
			//'before'=> tombolCreate().' '.tombolRefresh().' '.tombolExportExcel(),
			//'before'=> tombolReqStore(),
			'showFooter'=>false,
		],
		// 'floatOverflowContainer'=>true,
		// 'floatHeader'=>true,
	]); 
	
?>
<div class="container-fluid" style="font-family: verdana, arial, sans-serif ;font-size: 8pt">
	<div class="col-xs-12 col-sm-12 col-lg-12" style="font-family: tahoma ;font-size: 9pt;">
		<div class="row">
			<?=$gvStore?>
		</div>
		</br>
		<?php
		$items = [
			
			[
				'text' => 'Folder 2',
				'nodes' => [
					['text' => 'Node 2.1',
						'state' => [
							'checked' => true,
							'disabled' => false,
							'expanded' => false,
							'selected' => true
						],
						'nodes' =>[
							[	'text' => 'Node 2.2',
								'href' => "#node-1",
								'icon' => "glyphicon glyphicon-stop",
								'selectedIcon' => "glyphicon glyphicon-stop",
								'selectable' => false,
								'state' => [
									'checked' => true,
									'disabled' => false,
									'expanded' => true,
									'selected' => true
								],
							],
							[	'text' => 'Node 2.3',
								'href' => "#node-2",
								'icon' => "glyphicon glyphicon-stop",
								'selectedIcon' => "glyphicon glyphicon-stop",
								'selectable' => false,
								'state' => [
									'checked' => true,
									'disabled' => false,
									'expanded' => true,
									'selected' => true
								],
							
							]
						]
					],
					['text' => 'Node 2.4']
				]
			]
		];
		
		$trev=\lesha724\bootstraptree\TreeView::widget([
				'htmlOptions'=>[
							'id'=>'treeview-tabs'
				],
				'options'=>[
					'data'=>$items,
					'enableLinks'=>true,
					'showTags'=>true,
					'levels'=>3
				],
				'events'=>[
					'onNodeSelected'=>'function(event, data) {
						// Your logic goes here
						alert(data.href);
					}'
				]
			]);	 
		?>
		<?=$trev?>
	</div>
</div>
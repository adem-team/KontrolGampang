<?php

namespace api\modules\hirs\controllers;

use yii;
use yii\helpers\Json;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

use api\modules\hirs\models\EmployeData;
use api\modules\hirs\models\EmployeDataSearch;

class EmployeDataController extends ActiveController
{
    public $modelClass = 'api\modules\hirs\models\EmployeData';
	public $serializer = [
		'class' => 'yii\rest\Serializer',
		'collectionEnvelope' => 'employee',
	];

	public function behaviors(){
        return ArrayHelper::merge(parent::behaviors(), [
           /*  'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    ['class' => HttpBearerAuth::className()],
                    // ['class' => QueryParamAuth::className(), 'tokenParam' => 'access-token'],
                ],
                'except' => ['options']
            ],  */
			'bootstrap'=> [
				'class' => ContentNegotiator::className(),
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
				],
			],
			'corsFilter' => 
            [
                'class' => \yii\filters\Cors::className(),
                'cors' => 
                [
                    // restrict access to
                    'Origin' =>['*'],// ['http://ptrnov-erp.dev', 'https://ptrnov-erp.dev'],
                    'Access-Control-Request-Method' => ['GET','POST', 'PUT','OPTIONS'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Headers' => ['*'],
                    // Allow only headers 'X-Wsse'
                    'Access-Control-Allow-Credentials' => true,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age' => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
                ],

            ],
            //'exceptionFilter' => [
            //    'class' => ErrorToExceptionFilter::className()            ],
        ]);
    }
	
	public function actions()
    {		
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function () {					
					$param=["EmployeDataSearch"=>Yii::$app->request->queryParams];
					//return $param;
                    $searchModel = new EmployeDataSearch();
					return $searchModel->search($param);
                },
            ],
        ];
    }
	
	public function actionCreate()
    {
        $model = new EmployeData();
		$params     = $_REQUEST;        
        $model->attributes=$params;
        $model->CREATE_AT = date('Y:m:d H:i:s');//'2017-12-12 00:00';
        $model->UPDATE_AT = date('Y:m:d H:i:s');//'2017-12-12 00:00';
        if ($model->save()) 
        {
            return $model->attributes;
        } 
        else
        {
            return array('errors'=>$model->errors);
        } 
    }
}

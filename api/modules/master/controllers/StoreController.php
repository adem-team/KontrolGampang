<?php

namespace api\modules\master\controllers;

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
use api\modules\login\models\UserloginSearch;
use common\models\User;
use common\models\StoreSearch;
//use yii\web\User;

//use yii\data\ActiveDataProvider;

/**
  * Data user login by Token.
  *
  * @author ptrnov  <piter@lukison.com>
  * @since 1.1
  * CMD : curl -i http://api.kontrolgampang.int/login/users -H "Authorization: Bearer Yt4kLWLYlQf9OfnFSpZ5IO3128Gvw2gP"
 */
class StoreController extends ActiveController
{	
	/**
	  * Source Database declaration 
	 */
    //public $modelClass = 'common\models\User';
    public $modelClass = 'common\models\StoreSearch';
	public $serializer = [
		'class' => 'yii\rest\Serializer',
		'collectionEnvelope' => 'store',
	];
	
	/* public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        parent::beforeAction($action);

        if (Yii::$app->getRequest()->getMethod() === 'OPTIONS') {
            // End it, otherwise a 401 will be shown.
            Yii::$app->end();
        }

        return true;
    } */
	/**
     * @inheritdoc
     */
    public function behaviors()    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => 
            [
                'class' => CompositeAuth::className(),
				//'except' => ['token'],
                'authMethods' => 
                [
                    #Hapus Tanda Komentar Untuk Autentifikasi Dengan Token               
					 ['class' => HttpBearerAuth::className()]
                ]
            ],
			'bootstrap'=> 
            [
				'class' => ContentNegotiator::className(),
				'formats' => 
                [
					'application/json' => Response::FORMAT_JSON,
				],
			],
			'corsFilter' => [
				'class' => \yii\filters\Cors::className(),
				'cors' => [
					// restrict access to
					//'Origin' => ['http://lukisongroup.com', 'http://lukisongroup.int','http://localhost','http://103.19.111.1','http://202.53.354.82'],
					'Origin' => ['*'],
					'Access-Control-Request-Method' => ['POST', 'PUT','GET'],
					//'Access-Control-Request-Headers' => ['*'],
					// Allow only POST and PUT methods
					'Access-Control-Request-Headers' => ['X-Wsse'],
					'Access-Control-Allow-Headers' => ['X-Requested-With','Content-Type'],
					// Allow only headers 'X-Wsse'
					'Access-Control-Allow-Credentials' => true,
					// Allow OPTIONS caching
					'Access-Control-Max-Age' => 3600,
					// Allow the X-Pagination-Current-Page header to be exposed to the browser.
					'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page']
					]		 
			],
        ]);		
    }

	
	public function actions()
    {		
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function () {					
					$param=["StoreSearch"=>Yii::$app->request->queryParams];
					//return $param;
                    $searchModel = new StoreSearch();
					return $searchModel->searchUserStore($param);
                },
            ],
        ];
    }	 
}



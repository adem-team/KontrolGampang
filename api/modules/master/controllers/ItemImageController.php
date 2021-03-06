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
use api\modules\master\models\ItemImageSearch;


/**
  * Data user login by Token.
  *
  * @author ptrnov  <piter@lukison.com>
  * @since 1.1
  * CMD : curl -i http://api.kontrolgampang.int/login/users -H "Authorization: Bearer Yt4kLWLYlQf9OfnFSpZ5IO3128Gvw2gP"
  *   http://api.kontrolgampang.com/master/stores?ACCESS_UNIX=20170404081601
 */
class ItemImageController extends ActiveController
{	
	public $enableCsrfValidation = false;
	/**
	  * Source Database declaration 
	 */
    //public $modelClass = 'common\models\User';
    public $modelClass = 'api\modules\master\models\ItemImageSearch';
	public $serializer = [
		'class' => 'yii\rest\Serializer',
		'collectionEnvelope' => 'itemimage',
	];

	public static function allowedDomains(){
		return [
			 '*',                        // star allows all domains
			// 'http://localhost:8100',
			// 'http://localhost:3000',
			// 'localhost:3000',
			// 'localhost:8100',
		];
	}
	
	/**
     * @inheritdoc
     */
    public function behaviors()    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    //['class' => HttpBearerAuth::className()],
                    // ['class' => QueryParamAuth::className(), 'tokenParam' => 'access-token'],
                ],
                'except' => ['options']
            ],
			'bootstrap'=> [
				'class' => ContentNegotiator::className(),
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
				],
			],
			'corsFilter' => [
				'class' => \yii\filters\Cors::className(),
				'cors' => [
					// restrict access to
					//'Origin' => ['http://lukisongroup.com', 'http://lukisongroup.int','http://localhost','http://103.19.111.1','http://202.53.354.82'],
					'Origin' =>static::allowedDomains(),
					'Access-Control-Request-Method' => ['POST', 'GET', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
					//'Access-Control-Request-Headers' => ['*'],
					'Access-Control-Request-Headers' => ['*'],
					// Allow only headers 'X-Wsse'
					'Access-Control-Allow-Credentials' => false,
					// Allow OPTIONS caching
					'Access-Control-Max-Age' => 3600,
				]		 
			]
        ]);
    }

	
	
	public function actions()
    {		
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function () {					
					$param=["ItemImageSearch"=>Yii::$app->request->queryParams];
					//return $param;
                    $searchModel = new ItemImageSearch();
					return $searchModel->searchByDateTime($param);
                },
            ],
        ];
    }
}



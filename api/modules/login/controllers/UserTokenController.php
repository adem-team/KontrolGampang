<?php

namespace api\modules\login\controllers;

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
use api\modules\login\models\UserTokenSearch;
use common\models\User;

/**
  * LOGIN AND CHECK TOKEN USER.
  * auth_key		: Token Primary.
  * access_token 	: Token Access, after login for Access Api data POST,GET,PUT.
  * @author ptrnov  <piter@lukison.com>
  * @since 1.2
  * CMD : curl -u username:password http://api.kontrolgampang.int/login/user-tokens?username=trial1
  * CMD : curl -u trial1:semangat2016 http://api.kontrolgampang.int/login/user-tokens?username=trial1
 */
class UserTokenController extends ActiveController
{	
	/**
	  * Source Database declaration.
	  *
	 */
    //public $modelClass = 'common\models\User';
    public $modelClass = 'api\modules\login\models\UserTokenSearch';
	// public $serializer = [
		// 'class' => 'yii\rest\Serializer',
		//'collectionEnvelope' => 'User',
		//'linksEnvelope'=> false,
	// ];	
	
	/**
     * Behaviors
	 * Mengunakan Auth HttpBasicAuth.
	 * Chacking Login.
     */
    public function behaviors()    {
        return ArrayHelper::merge(parent::behaviors(), [
            /* 'authenticator' => 
            [
                'class' => CompositeAuth::className(),
				'authMethods' => 
                [
                    ['class' => HttpBasicAuth::className()
					,'auth' => function ($username, $password) {							
							$user = User::find()->where(['username' => $username])->one();
							if($user){
								if ($user->username==$username && $user->validatePassword($password)) {
									$user->findResetAccessToken($user->username);								
									return $user;
								}
								return null;
							}
						},
					], 
                ]
            ], */
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
					// Allow only POST and PUT methods
					'Access-Control-Request-Headers' => ['X-Wsse'],
					'Access-Control-Allow-Headers' => ['X-Requested-With','Content-Type'],
					// Allow only headers 'X-Wsse'
					'Access-Control-Allow-Credentials' => true,
					// Allow OPTIONS caching
					'Access-Control-Max-Age' => 3600,
					// Allow the X-Pagination-Current-Page header to be exposed to the browser.
					'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
				]		
			],
        ]);		
    }

	/**
     * Model Search Data.
     */
	public function actions()
    {		
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function () {					
					$param=["UserTokenSearch"=>Yii::$app->request->queryParams];
					//return $param;
                    $searchModel = new UserTokenSearch();
                    if($searchModel){
						return $searchModel->search($param);
					}else{
						$nodata=[
							"status"=> 404,
							'message'=> 'no-data',
						];
						return $nodata;
					}					
                },
            ],
        ];
    }	 
}



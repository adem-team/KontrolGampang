<?php

namespace frontend\backend\master\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Session;
use yii\widgets\ActiveForm;


use common\models\Store;
use frontend\backend\master\models\Item;
use frontend\backend\master\models\ItemSearch;
use frontend\backend\master\models\ItemSatuan;
use frontend\backend\master\models\ItemImage;
/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
	public $identifyItem_ACCESS_UNIX;
	public $identifyItem_ACCESS_GROUP;
	public $identifyItem_STORE_ID='0'; //Session.
	

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
	
	public function beforeAction($action){
		 $modulIndentify=4; //OUTLET
		// Check only when the user is logged in.
		// Author piter Novian [ptr.nov@gmail.com].
		// $this->store_code = Yii::$app->session['store_code'];
		if (!Yii::$app->user->isGuest){
			if (Yii::$app->session['userSessionTimeout']< time() ) {
				// timeout
				Yii::$app->user->logout();
				return $this->goHome(); 
			} else {	
				//add Session user login.
				Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
				
				//ITENTIFY CTR- Session Stored.
				$session = Yii::$app->session;
				$this->identifyItem_STORE_ID=$session['identifyItem_STORE_ID'];
				$this->identifyItem_ACCESS_UNIX=(!Yii::$app->user->isGuest)?Yii::$app->getUserOpt->user()['ACCESS_UNIX']:'';
				$this->identifyItem_ACCESS_GROUP=(!Yii::$app->user->isGuest)?Yii::$app->getUserOpt->user()['ACCESS_GROUP']:'';
	
				//check validation [access/url].
				$checkAccess=Yii::$app->getUserOpt->UserMenuPermission($modulIndentify);
				if($checkAccess['modulMenu']['MODUL_STS']==0 OR $checkAccess['ModulPermission']['STATUS']==0){				
					$this->redirect(array('/site/alert'));
				}else{
					if($checkAccess['PageViewUrl']==true){						
						return true;
					}else{
						$this->redirect(array('/site/alert'));
					}					
				}			 
			}
		}else{
			Yii::$app->user->logout();
			return $this->goHome(); 
		}
	}
	
    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
		$paramCari=Yii::$app->getRequest()->getQueryParam('outlet_code');
		$session = new Session;
		$session->remove('STORE_ID');
		$session['identifyItem_STORE_ID'] = $paramCari;
		$this->identifyItem_STORE_ID=$session['identifyItem_STORE_ID'];
		//Get 
		$modelOutlet=Store::find()->where(['OUTLET_CODE'=>$paramCari])->one();//->andWhere('FIND_IN_SET("'.$this->ACCESS_UNIX.'", ACCESS_UNIX)')->one();
		if($modelOutlet){
		    $searchModel = new ItemSearch(['OUTLET_CODE'=>$paramCari]);
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);			
			///OUTLET ID.		
			return $this->render('index', [
				'outletNm'=>$modelOutlet!=''?$modelOutlet->OUTLET_NM:'none',
				'searchModel' => $searchModel!=''?$searchModel:false,
				'dataProvider' => $dataProvider,
				'paramUrl'=>$paramCari,
			]);
		}else{
			$this->redirect(array('/site/alert'));
		}
    }

    /**
     * Displays a single Item model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	/**
     * Displays a single Item model.
     * @param string $id
     * @return mixed
     */
    public function actionReview($id)
    {
		$model =  $model = $this->findModel($id);
		$modelImage=ItemImage::findOne(['ACCESS_UNIX'=>$model->ACCESS_UNIX,'OUTLET_CODE'=>$model->OUTLET_CODE,'ITEM_ID'=>$model->ITEM_ID]);
		if(!$modelImage){
			$modelImage = new ItemImage();
			$modelImage->ACCESS_UNIX =$model->ACCESS_UNIX;
			$modelImage->OUTLET_CODE =$model->OUTLET_CODE;
			$modelImage->ITEM_ID =$model->ITEM_ID;
			$modelImage->CREATE_BY =$model->ACCESS_UNIX;
			$modelImage->CREATE_AT =date('Y:m:d H:i:s');
		}
		
        // $modelImage =ItemImage::findOne(['ACCESS_UNIX'=>$model->ACCESS_UNIX,'OUTLET_CODE'=>$model->OUTLET_CODE,'ITEM_ID'=>$model->ITEM_ID]);
		//$modelImage =ItemImage::find()->where(['ACCESS_UNIX'=>$model->ACCESS_UNIX,'OUTLET_CODE'=>$model->OUTLET_CODE,'ITEM_ID'=>$model->ITEM_ID])->one();
       
        if ($model->load(Yii::$app->request->post())) {
            $editUploadImage = $model->uploadImage();
			$image64edit=$editUploadImage!=''? $this->convertBase64(file_get_contents($editUploadImage->tempName)): '';
			// print_r($editUploadImage);
			// die();
			$modelImage->IMG64 = $image64edit;
			$modelImage->UPDATE_BY =$model->ACCESS_UNIX;
			if($model->save()){
				$modelImage->save();
				return $this->redirect(['index','outlet_code'=>$model->OUTLET_CODE]);
			}            
        } else {
           return $this->renderAjax('review', [
                'model' => $model
            ]);
        }
		
    }

	/**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		//Generate Code.
		$maxID=Item::find()->where(['ACCESS_UNIX'=>$this->identifyItem_ACCESS_GROUP,'OUTLET_CODE'=>$this->identifyItem_STORE_ID]);
		$newID=str_pad(($maxID->max('ITEM_ID'))+1,4,"0",STR_PAD_LEFT);
		
		$model = new Item();
		//$maxID=Item::find()->max('ITEM_ID')->where(['ACCESS_UNIX'=>$model->ACCESS_UNIX,'OUTLET_CODE'=>$model->OUTLET_CODE,'ITEM_ID'=>$model->ITEM_ID]);
        if ($model->load(Yii::$app->request->post())) {
			//Image Base64
			$ambilUploadImage = $model->uploadImage();
			$image64=$ambilUploadImage != ''? $this->convertBase64(file_get_contents($ambilUploadImage->tempName)): '';			
			
			
			
			//Attribute -Save-
			$model->ACCESS_UNIX =$this->identifyItem_ACCESS_GROUP;
			$model->OUTLET_CODE =$this->identifyItem_STORE_ID;
			$model->ITEM_ID =$newID;
			$model->STATUS = 1;	
			$model->CREATE_BY = $this->identifyItem_ACCESS_UNIX;
			$model->CREATE_AT = date("Y-m-d H:i:s");							
			if($model->save()){
					$modelImage=new ItemImage();
					$modelImage->ACCESS_UNIX =$this->identifyItem_ACCESS_GROUP;
					$modelImage->OUTLET_CODE =$this->identifyItem_STORE_ID;
					$modelImage->ITEM_ID = $newID;
					$modelImage->CREATE_BY = $this->identifyItem_ACCESS_UNIX;;
					$modelImage->CREATE_AT = date("Y-m-d H:i:s");
					$modelImage->STATUS = 1;					
					$modelImage->save();
			}
			return $this->redirect(['index', 'outlet_code' => $this->identifyItem_STORE_ID,'id'=>$newID]);
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
				'store_id'=>$newID,//this->identifyItem_ACCESS_UNIX,
            ]);
        }
    }
	
	public function actionValidItem()
    {
		$model = new Item();
		$model->scenario = "create";
		if(Yii::$app->request->isAjax && $model->load($_POST))
		{
			Yii::$app->response->format = 'json';
			return ActiveForm::validate($model);
		}
		return false;
    }

	/**
     * CREATE - ITEM SATUAN 
     */
    public function actionCreateSatuan($id)
    //public function actionCreateSatuan()
    {
		$paramACCESS_GROUP=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];
			
        $model = new ItemSatuan();
		if($model->load(Yii::$app->request->post())){
			if (Yii::$app->request->isAjax) {			
					$model->ACCESS_UNIX=Yii::$app->getUserOpt->user()['ACCESS_GROUP'];
					//$model->OUTLET_CODE='0001';//$id;
					$model->OUTLET_CODE=$id;
					$model->CREATE_BY=Yii::$app->getUserOpt->user()['ACCESS_UNIX'];
					$model->CREATE_AT=date('Y:m:d H:i:s');
					$model->STATUS=1;
					$model->save();			
					//if($model->save()){				
					   ///return $this->redirect(['index','outlet_code'=>$model->OUTLET_CODE]);
					   $out = Json::encode(['output'=>$model->save(), 'message'=>'suksess']);
					   // Yii::$app->session->setFlash('error', 'There was an error sending your message.');
					   return $out;
			}else{
				return $this->renderAjax('_formSatuan', [
					'model' => $model,
					'paramStore'=>$id,
					'paramACCESS_GROUP'=>$paramACCESS_GROUP
				]);			
			};
		}else{
			return $this->renderAjax('_formSatuan', [
				'model' => $model,
				'paramStore'=>$id,
				'paramACCESS_GROUP'=>$paramACCESS_GROUP
			]);			
		}
	}
    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

	public function convertBase64($base64)
    {
      $base64 = str_replace('data:image/jpg;base64,', '', $base64);
      $base64 = base64_encode($base64);
      $base64 = str_replace(' ', '+', $base64);

      return $base64;

    }
    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace frontend\backend\sistem\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;


class PermissionController extends Controller
{
	 public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action){
		if (Yii::$app->user->isGuest)  {
			 Yii::$app->user->logout();
				 $this->redirect(array('/site/login'));  
		}
		  // Check only when the user is logged in
		  if (!Yii::$app->user->isGuest)  {
			 if (Yii::$app->session['userSessionTimeout']< time() ) {
				 // timeout
				 Yii::$app->user->logout();
				 $this->redirect(array('/site/login'));  //
			 } else {
				 //Yii::$app->user->setState('userSessionTimeout', time() + Yii::app()->params['sessionTimeoutSeconds']) ;
				Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
				 return true;
			 }
		  } else {
			  return true;
		  }
		}

	public function actionIndex()
    {
        return $this->render('index');
    }
}

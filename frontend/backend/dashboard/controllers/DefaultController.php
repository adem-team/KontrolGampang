<?php

namespace frontend\backend\dashboard\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;


class DefaultController extends Controller
{
	
	/**
     * Before Action Index
	 * @author ptrnov  <piter@lukison.com>
	 * @since 1.1
     */
	public function beforeAction($action){
		if (Yii::$app->user->isGuest)  {
			 Yii::$app->user->logout();
			   $this->redirect(array('/site/login'));  //
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
			   //Modul permission URL, author -ptr.nov@gail.com-
			  // if(self::getPermission()->BTN_CREATE OR self::getPermission()->BTN_VIEW){
					//return true;
			  // }else{
				  $this->redirect(array('/site/validasi'));
			  // }
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

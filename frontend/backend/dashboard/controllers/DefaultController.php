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
			return $this->goHome();
		}
		// Check only when the user is logged in
		if (!Yii::$app->user->isGuest)  {
		   if (Yii::$app->session['userSessionTimeout']< time() ) {
			   // timeout
				Yii::$app->user->logout();
				return $this->goHome();
		   } else {
			   if(Yii::$app->getUserOpt->UserMenuPermission(2)['STATUS']==0){
					//Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
					$this->redirect(array('/site/alert'));
			   }else{
				   return $this->goHome();
			   }
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

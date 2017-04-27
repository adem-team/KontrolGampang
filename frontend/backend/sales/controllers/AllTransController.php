<?php

namespace frontend\backend\sales\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use frontend\backend\sales\models\TransAllStoreSearch;

class AllTransController extends Controller
{
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
/**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
		$searchModel = new TransAllStoreSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);	
		 return $this->render('index', [
			'searchModel'=>$searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

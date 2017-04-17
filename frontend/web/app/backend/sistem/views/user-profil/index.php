<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\backend\sistem\models\UserProfilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Profils');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profil-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Profil'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ACCESS_UNIX',
            'NM_DEPAN',
            'NM_TENGAH',
            'NM_BELAKANG',
            'KTP',
            // 'ALMAT:ntext',
            // 'LAHIR_TEMPAT',
            // 'LAHIR_TGL',
            // 'LAHIR_GENDER',
            // 'HP',
            // 'EMAIL:email',
            // 'CREATE_BY',
            // 'CREATE_AT',
            // 'UPDATE_BY',
            // 'UPDATE_AT',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

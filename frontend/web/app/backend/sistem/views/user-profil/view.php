<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\backend\sistem\models\UserProfil */

$this->title = $model->ACCESS_UNIX;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Profils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profil-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ACCESS_UNIX], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ACCESS_UNIX], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ACCESS_UNIX',
            'NM_DEPAN',
            'NM_TENGAH',
            'NM_BELAKANG',
            'KTP',
            'ALMAT:ntext',
            'LAHIR_TEMPAT',
            'LAHIR_TGL',
            'LAHIR_GENDER',
            'HP',
            'EMAIL:email',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
        ],
    ]) ?>

</div>

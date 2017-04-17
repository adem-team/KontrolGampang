<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\backend\sistem\models\UserProfilSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-profil-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ACCESS_UNIX') ?>

    <?= $form->field($model, 'NM_DEPAN') ?>

    <?= $form->field($model, 'NM_TENGAH') ?>

    <?= $form->field($model, 'NM_BELAKANG') ?>

    <?= $form->field($model, 'KTP') ?>

    <?php // echo $form->field($model, 'ALMAT') ?>

    <?php // echo $form->field($model, 'LAHIR_TEMPAT') ?>

    <?php // echo $form->field($model, 'LAHIR_TGL') ?>

    <?php // echo $form->field($model, 'LAHIR_GENDER') ?>

    <?php // echo $form->field($model, 'HP') ?>

    <?php // echo $form->field($model, 'EMAIL') ?>

    <?php // echo $form->field($model, 'CREATE_BY') ?>

    <?php // echo $form->field($model, 'CREATE_AT') ?>

    <?php // echo $form->field($model, 'UPDATE_BY') ?>

    <?php // echo $form->field($model, 'UPDATE_AT') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

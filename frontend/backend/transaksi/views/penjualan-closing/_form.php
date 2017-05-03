<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\backend\transaksi\models\PenjualanClosing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penjualan-closing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CREATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CREATE_AT')->textInput() ?>

    <?= $form->field($model, 'UPDATE_BY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UPDATE_AT')->textInput() ?>

    <?= $form->field($model, 'STATUS')->textInput() ?>

    <?= $form->field($model, 'CLOSING_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACCESS_UNIX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CLOSING_DATE')->textInput() ?>

    <?= $form->field($model, 'OUTLET_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_MODAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_UANG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TTL_QTY')->textInput() ?>

    <?= $form->field($model, 'TTL_STORAN')->textInput() ?>

    <?= $form->field($model, 'TTL_SISA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

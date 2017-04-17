<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\backend\sistem\models\Corp */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Corp',
]) . $model->ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Corps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="corp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

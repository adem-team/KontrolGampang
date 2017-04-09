<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\backend\sistem\models\UserProfil */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Profil',
]) . $model->ACCESS_UNIX;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Profils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ACCESS_UNIX, 'url' => ['view', 'id' => $model->ACCESS_UNIX]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-profil-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

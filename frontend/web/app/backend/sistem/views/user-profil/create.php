<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\backend\sistem\models\UserProfil */

$this->title = Yii::t('app', 'Create User Profil');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Profils'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profil-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

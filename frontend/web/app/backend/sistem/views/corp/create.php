<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\backend\sistem\models\Corp */

$this->title = Yii::t('app', 'Create Corp');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Corps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

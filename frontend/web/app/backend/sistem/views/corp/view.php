<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\backend\sistem\models\Corp */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Corps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->ID], [
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
            'ID',
            'ACCESS_UNIX:ntext',
            'CORP_NM',
            'ALAMAT:ntext',
            'MAP_LAG',
            'MAP_LAT',
            'STATUS',
            'CREATE_BY',
            'CREATE_AT',
            'UPDATE_BY',
            'UPDATE_AT',
        ],
    ]) ?>

</div>

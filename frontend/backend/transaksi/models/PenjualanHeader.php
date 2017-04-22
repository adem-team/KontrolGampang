<?php

namespace frontend\backend\transaksi\models;

use Yii;

/**
 * This is the model class for table "penjualan_header".
 *
 * @property string $ID RECEVED & RELEASE:
 * @property string $CREATE_BY CREATE_BY
 * @property string $CREATE_AT CREATE_AT
 * @property string $UPDATE_BY UPDATE_BY
 * @property string $UPDATE_AT UPDATE_AT
 * @property int $STATUS
 * @property string $TRANS_ID
 * @property string $ACCESS_UNIX
 * @property string $TRANS_DATE
 * @property string $OUTLET_ID
 * @property string $CONSUMER_NM
 * @property string $CONSUMER_EMAIL
 * @property string $CONSUMER_PHONE
 */
class PenjualanHeader extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'penjualan_header';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CREATE_AT', 'UPDATE_AT', 'TRANS_DATE'], 'safe'],
            [['STATUS'], 'integer'],
            [['CREATE_BY', 'UPDATE_BY', 'ACCESS_UNIX', 'OUTLET_ID'], 'string', 'max' => 50],
            [['TRANS_ID', 'CONSUMER_NM'], 'string', 'max' => 100],
            [['CONSUMER_EMAIL'], 'string', 'max' => 200],
            [['CONSUMER_PHONE'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'CREATE_BY' => Yii::t('app', 'Create  By'),
            'CREATE_AT' => Yii::t('app', 'Create  At'),
            'UPDATE_BY' => Yii::t('app', 'Update  By'),
            'UPDATE_AT' => Yii::t('app', 'Update  At'),
            'STATUS' => Yii::t('app', 'Status'),
            'TRANS_ID' => Yii::t('app', 'Trans  ID'),
            'ACCESS_UNIX' => Yii::t('app', 'Access  Unix'),
            'TRANS_DATE' => Yii::t('app', 'Trans  Date'),
            'OUTLET_ID' => Yii::t('app', 'Outlet  ID'),
            'CONSUMER_NM' => Yii::t('app', 'Consumer  Nm'),
            'CONSUMER_EMAIL' => Yii::t('app', 'Consumer  Email'),
            'CONSUMER_PHONE' => Yii::t('app', 'Consumer  Phone'),
        ];
    }
}
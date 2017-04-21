<?php

namespace frontend\backend\master\models;
use Yii;

/**
 * This is the model class for table "item_formula_discount".
 *
 * @property string $ID
 * @property string $CREATE_BY USER CREATED
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_BY USER UPDATE
 * @property string $UPDATE_AT Tanggal di update
 * @property int $STATUS 0 = NO DISCOUNT
 * @property string $ITEM_ID
 * @property string $OUTLET_CODE
 * @property int $HARI DISCOUNT BY HARI & PERIODE_TIME1&2
 * @property string $PERIODE_TGL1
 * @property string $PERIODE_TGL2
 * @property string $PERIODE_TIME1
 * @property string $PERIODE_TIME2
 * @property string $DISCOUNT_PERCENT
 * @property string $DCRIPT
 */
class ItemFdiscount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_formula_discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CREATE_AT', 'UPDATE_AT', 'PERIODE_TGL1', 'PERIODE_TGL2', 'PERIODE_TIME1', 'PERIODE_TIME2'], 'safe'],
            [['STATUS', 'HARI'], 'integer'],
            [['DISCOUNT_PERCENT'], 'number'],
            [['DCRIPT'], 'string'],
            [['CREATE_BY', 'UPDATE_BY', 'ITEM_ID', 'OUTLET_CODE'], 'string', 'max' => 50],
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
            'ITEM_ID' => Yii::t('app', 'Item  ID'),
            'OUTLET_CODE' => Yii::t('app', 'Outlet  Code'),
            'HARI' => Yii::t('app', 'Hari'),
            'PERIODE_TGL1' => Yii::t('app', 'Periode  Tgl1'),
            'PERIODE_TGL2' => Yii::t('app', 'Periode  Tgl2'),
            'PERIODE_TIME1' => Yii::t('app', 'Periode  Time1'),
            'PERIODE_TIME2' => Yii::t('app', 'Periode  Time2'),
            'DISCOUNT_PERCENT' => Yii::t('app', 'Discount  Percent'),
            'DCRIPT' => Yii::t('app', 'Dcript'),
        ];
    }
}
<?php

namespace api\modules\master\models;

use Yii;
use api\modules\master\models\ItemJual;
/**
 * This is the model class for table "item".
 *
 * @property string $ID
 * @property string $CREATE_BY USER CREATED
 * @property string $CREATE_AT Tanggal dibuat
 * @property string $UPDATE_BY USER UPDATE
 * @property string $UPDATE_AT Tanggal di update
 * @property int $STATUS 0=disable 1=Normal (one table items).      (Android No Stock) 2=Detail (Join Itm Hpp)     (Android USED Stock)
 * @property string $ITEM_ID
 * @property string $OUTLET_CODE
 * @property string $ITEM_NM
 */
class Item extends \yii\db\ActiveRecord
{

	public static function getDb()
    {
        return Yii::$app->get('api_dbkg');
    }
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CREATE_AT', 'UPDATE_AT'], 'safe'],
            [['STATUS'], 'integer'],
            [['CREATE_BY', 'UPDATE_BY', 'ITEM_ID', 'OUTLET_CODE'], 'string', 'max' => 50],
            [['ITEM_NM','SATUAN'], 'string', 'max' => 100],
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
            'STATUS' => Yii::t('app', 'STATUS'),
            'ITEM_ID' => Yii::t('app', 'ITEM.ID'),
            'OUTLET_CODE' => Yii::t('app', 'OUTLET.CODE'),
            'ITEM_NM' => Yii::t('app', 'ITEM NAME'),
            'SATUAN' => Yii::t('app', 'SATUAN'),
        ];
    }
	
	public function fields()
	{
		return [			
			'OUTLET_CODE'=>function($model){
				return $model->OUTLET_CODE;
			},
			'ITEM_ID'=>function($model){
				return $model->ITEM_ID;
			},					
			'ITEM_NM'=>function($model){
				return $model->ITEM_NM;
			},	
			'SATUAN'=>function($model){
				return $model->SATUAN;
			},				
			'UPDATE_AT'=>function($model){
				return $model->UPDATE_AT;
			},	
			'STATUS'=>function($model){
				return $model->STATUS;
			},
			'STATUS'=>function($model){
				return $model->STATUS;
			},	
			'HARGA'=>function(){
				return $this->harga;
			}					
		];
	}
	//Join TABLE ITEM
	public function getHarga(){
		//return $this->hasMany(Item::className(), ['OUTLET_CODE' => 'OUTLET_CODE']);//->from(['formula' => Item::tableName()]);
		return $this->hasMany(ItemJual::className(), ['OUTLET_CODE' => 'OUTLET_CODE','ITEM_ID'=>'ITEM_ID']);
		//PR STATUS=1
		//return $this->hasMany(ItemFormulaDetail::className(), ['FORMULA_ID' => 'FORMULA_ID'],['STATUS' => '1']);//->from(['formula' => Item::tableName()]);
	}
	
	/* public function extraFields()
	{
		return ['harga'];
		//return ['unit'];
	} */
}

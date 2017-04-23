<?php

namespace api\modules\master\models;

use Yii;
use yii\helpers\Json;
use api\modules\master\models\ItemJual;
use api\modules\master\models\ItemImage;
use api\modules\master\models\ItemFdiscount;
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
            [['ACCESS_UNIX','CREATE_AT', 'UPDATE_AT'], 'safe'],
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
            'ACCESS_UNIX' => Yii::t('app', 'Access Unix'),
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
			'STOCK'=>function(){
				return $this->stockCurrent;
			},	
			'HARGA'=>function(){
				return $this->harga;
			},	
			'DISCOUNT'=>function(){
				return $this->discount;
			},
			'IMAGE'=>function(){
				return $this->image;
				//return isset($this->image)?$this->image:$this->noImage;
				//return  $this->noImage;
			}					
		];
	}
	//Join TABLE IMAGE
	public function getImage(){
		return $this->hasMany(ItemImage::className(), ['ACCESS_UNIX'=>'ACCESS_UNIX','OUTLET_CODE' => 'OUTLET_CODE','ITEM_ID'=>'ITEM_ID']);
	}
	//Join TABLE HARGA JUAL
	public function getHarga(){
		return $this->hasMany(ItemJual::className(), ['ACCESS_UNIX'=>'ACCESS_UNIX','OUTLET_CODE' => 'OUTLET_CODE','ITEM_ID'=>'ITEM_ID']);
	}
	
	//Join TABLE DISCOUNT
	public function getDiscount(){
		return $this->hasMany(ItemFdiscount::className(), ['ACCESS_UNIX'=>'ACCESS_UNIX','OUTLET_CODE' => 'OUTLET_CODE','ITEM_ID'=>'ITEM_ID']);
	}
	
	public function getNoimage(){
		$rslt[]=[
			'CREATE_AT'=>'0000-00-00 00:00:00',
			'UPDATE_AT'=>'0000-00-00 00:00:00',
			'IMG64'=>'NoImage'
		];	 
		return $rslt;			
	}
	public function getStockCurrent(){
		$rslt[]=[
			'STOCK_DAFAULT'=>'100',
			'STOCK_BELI'=>'100',
			'STOCK_JUAL'=>'20',
			'STOCK_BERJALAN'=>'80'			
		];	 
		return $rslt;			
	}
}

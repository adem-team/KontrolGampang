<?php

namespace frontend\backend\sales\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\debug\components\search\Filter;
use yii\debug\components\search\matchers;

class TransAllStoreSearch extends Model
{	
	public $OUTLET_ID;
	public $ACCESS_UNIX;
	public $ITEM_ID;
	
    /**
     * @inheritdoc	
     */
    public function rules()
    {
        return [
            [['OTLET_CODE','ACCESS_UNIX_ITEM','ITEM_ID'], 'safe'],
        ];
    }

    public function search($params){
		
		$this->OUTLET_ID='0001';
		$this->ACCESS_UNIX='20170404081601';
		$qryAllStoreItems= Yii::$app->db->createCommand("select * from VwDataTransaksi where ACCESS_UNIX='".$this->ACCESS_UNIX."' AND OUTLET_ID='".$this->OUTLET_ID."'")->queryAll();
		
		$dataProvider= new ArrayDataProvider([
			'allModels'=>$qryAllStoreItems	,			
			'pagination' => [
				'pageSize' => 500,
			]
		]);
		if (!($this->load($params) && $this->validate())) {
 			return $dataProvider;
 		}
		
		$filter = new Filter();
 		$this->addCondition($filter, 'ACCESS_UNIX', true);
 		$this->addCondition($filter, 'OUTLET_ID', true);	
 		$this->addCondition($filter, 'ITEM_ID', true);	
 		$dataProvider->allModels = $filter->filter($qryAllStoreItems);
		
		return $dataProvider->getModels();
	}
	
	public function addCondition(Filter $filter, $attribute, $partial = false)
    {
        $value = $this->$attribute;

        if (mb_strpos($value, '>') !== false) {
            $value = intval(str_replace('>', '', $value));
            $filter->addMatcher($attribute, new matchers\GreaterThan(['value' => $value]));

        } elseif (mb_strpos($value, '<') !== false) {
            $value = intval(str_replace('<', '', $value));
            $filter->addMatcher($attribute, new matchers\LowerThan(['value' => $value]));
        } else {
            $filter->addMatcher($attribute, new matchers\SameAs(['value' => $value, 'partial' => $partial]));
        }
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
}

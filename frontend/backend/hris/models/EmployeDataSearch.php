<?php

namespace frontend\backend\hris\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\backend\hris\models\EmployeData;

/**
 * EmployeDataSearch represents the model behind the search form of `frontend\backend\hris\models\EmployeData`.
 */
class EmployeDataSearch extends EmployeData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'STATUS'], 'integer'],
            [['CREATE_BY', 'CREATE_AT', 'UPDATE_BY', 'UPDATE_AT', 'EMP_ID', 'ACCESS_UNIX', 'OUTLET_CODE', 'EMP_NM_DPN', 'EMP_NM_TGH', 'EMP_NM_BLK'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EmployeData::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
            'CREATE_AT' => $this->CREATE_AT,
            'UPDATE_AT' => $this->UPDATE_AT,
            'STATUS' => $this->STATUS,
        ]);

        $query->andFilterWhere(['like', 'CREATE_BY', $this->CREATE_BY])
            ->andFilterWhere(['like', 'UPDATE_BY', $this->UPDATE_BY])
            ->andFilterWhere(['like', 'EMP_ID', $this->EMP_ID])
            ->andFilterWhere(['like', 'ACCESS_UNIX', $this->ACCESS_UNIX])
            ->andFilterWhere(['like', 'OUTLET_CODE', $this->OUTLET_CODE])
            ->andFilterWhere(['like', 'EMP_NM_DPN', $this->EMP_NM_DPN])
            ->andFilterWhere(['like', 'EMP_NM_TGH', $this->EMP_NM_TGH])
            ->andFilterWhere(['like', 'EMP_NM_BLK', $this->EMP_NM_BLK]);

        return $dataProvider;
    }
}

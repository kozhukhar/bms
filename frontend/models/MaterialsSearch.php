<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Materials;

/**
 * MaterialsSearch represents the model behind the search form of `frontend\models\Materials`.
 */
class MaterialsSearch extends Materials
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sku', 'name', 'material_type', 'base_uom_id', 'created_at'], 'safe'],
            [['is_batch_tracked'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Materials::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'is_batch_tracked' => $this->is_batch_tracked,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'material_type', $this->material_type])
            ->andFilterWhere(['like', 'base_uom_id', $this->base_uom_id]);

        return $dataProvider;
    }
}

<?php

namespace common\models\base;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tab;

/**
 * TabSearch represents the model behind the search form of `common\models\Tab`.
 */
class TabSearch extends Tab
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'setting_id', 'classified_id', 'product_id', 'post_id', 'serial', 'status'], 'integer'],
            [['title', 'avatar', 'describe', 'content', 'slug', 'images', 'code'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tab::find();

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
            'id' => $this->id,
            'category_id' => $this->category_id,
            'setting_id' => $this->setting_id,
            'classified_id' => $this->classified_id,
            'product_id' => $this->product_id,
            'post_id' => $this->post_id,
            'serial' => $this->serial,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'describe', $this->describe])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}

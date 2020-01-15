<?php

namespace common\models\base;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\base\Topic;

/**
 * TopicSearch represents the model behind the search form of `common\models\base\Topic`.
 */
class TopicSearch extends Topic
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'active', 'classroom_subject_id', 'hot', 'seo_tool_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'avatar', 'description', 'slug', 'tags'], 'safe'],
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
        $query = Topic::find();

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
            'status' => $this->status,
            'active' => $this->active,
            'classroom_subject_id' => $this->classroom_subject_id,
            'hot' => $this->hot,
            'seo_tool_id' => $this->seo_tool_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'tags', $this->tags]);

        return $dataProvider;
    }
}

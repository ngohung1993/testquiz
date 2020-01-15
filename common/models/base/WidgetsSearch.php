<?php

namespace common\models\base;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Widgets;

/**
 * WidgetsSearch represents the model behind the search form of `common\models\Widgets`.
 */
class WidgetsSearch extends Widgets
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'position'], 'integer'],
            [['background_color', 'title_color', 'text_color', 'button_color', 'button_text', 'title', 'description', 'email'], 'safe'],
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
        $query = Widgets::find();

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
            'position' => $this->position,
        ]);

        $query->andFilterWhere(['like', 'background_color', $this->background_color])
            ->andFilterWhere(['like', 'title_color', $this->title_color])
            ->andFilterWhere(['like', 'text_color', $this->text_color])
            ->andFilterWhere(['like', 'button_color', $this->button_color])
            ->andFilterWhere(['like', 'button_text', $this->button_text])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}

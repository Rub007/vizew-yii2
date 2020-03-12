<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form of `common\models\Post`.
 */
class PostSearch extends Post
{
    public $date;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'updated_at'], 'integer'],
            [['name', 'description', 'src', 'type', 'mime_type','created_at'], 'safe'],
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

        $query = Post::find()->with('categories');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $startTime = strtotime($this->created_at);
        $endTime = $startTime+24*60*60;
//        echo '<pre>';
//            print_r($startTime);
//            print_r($endTime);
//        echo '<pre>';die;
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
//            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        if ($this->created_at){
            $query->andFilterWhere(['>','created_at',$startTime]);
            $query->andFilterWhere(['<','created_at',$endTime]);
        }
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'src', $this->src])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'mime_type', $this->mime_type]);

        return $dataProvider;
    }
}

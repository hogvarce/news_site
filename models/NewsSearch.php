<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\News;

/**
 * NewsSearch represents the model behind the search form about `app\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_new'], 'integer'],
            [['title_new', 'content_new', 'preview_new', 'data_new', 'smallimg_new'], 'safe'],
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
        $query = News::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_new' => $this->id_new,
            'data_new' => $this->data_new,
        ]);

        $query->andFilterWhere(['like', 'title_new', $this->title_new])
            ->andFilterWhere(['like', 'content_new', $this->content_new])
            ->andFilterWhere(['like', 'preview_new', $this->preview_new])
            ->andFilterWhere(['like', 'smallimg_new', $this->smallimg_new]);

        return $dataProvider;
    }
}

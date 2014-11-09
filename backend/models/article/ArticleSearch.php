<?php

namespace backend\models\article;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\article\Article;

/**
 * ArticleSearch represents the model behind the search form about `app\models\article\Article`.
 */
class ArticleSearch extends Article
{
    public function rules()
    {
        return [
            [['id_article', 'id_category', 'status', 'publication', 'end'], 'integer'],
            ['title', 'safe'],
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
        $query = Article::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_article'  => $this->id_article,
            'id_category' => $this->id_category,
            'status'      => $this->status,
            'publication' => $this->publication,
            'end'         => $this->end,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
<?php

namespace backend\models\article;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\article\Article;

/**
 * ArticleSearch - реализация поиска для модели `common\article\Article`
 */
class ArticleSearch extends Article
{
    public function rules()
    {
        return [
            [['id_article', 'id_category', 'status', 'active'], 'integer'],
            [['title', 'id_created_user'], 'string'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
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

        $query->innerJoinWith('createdUser')
        ->andFilterWhere([
            'id_article'           => $this->id_article,
            'id_category'          => $this->id_category,
            '{{%articles}}.status' => $this->status,
            'active'               => $this->active,
        ])
        ->andFilterWhere(['like', 'title', $this->title])
        ->andFilterWhere(['like', '{{%users}}.username', $this->id_created_user])

        ->select(['id_article', 'id_category', 'title', '{{%articles}}.status', 'id_created_user']);

        return $dataProvider;
    }
}
<?php

namespace backend\models\article;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\article\ArticleComment;

/**
 * ArticleCommentSearch - реализация поиска для модели `common\models\ArticleComment`
 */
class ArticleCommentSearch extends ArticleComment
{
    public function rules()
    {
        return [
            [['id_comment', 'id_parent', 'status'], 'integer'],
            [['id_article', 'id_user'], 'string'],
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
        $query = ArticleComment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->innerJoinWith('user')
            ->innerJoinWith('article')
            ->andFilterWhere([
            'id_comment'                   => $this->id_comment,
            'id_parent'                    => $this->id_parent,
            '{{%article_comments}}.status' => $this->status,
        ])
            ->andFilterWhere(['like', '{{%articles}}.title', $this->id_article])
            ->andFilterWhere(['like', '{{%users}}.username', $this->id_user])
            ->select(['id_comment', 'id_parent', '{{%article_comments}}.id_article', '{{%article_comments}}.id_user', '{{%article_comments}}.status', '{{%article_comments}}.created']);

        return $dataProvider;
    }
}
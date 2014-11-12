<?php

namespace backend\models\article;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\article\ArticleComment;

/**
 * ArticleCommentSearch represents the model behind the search form about `app\models\article\ArticleComment`.
 */
class ArticleCommentSearch extends ArticleComment
{

    public function rules()
    {
        return [
            [['id_comment', 'id_parent', 'id_article', 'id_user', 'status'], 'integer'],
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
     *
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

        $query->andFilterWhere([
            'id_comment' => $this->id_comment,
            'id_parent'  => $this->id_parent,
            'id_article' => $this->id_article,
            'id_user'    => $this->id_user,
            'status'     => $this->status,
        ]);

        return $dataProvider;
    }
}
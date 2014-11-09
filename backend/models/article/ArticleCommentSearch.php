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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_comment', 'id_parent', 'id_article', 'id_user', 'status', 'created'], 'integer'],
            [['title', 'text'], 'safe'],
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
        $query = ArticleComment::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_comment' => $this->id_comment,
            'id_parent' => $this->id_parent,
            'id_article' => $this->id_article,
            'id_user' => $this->id_user,
            'status' => $this->status,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
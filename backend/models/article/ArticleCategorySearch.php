<?php

namespace backend\models\article;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\article\ArticleCategory;

/**
 * ArticleCategorySearch represents the model behind the search form about `common\article\ArticleCategory`.
 */
class ArticleCategorySearch extends ArticleCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_category', 'id_parent'], 'integer'],
            [['name'], 'safe'],
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
        $query = ArticleCategory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_category' => $this->id_category,
            'id_parent' => $this->id_parent,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
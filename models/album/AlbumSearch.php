<?php

namespace app\models\album;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AlbumSearch represents the model behind the search form about `app\models\album\Album`.
 */
class AlbumSearch extends Album
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_album', 'template', 'type', 'size', 'sound', 'count_artists', 'status', 'repeated', 'changed', 'device', 'year'], 'integer'],
            [['name', 'released', 'length'], 'safe'],
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
        $query = Album::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_album'      => $this->id_album,
            'year'          => $this->year,
            'type'          => $this->type,
            'size'          => $this->size,
            'sound'         => $this->sound,
            'count_artists' => $this->count_artists,
            'status'        => $this->status,
            'repeated'      => $this->repeated,
            'changed'       => $this->changed,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
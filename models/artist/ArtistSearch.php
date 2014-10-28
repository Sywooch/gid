<?php

namespace app\models\artist;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\artist\Artist;

/**
 * ArtistSearch represents the model behind the search form about `app\models\artist\Artist`.
 */
class ArtistSearch extends Artist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_artist', 'type_artist', 'birthplace', 'deathplace', 'resident'], 'integer'],
            [['name_artist', 'date_birth', 'date_death', 'years_active'], 'safe'],
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
        $query = Artist::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_artist'   => $this->id_artist,
            'type_artist' => $this->type_artist,
            'date_birth'  => $this->date_birth,
            'date_death'  => $this->date_death,
            'birthplace'  => $this->birthplace,
            'deathplace'  => $this->deathplace,
            'resident'    => $this->resident,
        ]);

        $query->andFilterWhere(['like', 'name_artist', $this->name_artist . "%", false]);

        return $dataProvider;
    }
}

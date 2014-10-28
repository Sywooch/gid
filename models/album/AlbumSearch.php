<?php

namespace app\models\album;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\album\Album;

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
            [['id_album', 'template', 'size_disk', 'disks', 'number_album',
                'sound', 'artists', 'count_artists', 'status_album', 'repeated', 'changed', 'times', 'dead', 'ost', 'device'], 'integer'],
            [['name_album', 'alt_name_album', 'released', 'recorded', 'year_album', 'length_album', 'meta_description'], 'safe'],
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
            'released'      => $this->released,
            'year_album'    => $this->year_album,
            'template'      => $this->template,
            'size_disk'     => $this->size_disk,
            'disks'         => $this->disks,
            'number_album'  => $this->number_album,
            'sound'         => $this->sound,
            'artists'       => $this->artists,
            'count_artists' => $this->count_artists,
            'status_album'  => $this->status_album,
            'repeated'      => $this->repeated,
            'changed'       => $this->changed,
            'times'         => $this->times,
            'dead'          => $this->dead,
            'ost'           => $this->ost,
            'device'        => $this->device,
        ]);

        $query->andFilterWhere(['like', 'name_album', $this->name_album . "%", false]);

        return $dataProvider;
    }
}
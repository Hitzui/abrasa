<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Noticias;

/**
 * NoticiasSearch represents the model behind the search form of `app\models\Noticias`.
 */
class NoticiasSearch extends Noticias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idnoticias', 'idcategoria'], 'integer'],
            [['titulo', 'contenido_pe', 'contenido_gr', 'imagen', 'fecha'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Noticias::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idnoticias' => $this->idnoticias,
            'fecha' => $this->fecha,
            'idcategoria' => $this->idcategoria,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'contenido_pe', $this->contenido_pe])
            ->andFilterWhere(['like', 'contenido_gr', $this->contenido_gr])
            ->andFilterWhere(['like', 'imagen', $this->imagen]);

        return $dataProvider;
    }
}

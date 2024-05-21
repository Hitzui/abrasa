<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subnoticias;

/**
 * SubnoticiasSearch represents the model behind the search form of `app\models\Subnoticias`.
 */
class SubnoticiasSearch extends Subnoticias
{
    public $categoria;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idsubnoticias', 'idcategoria'], 'integer'],
            [['nombre', 'imagen','categoria'], 'safe'],
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
        $query = Subnoticias::find();
        $query->joinWith('categoria');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['categoria'] = [
            'asc' => ['categoria.nombre' => SORT_ASC],
            'desc' => ['categoria.nombre' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idsubnoticias' => $this->idsubnoticias,
            'idcategoria' => $this->idcategoria,
        ]);

        $query->andFilterWhere(['like', 'subnoticias.nombre', $this->nombre])
            ->andFilterWhere(['like', 'subnoticias.imagen', $this->imagen])
            ->andFilterWhere(['like', 'categoria.descripcion', $this->categoria]);

        return $dataProvider;
    }
}

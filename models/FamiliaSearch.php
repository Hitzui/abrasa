<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Familia;

/**
 * FamiliaSearch represents the model behind the search form of `app\models\Familia`.
 */
class FamiliaSearch extends Familia
{
    public $categoria;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfamilia', 'idcategoria'], 'integer'],
            [['nombre', 'categoria'], 'safe'],
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
        $query = Familia::find();
        $query = $query->joinWith('categoria');
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
            'idfamilia' => $this->idfamilia,
            'idcategoria' => $this->idcategoria,
        ]);

        $query->andFilterWhere(['like', 'familia.nombre', $this->nombre]);
        $query->andFilterWhere(['like', 'categoria.nombre', $this->categoria]);

        return $dataProvider;
    }
}

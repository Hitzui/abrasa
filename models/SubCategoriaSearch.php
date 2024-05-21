<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subcategoria;

/**
 * SubCategoriaSearch represents the model behind the search form of `app\models\Subcategoria`.
 */
class SubCategoriaSearch extends Subcategoria
{
    public $categoria;

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['categoria.nombre']);
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idsubcategoria', 'idcategoria'], 'integer'],
            [['nombre','categoria.nombre','categoria'], 'safe'],
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
        $query = Subcategoria::find();
        $query->joinWith(['categoria']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        // Important: here is how we set up the sorting
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
            'subcategoria.idsubcategoria' => $this->idsubcategoria,
            'subcategoria.idcategoria' => $this->idcategoria
        ]);
        $query->andFilterWhere(['like','categoria.nombre',$this->categoria]);
        $query->andFilterWhere(['like', 'subcategoria.nombre', $this->nombre]);
        return $dataProvider;
    }
}

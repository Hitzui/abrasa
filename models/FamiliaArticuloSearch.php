<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FamiliaArticulo;

/**
 * FamiliaArticuloSearch represents the model behind the search form of `app\models\FamiliaArticulo`.
 */
class FamiliaArticuloSearch extends FamiliaArticulo
{
    public $familia;
    public $articulo;
    public $subcategoria;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfamilia', 'idsubcategoria'], 'integer'],
            [['idarticulo'], 'safe'],
            [['articulo','familia','subcategoria'], 'safe'],
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
        $query = FamiliaArticulo::find();
        $query = $query->joinWith('articulo');
        $query = $query->joinWith('familia');
        $query = $query->joinWith('subcategoria');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['familia'] = [
            'asc' => ['familia.nombre' => SORT_ASC],
            'desc' => ['familia.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['articulo'] = [
            'asc' => ['articulo.descripcion' => SORT_ASC],
            'desc' => ['articulo.descripcion' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['subcategoria'] = [
            'asc' => ['subcategoria.nombre' => SORT_ASC],
            'desc' => ['subcategoria.nombre' => SORT_DESC],
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
            'idsubcategoria' => $this->idsubcategoria,
        ]);

        $query->andFilterWhere(['like', 'familia_articulo.idarticulo', $this->idarticulo]);
        $query->andFilterWhere(['like', 'articulo.descripcion', $this->articulo]);
        $query->andFilterWhere(['like', 'familia.nombre', $this->familia]);
        $query->andFilterWhere(['like', 'subcategoria.nombre', $this->subcategoria]);
        return $dataProvider;
    }
}

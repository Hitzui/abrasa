<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ArticuloSearch represents the model behind the search form of `app\models\Articulo`.
 */
class ArticuloSearch extends Articulo
{

	public $subcategoria='';


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idarticulo', 'descripcion', 'caracteristicas', 'rutaimg', 'ficha','hoja','uso','presentacion'], 'safe'],
            [['subcategoria'], 'safe'],
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
        $query = Articulo::find();
		$query->joinWith('detaarticulo');
        $query->joinWith(['subcategoria']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        // Important: here is how we set up the sorting
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
            'idsubcategoria' => $this->idsubcategoria,
        ]);

        $query->andFilterWhere(['like', 'articulo.idarticulo', $this->idarticulo])
            ->andFilterWhere(['like', 'articulo.descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'articulo.caracteristicas', $this->caracteristicas])
            ->andFilterWhere(['like', 'articulo.rutaimg', $this->rutaimg])
            ->andFilterWhere(['like', 'articulo.ficha', $this->ficha])
            ->andFilterWhere(['like', 'articulo.hoja', $this->hoja])
            ->andFilterWhere(['like', 'articulo.uso', $this->uso])
            ->andFilterWhere(['like', 'articulo.presentacion', $this->presentacion])
            ->andFilterWhere(['like', 'subcategoria.nombre', $this->subcategoria]);
        return $dataProvider;
    }
}

<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Detaarticulo;

/**
 * DetaArticuloSearch represents the model behind the search form of `app\models\Detaarticulo`.
 */
class DetaArticuloSearch extends Detaarticulo
{
	public $subcategoria;
	public $articulo;
	

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idsubcategoria'], 'integer'],
            [['idarticulo','subcategoria','articulo'], 'safe'],
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
        $query = Detaarticulo::find()->joinWith(['subcategoria'])->joinWith(['articulo']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

         // Important: here is how we set up the sorting
         $dataProvider->sort->attributes['subcategoria'] = [
            'asc' => ['subcategoria.nombre' => SORT_ASC],
            'desc' => ['subcategoria.nombre' => SORT_DESC],
        ];
		$dataProvider->sort->attributes['articulo'] = [
            'asc' => ['articulo.descripcion' => SORT_ASC],
            'desc' => ['articulo.descripcion' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['detaarticulo.idsubcategoria' => $this->idsubcategoria,]);
        $query->andFilterWhere(['like', 'detaarticulo.idarticulo', $this->idarticulo]);
        $query->andFilterWhere(['like', 'subcategoria.nombre', $this->subcategoria]);
        $query->andFilterWhere(['like', 'articulo.descripcion', $this->articulo]);

        return $dataProvider;
    }
}

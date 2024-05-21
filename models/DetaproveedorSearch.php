<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Detaproveedor;

/**
 * DetaproveedorSearch represents the model behind the search form of `app\models\Detaproveedor`.
 */
class DetaproveedorSearch extends Detaproveedor
{
	public $articulo;
	public $proveedor;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproveedor'], 'integer'],
            [['idarticulo'], 'safe'],
			[['articulo','proveedor'],'safe']
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
        $query = Detaproveedor::find();
		$query = $query->joinWith('articulo');
		$query = $query->joinWith('proveedor');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		$dataProvider->sort->attributes['proveedor'] = [
            'asc' => ['proveedor.nombre' => SORT_ASC],
            'desc' => ['proveedor.nombre' => SORT_DESC],
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
        $query->andFilterWhere([
            'detaproveedor.idproveedor' => $this->idproveedor,
        ]);
		
        $query->andFilterWhere(['like', 'detaproveedor.idarticulo', $this->idarticulo]);
        $query->andFilterWhere(['like', 'articulo.descripcion', $this->articulo]);
        $query->andFilterWhere(['like', 'proveedor.nombre', $this->proveedor]);
        //$query->andFilterWhere(['like', 'idarticulo', $this->idarticulo]);

        return $dataProvider;
    }
}

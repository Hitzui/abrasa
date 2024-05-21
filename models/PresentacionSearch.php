<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Presentacion;

/**
 * PresentacionSearch represents the model behind the search form of `app\models\Presentacion`.
 */
class PresentacionSearch extends Presentacion
{
    public $item;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpresentacion'], 'integer'],
            [['idarticulo', 'ruta', 'descripcion','item'], 'safe'],
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
    public function search($params): ActiveDataProvider
    {
        $query = Presentacion::find();
        $query->joinWith('articulo');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['item'] = [
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
            'idpresentacion' => $this->idpresentacion,
        ]);

        $query->andFilterWhere(['like', 'presentacion.idarticulo', $this->idarticulo])
            ->andFilterWhere(['like', 'presentacion.ruta', $this->ruta])
            ->andFilterWhere(['like', 'presentacion.descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'articulo.descripcion', $this->item]);

        return $dataProvider;
    }
}

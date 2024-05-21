<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tecnico;

/**
 * TecnicoSearch represents the model behind the search form of `app\models\Tecnico`.
 */
class TecnicoSearch extends Tecnico
{
    public $cattecnico;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtecnico', 'idcattecnico'], 'integer'],
            [['nombre', 'sucursal', 'telefono', 'correo', 'area', 'cattecnico'], 'safe'],
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
        $query = Tecnico::find()->joinWith('cattecnico');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['cattecnico'] = [
            'asc' => ['cattecnico.nombre' => SORT_ASC],
            'desc' => ['cattecnico.nombre' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idtecnico' => $this->idtecnico,
            'idcattecnico' => $this->idcattecnico,
        ]);

        $query->andFilterWhere(['like', 'tecnico.nombre', $this->nombre])
            ->andFilterWhere(['like', 'cattenico.nombre', $this->cattecnico])
            ->andFilterWhere(['like', 'sucursal', $this->sucursal])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'correo', $this->correo])
            ->andFilterWhere(['like', 'area', $this->area]);

        return $dataProvider;
    }
}

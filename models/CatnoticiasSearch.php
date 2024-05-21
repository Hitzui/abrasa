<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Catnoticias;

/**
 * CatnoticiasSearch represents the model behind the search form of `app\models\Catnoticias`.
 */
class CatnoticiasSearch extends Catnoticias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcatnoticias'], 'integer'],
            [['descripcion', 'imagen'], 'safe'],
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
        $query = Catnoticias::find();

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
            'idcatnoticias' => $this->idcatnoticias,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'imagen', $this->imagen]);

        return $dataProvider;
    }
}

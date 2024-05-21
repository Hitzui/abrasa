<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Detafamilia;

/**
 * DetafamiliaSearch represents the model behind the search form of `app\models\Detafamilia`.
 */
class DetafamiliaSearch extends Detafamilia
{
    public $familia;
    public $subcategoria;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfamilia', 'idsubcategoria'], 'integer'],
            [['subcategoria', 'familia'], 'safe'],
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
        $query = Detafamilia::find()
            ->joinWith('familia')
            ->joinWith('subcategoria');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['subcategoria'] = [
            'asc' => ['subcategoria.nombre' => SORT_ASC],
            'desc' => ['subcategoria.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['familia'] = [
            'asc' => ['familia.nombre' => SORT_ASC],
            'desc' => ['familia.nombre' => SORT_DESC],
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
        $query->andFilterWhere(['like', 'subcategoria.nombre', $this->subcategoria])
            ->andFilterWhere(['like', 'familia.nombre', $this->familia]);;
        return $dataProvider;
    }
}

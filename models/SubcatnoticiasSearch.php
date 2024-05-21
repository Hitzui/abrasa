<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SubcatnoticiasSearch represents the model behind the search form of `app\models\Subcatnoticias`.
 */
class SubcatnoticiasSearch extends Subcatnoticias
{
    public $subcategoria;
    public $noticia;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idsubcategoria', 'idnoticia'], 'integer'],
            [['subcategoria', 'noticia'], 'safe'],
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
        $query = Subcatnoticias::find();
        $query->joinWith('subcategoria');
        $query->joinWith('noticia');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['subcategoria'] = [
            'asc' => ['subcategoria.nombre' => SORT_ASC],
            'desc' => ['subcategoria.nombre' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['noticia'] = [
            'asc' => ['noticia.titulo' => SORT_ASC],
            'desc' => ['noticia.titulo' => SORT_DESC],
        ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'subcatnoticias.idsubcategoria' => $this->idsubcategoria,
            'subcatnoticias.idnoticia' => $this->idnoticia,
            'noticia.titulo' => $this->noticia,
            'subcategoria.nombre' => $this->subcategoria,
        ]);

        return $dataProvider;
    }
}

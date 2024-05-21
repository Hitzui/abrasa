<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subcategoria".
 *
 * @property int $idsubcategoria
 * @property int $idcategoria
 * @property string $nombre
 *
 * @property Articulo[] $articulos
 * @property Detaarticulo[] $detaarticulos
 * @property Articulo[] $idarticulos
 * @property Detafamilia[] $detafamilias
 * @property Familia[] $idfamilias
 * @property FamiliaArticulo[] $familiaArticulos
 * @property Categoria $idcategoria0
 */
class Subcategoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcategoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcategoria'], 'required'],
            [['idcategoria'], 'integer'],
            [['nombre'], 'string', 'max' => 250],
            [['idcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['idcategoria' => 'idcategoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idsubcategoria' => 'Idsubcategoria',
            'idcategoria' => 'Idcategoria',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Articulos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasMany(Articulo::class, ['idsubcategoria' => 'idsubcategoria']);
    }

    /**
     * Gets query for [[Detaarticulos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetaarticulos()
    {
        return $this->hasMany(Detaarticulo::className(), ['idsubcategoria' => 'idsubcategoria']);
    }

    /**
     * Gets query for [[Idarticulos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticulos()
    {
        return $this->hasMany(Articulo::class, ['idarticulo' => 'idarticulo'])->viaTable('detaarticulo', ['idsubcategoria' => 'idsubcategoria']);
    }

    /**
     * Gets query for [[Detafamilias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetafamilias()
    {
        return $this->hasMany(Detafamilia::class, ['idsubcategoria' => 'idsubcategoria']);
    }

    /**
     * Gets query for [[Idfamilias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilias()
    {
        return $this->hasMany(Familia::class, ['idfamilia' => 'idfamilia'])->viaTable('detafamilia', ['idsubcategoria' => 'idsubcategoria']);
    }

    /**
     * Gets query for [[FamiliaArticulos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliaArticulos()
    {
        return $this->hasMany(FamiliaArticulo::class, ['idsubcategoria' => 'idsubcategoria']);
    }

    /**
     * Gets query for [[Idcategoria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['idcategoria' => 'idcategoria']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "familia_articulo".
 *
 * @property int $idfamilia
 * @property string $idarticulo
 * @property int|null $idsubcategoria
 *
 * @property Articulo $articulo
 * @property Familia $familia
 * @property Subcategoria $subcategoria
 */
class FamiliaArticulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'familia_articulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfamilia', 'idarticulo'], 'required'],
            [['idfamilia', 'idsubcategoria'], 'integer'],
            [['idarticulo'], 'string', 'max' => 20],
            [['idfamilia', 'idarticulo'], 'unique', 'targetAttribute' => ['idfamilia', 'idarticulo']],
            [['idarticulo'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['idarticulo' => 'idarticulo']],
            [['idfamilia'], 'exist', 'skipOnError' => true, 'targetClass' => Familia::className(), 'targetAttribute' => ['idfamilia' => 'idfamilia']],
            [['idsubcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategoria::className(), 'targetAttribute' => ['idsubcategoria' => 'idsubcategoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idfamilia' => 'Idfamilia',
            'idarticulo' => 'Idarticulo',
            'idsubcategoria' => 'Idsubcategoria',
        ];
    }

    /**
     * Gets query for [[Idarticulo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasOne(Articulo::class, ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[Idfamilia0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilia()
    {
        return $this->hasOne(Familia::class, ['idfamilia' => 'idfamilia']);
    }

    /**
     * Gets query for [[Idsubcategoria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategoria()
    {
        return $this->hasOne(Subcategoria::class, ['idsubcategoria' => 'idsubcategoria']);
    }
}

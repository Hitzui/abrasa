<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detaarticulo".
 *
 * @property int $idsubcategoria
 * @property string $idarticulo
 *
 * @property Subcategoria $subcategoria
 * @property Articulo $articulo
 */
class Detaarticulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detaarticulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idsubcategoria', 'idarticulo'], 'required'],
            [['idsubcategoria'], 'integer'],
            [['idarticulo'], 'string', 'max' => 20],
            [['idsubcategoria', 'idarticulo'], 'unique', 'targetAttribute' => ['idsubcategoria', 'idarticulo']],
            [['idsubcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategoria::class, 'targetAttribute' => ['idsubcategoria' => 'idsubcategoria']],
            [['idarticulo'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::class, 'targetAttribute' => ['idarticulo' => 'idarticulo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idsubcategoria' => 'Idsubcategoria',
            'idarticulo' => 'Idarticulo',
        ];
    }

    /**
     * Gets query for [[Subcategoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategoria()
    {
        return $this->hasOne(Subcategoria::class, ['idsubcategoria' => 'idsubcategoria']);
    }

    /**
     * Gets query for [[Articulo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasOne(Articulo::className(), ['idarticulo' => 'idarticulo']);
    }
}

<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "noticia_categoria_articulo".
 *
 * @property int $idnoticiacategoriaarticulo
 * @property int $idnoticias
 * @property string $idarticulo
 *
 * @property Articulo $idarticulo0
 * @property Catnoticias $idnoticias0
 */
class NoticiaCategoriaArticulo extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticia_categoria_articulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idnoticias', 'idarticulo'], 'required'],
            [['idnoticias'], 'integer'],
            [['idarticulo'], 'string', 'max' => 20],
            [['idarticulo'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['idarticulo' => 'idarticulo']],
            [['idnoticias'], 'exist', 'skipOnError' => true, 'targetClass' => Catnoticias::className(), 'targetAttribute' => ['idnoticias' => 'idcatnoticias']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idnoticiacategoriaarticulo' => 'Idnoticiacategoriaarticulo',
            'idnoticias' => 'Idnoticias',
            'idarticulo' => 'Idarticulo',
        ];
    }

    /**
     * Gets query for [[Idarticulo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdarticulo0()
    {
        return $this->hasOne(Articulo::class, ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[Idnoticias0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdnoticias0()
    {
        return $this->hasOne(Catnoticias::class, ['idcatnoticias' => 'idnoticias']);
    }
}
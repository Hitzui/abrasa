<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noticia_categoria_articulo".
 *
 * @property int $idnoticiacategoriaarticulo
 * @property int $idnoticias
 * @property string $idarticulo
 *
 * @property Articulo $articulo
 * @property Noticias $noticias
 */
class NoticiaCategoriaArticulo extends \yii\db\ActiveRecord
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
            [['idnoticias'], 'exist', 'skipOnError' => true, 'targetClass' => Noticias::className(), 'targetAttribute' => ['idnoticias' => 'idnoticias']],
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
    public function getArticulo()
    {
        return $this->hasOne(Articulo::class, ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[Idnoticias0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasOne(Noticias::class, ['idnoticias' => 'idnoticias']);
    }
}

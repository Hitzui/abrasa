<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noticia_categoria_articulo".
 *
 * @property int $idnoticiacategoriaarticulo
 * @property int $idnoticias
 * @property int $idcatarticulo
 *
 * @property Categoria $idcatarticulo0
 * @property Catnoticias $idnoticias0
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
            [['idnoticias', 'idcatarticulo'], 'required'],
            [['idnoticias', 'idcatarticulo'], 'integer'],
            [['idcatarticulo'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['idcatarticulo' => 'idcategoria']],
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
            'idcatarticulo' => 'Idcatarticulo',
        ];
    }

    /**
     * Gets query for [[Idcatarticulo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcatarticulo0()
    {
        return $this->hasOne(Categoria::className(), ['idcategoria' => 'idcatarticulo']);
    }

    /**
     * Gets query for [[Idnoticias0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdnoticias0()
    {
        return $this->hasOne(Catnoticias::className(), ['idcatnoticias' => 'idnoticias']);
    }
}
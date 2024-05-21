<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "subcatnoticias".
 *
 * @property int $idsubcategoria
 * @property int $idnoticia
 *
 * @property Noticias $noticia
 * @property Subnoticias $subcategoria
 */
class Subcatnoticias extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcatnoticias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idsubcategoria', 'idnoticia'], 'required'],
            [['idsubcategoria', 'idnoticia'], 'integer'],
            [['idsubcategoria', 'idnoticia'], 'unique', 'targetAttribute' => ['idsubcategoria', 'idnoticia']],
            [['idnoticia'], 'exist', 'skipOnError' => true, 'targetClass' => Noticias::class, 'targetAttribute' => ['idnoticia' => 'idnoticias']],
            [['idsubcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Subnoticias::class, 'targetAttribute' => ['idsubcategoria' => 'idsubnoticias']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idsubcategoria' => 'Idsubcategoria',
            'idnoticia' => 'Idnoticia',
        ];
    }

    /**
     * Gets query for [[Idnoticia0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoticia()
    {
        return $this->hasOne(Noticias::class, ['idnoticias' => 'idnoticia']);
    }

    /**
     * Gets query for [[Idsubcategoria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategoria()
    {
        return $this->hasOne(Subnoticias::class, ['idsubnoticias' => 'idsubcategoria']);
    }
}

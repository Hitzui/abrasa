<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "catnoticias".
 *
 * @property int $idcatnoticias
 * @property string $descripcion
 * @property string $imagen
 * @property int $principal
 *
 * @property Noticias[] $noticias
 * @property Subnoticias[] $subnoticias
 */
class Catnoticias extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'catnoticias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'required'],
            [['imagen'], 'string'],
            [['principal'], 'integer'],
            [['descripcion'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcatnoticias' => 'Idcatnoticias',
            'descripcion' => 'Descripcion',
            'imagen' => 'Imagen',
            'principal' => 'Principal',
        ];
    }

    /**
     * Gets query for [[Noticias]].
     *
     * @return ActiveQuery
     */
    public function getNoticias(): ActiveQuery
    {
        return $this->hasMany(Noticias::class, ['idcategoria' => 'idcatnoticias']);
    }

    /**
     * Gets query for [[Subnoticias]].
     *
     * @return ActiveQuery
     */
    public function getSubnoticias(): ActiveQuery
    {
        return $this->hasMany(Subnoticias::class, ['idcategoria' => 'idcatnoticias']);
    }
}

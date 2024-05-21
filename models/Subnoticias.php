<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "subnoticias".
 *
 * @property int $idsubnoticias
 * @property int $idcategoria
 * @property string $nombre
 * @property string $imagen
 *
 * @property Catnoticias $categoria
 */
class Subnoticias extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subnoticias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcategoria', 'nombre', 'imagen'], 'required'],
            [['idcategoria'], 'integer'],
            [['nombre', 'imagen'], 'string'],
            [['idcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Catnoticias::class, 'targetAttribute' => ['idcategoria' => 'idcatnoticias']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idsubnoticias' => 'Idsubnoticias',
            'idcategoria' => 'Idcategoria',
            'nombre' => 'Nombre',
            'imagen' => 'Imagen',
        ];
    }

    /**
     * Gets query for [[Idcategoria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Catnoticias::class, ['idcatnoticias' => 'idcategoria']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $idcategoria
 * @property string $nombre
 * @property string|null $imagen
 * @property string|null $color
 * @property int|null $posicion
 *
 * @property Subcategoria[] $subcategorias
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['imagen'], 'string'],
            [['color'], 'string'],
            [['posicion'],'number'],
            [['nombre'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcategoria' => 'Idcategoria',
            'nombre' => 'Nombre',
            'imagen' => 'Imagen',
            'color' => 'Color',
            'posicion' => 'Posicion',
        ];
    }

    /**
     * Gets query for [[Subcategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategorias()
    {
        return $this->hasMany(Subcategoria::class, ['idcategoria' => 'idcategoria']);
    }
}

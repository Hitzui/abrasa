<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedor".
 *
 * @property int $idproveedor
 * @property string|null $nombre
 * @property string|null $imagen
 * @property int|null $orden
 */
class Proveedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'imagen'], 'string', 'max' => 200],
            [['orden'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproveedor' => 'Id Proveedor',
            'nombre' => 'Nombre',
            'imagen' => 'Imagen',
            'orden' => 'Orden en la pagina principal',
        ];
    }
}

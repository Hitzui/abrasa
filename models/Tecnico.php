<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tecnico".
 *
 * @property int $idtecnico
 * @property int $idcattecnico
 * @property string $nombre
 * @property string $sucursal
 * @property string $telefono
 * @property string $correo
 * @property string $imagen
 * @property string $area
 * @property int $posicion
 *
 * @property Cattecnico $cattecnico
 */
class Tecnico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tecnico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idcattecnico', 'nombre', 'sucursal', 'telefono', 'correo'], 'required'],
            [['idcattecnico','posicion'], 'integer'],
            [['nombre', 'sucursal', 'telefono', 'correo', 'imagen', 'area'], 'string'],
            [['idcattecnico'], 'exist', 'skipOnError' => true, 'targetClass' => Cattecnico::class, 'targetAttribute' => ['idcattecnico' => 'idcattecnico']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtecnico' => 'Id tecnico',
            'idcattecnico' => 'Id categoria tecnico',
            'nombre' => 'Nombre',
            'sucursal' => 'Sucursal',
            'telefono' => 'Telefono',
            'correo' => 'E-mail',
            'imagen' => 'Imagen',
            'area' => 'Area',
            'posicion' => 'Posicion',
        ];
    }

    /**
     * Gets query for [[Idcattecnico0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCattecnico()
    {
        return $this->hasOne(Cattecnico::class, ['idcattecnico' => 'idcattecnico']);
    }
}

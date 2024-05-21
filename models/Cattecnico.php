<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "cattecnico".
 *
 * @property int $idcattecnico
 * @property string $nombre
 * @property string $imagen
 *
 * @property Tecnico[] $tecnicos
 */
class Cattecnico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cattecnico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre','imagen'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcattecnico' => 'Idcattecnico',
            'nombre' => 'Nombre',
            'imagen' => 'Imagen',
        ];
    }

    /**
     * Gets query for [[Tecnicos]].
     *
     * @return ActiveQuery
     */
    public function getTecnicos()
    {
        return $this->hasMany(Tecnico::class, ['idcattecnico' => 'idcattecnico']);
    }
}

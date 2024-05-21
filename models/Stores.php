<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "stores".
 *
 * @property int $id
 * @property string|null $storeName
 * @property string|null $phoneFormatted
 * @property string|null $address
 * @property string|null $city
 * @property string|null $country
 * @property string|null $postalCode
 * @property string $latitude
 * @property string $longitude
 * @property string $cobertura
 * @property string $ejecutivo
 * @property string $imagen
 */
class Stores extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['latitude', 'longitude'], 'required'],
            [['storeName', 'phoneFormatted', 'address', 'city', 'country', 'postalCode', 'latitude', 'longitude'], 'string', 'max' => 100],
            [['cobertura','ejecutivo','imagen'],'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'storeName' => 'Nombre tienda',
            'phoneFormatted' => 'Telefonos',
            'address' => 'Dirección',
            'city' => 'Ciudad',
            'country' => 'Pais',
            'postalCode' => 'Codigo Postal',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'cobertura'=>'Cobertura',
            'ejecutivo'=>'Ejecutivo de venta',
            'imagen'=>'Imagen'
        ];
    }
}

<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "detafamilia".
 *
 * @property int $idfamilia
 * @property int $idsubcategoria
 *
 * @property Familia $familia
 * @property Subcategoria $ubcategoria
 */
class Detafamilia extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detafamilia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfamilia', 'idsubcategoria'], 'required'],
            [['idfamilia', 'idsubcategoria'], 'integer'],
            [['idfamilia', 'idsubcategoria'], 'unique', 'targetAttribute' => ['idfamilia', 'idsubcategoria']],
            [['idfamilia'], 'exist', 'skipOnError' => true, 'targetClass' => Familia::class, 'targetAttribute' => ['idfamilia' => 'idfamilia']],
            [['idsubcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategoria::class, 'targetAttribute' => ['idsubcategoria' => 'idsubcategoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idfamilia' => 'Idfamilia',
            'idsubcategoria' => 'Idsubcategoria',
        ];
    }

    /**
     * Gets query for [[Idfamilia0]].
     *
     * @return ActiveQuery
     */
    public function getFamilia(): ActiveQuery
    {
        return $this->hasOne(Familia::class, ['idfamilia' => 'idfamilia']);
    }

    /**
     * Gets query for [[Idsubcategoria0]].
     *
     * @return ActiveQuery
     */
    public function getSubcategoria(): ActiveQuery
    {
        return $this->hasOne(Subcategoria::class, ['idsubcategoria' => 'idsubcategoria']);
    }
}

<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "familia".
 *
 * @property int $idfamilia
 * @property string $nombre
 * @property int $idcategoria
 *
 * @property Detafamilia[] $detafamilias
 * @property Subcategoria[] $idsubcategorias
 * @property Categoria $categoria
 */
class Familia extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'familia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'idcategoria'], 'required'],
            [['nombre'], 'string'],
            [['idcategoria'], 'integer'],
            [['idcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['idcategoria' => 'idcategoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idfamilia' => 'Idfamilia',
            'nombre' => 'Nombre',
            'idcategoria' => 'Idcategoria',
        ];
    }

    /**
     * Gets query for [[Detafamilias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetafamilias()
    {
        return $this->hasMany(Detafamilia::class, ['idfamilia' => 'idfamilia']);
    }

    /**
     * Gets query for [[Idsubcategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategorias()
    {
        return $this->hasMany(Subcategoria::class, ['idsubcategoria' => 'idsubcategoria'])->viaTable('detafamilia', ['idfamilia' => 'idfamilia']);
    }

    /**
     * Gets query for [[Idcategoria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['idcategoria' => 'idcategoria']);
    }
}

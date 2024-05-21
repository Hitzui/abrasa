<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detaproveedor".
 *
 * @property int $idproveedor
 * @property string $idarticulo
 *
 * @property Articulo $articulo
 * @property Proveedor $proveedor
 */
class Detaproveedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detaproveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproveedor', 'idarticulo'], 'required'],
            [['idproveedor'], 'integer'],
            [['idarticulo'], 'string', 'max' => 20],
            [['idproveedor', 'idarticulo'], 'unique', 'targetAttribute' => ['idproveedor', 'idarticulo']],
            [['idarticulo'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['idarticulo' => 'idarticulo']],
            [['idproveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['idproveedor' => 'idproveedor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproveedor' => 'Idproveedor',
            'idarticulo' => 'Idarticulo',
        ];
    }

    /**
     * Gets query for [[Articulo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasOne(Articulo::className(), ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[Proveedor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProveedor()
    {
        return $this->hasOne(Proveedor::className(), ['idproveedor' => 'idproveedor']);
    }
}

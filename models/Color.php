<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "color".
 *
 * @property int $idcolor
 * @property string $codigo
 *
 * @property Detacolor[] $detacolors
 * @property Articulo[] $idarticulos
 */
class Color extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'color';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['codigo'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcolor' => 'Idcolor',
            'codigo' => 'Codigo',
        ];
    }

    /**
     * Gets query for [[Detacolors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetacolors()
    {
        return $this->hasMany(Detacolor::className(), ['idcolor' => 'idcolor']);
    }

    /**
     * Gets query for [[Idarticulos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdarticulos()
    {
        return $this->hasMany(Articulo::className(), ['idarticulo' => 'idarticulo'])->viaTable('detacolor', ['idcolor' => 'idcolor']);
    }
}

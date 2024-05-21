<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detacolor".
 *
 * @property string $idarticulo
 * @property int $idcolor
 *
 * @property Articulo $idarticulo0
 * @property Color $idcolor0
 */
class Detacolor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detacolor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idarticulo', 'idcolor'], 'required'],
            [['idcolor'], 'integer'],
            [['idarticulo'], 'string', 'max' => 20],
            [['idarticulo', 'idcolor'], 'unique', 'targetAttribute' => ['idarticulo', 'idcolor']],
            [['idarticulo'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::className(), 'targetAttribute' => ['idarticulo' => 'idarticulo']],
            [['idcolor'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['idcolor' => 'idcolor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idarticulo' => 'Idarticulo',
            'idcolor' => 'Idcolor',
        ];
    }

    /**
     * Gets query for [[Idarticulo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdarticulo0()
    {
        return $this->hasOne(Articulo::className(), ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[Idcolor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcolor0()
    {
        return $this->hasOne(Color::className(), ['idcolor' => 'idcolor']);
    }
}

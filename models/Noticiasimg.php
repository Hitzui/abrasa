<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "noticiasimg".
 *
 * @property int $idnoticias
 * @property int $idimagenes
 *
 * @property Imagenes $idimagenes0
 * @property Noticias $idnoticias0
 */
class Noticiasimg extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticiasimg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idnoticias', 'idimagenes'], 'required'],
            [['idnoticias', 'idimagenes'], 'integer'],
            [['idnoticias', 'idimagenes'], 'unique', 'targetAttribute' => ['idnoticias', 'idimagenes']],
            [['idimagenes'], 'exist', 'skipOnError' => true, 'targetClass' => Imagenes::className(), 'targetAttribute' => ['idimagenes' => 'idimagenes']],
            [['idnoticias'], 'exist', 'skipOnError' => true, 'targetClass' => Noticias::className(), 'targetAttribute' => ['idnoticias' => 'idnoticias']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idnoticias' => 'Idnoticias',
            'idimagenes' => 'Idimagenes',
        ];
    }

    /**
     * Gets query for [[Idimagenes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdimagenes0()
    {
        return $this->hasOne(Imagenes::className(), ['idimagenes' => 'idimagenes']);
    }

    /**
     * Gets query for [[Idnoticias0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdnoticias0()
    {
        return $this->hasOne(Noticias::className(), ['idnoticias' => 'idnoticias']);
    }
}

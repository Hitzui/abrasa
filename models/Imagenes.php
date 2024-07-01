<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "imagenes".
 *
 * @property int $idimagenes
 * @property string $ruta
 * @property int $idnoticia
 *
 * @property Noticias $idnoticia0
 */
class Imagenes extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idnoticia'], 'required'],
            [['idnoticia','idimagenes'], 'integer'],
            [['ruta'], 'string'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg, mp4', 'maxFiles' => 5],
            [['idnoticia'], 'exist', 'skipOnError' => true, 'targetClass' => Noticias::class, 'targetAttribute' => ['idnoticia' => 'idnoticias']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idimagenes' => 'Idimagenes',
            'ruta' => 'Ruta',
            'idnoticia' => 'Idnoticia',
        ];
    }

    /**
     * Gets query for [[Idnoticia0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoticia()
    {
        return $this->hasOne(Noticias::class, ['idnoticias' => 'idnoticia']);
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/imgnoticias/'. $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}

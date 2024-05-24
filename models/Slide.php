<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "slide".
 *
 * @property int $idslide
 * @property string $ruta
 * @property string $titulo
 * @property string $descripcion
 * @property int $video
 */
class Slide extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slide';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['ruta'], 'required'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg,mp4', 'maxFiles' => 1],
            [['titulo','descripcion'], 'string'],
            [['ruta'], 'string'],
            [['video'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idslide' => 'Idslide',
            'ruta' => 'Ruta',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
        ];
    }
}

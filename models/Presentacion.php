<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "presentacion".
 *
 * @property int $idpresentacion
 * @property string $idarticulo
 * @property string $ruta
 * @property string $descripcion
 *
 * @property Articulo $articulo
 */
class Presentacion extends ActiveRecord
{

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presentacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idarticulo', 'descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['idarticulo'], 'string', 'max' => 20],
            [['ruta'], 'string', 'max' => 250],
            [['idarticulo'], 'exist', 'skipOnError' => true, 'targetClass' => Articulo::class, 'targetAttribute' => ['idarticulo' => 'idarticulo']],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpresentacion' => 'Idpresentacion',
            'idarticulo' => 'Idarticulo',
            'ruta' => 'Ruta',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * Gets query for [[Idarticulo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticulo()
    {
        return $this->hasOne(Articulo::class, ['idarticulo' => 'idarticulo']);
    }
}

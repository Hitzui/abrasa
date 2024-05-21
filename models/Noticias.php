<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "noticias".
 *
 * @property int $idnoticias
 * @property string $titulo
 * @property string $contenido_pe
 * @property string $contenido_gr
 * @property string $imagen
 * @property string $fecha
 * @property int|null $idcategoria
 *
 * @property Catnoticias $categoria
 * @property Noticiasimg[] $noticiasimgs
 * @property Imagenes[] $idimagenes
 */
class Noticias extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'contenido_pe', 'contenido_gr', 'fecha'], 'required'],
            [['contenido_pe', 'contenido_gr'], 'string'],
            [['fecha'], 'safe'],
            [['idcategoria'], 'integer'],
            [['titulo'], 'string', 'max' => 300],
            [['imagen'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idnoticias' => 'Idnoticias',
            'titulo' => 'Titulo',
            'contenido_pe' => 'Contenido index',
            'contenido_gr' => 'Contenido vista',
            'imagen' => 'Imagen',
            'fecha' => 'Fecha',
            'idcategoria' => 'Idcategoria',
        ];
    }

    /**
     * Gets query for [[Idcategoria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Catnoticias::class, ['idcatnoticias' => 'idcategoria']);
    }

    /**
     * Gets query for [[Noticiasimgs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNoticiasimgs()
    {
        return $this->hasMany(Noticiasimg::className(), ['idnoticias' => 'idnoticias']);
    }

    /**
     * Gets query for [[Idimagenes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdimagenes()
    {
        return $this->hasMany(Imagenes::className(), ['idimagenes' => 'idimagenes'])->viaTable('noticiasimg', ['idnoticias' => 'idnoticias']);
    }
}

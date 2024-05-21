<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "articulo".
 *
 * @property string $idarticulo
 * @property string $descripcion
 * @property string|null $caracteristicas
 * @property int|null $idsubcategoria
 * @property string|null $rutaimg
 * @property string|null $ficha
 * @property string|null $hoja
 * @property string|null $uso
 * @property string|null $presentacion
 * @property string|null $colores
 * @property string|null $tallas
 * @property boolean|null $inicio
 * @property string|null $keyword
 *
 * @property Subcategoria $idsubcategoria0
 * @property Detaarticulo[] $detaarticulo
 * @property Subcategoria[] $idsubcategorias
 * @property Detacolor[] $detacolors
 * @property Color[] $idcolors
 * @property Detaproveedor[] $detaproveedors
 * @property Proveedor[] $idproveedors
 * @property FamiliaArticulo[] $familiaArticulos
 * @property Familia[] $idfamilias
 */
class Articulo extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idarticulo', 'descripcion'], 'required'],
            [['descripcion', 'caracteristicas', 'hoja', 'uso', 'presentacion', 'colores', 'tallas','keyword'], 'string'],
            [['idsubcategoria'], 'integer'],
            [['inicio'], 'boolean'],
            [['idarticulo'], 'string', 'max' => 20],
            [['rutaimg', 'ficha'], 'string', 'max' => 250],
            [['idarticulo'], 'unique'],
            [['idsubcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategoria::class, 'targetAttribute' => ['idsubcategoria' => 'idsubcategoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idarticulo' => 'Id articulo',
            'descripcion' => 'Descripcion',
            'caracteristicas' => 'Caracteristicas',
            'idsubcategoria' => 'Subcategoria',
            'rutaimg' => 'Ruta imagen',
            'ficha' => 'Ficha',
            'hoja' => 'Hoja',
            'uso' => 'Uso',
            'presentacion' => 'Presentacion',
            'colores' => 'Colores',
            'tallas' => 'Tallas',
            'inicio' => 'Slide Principal',
            'keyword' => 'Palabras claves',
        ];
    }

    /**
     * Gets query for [[Idsubcategoria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategoria()
    {
        return $this->hasOne(Subcategoria::class, ['idsubcategoria' => 'idsubcategoria']);
    }

    /**
     * Gets query for [[Detaarticulos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetaarticulo()
    {
        return $this->hasMany(Detaarticulo::class, ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[Idsubcategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdsubcategorias()
    {
        return $this->hasMany(Subcategoria::class, ['idsubcategoria' => 'idsubcategoria'])->viaTable('detaarticulo', ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[Detacolors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetacolors()
    {
        return $this->hasMany(Detacolor::class, ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[Idcolors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdcolors()
    {
        return $this->hasMany(Color::class, ['idcolor' => 'idcolor'])->viaTable('detacolor', ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[Detaproveedors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetaproveedor()
    {
        return $this->hasMany(Detaproveedor::class, ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[Idproveedors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdproveedors()
    {
        return $this->hasMany(Proveedor::class, ['idproveedor' => 'idproveedor'])->viaTable('detaproveedor', ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[FamiliaArticulos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamiliaArticulos()
    {
        return $this->hasMany(FamiliaArticulo::class, ['idarticulo' => 'idarticulo']);
    }

    /**
     * Gets query for [[Idfamilias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdfamilias()
    {
        return $this->hasMany(Familia::class, ['idfamilia' => 'idfamilia'])->viaTable('familia_articulo', ['idarticulo' => 'idarticulo']);
    }
}

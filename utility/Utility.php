<?php

namespace app\utility;

use app\models\Articulo;
use app\models\Familia;
use app\models\Subcategoria;
use yii\helpers\ArrayHelper;

class Utility
{
    public static function familias(): array
    {
        $familiaQuery = Familia::find()
            ->joinWith('categoria')
            ->select(['familia.idfamilia', 'concat(categoria.nombre, "-",familia.nombre) as nombre'])
            ->all();
        return ArrayHelper::map($familiaQuery, 'idfamilia', 'nombre');
    }

    public static function subCategorias(): array
    {
        $query = Subcategoria::find()
            ->joinWith('categoria')
            ->select(['subcategoria.idsubcategoria', 'concat(categoria.nombre,"-",subcategoria.nombre) as nombre'])
            ->all();
        return ArrayHelper::map($query, 'idsubcategoria', 'nombre');
    }
    public static function articulos(): array
    {
        $query = Articulo::find()
            ->joinWith('subcategoria')
            ->select(['articulo.idarticulo','concat(subcategoria.nombre,"-",articulo.descripcion) as descripcion'])
            ->all();
        return ArrayHelper::map($query, 'idarticulo', 'descripcion');
    }
}
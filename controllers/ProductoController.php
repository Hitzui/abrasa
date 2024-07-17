<?php

namespace app\controllers;

use app\models\Articulo;
use app\models\Categoria;
use app\models\Detaarticulo;
use app\models\Familia;
use app\models\FamiliaArticulo;
use app\models\Presentacion;
use app\models\Proveedor;
use app\models\Detaproveedor;
use app\models\Stores;
use app\models\Subcategoria;
use yii\data\Pagination;
use yii\data\Sort;
use yii\filters\AccessControl;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use function PHPUnit\Framework\isNull;

class ProductoController extends Controller
{

    private $pageSize = 12;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => Cors::class,
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($search = null): string
    {
        if (!isset($search)) {
            $search = '';
        }
        $sort = new Sort([
            'attributes' => [
                'descripcion' => SORT_ASC,
                'ascendente' => [
                    'asc' => ['descripcion' => SORT_ASC],
                    //'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Ascendente',
                ],
                'descendente' => [
                    'desc' => ['descripcion' => SORT_DESC],
                    //'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Descendente',
                ]
            ],
        ]);
        $query = Articulo::find()->andFilterWhere(['like', 'keyword', $search]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = $this->pageSize;
        $model = $query->offset($pages->offset)
            ->orderBy($sort->orders)
            ->limit($pages->limit)
            ->all();
        $categorias = Categoria::find()->all();
        if (!isset($search)) {
            $search = "Todos";
        }
        $nombre = "Productos filtrados por: " . $search;
        return $this->render('index', [
            'categorias' => $categorias,
            'buscar' => $search,
            'nombre' => $nombre,
            'model' => $model,
            'pagination' => $pages,
            'family' => new Familia(),
            'category' => new Categoria(),
            'cat' => new Categoria(),
            'sub' => new Subcategoria(),
            'sort' => $sort
        ]);
    }

    public function actionStore()
    {
        $query = Stores::find()->all();
        $features = [];
        $i = 0;
        foreach ($query as $row) {
            $lat = $row['latitude'];
            $long = $row['longitude'];
            $propiedades1 = array('phoneFormatted' => $row['phoneFormatted'], 'address' => $row['address'],
                'city' => $row['city'], 'country' => $row['country'], 'cobertura' => $row['cobertura'],
                'ejecutivo' => $row['ejecutivo'], 'postalCode' => $row['postalCode'],
                'storeName' => $row['storeName'],'imagen'=>$row['imagen']);
            $arreglo_datos = array('type' => 'Feature', 'properties' => $propiedades1,
                'geometry' => array('type' => 'Point', 'coordinates' => array(0 => $long, 1 => $lat)));
            $features += ["$i" => $arreglo_datos];
            $i++;
        }
        $data = array('type' => 'FeatureCollection', 'features' => $features);
        return Json::encode($data);
    }


    public function actionSubcategoria($id)
    {
        $query = Articulo::find()->where(['idsubcategoria' => $id])->orderBy(['descripcion' => SORT_DESC]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = $this->pageSize;
        $model = $query->offset($pages->offset)
            ->orderBy(['articulo.descripcion' => SORT_ASC])
            ->limit($pages->limit)
            ->all();
        //$model = Articulo::findAll(['idsubcategoria'=>$id]);
        $categorias = Categoria::find()->all();
        if ($model === null) {
            return $this->redirect('index', [
                'categorias' => $categorias,
            ]);
        }
        $sub = Subcategoria::findOne($id);
        $cat = Categoria::findOne($sub->idcategoria);
        $nombre = $cat->nombre . ' | ' . $sub->nombre;
        return $this->render('find', [
            'sub' => $sub,
            'cat' => $cat,
            'nombre' => $nombre,
            'categorias' => $categorias,
            'model' => $model,
            'pagination' => $pages,
            'familia' => new Familia(),
        ]);
    }

    public function actionAfamilia($idfamilia)
    {
        $familia = Familia::findOne(['idfamilia' => $idfamilia]);
        $familias = FamiliaArticulo::find()->where(['idfamilia' => $idfamilia])->all();
        $query = Articulo::find()->where(['idsubcategoria' => $familias])->orderBy(['descripcion' => SORT_DESC]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = $this->pageSize;
        $model = $query->offset($pages->offset)
            ->orderBy(['articulo.descripcion' => SORT_ASC])
            ->limit($pages->limit)
            ->all();
        $categorias = Categoria::find()->all();
        $categoria = Categoria::findOne(['idcategoria' => $familia->idcategoria]);
        if ($model === null) {
            return $this->redirect('index', [
                'categorias' => $categorias,
            ]);
        }
        return $this->renderPartial('_datos', [
            'categorias' => $categorias,
            'model' => $model,
            'category' => $categoria,
            'familias' => $familias,
            'family' => $familia,
            'pagination' => $pages,
        ]);
    }

    public function actionFamilia($idfamilia)
    {
        $sort = new Sort([
            'attributes' => [
                'descripcion' => [
                    'default' => SORT_ASC
                ],
                'ascendente' => [
                    'asc' => ['descripcion' => SORT_ASC],
                    //'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Ascendente',
                ],
                'descendente' => [
                    'desc' => ['descripcion' => SORT_DESC],
                    //'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Descendente',
                ]
            ],
        ]);
        //$sort->defaultOrder=['descripcion'=>SORT_ASC];
        $familia = Familia::find()->where(['idfamilia' => $idfamilia])->one();
        $category = $familia->categoria;
        $familias = FamiliaArticulo::find()->where(['idfamilia' => $idfamilia])->all();
        $categorias = Categoria::find()->all();
        $query = Articulo::find()->where(['idarticulo' => $familias])->orderBy($sort->orders);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = $this->pageSize;
        $model = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        if ($model === null) {
            return $this->redirect('index', [
                'categorias' => $categorias,
            ]);
        }
        return $this->render('familia', [
            'categorias' => $categorias,
            'category' => $category,
            'model' => $model,
            'familias' => $familias,
            'family' => $familia,
            'pagination' => $pages,
            'sort' => $sort,
            'sub' => new Subcategoria(),
            'cat' => $category,
        ]);
    }

    public function actionFind($id, $idfamilia)
    {
        $sort = new Sort([
            'attributes' => [
                'descripcion' => SORT_ASC,
                'ascendente' => [
                    'asc' => ['descripcion' => SORT_ASC],
                    //'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Ascendente',
                ],
                'descendente' => [
                    'desc' => ['descripcion' => SORT_DESC],
                    //'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Descendente',
                ]
            ],
        ]);
        $familias = FamiliaArticulo::find()->where(['idsubcategoria' => $id, 'idfamilia' => $idfamilia])->all();
        if (count($familias) <= 0) {
            $ids = Detaarticulo::findAll(['idsubcategoria' => $id]);
            $query = Articulo::find()->where(['idarticulo' => $ids]);
            $familia = new Familia();
        } else {
            $query = Articulo::find()->where(['idarticulo' => $familias]);
            $familia = Familia::findOne(['idfamilia' => $idfamilia]);
        }
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = $this->pageSize;
        $model = $query->orderBy($sort->orders)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        //$model = Articulo::findAll(['idsubcategoria'=>$id]);
        $categorias = Categoria::find()->all();
        if ($model === null) {
            return $this->redirect('index', [
                'categorias' => $categorias,
            ]);
        }
        $sub = Subcategoria::findOne($id);
        $cat = Categoria::findOne($sub->idcategoria);
        $nombre = $cat->nombre . ' | ' . $sub->nombre;
        $category = $familia->categoria;
        if (is_null($category)) {
            $category = new Categoria();
        }
        return $this->render('find', [
            'sub' => $sub,
            'cat' => $cat,
            'nombre' => $nombre,
            'categorias' => $categorias,
            'model' => $model,
            'family' => $familia,
            'pagination' => $pages,
            'sort' => $sort,
            'category' => $category
        ]);
    }

    public function actionCategoria($id)
    {
        $sort = new Sort([
            'attributes' => [
                'descripcion',
                'ascendente' => [
                    'asc' => ['descripcion' => SORT_ASC],
                    //'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                    'default' => SORT_ASC,
                    'label' => 'Ascendente',
                ],
                'descendente' => [
                    'desc' => ['descripcion' => SORT_DESC],
                    //'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Descendente',
                ]
            ],
        ]);
        //$sort->defaultOrder=['descripcion'=>SORT_ASC];
        /*
         select * from familia_articulo far
         join subcategoria sub on far.idsubcategoria = sub.idsubcategoria
         join categoria cat on sub.idcategoria=sub.idcategoria
         where cat.idcategoria=22
         */
        $filter = FamiliaArticulo::find()
            ->leftJoin('subcategoria','familia_articulo.idsubcategoria = subcategoria.idsubcategoria')
            ->leftJoin('categoria', 'subcategoria.idcategoria = categoria.idcategoria')
            ->where(['categoria.idcategoria' => $id])
            ->all();
        $query=Articulo::find()->where(['idarticulo' => $filter]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = $this->pageSize;
        $model = $query->offset($pages->offset)
            ->orderBy($sort->orders)
            ->limit($pages->limit)
            ->all();
        //$model = Articulo::findAll(['idsubcategoria'=>$id]);
        $categorias = Categoria::find()->all();
        if ($model === null) {
            return $this->redirect('index', [
                'categorias' => $categorias,
            ]);
        }
        $cat = Categoria::findOne($id);
        $nombre = $cat->nombre;
        return $this->render('categoria', [
            'cat' => $cat,
            'category' => $cat,
            'nombre' => $nombre,
            'categorias' => $categorias,
            'model' => $model,
            'pagination' => $pages,
            'sort' => $sort,
            'sub' => new Subcategoria(),
            'family' => new Familia()
        ]);
    }

    public function actionView($idarticulo)
    {
        $find = Articulo::findOne(["idarticulo" => $idarticulo]);
        $categorias = Categoria::find()->all();
        $familiaArticulo = FamiliaArticulo::find()->where(['idarticulo' => $idarticulo])->one();
        $deta = Detaproveedor::find()->where(['idarticulo' => $find->idarticulo])->all();
        $family = Familia::find()->where(['idfamilia' => $familiaArticulo->idfamilia])->one();
        $ids = array();
        $subcategoria = Subcategoria::findOne(['idsubcategoria' => $familiaArticulo->idsubcategoria]);
        $category=null;
        if (!is_null($family)) {
            $category = Categoria::findOne(['idcategoria' => $family->idcategoria]);
        }
        if (is_null($category)) {
            $category = new Categoria();
        }
        $detaFamilia = FamiliaArticulo::find()->where(['idarticulo' => $find->idarticulo])->all();
        $presentaciones = Presentacion::find()->where(['idarticulo' => $idarticulo])->all();
        if (count($detaFamilia) > 0) {
            $familias = Familia::find()->where(['idfamilia' => $detaFamilia])->all();
            $family = Familia::find()->where(['idfamilia' => $detaFamilia])->one();
            $category = Categoria::findOne(['idcategoria' => $family->idcategoria]);
        } else {
            $family = new Familia();
            $familias = null;
        }
        foreach ($deta as $d) {
            $ids[] = $d->idproveedor;
        }
        $proveedor = Proveedor::findAll($ids);
        return $this->render("view", [
            'find' => $find,
            'proveedor' => $proveedor,
            'categorias' => $categorias,
            'category' => $category,
            'cat' => $category,
            'subcategoria' => $subcategoria,
            'sub' => $subcategoria,
            'detaFamilia' => $detaFamilia,
            'family' => $family,
            'familias' => $familias,
            'presentaciones' => $presentaciones,
        ]);
    }

    public function actionProveedor($id = null)
    {
        $proveedores = Proveedor::findOne(['idproveedor' => $id]);
        $query = Articulo::find()
            ->joinWith('detaproveedor')
            ->where(['detaproveedor.idproveedor' => $id]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = $this->pageSize;
        $model = $query->offset($pages->offset)
            ->orderBy(['descripcion' => SORT_ASC])
            ->limit($pages->limit)
            ->all();
        $categorias = Categoria::find()->all();
        return $this->render('proveedor', [
            'proveedores' => $proveedores,
            'categorias' => $categorias,
            'model' => $model,
            'pagination' => $pages,
            'family' => new Familia(),
            'category' => new Categoria(),
            'cat' => new Categoria(),
            'sub' => new Subcategoria(),
        ]);
    }
}
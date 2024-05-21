<?php

namespace app\controllers;

use app\models\Articulo;
use app\models\Categoria;
use app\models\Detaarticulo;
use app\models\Familia;
use app\models\FamiliaArticulo;
use app\models\Proveedor;
use app\models\Detaproveedor;
use app\models\Stores;
use app\models\Subcategoria;
use Codeception\Test\Gherkin;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;

class ProductoController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
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

    public function actionIndex($search = null)
    {
        if (!isset($search)) {
            $search = "";
        }
        $query = Articulo::find()->andFilterWhere(['like', 'descripcion', $search])->orderBy(['descripcion'=>SORT_DESC]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = 6;
        $model = $query->offset($pages->offset)
            ->orderBy(['descripcion' => SORT_ASC])
            ->limit($pages->limit)
            ->all();
        $categorias = Categoria::find()->all();
        $nombre = "Productos filtrados por: " . $search;
        return $this->render('index', [
            'categorias' => $categorias,
            'buscar' => $search,
            'nombre' => $nombre,
            'model' => $model,
            'pagination' => $pages,
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
            $propiedades1 = array('phoneFormatted' => $row['phoneFormatted'], 'address' => $row['address'], 'city' => $row['city'], 'country' => $row['country']
            , 'postalCode' => $row['postalCode'], 'storeName' => $row['storeName']);
            $arreglo_datos = array('type' => 'Feature', 'properties' => $propiedades1, 'geometry' => array('type' => 'Point', 'coordinates' => array(0 => $long, 1 => $lat)));
            $features += ["$i" => $arreglo_datos];
            $i++;
        }
        $data = array('type' => 'FeatureCollection', 'features' => $features);
        return Json::encode($data);
    }


    public function actionSubcategoria($id)
    {
        $query = Articulo::find()->where(['idsubcategoria' => $id])->orderBy(['descripcion'=>SORT_DESC]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = 6;
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
            'familia'=>new Familia(),
        ]);
    }

    public function actionFamilia($idfamilia)
    {
        $familia = Familia::findOne(['idfamilia'=>$idfamilia]);
        $familias = FamiliaArticulo::find()->where(['idfamilia' => $idfamilia])->all();
        $query = Articulo::find()->where(['idsubcategoria' => $familias])->orderBy(['descripcion'=>SORT_DESC]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = 6;
        $model = $query->offset($pages->offset)
            ->orderBy(['articulo.descripcion' => SORT_ASC])
            ->limit($pages->limit)
            ->all();
        $categorias = Categoria::find()->all();
        $categoria = Categoria::findOne(['idcategoria'=>$familia->idcategoria]);
        if ($model === null) {
            return $this->redirect('index', [
                'categorias' => $categorias,
            ]);
        }
        return $this->render('familia', [
            'categorias' => $categorias,
            'model' => $model,
            'categoria' => $categoria,
            'familias' => $familias,
            'family' => $familia,
            'pagination' => $pages,
        ]);
    }

    public function actionFind($id, $idfamilia)
    {
        $familias = FamiliaArticulo::find()->where(['idsubcategoria' => $id, 'idfamilia' => $idfamilia])->all();
        if (count($familias) <= 0) {
            $ids = Detaarticulo::findAll(['idsubcategoria' => $id]);
            $query = Articulo::find()->where(['idarticulo' => $ids])->orderBy(['descripcion'=>SORT_DESC]);
            $familia = null;
        } else {
            $query = Articulo::find()->where(['idsubcategoria' => $familias])->orderBy(['descripcion'=>SORT_DESC]);
            $familia = Familia::findOne(['idfamilia' => $idfamilia]);
        }
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = 6;
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
            'familia' => $familia,
            'pagination' => $pages,
        ]);
    }

    public function actionCategoria($id)
    {
        $query = Articulo::find()
            ->joinWith('subcategoria')
            ->leftJoin('categoria', 'subcategoria.idcategoria = categoria.idcategoria')
            ->where(['categoria.idcategoria' => $id]);
        $count = $query->count();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->defaultPageSize = 6;
        $model = $query->offset($pages->offset)
            ->orderBy(['descripcion' => SORT_ASC])
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
            'nombre' => $nombre,
            'categorias' => $categorias,
            'model' => $model,
            'pagination' => $pages,
        ]);
    }

    public function actionView($idarticulo)
    {
        $find = Articulo::findOne(["idarticulo" => $idarticulo]);
        $categorias = Categoria::find()->all();
        $deta = Detaproveedor::find()->where(['idarticulo' => $find->idarticulo])->all();
        $ids = array();
        $subcategoria = Subcategoria::findOne(['idsubcategoria' => $find->idsubcategoria]);
        $categoria = Categoria::findOne(['idcategoria' => $subcategoria->idcategoria]);
        $detaFamilia = FamiliaArticulo::findOne(['idarticulo' => $find->idarticulo]);
        $familia = Familia::findOne(['idcategoria' => $categoria->idcategoria]);
        foreach ($deta as $d) {
            $ids[] = $d->idproveedor;
        }
        $proveedor = Proveedor::findAll($ids);
        return $this->render("view", [
            'find' => $find,
            'proveedor' => $proveedor,
            'categorias' => $categorias,
            'categoria' => $categoria,
            'subcategoria' => $subcategoria,
            'detaFamilia' => $detaFamilia,
            'familia' => $familia,
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
        $pages->defaultPageSize = 6;
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
        ]);
    }
}
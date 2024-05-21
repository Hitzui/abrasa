<?php

namespace app\controllers;

use app\models\Articulo;
use app\models\Cattecnico;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\Proveedor;
use app\models\Stores;
use Yii;
use yii\filters\AccessControl;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

class AboutController extends Controller
{
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
                'only' => ['logout'],
                'rules' => [
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

    public function actionIndex()
    {
        $stores = Stores::find()->all();
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('index', [
            'model' => $model,
            'stores' => $stores,
        ]);
        //return $this->render('index');
    }

    public function actionProveedores()
    {
        $proveedores = Proveedor::find()->all();
        return $this->render('proveedores', [
            'proveedores' => $proveedores
        ]);
    }

    public function actionFilter($param)
    {
        $query = Proveedor::find()->andFilterWhere(['like', 'nombre', $param])->all();
        return $this->renderPartial('_filter', [
            'proveedores' => $query
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
            , 'postalCode' => $row['postalCode'], 'storeName' => $row['storeName'], 'cobertura' => $row['cobertura']);
            $arreglo_datos = array('type' => 'Feature', 'properties' => $propiedades1, 'geometry' => array('type' => 'Point', 'coordinates' => array(0 => $long, 1 => $lat)));
            $features += ["$i" => $arreglo_datos];
            $i++;
        }
        $data = array('type' => 'FeatureCollection', 'features' => $features);
        return Json::encode($data);
        //return json_encode($data);
    }

    public function actionCobertura()
    {
        $articulo = Articulo::find()->all();
        $query = Stores::find()->all();
        return $this->render('cobertura', [
            "articulos" => $articulo,
            "stores" => $query
        ]);
    }

    public function actionSucursales()
    {
        return $this->render('sucursales');
    }

    public function actionEquipo($activo = null)
    {
        if(!isset($activo)){
            $activo=0;
        }
        $categoriasTecnicos = Cattecnico::find()->all();
        return $this->render('equipo', [
            'categoriaTecnicos' => $categoriasTecnicos,
            'activo' => $activo
        ]);
    }

    public function actionQuienesSomos()
    {
        return $this->render('about');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPerfil()
    {
        $proveedores = Proveedor::find()->all();
        $categoriaTecnicos = Cattecnico::find()->all();
        return $this->render('perfil',
            [
                'proveedores' => $proveedores,
                'categoriaTecnicos' => $categoriaTecnicos
            ]
        );
    }
}
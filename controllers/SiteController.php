<?php

namespace app\controllers;

use app\models\Articulo;
use app\models\Categoria;
use app\models\Catnoticias;
use app\models\ContactForm;
use app\models\LoginForm;
use app\models\Noticias;
use app\models\Proveedor;
use app\models\Slide;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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

    /**}
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $categoria = Categoria::find()->orderBy('posicion')->all();
        $proveedores = Proveedor::find()->orderBy('orden')->all();
        $slide = Slide::find()->all();
        $articulos = Articulo::find()->where(['inicio' => true])->orderBy('descripcion')->all();
        //buscamos todas las noticias que tenga como categoria aparecer en la pagina principal
        /*$noticias = Catnoticias::find()->where(['principal'=>1])->one();
        if (isset($noticias)){
            $noticias=$noticias->getNoticias()->limit(6)->all();
        }else{
            $noticias=Noticias::find()->limit(6)->all();
        }*/
        $noticias=Noticias::find()->orderBy(['idnoticias'=>SORT_DESC])->limit(6)->all();
        return $this->render('index', [
            'categorias' => $categoria,
            'proveedores' => $proveedores,
            'articulos' => $articulos,
            'slide' => $slide,
            'noticias'=>$noticias
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'admin';
        //$isGuest = Yii::$app->user->isGuest;
        $isGuest = Yii::$app->user->identity;
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'isGuest' => $isGuest,
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
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
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
}

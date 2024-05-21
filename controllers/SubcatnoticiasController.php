<?php

namespace app\controllers;

use app\models\Catnoticias;
use app\models\Noticias;
use app\models\Subnoticias;
use Yii;
use app\models\Subcatnoticias;
use app\models\SubcatnoticiasSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * SubcatnoticiasController implements the CRUD actions for Subcatnoticias model.
 */
class SubcatnoticiasController extends Controller
{
    public $layout = 'admin';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'index', 'create', 'update', 'view', 'logout'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Subcatnoticias models.
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new SubcatnoticiasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subcatnoticias model.
     * @param integer $idsubcategoria
     * @param integer $idnoticia
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $idsubcategoria, int $idnoticia): string
    {
        return $this->render('view', [
            'model' => $this->findModel($idsubcategoria, $idnoticia),
        ]);
    }

    /**
     * Creates a new Subcatnoticias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Subcatnoticias();
        $subcategoria = ArrayHelper::map(Subnoticias::find()->all(),'idsubnoticias','nombre');
        $noticias = ArrayHelper::map(Noticias::find()->all(),'idnoticias','titulo');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idsubcategoria' => $model->idsubcategoria, 'idnoticia' => $model->idnoticia]);
        }

        return $this->render('create', [
            'model' => $model,
            'subcategoria' => $subcategoria,
            'noticias' => $noticias,
        ]);
    }

    /**
     * Updates an existing Subcatnoticias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idsubcategoria
     * @param integer $idnoticia
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idsubcategoria, $idnoticia)
    {
        $model = $this->findModel($idsubcategoria, $idnoticia);
        $subcategoria = ArrayHelper::map(Subnoticias::find()->all(),'idsubnoticias','nombre');
        $noticias = ArrayHelper::map(Noticias::find()->all(),'idnoticias','titulo');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idsubcategoria' => $model->idsubcategoria, 'idnoticia' => $model->idnoticia]);
        }

        return $this->render('update', [
            'model' => $model,
            'subcategoria' => $subcategoria,
            'noticias' => $noticias,
        ]);
    }

    /**
     * Deletes an existing Subcatnoticias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idsubcategoria
     * @param integer $idnoticia
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idsubcategoria, $idnoticia)
    {
        $this->findModel($idsubcategoria, $idnoticia)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Subcatnoticias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idsubcategoria
     * @param integer $idnoticia
     * @return Subcatnoticias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idsubcategoria, $idnoticia)
    {
        if (($model = Subcatnoticias::findOne(['idsubcategoria' => $idsubcategoria, 'idnoticia' => $idnoticia])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

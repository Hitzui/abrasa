<?php

namespace app\controllers;

use app\models\Articulo;
use app\models\Presentacion;
use app\models\PresentacionSearch;
use app\utility\Utility;
use Yii;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * PresentacionController implements the CRUD actions for Presentacion model.
 */
class PresentacionController extends Controller
{
    public $layout = 'admin';

    public $rutaImagen = 'uploads/presentacion/';

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
     * Lists all Presentacion models.
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new PresentacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Presentacion model.
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Presentacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Presentacion();
        $articulos = Utility::articulos();
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'ruta');
            if (!file_exists($this->rutaImagen . $model->idarticulo . '/')) {
                mkdir($this->rutaImagen . $model->idarticulo . '/', 0777, true);
            }
            if (isset($file)) {
                $file->saveAs($this->rutaImagen . $model->idarticulo . '/' . $file->baseName . '.' . $file->extension);
                $model->ruta = Url::base(true) . '/' . $this->rutaImagen . $model->idarticulo . '/' . $file->baseName . '.' . $file->extension;
            } else {
                $model->ruta = '';
            }
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->idpresentacion]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'articulos' => $articulos,
        ]);
    }

    /**
     * Updates an existing Presentacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return Response|string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $imagen = $model->ruta;
        $articulos = Utility::articulos();
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'ruta');
            if (!file_exists($this->rutaImagen . $model->idarticulo . '/')) {
                mkdir($this->rutaImagen . $model->idarticulo . '/', 0777, true);
            }
            if (isset($file) || !empty($file)) {
                $file->saveAs($this->rutaImagen . $model->idarticulo . '/' . $file->baseName . '.' . $file->extension);
                $model->ruta = Url::base(true) . '/' .$this->rutaImagen . $model->idarticulo . '/' . $file->baseName . '.' . $file->extension;
            } else {
                $model->ruta = $imagen;
            }
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->idpresentacion]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'articulos' => $articulos,
        ]);
    }

    /**
     * Deletes an existing Presentacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     * @noinspection PhpMultipleClassDeclarationsInspection
     */
    public function actionDelete(int $id): Response
    {
        try {
            $this->findModel($id)->delete();
        } catch (StaleObjectException|NotFoundHttpException|\Throwable $e) {
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Presentacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Presentacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Presentacion
    {
        if (($model = Presentacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

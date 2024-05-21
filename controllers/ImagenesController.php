<?php

namespace app\controllers;

use app\models\Noticias;
use Yii;
use app\models\Imagenes;
use app\models\ImagenesSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ImagenesController implements the CRUD actions for Imagenes model.
 */
class ImagenesController extends Controller
{
    public $layout = 'admin';
    private $path = 'uploads/imgnoticias/';

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
     * Lists all Imagenes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImagenesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Imagenes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpload($model)
    {

    }

    /**
     * Creates a new Imagenes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Imagenes();
        $noticias = ArrayHelper::map(Noticias::find()->all(), 'idnoticias', 'titulo');
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            $files = $model->imageFiles;
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {
                if ($model->validate()) {
                    if (!file_exists($this->path . $model->idnoticia)) {
                        mkdir($this->path . $model->idnoticia);
                    }
                    foreach ($files as $file) {
                        $file->saveAs($this->path . $model->idnoticia . '/' . $file->baseName . '.' . $file->extension);
                        $img = new Imagenes();
                        $img->ruta = $this->path . $model->idnoticia . '/' . $file->baseName . '.' . $file->extension;
                        $img->idnoticia = $model->idnoticia;
                        $img->save(false);
                    }
                    $transaction->commit();
                    return $this->redirect('view', [
                        'model'=>$model
                    ]);
                }
            } catch (\Exception $exception) {
                $transaction->rollBack();
                return $this->render('create', [
                    'model' => $model,
                    'noticias' => $noticias,
                    'multiple' => true
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'noticias' => $noticias,
                'multiple' => true
            ]);
        }

    }

    /**
     * Updates an existing Imagenes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagen = $model->ruta;
        $noticias = ArrayHelper::map(Noticias::find()->all(), 'idnoticias', 'titulo');
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            $file = $model->imageFiles[0];
            if (strlen($file->baseName) >= 1) {
                if (!file_exists($this->path . $model->idnoticia)) {
                    mkdir($this->path . $model->idnoticia);
                }
                //$model->ruta = $this->path . $model->imageFiles[0]->baseName . '.' . $model->imageFiles[0]->extension;
                $model->ruta = $this->path . $model->idnoticia . '/' . $model->imageFiles[0]->baseName . '.' . $model->imageFiles[0]->extension;
            } else {
                $model->ruta = $imagen;
            }
            $model->save();
            $file->saveAs($this->path . $model->idnoticia . '/' . $model->imageFiles[0]->baseName . '.' . $model->imageFiles[0]->extension);
            return $this->redirect(['view', 'id' => $model->idimagenes]);
        }

        return $this->render('update', ['model' => $model,
                'noticias' => $noticias,
                'multiple' => false]
        );
    }

    /**
     * Deletes an existing Imagenes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Imagenes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Imagenes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Imagenes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

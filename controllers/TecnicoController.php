<?php

namespace app\controllers;

use app\models\Cattecnico;
use Yii;
use app\models\Tecnico;
use app\models\TecnicoSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TecnicoController implements the CRUD actions for Tecnico model.
 */
class TecnicoController extends Controller
{
    public $layout = 'admin';
    public $rutaImagen = 'uploads/tecnicos/';

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
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
     * Lists all Tecnico models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TecnicoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tecnico model.
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

    /**
     * Creates a new Tecnico model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tecnico();
        $cattecnicos = ArrayHelper::map(Cattecnico::find()->all(), 'idcattecnico', 'nombre');
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'imagen');
            if (!file_exists($this->rutaImagen)) {
                mkdir($this->rutaImagen, 0777, true);
            }
            if (isset($file)) {
                $file->saveAs($this->rutaImagen . $file->baseName . '.' . $file->extension);
                $model->imagen = $this->rutaImagen . $file->baseName . '.' . $file->extension;
            } else {
                $model->imagen = '';
            }
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->idtecnico]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'cattecnicos' => $cattecnicos,
        ]);
    }

    /**
     * Updates an existing Tecnico model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagen = $model->imagen;
        $cattecnicos = ArrayHelper::map(Cattecnico::find()->all(), 'idcattecnico', 'nombre');
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'imagen');
            if (!file_exists($this->rutaImagen)) {
                mkdir($this->rutaImagen, 0777, true);
            }
            if (isset($file)) {
                $file->saveAs($this->rutaImagen . $file->baseName . '.' . $file->extension);
                $model->imagen = $this->rutaImagen . $file->baseName . '.' . $file->extension;
            } else {
                $model->imagen = $imagen;
            }
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->idtecnico]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'cattecnicos' => $cattecnicos,
        ]);
    }

    /**
     * Deletes an existing Tecnico model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tecnico model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tecnico the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tecnico::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

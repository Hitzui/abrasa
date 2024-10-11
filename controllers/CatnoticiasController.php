<?php

namespace app\controllers;

use Yii;
use app\models\Catnoticias;
use app\models\CatnoticiasSearch;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * CatnoticiasController implements the CRUD actions for Catnoticias model.
 */
class CatnoticiasController extends Controller
{
    public $layout = 'admin';
    public $rutaImagen = 'uploads/noticias/';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Catnoticias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CatnoticiasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Catnoticias model.
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
     * Creates a new Catnoticias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return Response|string
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = new Catnoticias();

        if ($model->load(Yii::$app->request->post())) {
            $this->uploadFile($model, '');
            if ($model->save(false)) {
                if ($model->principal > 0) {
                    Yii::$app->db->createCommand()
                        ->update('catnoticias', ['principal' => 0], 'idcatnoticias !=:id')
                        ->bindValue(':id',$model->idcatnoticias)
                        ->execute();
                }
                return $this->redirect(['view', 'id' => $model->idcatnoticias]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Catnoticias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return Response|string
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Exception
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $imagen = $model->imagen;
        if ($model->load(Yii::$app->request->post())) {
            $this->uploadFile($model, $imagen);
            if ($model->save()) {
                if ($model->principal > 0) {
                    Yii::$app->db->createCommand()
                        ->update('catnoticias', ['principal' => 0], 'idcatnoticias !=:id')
                        ->bindValue(':id',$model->idcatnoticias)
                        ->execute();
                }
                return $this->redirect(['view', 'id' => $model->idcatnoticias]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Catnoticias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return Response
     */
    public function actionDelete(int $id): Response
    {
        try {
            $this->findModel($id)->delete();
        } catch (\Exception|\Throwable $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Catnoticias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catnoticias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Catnoticias
    {
        if (($model = Catnoticias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function uploadFile(Catnoticias $model, $imagen)
    {
        $file = UploadedFile::getInstance($model, 'imagen');
        if (isset($file)) {
            $file->saveAs($this->rutaImagen . $file->baseName . '.' . $file->getExtension());
            $model->imagen = Url::base(true) . '/' . $this->rutaImagen . $file->baseName . '.' . $file->getExtension();
        } else {
            $model->imagen = $imagen;
        }
    }
}

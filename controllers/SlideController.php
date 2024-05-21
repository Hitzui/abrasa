<?php

namespace app\controllers;

use app\models\Slide;
use app\models\SlideSearch;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * SlideController implements the CRUD actions for Slide model.
 */
class SlideController extends Controller
{
    private $path = 'uploads/slide/';
    public $layout = 'admin';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'alls', 'create', 'update', 'view', 'logout'],
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
     * Lists all Slide models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SlideSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Slide model.
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
     * Creates a new Slide model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Slide();
        $searchModel = new SlideSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'imageFiles');
            try {
                if(isset($file)){
                    $this->updateFile($file, $model);
                }
                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->idslide]);
                }
            } catch (Exception $exception) {
                Yii::$app->session->setFlash('error', $exception->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Slide model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return Response|string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $imagen = $model->ruta;
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'imageFiles');
            if(isset($file)){
                $this->updateFile($file, $model);
            }
            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->idslide]);
            }
        }

        return $this->render('update', [
                'model' => $model,
                'multiple' => false]
        );
    }

    /**
     * Deletes an existing Slide model.
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
     * Finds the Slide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slide::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param Slide $model
     * @param UploadedFile|null $file
     */
    protected function updateFile(UploadedFile $file, Slide $model)
    {
        if (strlen($file->baseName) >= 1) {
            if(!file_exists($this->path)){
                mkdir($this->path);
            }
            $file->saveAs($this->path . $file->baseName . '.' . $file->extension);
            $model->ruta = Url::base(true) . '/' . $this->path . $file->baseName . '.' . $file->extension;
        }
    }
}

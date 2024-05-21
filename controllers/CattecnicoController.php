<?php

namespace app\controllers;

use Yii;
use app\models\Cattecnico;
use app\models\CattecnicoSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CattecnicoController implements the CRUD actions for Cattecnico model.
 */
class CattecnicoController extends Controller
{

    public $layout = 'admin';

    private $path = 'uploads/cattecnico/';

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
     * Lists all Cattecnico models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CattecnicoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cattecnico model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $tecnicos = $this->findModel($id)->getTecnicos();
        $dataProvider = new ActiveDataProvider([
            'query' => $tecnicos,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Cattecnico model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cattecnico();
        if ($model->load(Yii::$app->request->post())) {
            if ($this->uploadFile($model)) {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->idcattecnico]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cattecnico model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagen = $model->imagen;
        if ($model->load(Yii::$app->request->post())) {
            if (!$this->uploadFile($model)) {
                $model->imagen = $imagen;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->idcattecnico]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cattecnico model.
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
     * Finds the Cattecnico model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cattecnico the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Cattecnico
    {
        if (($model = Cattecnico::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function uploadFile(Cattecnico $model): bool
    {
        $file = UploadedFile::getInstance($model, 'imagen');
        if (isset($file)) {
            if (!file_exists($this->path)) {
                mkdir($this->path);
            }
            $save = $file->saveAs($this->path . $file->baseName . '.' . $file->extension);
            $model->imagen = Url::base(true) . '/' . $this->path . $file->baseName . '.' . $file->extension;
            return $save;
        } else {
            return false;
        }
    }
}

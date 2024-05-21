<?php

namespace app\controllers;

use Yii;
use app\models\Subnoticias;
use app\models\SubnoticiasSearch;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SubnoticiasController implements the CRUD actions for Subnoticias model.
 */
class SubnoticiasController extends Controller
{
    public $layout = 'admin';

    protected $ruta = 'uploads/subnoticias/';

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
     * Lists all Subnoticias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubnoticiasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subnoticias model.
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
     * Creates a new Subnoticias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Subnoticias();
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'imagen');
            if (!file_exists($this->ruta)) {
                mkdir($this->ruta);
            }
            if (isset($file)) {
                $file->saveAs($this->ruta . $file->baseName . '.' . $file->getExtension());
                $model->imagen = Url::base(true) . '/' . $this->ruta . $file->baseName . '.' . $file->getExtension();
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->idsubnoticias]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Subnoticias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'imagen');
            if (isset($file)) {
                $file->saveAs($this->ruta . $file->baseName . '.' . $file->getExtension());
                $model->imagen = Url::base(true) . '/' . $this->ruta . $file->baseName . '.' . $file->getExtension();
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->idsubnoticias]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Subnoticias model.
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
     * Finds the Subnoticias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subnoticias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subnoticias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

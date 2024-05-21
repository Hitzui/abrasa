<?php

namespace app\controllers;

use Yii;
use app\models\Categoria;
use app\models\CategoriaSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CategoriaController extends Controller
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
                'only' => ['login','index','create','update','view'],
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Categoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $isGuest = Yii::$app->user->isGuest;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'isGuest'=> $isGuest,
        ]);
    }

    /**
     * Displays a single Categoria model.
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
     * Creates a new Categoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categoria();
        if ($model->load(Yii::$app->request->post())) {
			$file = UploadedFile::getInstance($model, 'imagen');
			if (isset($file)) {
				$file->saveAs('uploads/categoria/' . $file->baseName . '.' . $file->extension);
				$model->imagen = 'uploads/categoria/' . $file->baseName . '.' . $file->extension;
			} else {
          		$model->imagen ='';
			}	
			if($model->save()){
            	return $this->redirect(['view', 'id' => $model->idcategoria]);
			}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Categoria model.
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
            $file = UploadedFile::getInstance($model, 'imagen');
			if (isset($file) || !empty($file)) {
				$file->saveAs('uploads/categoria/' . $file->baseName . '.' . $file->extension);
				$model->imagen = 'uploads/categoria/' . $file->baseName . '.' . $file->extension;
			} else {
          		$model->imagen =$imagen;
			}	
			if($model->save()){
            	return $this->redirect(['view', 'id' => $model->idcategoria]);
			}
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Categoria model.
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
     * Finds the Categoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categoria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

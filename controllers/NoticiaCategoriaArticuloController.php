<?php

namespace app\controllers;

use app\models\Articulo;
use app\models\Categoria;
use app\models\CategoriaSearch;
use app\models\Catnoticias;
use Yii;
use app\models\NoticiaCategoriaArticulo;
use app\models\NoticiaCategoriaArticuloSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NoticiaCategoriaArticuloController implements the CRUD actions for NoticiaCategoriaArticulo model.
 */
class NoticiaCategoriaArticuloController extends Controller
{
    public $layout='admin';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all NoticiaCategoriaArticulo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoticiaCategoriaArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NoticiaCategoriaArticulo model.
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
     * Creates a new NoticiaCategoriaArticulo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NoticiaCategoriaArticulo();
        $categorias = ArrayHelper::map(Categoria::find()->all(), 'idcategoria', 'nombre');
        $catnoticias =ArrayHelper::map( Catnoticias::find()->all(), 'idcatnoticias', 'descripcion');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idnoticiacategoriaarticulo]);
        }

        return $this->render('create', [
            'categorias'=>$categorias,
            'catnoticias'=>$catnoticias,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NoticiaCategoriaArticulo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categorias = ArrayHelper::map(Categoria::find()->all(), 'idcategoria', 'nombre');
        $catnoticias =ArrayHelper::map( Catnoticias::find()->all(), 'idcatnoticias', 'descripcion');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idnoticiacategoriaarticulo]);
        }

        return $this->render('update', [
            'categorias'=>$categorias,
            'catnoticias'=>$catnoticias,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NoticiaCategoriaArticulo model.
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
     * Finds the NoticiaCategoriaArticulo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NoticiaCategoriaArticulo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NoticiaCategoriaArticulo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

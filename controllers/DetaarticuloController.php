<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Categoria;
use yii\filters\VerbFilter;
use app\models\Detaarticulo;
use app\models\Subcategoria;
use yii\filters\AccessControl;
use app\models\DetaArticuloSearch;
use yii\web\NotFoundHttpException;

/**
 * DetaarticuloController implements the CRUD actions for Detaarticulo model.
 */
class DetaarticuloController extends Controller
{
    public $layout='admin';

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
                    [
                        'allow' => true,
                        'actions' => ['subcategoria'],
                        'roles' => ['?'],
                    ],
                    // everything else is denied
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    //'subcategoria' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Detaarticulo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DetaArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSubcategoria($idcategoria=null) {
        $request = Yii::$app->request;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $get = $request->get();        
        $term = $get['search'];
        $out = [];        
        $query = Subcategoria::find()->where(['idcategoria'=>$idcategoria]);
        if(!empty($term)){
            $list=$query->andFilterWhere(['like','nombre',$term])->asArray()->all();
        }else{
            $list = Subcategoria::find()->where(['idcategoria'=>$idcategoria])->asArray()->all();
        }
        if (count($list) > 0) {
            $selected = '';
            foreach ($list as $i => $account) {
                $out[] = ['id' => $account['idsubcategoria'], 'text' => $account['nombre']];                
            }
            // Shows how you can preselect a value
            return ["results"=> $out];
        }        
        return ['fail'];
    }
    public function actionCategoria() {
        $request = Yii::$app->request;
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $get = $request->get();        
        $term = $get['search'];
        $out = [];        
        $query = Categoria::find();
        if(!empty($term)){
            $list=$query->andFilterWhere(['like','nombre',$term])->asArray()->all();
        }else{
            $list = Categoria::find()->asArray()->all();
        }
        if (count($list) > 0) {
            $selected = '';
            foreach ($list as $account) {
                $out[] = ['id' => $account['idcategoria'], 'text' => $account['nombre']];                
            }
            // Shows how you can preselect a value
            return ["results"=> $out,'select'];
        }        
        return ['fail'];
    }

    /**
     * Displays a single Detaarticulo model.
     * @param integer $idsubcategoria
     * @param string $idarticulo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idsubcategoria, $idarticulo)
    {
        return $this->render('view', [
            'model' => $this->findModel($idsubcategoria, $idarticulo),
        ]);
    }

    /**
     * Creates a new Detaarticulo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Detaarticulo();        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idsubcategoria' => $model->idsubcategoria, 'idarticulo' => $model->idarticulo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Detaarticulo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idsubcategoria
     * @param string $idarticulo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idsubcategoria, $idarticulo)
    {
        $model = $this->findModel($idsubcategoria, $idarticulo);        
        $subcategoria = Subcategoria::find()->where(['idsubcategoria'=>$idsubcategoria])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idsubcategoria' => $model->idsubcategoria, 'idarticulo' => $model->idarticulo]);
        }
        return $this->render('update', [
            'subcategoria'=>$subcategoria,
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Detaarticulo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idsubcategoria
     * @param string $idarticulo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idsubcategoria, $idarticulo)
    {
        $this->findModel($idsubcategoria, $idarticulo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Detaarticulo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idsubcategoria
     * @param string $idarticulo
     * @return Detaarticulo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idsubcategoria, $idarticulo)
    {
        if (($model = Detaarticulo::findOne(['idsubcategoria' => $idsubcategoria, 'idarticulo' => $idarticulo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

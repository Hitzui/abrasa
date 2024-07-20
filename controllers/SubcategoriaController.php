<?php

namespace app\controllers;

use app\models\Articulo;
use app\models\Categoria;
use app\models\Detaarticulo;
use app\models\Detafamilia;
use app\models\FamiliaArticulo;
use app\models\Subcategoria;
use app\models\SubCategoriaSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * SubategoriaController implements the CRUD actions for Subcategoria model.
 */
class SubcategoriaController extends Controller
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
                'only' => ['login', 'index', 'create', 'update', 'view'],
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
     * Lists all Subcategoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubCategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $isGuest = Yii::$app->user->isGuest;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'isGuest' => $isGuest,
        ]);
    }

    /**
     * Displays a single Subcategoria model.
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
     * Creates a new Subcategoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Subcategoria();
        $categoria = Categoria::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idsubcategoria]);
        }

        return $this->render('create', [
            'model' => $model,
            'categoria' => $categoria
        ]);
    }

    /**
     * Updates an existing Subcategoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idsubcategoria]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Subcategoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $tran = Yii::$app->db->beginTransaction();
        try {
            $findDeta = Detaarticulo::find()->where(['idsubcategoria' => $id])->all();
            if ($findDeta !== null && count($findDeta) > 0) {
                Detaarticulo::deleteAll(['idsubcategoria' => $id]);
            }
            $findDetaFamilia = Detafamilia::find()->where(['idsubcategoria' => $id])->all();
            if ($findDetaFamilia !== null && count($findDetaFamilia) > 0) {
                Detafamilia::deleteAll(['idsubcategoria' => $id]);
            }
            $findFamiliaArticulo = FamiliaArticulo::find()->where(['idsubcategoria' => $id])->all();
            if ($findFamiliaArticulo !== null && count($findFamiliaArticulo) > 0) {
                FamiliaArticulo::deleteAll(['idsubcategoria' => $id]);
            }
            $articulo = Articulo::find()->where(['idsubcategoria' => $id])->all();
            if ($articulo !== null && count($articulo) > 0) {
                Articulo::updateAll(['idsubcategoria' => null], ['idsubcategoria' => $id]);
            }
            $this->findModel($id)->delete();
            $tran->commit();
        } catch (\Exception $e) {
            $tran->rollBack();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Subcategoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subcategoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subcategoria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSubcat() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Subcategoria::find()->where(['idcategoria'=>$cat_id])->select('idsubcategoria, nombre')->all();
                // Mapear los datos para retornar solo 'id' y 'name'
                $result = array_map(function($cat) {
                    return [
                        'id' => $cat->idsubcategoria,
                        'name' => $cat->nombre
                    ];
                }, $out);
                return ['output'=>$result, 'selected'=>''];
            }
        }
        return ['output'=>$out, 'selected'=>''];
    }
}

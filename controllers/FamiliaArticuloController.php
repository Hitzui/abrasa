<?php

namespace app\controllers;

use app\models\Detafamilia;
use app\models\Subcategoria;
use app\utility\Utility;
use Yii;
use app\models\FamiliaArticulo;
use app\models\FamiliaArticuloSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Articulo;
use app\models\Familia;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * FamiliaArticuloController implements the CRUD actions for FamiliaArticulo model.
 */
class FamiliaArticuloController extends Controller
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
     * Lists all FamiliaArticulo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FamiliaArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FamiliaArticulo model.
     * @param integer $idfamilia
     * @param string $idarticulo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idfamilia, $idarticulo)
    {
        $familia = Familia::findOne(['idfamilia'=>$idfamilia]);
        $articulo = Articulo::findOne(['idarticulo'=>$idarticulo]);
        return $this->render('view', [
            'model' => $this->findModel($idfamilia, $idarticulo),
            'familia'=>$familia,
            'articulo'=>$articulo,
        ]);
    }

    /**
     * Creates a new FamiliaArticulo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FamiliaArticulo();
		$articulos = Utility::articulos();
		$familias = Utility::familias();
		$subcateogrias = Utility::subCategorias();
        if ($model->load(Yii::$app->request->post())) {
            $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction();
            try {
                $model->save(false);
                $detaFamilia = Detafamilia::find()
                    ->where(['idsubcategoria'=>$model->idsubcategoria,'idfamilia'=>$model->idfamilia])
                    ->one();
                if(empty($detaFamilia)){
                    $detaFamilia=new Detafamilia();
                    $detaFamilia->idfamilia=$model->idfamilia;
                    $detaFamilia->idsubcategoria=$model->idsubcategoria;
                    $detaFamilia->save(false);
                }
                $transaction->commit();
            } catch (\Exception $e) {
                $transaction->rollBack();
            }
            return $this->redirect(
				[
					'view', 
					'idfamilia' => $model->idfamilia, 					
					'idarticulo' => $model->idarticulo
				]
			);
        }

        return $this->render('create', [
            'model' => $model,
			'articulos' => $articulos, 
			'familias' => $familias, 
			'subcategorias' => $subcateogrias,
        ]);
    }

    /**
     * Updates an existing FamiliaArticulo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idfamilia
     * @param string $idarticulo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idfamilia, $idarticulo)
    {
        $model = $this->findModel($idfamilia, $idarticulo);
        $articulos = Utility::articulos();
        $familias = Utility::familias();
        $subcateogrias = Utility::subCategorias();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idfamilia' => $model->idfamilia, 'idarticulo' => $model->idarticulo]);
        }

        return $this->render('update', [
            'model' => $model,
			'articulos' => $articulos, 
			'familias' => $familias,
            'subcategorias' => $subcateogrias,
        ]);
    }

    /**
     * Deletes an existing FamiliaArticulo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idfamilia
     * @param string $idarticulo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idfamilia, $idarticulo)
    {
        $this->findModel($idfamilia, $idarticulo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FamiliaArticulo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idfamilia
     * @param string $idarticulo
     * @return FamiliaArticulo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idfamilia, $idarticulo)
    {
        if (($model = FamiliaArticulo::findOne(['idfamilia' => $idfamilia, 'idarticulo' => $idarticulo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSubcat() {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id = $parents[0];
                $deta = Detafamilia::find()->where(['idfamilia'=>$id])->all();
                $out = Subcategoria::find()->where(['idcategoria'=>$deta])->select('idsubcategoria, nombre')->all();
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

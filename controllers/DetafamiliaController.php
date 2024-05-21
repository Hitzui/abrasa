<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace app\controllers;

use app\utility\Utility;
use Yii;
use app\models\Detafamilia;
use app\models\Familia;
use app\models\Subcategoria;
use app\models\DetafamiliaSearch;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * DetafamiliaController implements the CRUD actions for Detafamilia model.
 */
class DetafamiliaController extends Controller
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
     * Lists all Detafamilia models.
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new DetafamiliaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Detafamilia model.
     * @param integer $idfamilia
     * @param integer $idsubcategoria
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idfamilia, $idsubcategoria)
    {
        return $this->render('view', [
            'model' => $this->findModel($idfamilia, $idsubcategoria),
        ]);
    }

    /**
     * Creates a new Detafamilia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return Response|string
     */
    public function actionCreate()
    {
        $model = new Detafamilia();
        $familias = Utility::familias();
        $subcategorias = Utility::subCategorias();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idfamilia' => $model->idfamilia, 'idsubcategoria' => $model->idsubcategoria]);
        }

        return $this->render('create', [
            'model' => $model,
            'familias' => $familias,
            'subcategorias' => $subcategorias,
        ]);
    }

    /**
     * Updates an existing Detafamilia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idfamilia
     * @param integer $idsubcategoria
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $idfamilia, int $idsubcategoria)
    {
        $model = $this->findModel($idfamilia, $idsubcategoria);
        $familias = Utility::familias();
        $subcategorias = Utility::subCategorias();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idfamilia' => $model->idfamilia, 'idsubcategoria' => $model->idsubcategoria]);
        }

        return $this->render('update', [
            'model' => $model,
            'familias' => $familias,
            'subcategorias' => $subcategorias,
        ]);
    }

    /**
     * Deletes an existing Detafamilia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idfamilia
     * @param integer $idsubcategoria
     * @return Response
     */
    public function actionDelete(int $idfamilia, int $idsubcategoria): Response
    {
        try {
            $this->findModel($idfamilia, $idsubcategoria)->delete();
        } catch (StaleObjectException|NotFoundHttpException|\Throwable $e) {
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Detafamilia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idfamilia
     * @param integer $idsubcategoria
     * @return Detafamilia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $idfamilia, int $idsubcategoria): Detafamilia
    {
        if (($model = Detafamilia::findOne(['idfamilia' => $idfamilia, 'idsubcategoria' => $idsubcategoria])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}

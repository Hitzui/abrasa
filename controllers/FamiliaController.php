<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace app\controllers;

use app\models\Detafamilia;
use app\models\FamiliaArticulo;
use Yii;
use app\models\Familia;
use app\models\FamiliaSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

/**
 * FamiliaController implements the CRUD actions for Familia model.
 */
class FamiliaController extends Controller
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
     * Lists all Familia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FamiliaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Familia model.
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
     * Creates a new Familia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Familia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idfamilia]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Familia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idfamilia]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Familia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return Response
     * @throws NotFoundHttpException|\Throwable if the model cannot be found
     */
    public function actionDelete(int $id): Response
    {
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $deta = Detafamilia::find()->where(['idfamilia' => $id]);
            if ($deta->count() > 0) {
                foreach ($deta->all() as $item){
                    $item->delete();
                }
            }
            $familiaArticulo =FamiliaArticulo::find()->where(['idfamilia' => $id]);
            if($familiaArticulo->count()>0){
                foreach($familiaArticulo->all() as $value){
                    $value->delete();
                }
            }
            $this->findModel($id)->delete();
            $transaction->commit();
        } catch (Exception $ex) {
            $transaction->rollback();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Familia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Familia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Familia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

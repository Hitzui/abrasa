<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace app\controllers;

use Yii;
use app\models\Stores;
use app\models\StoresSearch;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * StoresController implements the CRUD actions for Stores model.
 */
class StoresController extends Controller
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
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Stores models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAll()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->asJson(Stores::find()->all());
    }

    public function actionStore($city)
    {
        $model = Stores::find()->andFilterWhere(['like', 'city', $city])->one();
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $model;
    }

    /**
     * Displays a single Stores model.
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
     * Creates a new Stores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stores();

        if ($model->load(Yii::$app->request->post())) {
            $this->uploadFile($model, '');
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Stores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return Response|string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $imagen = $model->imagen;
        if ($model->load(Yii::$app->request->post())) {
            $this->uploadFile($model, $imagen);
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Stores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return Response
     **/
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Stores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Stores
    {
        if (($model = Stores::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function uploadFile(Stores $model, string $imagen)
    {
        $file = UploadedFile::getInstance($model, 'imagen');
        $path = 'uploads/stores/';
        if (isset($file)) {
            if (!file_exists($path)) {
                mkdir($path);
            }
            $file->saveAs($path . $file->baseName . '.' . $file->getExtension());
            $model->imagen = Url::base(true) . '/'.$path . $file->baseName . '.' . $file->getExtension();
        } else {
            $model->imagen = $imagen;
        }
    }
}

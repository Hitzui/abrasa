<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace app\controllers;

use app\models\Categoria;
use app\models\Catnoticias;
use app\models\Imagenes;
use app\models\NoticiaCategoriaArticulo;
use app\models\Subcatnoticias;
use app\models\Subnoticias;
use Exception;
use Yii;
use app\models\Noticias;
use app\models\NoticiasSearch;
use yii\data\Pagination;
use yii\db\StaleObjectException;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * NoticiasController implements the CRUD actions for Noticias model.
 */
class NoticiasController extends Controller
{
    public $layout = 'admin';
    private $path = 'uploads/noticias/';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'alls', 'create', 'update', 'view', 'logout'],
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
     * Lists all Noticias models.
     * @return string
     */
    public function actionAlls(): string
    {
        $searchModel = new NoticiasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('alls', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Noticias model.
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Noticias model.
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionFind(int $id): string
    {
        $this->layout = 'main';
        $noticias = Noticias::find()->all();
        $imagenes = Imagenes::find()->where(['idnoticia' => $id])->all();
        return $this->render('find', [
            'noticia' => $this->findModel($id),
            'noticias' => $noticias,
            'imagenes' => $imagenes,
        ]);
    }

    public function actionSearch($search): string
    {
        $this->layout = 'main';
        $noticias = Noticias::find()->andFilterWhere(['like', 'titulo', $search])->all();
        return $this->render('search', [
            'noticias' => $noticias
        ]);
    }

    public function actionIndex(): string
    {
        $this->layout = 'main';
        $noticias = Noticias::find()->orderBy(['fecha'=>SORT_DESC])->limit(10)->all();
        $categoriaNoticias = Catnoticias::find()->all();
        return $this->render('index', [
            'noticias' => $noticias,
            'categorias' => $categoriaNoticias,
        ]);
    }


    public function actionCategoria($id): string
    {
        $this->layout = 'main';
        $categoria = Catnoticias::findOne($id);
        $query = Noticias::find()->where(['idcategoria' => $id]);
        $catnot = NoticiaCategoriaArticulo::find()->where(['idnoticias' => $id])->select('idcatarticulo');
        $categoriart = Categoria::find()->where(['idcategoria' => $catnot])->all();
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $noticias = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        $subcategoria = Subnoticias::findAll(['idcategoria' => $id]);
        return $this->render('categoria', [
            'subcategoria' => $subcategoria,
            'noticias' => $noticias,
            'categoria' => $categoria,
            'categoriart' => $categoriart,
            'pagination' => $pagination
        ]);
    }

    public function actionSubcategoria($id)
    {
        $this->layout = 'main';
        $sub = Subcatnoticias::find()->where(['idsubcategoria' => $id]);
        $query = Noticias::find()->andFilterWhere(['in', 'idnoticias', $sub->select('idsubcategoria')]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $noticias = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('categoria', [
            'subcategoria' => array(),
            'noticias' => $noticias,
            'categoria' => new Catnoticias(),
            'pagination' => $pagination
        ]);
    }

    protected function ComboBoxCategoriaNoticias()
    {
        return ArrayHelper::map(Catnoticias::find()->all(), 'idcatnoticias', 'descripcion');
    }

    /**
     * Creates a new Noticias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return Response|string
     */
    public function actionCreate()
    {
        $model = new Noticias();
        if ($model->load(Yii::$app->request->post())) {
            if ($this->save($model, '')) {
                return $this->redirect(['view', 'id' => $model->idnoticias]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'catnoticias' => $this->ComboBoxCategoriaNoticias()
        ]);
    }

    /**
     * Updates an existing Noticias model.
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
            if ($this->save($model, $imagen)) {
                return $this->redirect(['view', 'id' => $model->idnoticias]);
            }
        }
        return $this->render('update', [
            'model' => $model,
            'catnoticias' => $this->ComboBoxCategoriaNoticias()
        ]);
    }

    /**
     * Deletes an existing Noticias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return Response
     */
    public function actionDelete(int $id): Response
    {
        try {
            $this->findModel($id)->delete();
        } catch (StaleObjectException|NotFoundHttpException|\Throwable $e) {
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Noticias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Noticias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Noticias
    {
        if (($model = Noticias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function updateFile(UploadedFile $file, Noticias $model)
    {
        if (strlen($file->baseName) >= 1) {
            if (!file_exists($this->path)) {
                mkdir($this->path);
            }
            $file->saveAs($this->path . $file->baseName . '.' . $file->extension);
            $model->imagen = Url::base(true) . '/' . $this->path . $file->baseName . '.' . $file->extension;
        }
    }

    function isYouTubeUrl($url)
    {
        $patterns = [
            '/youtube\.com\/watch\?v=[^&]+/',  // URLs de YouTube estándar
            '/youtu\.be\/[^?]+/'              // URLs cortas de YouTube
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url)) {
                return true;
            }
        }
        return false;
    }

    private function save(Noticias $model, string $imagen): bool
    {

        if ($model->validate()) {
            $file = UploadedFile::getInstance($model, 'imagen');
            $this->path .= $model->idnoticias;
            if(isset($file)){
                $this->updateFile($file, $model);
            }

            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}

<?php

namespace app\controllers;

use app\models\Color;
use app\models\Detaarticulo;
use app\models\Detacolor;
use app\models\Familia;
use app\models\FamiliaArticulo;
use app\models\Subcategoria;
use Exception;
use Yii;
use app\models\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\rest\DeleteAction;
use yii\web\Controller;
use app\models\Articulo;
use app\models\Proveedor;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\Detaproveedor;
use app\models\DetaproveedorSearch;
use app\models\ArticuloSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * ArticuloController implements the CRUD actions for Articulo model.
 */
class ArticuloController extends Controller
{
    public $layout = 'admin';
    public $rutaImagen = 'uploads/imagenes/';
    public $rutaFicha = 'uploads/fichas/';
    public $rutaHoja = 'uploads/hojas/';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'index', 'create', 'update', 'view', 'logout', 'proveedores'],
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
                    'ficha' => ['POST'],
                    'hoja' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Articulo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticuloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $articulos = ArrayHelper::map(Articulo::find()->all(), 'idarticulo', 'descripcion');
        $familias = ArrayHelper::map(Familia::find()->all(), 'idfamilia', 'nombre');
        $subcateogrias = ArrayHelper::map(Subcategoria::find()->all(), 'idsubcategoria', 'nombre');
        $isGuest = Yii::$app->user->isGuest;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'isGuest' => $isGuest,
            'articulos' => $articulos,
            'familias' => $familias,
            'subcategorias' => $subcateogrias,
        ]);
    }

    public function actionProveedores()
    {
        $searchModel = new DetaproveedorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('proveedores', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProveedor()
    {
        $model = new Detaproveedor();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $articulo = Articulo::find()->where(['idarticulo' => $model->idarticulo])->one();
                $proveedor = Proveedor::find()->where(['idproveedor' => $model->idproveedor])->one();
                return $this->render('viewproveedor', [
                    'articulo' => $articulo,
                    'proveedor' => $proveedor,
                ]);
            }
        }
        return $this->render('proveedor', ['model' => $model]);
    }

    /**
     * Displays a single Articulo model.
     * @param string $id
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
     * Displays a single Detaproveedor model.
     * @param string $idarticulo , $idproveedor
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewproveedor($idproveedor, $idarticulo)
    {
        $articulo = Articulo::find()->where(['idarticulo' => $idarticulo])->one();
        $proveedor = Proveedor::find()->where(['idproveedor' => $idproveedor])->one();
        return $this->render('viewproveedor', [
            'articulo' => $articulo,
            'proveedor' => $proveedor,
        ]);
    }

    /**
     * Creates a new Articulo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Articulo();
        $modelColors = [new Color];
        if ($model->load(Yii::$app->request->post())) {
            $modelColors = Model::createMultiple(Color::class);
            Model::loadMultiple($modelColors, Yii::$app->request->post());
            $file = UploadedFile::getInstance($model, 'rutaimg');
            $fichaFile = UploadedFile::getInstance($model, 'ficha');
            $hojaFile = UploadedFile::getInstance($model, 'hoja');
            if (!file_exists($this->rutaImagen . $model->idarticulo . '/')) {
                mkdir($this->rutaImagen . $model->idarticulo . '/', 0777, true);
            }
            if (!file_exists($this->rutaFicha . $model->idarticulo . '/')) {
                mkdir($this->rutaFicha . $model->idarticulo . '/', 0777, true);
            }
            if (!file_exists($this->rutaHoja . $model->idarticulo . '/')) {
                mkdir($this->rutaHoja . $model->idarticulo . '/', 0777, true);
            }
            if (isset($file) || !empty($file)) {
                $file->saveAs($this->rutaImagen . $model->idarticulo . '/' . $file->baseName . '.' . $file->extension);
                $model->rutaimg = $this->rutaImagen . $model->idarticulo . '/' . $file->baseName . '.' . $file->extension;
            } else {
                $model->rutaimg = '';
            }
            if (isset($fichaFile) || !empty($fichaFile)) {
                $fichaFile->saveAs($this->rutaFicha . $model->idarticulo . '/' . $fichaFile->baseName . '.' . $fichaFile->extension);
                $model->ficha = $this->rutaFicha . $model->idarticulo . '/' . $fichaFile->baseName . '.' . $fichaFile->extension;
            } else {
                $model->ficha = '';
            }
            if (isset($hojaFile) || !empty($hojaFile)) {
                $hojaFile->saveAs($this->rutaHoja . $model->idarticulo . '/' . $hojaFile->baseName . '.' . $hojaFile->extension);
                $model->hoja = $this->rutaHoja . $model->idarticulo . '/' . $hojaFile->baseName . '.' . $hojaFile->extension;
            } else {
                $model->ficha = '';
            }
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelColors) && $valid;
            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelColors as $modelColor) {
                            $detacolor = new Detacolor();
                            $detacolor->idarticulo = $model->idarticulo;
                            $detacolor->idcolor = $modelColor->idcolor;
                            if (!$flag = $detacolor->save(false)) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->setFlash("save", "Se han guardado los datos de forma correcta.");
                        return $this->redirect(['view', 'id' => $model->idarticulo]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render(
            'create', [
                'model' => $model,
                'modelColors' => (empty($modelColors)) ? [new Color()] : $modelColors
            ]
        );
    }

    /**
     * Updates an existing Detamodel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $idarticulo
     * @param string $idproveedor
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateprov($idproveedor, $idarticulo)
    {
        $model = Detaproveedor::find()->where(['idproveedor' => $idproveedor, 'idarticulo' => $idarticulo])->one();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->idarticulo]);
            }
        }
        return $this->render('proveedor', ['model' => $model]);

    }

    /**
     * Updates an existing Articulo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $colores = $model->colores;
        $pos = strpos($colores, '#');
        if ($pos === false) {
            $model->colores = '';
        }
        $rutaImg = $model->rutaimg;
        $ficha = $model->ficha;
        $hoja = $model->hoja;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $file = UploadedFile::getInstance($model, 'rutaimg');
                $fichaFile = UploadedFile::getInstance($model, 'ficha');
                $hojaFile = UploadedFile::getInstance($model, 'hoja');
                if (!file_exists($this->rutaImagen . $model->idarticulo)) {
                    mkdir($this->rutaImagen . $model->idarticulo . '/', 0777);
                }
                if (!file_exists($this->rutaFicha . $model->idarticulo)) {
                    mkdir($this->rutaFicha . $model->idarticulo . '/', 0777);
                }
                if (!file_exists($this->rutaHoja . $model->idarticulo)) {
                    mkdir($this->rutaHoja . $model->idarticulo . '/', 0777);
                }
                if (!empty($file)) {
                    $file->saveAs($this->rutaImagen . $model->idarticulo . '/' . $file->baseName . '.' . $file->extension);
                    $model->rutaimg = $this->rutaImagen . $model->idarticulo . '/' . $file->baseName . '.' . $file->extension;
                } else {
                    $model->rutaimg = $rutaImg;
                }
                if (!empty($fichaFile)) {
                    if (!$fichaFile->saveAs($this->rutaFicha . $model->idarticulo . '/' . $fichaFile->baseName . '.' . $fichaFile->extension)) {
                        Yii::$app->session->setFlash("ficha_e", "No se pudo subir el archivo debido a un error, es posible que el archivo sobrepase los 2mb");
                    }
                    $model->ficha = $this->rutaFicha . $model->idarticulo . '/' . $fichaFile->baseName . '.' . $fichaFile->extension;
                } else {
                    $model->ficha = $ficha;
                }
                if (!empty($hojaFile)) {
                    $hojaFile->saveAs($this->rutaHoja . $model->idarticulo . '/' . $hojaFile->baseName . '.' . $hojaFile->extension);
                    $model->hoja = $this->rutaHoja . $model->idarticulo . '/' . $hojaFile->baseName . '.' . $hojaFile->extension;

                } else {
                    $model->hoja = $hoja;
                }
                $encode = Json::encode($model->colores);
                if (strcmp($colores, $encode) !== 0) {
                    $model->colores = $encode;
                }
                if ($model->save()) {
                    Yii::$app->session->setFlash("save", "Se han guardado los datos de forma correcta.");
                    return $this->redirect(['view', 'id' => $model->idarticulo]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Articulo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $queryFamiliaArticulo = FamiliaArticulo::find()->where(['idarticulo' => $id]);
            $fam = $queryFamiliaArticulo->all();
            $countFamiliaArticulo = $queryFamiliaArticulo->count();
            if (!is_null($fam) || $countFamiliaArticulo > 0) {
                FamiliaArticulo::deleteAll(['idarticulo' => $fam]);
            }
            $deta = Detaproveedor::findOne(['idarticulo' => $id]);
            if (!is_null($deta)) {
                $deta->delete();
            }
            $sub = Detaarticulo::findOne(['idarticulo' => $id]);
            if (!is_null($sub)) {
                $sub->delete();
            }
            $this->findModel($id)->delete();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionFicha($id)
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $articulo = Articulo::findOne($id);
            $articulo->ficha = "";
            $articulo->save();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionHoja($id)
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $articulo = Articulo::find()->where(['idarticulo' => $id])->one();
            $articulo->hoja = "";
            $articulo->save();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return $this->redirect(['view', 'id' => $id]);
    }
    public function actionImagen($id)
    {
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            $articulo = Articulo::find()->where(['idarticulo' => $id])->one();
            $articulo->rutaimg = "";
            $articulo->save();
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Deletes an existing Articulo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleteprov($idproveedor, $idarticulo)
    {
        $detaprov = Detaproveedor::find()->where(['idproveedor' => $idproveedor, 'idarticulo' => $idarticulo])->one();
        $detaprov->delete();
        return $this->redirect(['proveedores']);
    }

    /**
     * Finds the Articulo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Articulo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Articulo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

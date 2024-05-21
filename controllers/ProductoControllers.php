<?php


namespace app\controllers;


use yii\web\Controller;

class ProductoControllers extends Controller
{

    public function actionIndex(){
        return $this->redirect('index');
    }
}
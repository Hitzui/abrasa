<?php


namespace app\commands;


class Controller extends \yii\web\Controller
{
    public function actionSearch(){
        return $this->render('index');
    }
}
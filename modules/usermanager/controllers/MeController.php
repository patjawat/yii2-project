<?php

namespace app\modules\usermanager\controllers;

class MeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}

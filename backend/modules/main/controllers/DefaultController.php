<?php

namespace backend\modules\main\controllers;

use backend\components\BaseController;

class DefaultController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

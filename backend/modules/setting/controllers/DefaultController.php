<?php

namespace backend\modules\setting\controllers;

use \backend\components\BaseController;

class DefaultController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

<?php

namespace backend\modules\blog\controllers;

use backend\components\BaseController;

class DefaultController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

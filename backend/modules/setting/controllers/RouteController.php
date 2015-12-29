<?php

namespace backend\modules\setting\controllers;

use backend\components\BaseController;
use backend\modules\setting\models\Route;
use backend\modules\setting\models\searchs\AuthItemSearch;
use Yii;

class RouteController extends BaseController
{
    public function actionIndex()
    {
        $model = new AuthItemSearch();
        $dataProvider = $model->search(Yii::$app->request->get());
        return $this->render('index',['model'=>$model,'dataProvider'=>$dataProvider]);
    }

    /**
     * 新增路由
     * @return string
     */
    public function actionCreate()
    {
        $model = new Route();
        if($model->load(Yii::$app->request->post()))
        {
            //按照逗号分隔数组
            $routes = preg_split('/\s*,\s*/', trim($model->route), -1, PREG_SPLIT_NO_EMPTY);
            $descriptions = preg_split('/\s*,\s*/', trim($model->description), -1, PREG_SPLIT_NO_EMPTY);
            if($model->save($routes,$descriptions)){
                Yii::$app->session->setFlash('success','添加路由成功');
                $this->redirect(['index']);
            }else{
                Yii::$app->session->setFlash('fail','添加路由失败');
                $this->redirect(['create']);
            }
        }
        return $this->render('create',['model'=>$model]);
    }


    public function actionUpdate($id)
    {
        $model = Route::find($id);
        if($model->load(Yii::$app->request->post()))
        {
            $auth = Yii::$app->authManager;
            $newItem = $auth->createPermission('/' . trim($model->route,'/'));
            $newItem -> description = $model -> description;
            if($auth -> update($id,$newItem)){
                Yii::$app->session->setFlash('success','修改成功');
                $this->redirect(['index']);
            }else{
                Yii::$app->session->setFlash('success','修改失败');
                $this->redirect(['update']);
            }

        }
        return $this->render('update',['model'=>$model]);
    }

}

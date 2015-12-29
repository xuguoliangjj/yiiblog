<?php

namespace backend\modules\setting\controllers;

use \backend\components\BaseController;
use backend\modules\setting\models\AuthPermissionForm;
use backend\modules\setting\models\AuthItem;
use backend\modules\setting\models\searchs\AuthItemSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\rbac\Item;
use Yii;

class PermissionController extends BaseController
{
    /*
     * 权限列表
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch(['type'=>Item::TYPE_PERMISSION]);
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionCreate()
    {
        $model = new AuthItem();
        $model->type=Item::TYPE_PERMISSION;
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view','id'=>$model->name]);
        }else {
            return $this->render('create',['model'=>$model]);
        }
    }

    public function actionView($id)
    {
        $model = new AuthPermissionForm();
        $model -> setScenario('auth');
        $result = [
            'Permissions' => [],
            'Routes' => [],
        ];
        $authManager = Yii::$app->authManager;
        $parent = $authManager->getPermission($id);

        if($model -> load(Yii::$app->request->post()) && $model -> validate()){
            $authManager->removeChildren($parent);
            try {
                if (is_array($model->permissions)) {
                    foreach ($model->permissions as $item) {
                        if ($item == $id) {
                            continue;
                        }
                        $child = $authManager->getPermission($item);
                        $authManager->addChild($parent, $child);
                    }
                }
                if (is_array($model->routes)) {
                    foreach ($model->routes as $item) {
                        $child = $authManager->getPermission($item);
                        $authManager->addChild($parent, $child);
                    }
                }
            }catch (\Exception $e){
                Yii::$app ->session->setFlash('fail',$e->getMessage());
                $this -> refresh();
                Yii::$app->end();
            }
            Yii::$app ->session->setFlash('success','授权成功');
            $this -> redirect(['index']);
        }

        foreach ($authManager -> getPermissions() as $name => $role) {
            if($name === $id){
                continue;
            }
            if (empty($term) or strpos($name, $term) !== false) {
                $result[$name[0] === '/' ? 'Routes' : 'Permissions'][$name] = $role->description;
            }
        }

        foreach($authManager -> getChildren($id) as $name => $item){
            if($item->name[0] === '/'){
                $model -> routes[$item->name] = $item->name;
            }else{
                $model -> permissions[$item->name] = $item ->name;
            }
        }

        return $this->render('view',['model'=>$model,'result'=>$result]);
    }

    public function actionDelete($id)
    {
        $authManager = Yii::$app->authManager;
        $item = $authManager -> getPermission($id);
        if($authManager -> remove($item)){
            Yii::$app ->session->setFlash('success','删除成功');
        }else{
            Yii::$app ->session->setFlash('fail','删除失败');
        }
        $this -> redirect(['index']);
    }

    public function actionUpdate($id)
    {
        $item = Yii::$app->authManager->getPermission($id);
        $model = new AuthItem($item);
        if($model -> load(Yii::$app->request->post()) && $model -> save()){
            Yii::$app ->session->setFlash('success','修改权限成功');
            $this -> redirect(['index']);
        }
        return $this->render('update',[
            'model'=>$model
        ]);
    }
}

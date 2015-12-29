<?php

namespace backend\modules\setting\controllers;

use \backend\components\BaseController;
use backend\modules\setting\models\AssignmentForm;
use backend\modules\setting\models\searchs\UserSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use Yii;


class UserController extends BaseController
{
    public function actionIndex()
    {
        $model = new UserSearch();
        $dataProvider = $model -> search(Yii::$app->request->get());
        return $this->render('index',[
            'dataProvider'=>$dataProvider,
            'model'=>$model
        ]);
    }

    public function actionView($id)
    {
        $model = new AssignmentForm();
        $model -> setScenario('auth');
        $permissions = [];
        $authManager = Yii::$app->authManager;
        if($model -> load(Yii::$app->request->post()) && $model -> validate()){
            //Revokes all roles from a user.
            try {
                $authManager->revokeAll($id);
                //角色
                if(is_array($model->roles)) {
                    foreach ($model->roles as $name) {
                        $item = $authManager->getRole($name);
                        $authManager->assign($item, $id);
                    }
                }
                //权限
                if(is_array($model->permissions)) {
                    foreach ($model->permissions as $name) {
                        $item = $authManager->getPermission($name);
                        $authManager->assign($item, $id);
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
        $roles = $authManager->getRoles();
        $roles = ArrayHelper::map($roles,'name','name');
        foreach ($authManager->getPermissions() as $name => $role) {
            if($role->name[0] == '/'){
                $permissions[$name] = $role->description;
            }
        }

        foreach($authManager->getAssignments($id) as $name => $item){
            if($name[0] == '/'){
                $model -> permissions[$authManager -> getPermission($name) -> description] =  $name;
            }else{
                $model -> roles[$name] = $name;
            }
        }

        return $this->render('view',[
            'model'=>$model,
            'roles'=>$roles,
            'permissions'=>$permissions
        ]);
    }

    /**
     * @param $pk
     */
    public function actionChangeName($pk)
    {
        $model = UserSearch::findOne($pk);
        if($model)
        {
            $model->load(Yii::$app->request->get());
            if($model->update())
            {
                echo Json::encode(array('status' => 'success'));
            }else{
                echo Json::encode(array('status' => 'error','msg'=>'修改名称失败'));
            }
        }else{
            echo Json::encode(array('status' => 'error','msg'=>'不存在此人'));
        }
        Yii::$app->end();
    }

    /**
     * @param $pk
     */
    public function actionChangeTime($pk)
    {
        $model = UserSearch::findOne($pk);
        if($model)
        {
            $model->load(Yii::$app->request->get());
            $model->created_at = strtotime($model->created_at);

            if($model->update())
            {
                echo Json::encode(array('status' => 'success'));
            }else{
                echo Json::encode(array('status' => 'error','msg'=>'修改时间失败'));
            }
        }else{
            echo Json::encode(array('status' => 'error','msg'=>'不存在此人'));
        }
        Yii::$app->end();
    }

}

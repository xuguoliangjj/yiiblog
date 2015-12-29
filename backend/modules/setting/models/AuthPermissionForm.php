<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/9/27
 * Time: 2:55
 */
namespace backend\modules\setting\models;

use yii\base\Model;

class AuthPermissionForm extends Model
{
    public $routes;
    public $permissions;

    public function rules()
    {
        return [
           // ['routes,permissions','default','value'=>[]]
        ];
    }

    public function scenarios()
    {
        return [
            'auth'=>['routes','permissions']
        ];
    }

    public function attributeLabels()
    {
        return [
            'routes'=>'路由',
            'permissions'=>'权限'
        ];
    }
}
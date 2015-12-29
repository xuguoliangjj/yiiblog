<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/9/13
 * Time: 19:04
 */
namespace backend\modules\setting\models;

use yii\base\Model;

class RoleAuthForm extends Model
{
    public $routes;
    public $roles;
    public $permissions;

    public function rules()
    {
        return [
            ['roles','required']
        ];
    }

    public function scenarios()
    {
        return [
            'auth'=>['routes','permissions','roles']
        ];
    }

    public function attributeLabels()
    {
        return [
            'routes'=>'路由',
            'roles'=>'角色',
            'permissions'=>'规则'
        ];
    }
}
<?php

namespace backend\modules\setting\models;

use yii\base\Model;

class AssignmentForm extends Model
{
    public $roles;
    public $permissions;

    public function rules()
    {
        return [

        ];
    }

    public function scenarios()
    {
        return [
            'auth'=>['roles','permissions']
        ];
    }

    public function attributeLabels()
    {
        return [
            'roles'=>'角色',
            'permissions'=>'权限'
        ];
    }
}
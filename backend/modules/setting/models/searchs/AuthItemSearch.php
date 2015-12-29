<?php

namespace backend\modules\setting\models\searchs;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use Yii;
use yii\rbac\Item;

/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/8/9
 * Time: 16:23
 */
class AuthItemSearch extends Model
{
    public $type;
    public $name;
    public $description;
    public $ruleName;
    public $data;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'safe'],
            [['type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '用户名',
        ];
    }

    public function search($params)
    {
        $auth = Yii::$app->authManager;
        if($this->type == Item::TYPE_ROLE) {
            $items = $auth->getRoles();
        }else{
            $items = [];
            if ($this->type == Item::TYPE_PERMISSION) {
                foreach ($auth->getPermissions() as $name => $item) {
                    //name的第一个字符不是'/'的就是权限组名
                    if ($name[0] !== '/') {
                        $items[$name] = $item;
                    }
                }
            } else {
                foreach ($auth->getPermissions() as $name => $item) {
                    //name的第一个字符是'/'的就是路由权限
                    if ($name[0] === '/') {
                        $items[$name] = $item;
                    }
                }
            }
        }
        if($this->load($params)) {
            $name = strtolower(trim($this->name));
            $items = array_filter($items, function ($role) use ($name){
                return (empty($name) || strpos((strtolower($role->name)),$name) !== false);
            });
        }

        return new ArrayDataProvider([
            'allModels'=>$items,
        ]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/8/2
 * Time: 12:48
 */
namespace backend\modules\setting\models\searchs;
use \yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
class UserSearch extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','email'],'required'],
            [['created_at','updated_at'],'integer'],
            ['email','email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'email' => '邮箱'
        ];
    }

    public function search($params)
    {
        $query = UserSearch::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>2
            ]
        ]);
        if (!$this->load($params)) {
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'username', $this->username]);
        return $dataProvider;
    }
}
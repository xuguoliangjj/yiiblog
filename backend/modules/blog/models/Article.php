<?php

namespace backend\modules\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $create_by
 * @property string $update_by
 * @property string $create_at
 * @property string $update_at
 * @property integer $times
 * @property integer $status
 * @property integer $type_id
 *
 * @property Type $type
 * @property Tag[] $tags
 */
class Article extends \yii\db\ActiveRecord
{
    //文章标签
    public $tags;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /*
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
                'value'=>function(){
                    return date('Y-m-d H:i:s',time());
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content','title','type_id','status','tags'],'required'],
            [['content'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['times', 'status', 'type_id'], 'integer'],
            [['status'],'in','range'=>[0,1]],
            [['title'], 'string', 'max' => 255],
            [['create_by', 'update_by'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '文章标题'),
            'content' => Yii::t('app', '内容'),
            'create_by' => Yii::t('app', '新增人'),
            'update_by' => Yii::t('app', '修改人'),
            'create_at' => Yii::t('app', '新增时间'),
            'update_at' => Yii::t('app', '更新时间'),
            'times' => Yii::t('app', '访问次数'),
            'status' => Yii::t('app', '状态'),
            'type_id' => Yii::t('app', '分类'),
            'tags' => Yii::t('app', '文章标签'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['article_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert) {
                $this->create_by = Yii::$app->user->identity->username;
            }else {
                $this->update_by = Yii::$app->user->identity->username;
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!$insert) {
            Tag::deleteAll(['article_id' => $this->id]);
        }
        $tags_arr = explode(',', $this->tags);
        foreach ($tags_arr as $tag) {
            $model = new Tag();
            $model->article_id = $this->id;
            $model->tag = $tag;
            $model->save();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete()
    {
        Tag::deleteAll(['article_id'=>$this->id]);
        return true;
    }
}

<?php

namespace backend\modules\blog\models;

use Yii;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['create_at', 'update_at'], 'safe'],
            [['times', 'status', 'type_id'], 'integer'],
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
            'update_by' => Yii::t('app', 'Update By'),
            'create_at' => Yii::t('app', '新增时间'),
            'update_at' => Yii::t('app', '更新时间'),
            'times' => Yii::t('app', '访问次数'),
            'status' => Yii::t('app', '0、草稿 1、发布'),
            'type_id' => Yii::t('app', '分类'),
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
}

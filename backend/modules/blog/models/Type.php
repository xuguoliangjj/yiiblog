<?php

namespace backend\modules\blog\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property integer $id
 * @property string $tag
 * @property string $name
 *
 * @property Article[] $articles
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 125]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tag' => Yii::t('app', '分类简写'),
            'name' => Yii::t('app', '分类名'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['type_id' => 'id']);
    }
}

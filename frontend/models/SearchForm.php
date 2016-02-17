<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SearchForm extends Model
{
    public $keyword;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'keyword' => 'Keyword',
        ];
    }
}

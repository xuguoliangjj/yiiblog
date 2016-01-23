<?php

namespace frontend\controllers;

use backend\modules\blog\models\Article;
use backend\modules\blog\models\Type;
use yii\data\ActiveDataProvider;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex($type)
    {
        $type = Type::findOne(['tag'=>$type]);
        $dataProvider = new ActiveDataProvider([
            'query' => $type->getArticles()->orderBy('create_at desc'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('index',['dataProvider'=>$dataProvider,'type'=>$type]);
    }

    public function actionView($id)
    {
        $model = Article::findOne($id);
        Article::updateAllCounters(['times'=>1],['id'=>$id]);
        return $this->render('view',['model'=>$model]);
    }

}

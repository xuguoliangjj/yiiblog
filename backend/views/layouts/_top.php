<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>
<?php
NavBar::begin([
    'brandLabel' => '数据分析平台',
    'brandUrl' => Yii::$app->homeUrl,
    'innerContainerOptions'=>['class'=>'container-fluid'],
    'options' => [
        'class' => 'navbar-inverse navbar-static-top own-navbar-top',
    ],
]);
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
} else {
    $menuItems[] = [
        'label' => '<span class="glyphicon glyphicon-user"></span> '.Yii::$app->user->identity->username,
        'items' => [
            ['label' => '<span class="glyphicon glyphicon-off"></span> 注销登录', 'url' => ['/site/logout'],'linkOptions' => ['data-method' => 'post']],
            ['label' => '<span class="glyphicon glyphicon-cog"></span> 修改密码','url'=>['/']],
        ]
    ];
}
if(!Yii::$app->user->isGuest) {
    echo Nav::widget([
        'encodeLabels'=>false,
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $this->context->topMenu,
    ]);
}


echo Nav::widget([
    'encodeLabels'=>false,
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);



NavBar::end();
?>
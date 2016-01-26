<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '第十九层空间',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => '主页', 'url' => ['/site/index']],
                ['label' => 'LNMP', 'items' => [
                    ['label' => 'PHP', 'url' => ['/article/index','type'=>'php']],
                    ['label' => 'Swoole', 'url' => ['/article/index','type'=>'swoole']],
                    ['label' => 'Linux', 'url' => ['/article/index','type'=>'linux']],
                    ['label' => 'MySQL', 'url' => ['/article/index','type'=>'mysql']]
                ]],
                ['label' => 'Yii框架', 'url' => ['/article/index','type'=>'yii']],
                ['label' => '数据分析', 'url' => ['/article/index','type'=>'data']],
                ['label' => 'Hadoop', 'url' => ['/article/index','type'=>'hadoop']],
                ['label' => '开发工具', 'items' => [
                    ['label' => 'git', 'url' => ['/article/index','type'=>'svn']],
                    ['label' => 'svn', 'url' => ['/article/index','type'=>'git']]
                ]],
                ['label' => '关于我', 'url' => ['/site/contact']],
            ];
//            if (Yii::$app->user->isGuest) {
//                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
//                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
//            } else {
//                $menuItems[] = [
//                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
//                    'url' => ['/site/logout'],
//                    'linkOptions' => ['data-method' => 'post']
//                ];
//            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
        ?>
        <form class="navbar-form navbar-left" action="" method="post">
                <div class="input-group">
                <input class="form-control" name="search" placeholder="Searching..." type="text">
                <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
                </div>
        </form>
        <?php
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => [
                'label' => '首页',  // required
                'url' => '/',      // optional, will be processed by Url::to()
                'template' => "<li>{link}</li>\n", // optional, if not set $this->itemTemplate will be used
            ]
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">Copyright  &copy; 2009-2016 loadata.com</p>
            <p class="pull-right"><?= Yii::powered() ?> 粤ICP备15101512号 
            <span class="pull-right" style="margin-left:5px;">
	            <script type="text/javascript">
	            var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	            document.write(unescape("%3Cspan id='cnzz_stat_icon_1000217531'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s96.cnzz.com/z_stat.php%3Fid%3D1000217531%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
	            </script>
            </span>
            </p>
           
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

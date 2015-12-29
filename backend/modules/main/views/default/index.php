<?php
use yii\bootstrap\Tabs;
$this->title = '新增玩家';
$this->params['breadcrumbs'][] = ['label'=>$this->title];
?>
<div class="panel panel-default own-panel">
    <div class="panel-heading">
        新增玩家
        <span class="pull-right own-toggle">
            <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
        <span class="pull-right own-download">
            <a class="glyphicon glyphicon-download-alt"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= Tabs::widget([
                'navType'=>'nav-pills',
                'items' => [
                    [
                        'label' => '新增玩家',
                        'content' => $this->render('part'),
//                        'headerOptions' => ['id'=>'adp-tag'],
                        'active' => true
                    ],
                    [
                        'label' => '激活玩家',
                        'content' => $this->render('other'),
//                        'headerOptions' => [],
//                        'options' => ['id' => 'acp-tag'],
                    ]
                ],
            ]);
        ?>
    </div>
</div>

<div class="panel panel-default own-panel">
    <div class="panel-heading">
        实时数据
        <span class="pull-right own-toggle">
            <a class="glyphicon glyphicon-chevron-up"></a>
        </span>
        <span class="pull-right own-download">
            <a class="glyphicon glyphicon-download-alt"></a>
        </span>
    </div>
    <div class="panel-body">
        <?= Tabs::widget([
            'navType'=>'nav-pills',
            'items' => [
                [
                    'label' => '实时在线',
                    'content' => $this->render('part2'),
                    'active' => true
                ],
                [
                    'label' => '活跃玩家',
                    'content' => $this->render('other2'),
                    'headerOptions' => [],

                ]
            ],
        ]);
        ?>
    </div>
</div>
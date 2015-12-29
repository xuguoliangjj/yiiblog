<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/7/11
 * Time: 2:06
 */

return [
    'menu'=>[
        'fronted'=> ['label'=>'数据统计','items'=>[
                ['icon'=>'glyphicon glyphicon-user','label' => '玩家分析','items' => [
                    ['label' => '新增玩家', 'url' => ['/main/default']],
                    ['label' => '活跃玩家', 'url' => ['/product/index2']],
                ]],
                ['icon'=>'glyphicon glyphicon-tag','label' => '付费分析','items' => [
                    ['label' => '新产品2', 'url' => ['/site/indsex']],
                    ['label' => '流行产品2', 'url' => ['/product/index4']],
                ]],
                ['icon'=>'glyphicon glyphicon-folder-close','label' => '流失分析','items' => [
                    ['label' => '新产品3', 'url' => ['/product/index5']],
                    ['label' => '流行产品3', 'url' => ['/product/index6']],
                ]],
            ]
        ],
        'blog'=> ['label'=>'博客管理', 'items'=>[
                ['icon'=>'glyphicon glyphicon-user','label' => '文章管理','items' => [
                    ['label' => '文章列表', 'url' => ['/blog/article']],
                    ['label' => '分类列表', 'url' => ['/blog/type']],
                    ['label' => '标签列表', 'url' => ['/blog/tag']],
                ]]
            ]
        ],
        'setting'=> ['label'=>'系统设置', 'items'=>[
                ['icon'=>'glyphicon glyphicon-user','label' => '权限管理','items' => [
                    ['label' => '用户管理', 'url' => ['/setting/user']],
                    ['label' => '角色管理', 'url' => ['/setting/roles']],
                    ['label' => '权限列表', 'url' => ['/setting/permission']],
                    ['label' => '路由列表', 'url' => ['/setting/route']],
                    ['label' => '规则列表', 'url' => ['/setting/rule']],
                ]]
            ]
        ]

    ]
];
<?php
use yii\widgets\Menu;
?>
<nav class="sidebar-nav">
    <?= Menu::widget([
        'options'=>["id"=>"menu","class"=>'metismenu'],
        'encodeLabels'=>false,
        'activateParents'=>true,
        'linkTemplate'=>'<a href="{url}">{label}</a>',  //<i class="glyphicon glyphicon-chevron-left pull-right"></i>
        'items' => $this ->context -> leftMenu
    ]);?>
</nav>
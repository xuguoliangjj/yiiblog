<?php
/* @var $this yii\web\View */
\backend\assets\DatatableAsset::register($this);
?>
<?php
$this->registerJs('
    $("#gameList").DataTable({
				searching:false,
				info:false,
				language: {
                "sLengthMenu": "",

				}
			});
');
?>
<div class="container">
    <?php echo \yii\helpers\Markdown::process('
```php
<?php
function function_name() {
    echo "hello world";
}
// traditional markdown and parse full text
$parser = new \cebe\markdown\Markdown();
$parser->parse($markdown);

// use github markdown
$parser = new \cebe\markdown\GithubMarkdown();
$parser->parse($markdown);

// use markdown extra
$parser = new \cebe\markdown\MarkdownExtra();
$parser->parse($markdown);

// parse only inline elements (useful for one-line descriptions)
$parser = new \cebe\markdown\GithubMarkdown();
$parser->parseParagraph($markdown);
```
        ','gfm')?>
    <div class="jumbotron">
        <h1><?=Yii::$app->user->identity->username?>，欢迎使用数据分析平台!</h1>
    </div>
    <div class="row">
    <table id="gameList" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>游戏名称</th>
            <th>设备激活</th>
            <th>玩家</th>
            <th>游戏次数</th>
            <th>收入</th>
            <th>报表</th>
        </tr>
        </thead>


        <tbody>
        <tr>
            <td>测试游戏1</td>
            <td>1241</td>
            <td>123211</td>
            <td>1122</td>
            <td>$12345633</td>
            <td>--</td>
        </tr>
        <tr>
            <td>测试游戏2</td>
            <td>1322</td>
            <td>123211</td>
            <td>1122</td>
            <td>$12345633</td>
            <td>--</td>
        </tr>
        </tbody>
    </table>
        </div>
</div>

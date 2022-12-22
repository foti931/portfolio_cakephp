<?php
/**
 * @var AppView $this
 * @var Array $data
 */

use App\View\AppView;

?>
<h1>アクセスログ</h1>
<table>
    <?= $this->Html->tableHeaders(["アクセス日時", "スクリプト名","ユーザーエージェント","リンク元のURL"]) ?>
    <?php foreach ($data as $v): ?>
        <?= $this->Html->tableCells($v) ?>
    <?php endforeach; ?>
</table>

<?php defined('LSKY') or die('Illegal access!');

// 每页显示数量
$page_size = 12;

// limit
$page_now = ($page - 1) * $page_size;

$total = $db->table('article')
    ->findNumRows();
$article = $db->table('article')
    ->order('send_time desc')
    ->limit("{$page_now}, {$page_size}")
    ->select();
$pageno = new Page($total, 3, $page, $page_size);

?>
<style>
    .page {
        margin-bottom: 20px;
    }
</style>
<div class="animated fadeInDown">
    <div class="mdui-table-fluid">
        <table class="mdui-table mdui-table-hoverable article">
            <thead>
            <tr>
                <th>序号</th>
                <th>内容</th>
                <th>名称</th>
                <th>性别</th>
                <th>QQ</th>
                <th>是否匿名</th>
                <th>IP</th>
                <th>时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($article as $value): ?>
                <tr>
                    <td><?php echo $value['id'] ?></td>
                    <td class="content" mdui-tooltip="{content: '<?php echo htmlspecialchars($value['content']); ?>'}"><?php echo htmlspecialchars($value['content']); ?></td>
                    <td><?php echo $value['name'] ?></td>
                    <td>
                        <?php
                        switch ($value['sex']):
                            case 1: echo '男'; break;
                            case 2: echo '女'; break;
                            default: echo '未知'; break;
                        endswitch;
                        ?>
                    </td>
                    <td><?php echo $value['qq'] ?></td>
                    <td><?php echo $value['is_anonymous'] ? '是' : '否' ?></td>
                    <td><?php echo $value['ip']; ?></td>
                    <td mdui-tooltip="{content: '<?php echo date('Y-m-d h:i:s', $value['send_time']); ?>'}"><?php echo Operate::formatTime($value['send_time']); ?></td>
                    <td><button class="delete mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" data-id="<?php echo $value['id']; ?>"><i class="mdui-icon material-icons">delete</i></button></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="page">
        <?php echo $pageno->showPages(); ?>
    </div>
</div>
<script>
    $('.page a').click(function(e) {
        e.preventDefault();
        if($(this).hasClass('active')) {
            return false;
        }
        loading(true);
        $('.main').load($(this).attr('href'), {action:'article'}, function() {
            loading(false);
        });
    });
    $('.delete').click(function () {
        mdui.confirm('删除不可恢复，确定删除吗？', function() {
            var t = $(this);
            ajax('?type=article_delete', {id:$(this).attr('data-id')}, function (res) {
                if (res.code) {
                    t.parent('td').parent('tr').remove();
                }
                msg(res.msg);
            });
        }, function () {

        }, {
            confirmText: '确定',
            cancelText: '取消'
        });
    });
</script>
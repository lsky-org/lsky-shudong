<?php defined('LSKY') or die('Illegal access!');

$blacklist = get_blacklist();

?>
<div class="animated fadeInDown">
    <button id="add" class="mdui-float-right mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">添加关键字</button>
    <div class="mdui-clearfix"></div>
    <hr>
    <?php foreach ($blacklist as $item => $value): ?>
        <div class="mdui-chip">
            <span class="mdui-chip-title"><?php echo $value; ?></span>
            <span data-id="<?php echo $item; ?>" class="delete mdui-chip-delete"><i class="mdui-icon material-icons">cancel</i></span>
        </div>
    <?php endforeach; ?>
</div>
<script>
    $('.delete').click(function () {
        var t = $(this);
        ajax('?type=blacklist_delete', {id:$(this).attr('data-id')}, function (res) {
            if (res.code) {
                t.parent('.mdui-chip').remove();
            }
            msg(res.msg);
        });
    });
    $('#add').click(function () {
        mdui.prompt('请输入关键字', '添加关键字',
            function (value) {
                if (value.length >= 1) {
                    ajax('?type=blacklist_add', {name:value}, function (res) {
                        msg(res.msg);
                    });
                }
            },
            function (value) {
            },
            {
                maxlength: 20,
                confirmText: '添加',
                cancelText: '取消'
            }
        );
    });
</script>

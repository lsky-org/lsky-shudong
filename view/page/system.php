<?php defined('LSKY') or die('Illegal access!'); ?>
<div class="animated fadeInDown">
    <form action="" method="post">
        快速删除　
        <label class="mdui-switch">
            <input name="fast_delete" type="checkbox" value="1" <?php echo $conf['fast_delete'] ? 'checked' : '' ?> />
            <i class="mdui-switch-icon"></i>
        </label>
        <div class="mdui-textfield">
            <label class="mdui-textfield-label">网站标题</label>
            <input class="mdui-textfield-input" type="text" name="web_title" value="<?php echo $conf['web_title']; ?>" placeholder="网站标题"/>
        </div>
        <div class="mdui-textfield">
            <label class="mdui-textfield-label">网站关键字</label>
            <input class="mdui-textfield-input" type="text" name="keywords" value="<?php echo $conf['keywords']; ?>" placeholder="网站关键字，逗号隔开"/>
        </div>
        <div class="mdui-textfield">
            <label class="mdui-textfield-label">网站描述</label>
            <input class="mdui-textfield-input" type="text" name="description" value="<?php echo $conf['description']; ?>" placeholder="网站描述"/>
        </div>
        <div class="mdui-textfield">
            <label class="mdui-textfield-label">同一IP每日发表次数</label>
            <input class="mdui-textfield-input" type="text" name="publish_num" value="<?php echo $conf['publish_num']; ?>" placeholder="发表次数限制"/>
        </div>
        <div class="mdui-textfield">
            <label class="mdui-textfield-label">ICP备案号</label>
            <input class="mdui-textfield-input" type="text" name="icp" value="<?php echo $conf['icp']; ?>" placeholder="ICP备案号"/>
        </div>
        <button type="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent mdui-float-right">确认修改</button>
    </form>
</div>
<script>
    $('form').submit(function (e) {
        e.preventDefault();
        ajax('?type=config', $(this).serialize(), function (data) {
            msg(data.msg);
        });
    });
</script>
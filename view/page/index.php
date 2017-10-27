<?php defined('LSKY') or die('Illegal access!');?>
<div class="fadeInDown animated mdui-container">
    <?php foreach($list as $value) { ?>
    <div class="mdui-col-md-3 mdui-col-sm-4">
        <div class="article lk-hover">
            <div class="lk-panel-body
            <?php switch ($value['sex']) {
                case 0: echo '';
                    break;
                case 1: echo 'boy';
                    break;
                case 2: echo 'girl';
                    break;
            } ?>">
                <span class="span">
                    <?php echo htmlspecialchars($value['content']) ?>
                </span>
            </div>
            <div class="lk-panel-foot">
                <img class="author-img mdui-img-circle" src="<?php echo $value['is_anonymous'] ? '/static/images/wms.jpg' : "https://avatar.mixcm.cn/qq/{$value['qq']}" ?>">
                <p><?php echo $value['is_anonymous'] ? '匿名' : htmlspecialchars($value['name']) ?></p>
                <cite mdui-tooltip="{'content': '<?php echo date('Y-m-d h:i:s', $value['send_time']) ?>', 'position': 'right'}"><?php echo Operate::formatTime($value['send_time']) ?></cite>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="page">
        <?php echo $pageno->showPages(); ?>
    </div>
</div>
<script>
    // Page
    $('.page a').click(function(e) {
        e.preventDefault();
        if($(this).hasClass('active')) {
            return false;
        }
        loading(true);
        $('.content').load($(this).attr('href'), {'action': 'index'}, function() {
            loading(false);
        });
    });
</script>

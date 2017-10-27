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
                <cite mdui-tooltip="{'content': '<?php echo date('Y-m-d h:i:s', $value['send_time']) ?>'}"><?php echo formatTime($value['send_time']) ?></cite>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

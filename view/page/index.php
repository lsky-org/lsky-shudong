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
    <style>
        .page {
            clear: both;
            padding-top: 25px;
            text-align: center;
        }
        .page a {
            margin: 0 4px;
            padding: 7px 14px;
            border-radius: 4px;
            display: inline-block;
            line-height: 18px;
            color: #2196F3;
            background: #E3F2FD;
        }
        .page a:hover, .page a.active {
            color: #ffffff;
            background: #2196F3;
            box-shadow: 0 0 8px #42A5F5;
        }
        .page a.active { cursor: not-allowed; }
    </style>
    <div class="page">
        <?php echo $pageno->showPages(); ?>
    </div>
</div>

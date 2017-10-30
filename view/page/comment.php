<?php defined('LSKY') or die('Illegal access!');?>
<?php if(count($comment_list) > 0) { ?>
<div class="comment-list">
    <?php foreach ($comment_list as $item => $value) { ?>
    <div class="comment-body">
        <div class="comment-author">
            <img class="mdui-img-circle" src="./static/images/wms.jpg">
        </div>
        <div class="comment-content">
            <div class="comment-label">
                <span><?php echo $value['os'] ?></span>
                <span><?php echo Operate::formatTime($value['add_time']) ?></span>
                <em>#<?php echo $item + 1 ?></em>
            </div>
            <div class="comment-text">
                <?php echo Operate::face($config['face'], htmlspecialchars($value['content'])) ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<div class="comment-textarea">
    <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">说点什么吧...</label>
        <textarea class="mdui-textfield-input" maxlength="300"></textarea>
    </div>
</div>
<?php } else { ?>
<h3 style="text-align: center;">暂时没有评论</h3>
<?php } ?>

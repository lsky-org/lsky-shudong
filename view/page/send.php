<?php defined('LSKY') or die('Illegal access!'); ?>
<div class="fadeInDown animated mdui-container panel send">
    <form action="" method="post">
        <div class="mdui-col-md-8 mdui-col-sm-8">
            <div class="textfield">
                <h2>你想说的话</h2>
                <textarea rows="5" id="content" name="content" placeholder="你想说的话" required></textarea>
                <div class="kind">
                    <div class="face">
                        <a class="mdui-typo-caption-opacity mdui-ripple" href="javascript:void(0)">
                            <i class="mdui-icon material-icons">&#xe24e;</i>
                        </a>
                        <div class="face-fixed face-fade none">
                            <?php foreach ($config['face'] as $value) { ?>
                                <a data-value="{face:<?php echo $value ?>}" title="<?php echo $value ?>"
                                   href="javascript:void(0)">
                                    <img src="./static/images/face/<?php echo $value ?>.png">
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="textfield">
                <h2>名称</h2>
                <input type="text" name="name" placeholder="你的名字(20个字符)" autocomplete="off" required maxlength="20">
            </div>
            <div class="textfield">
                <h2>QQ</h2>
                <input type="text" name="qq" placeholder="用于显示头像" autocomplete="off" required maxlength="10">
            </div>
        </div>
        <div class="mdui-col-md-4 mdui-col-sm-4">
            <div class="textfield">
                <h2>你的性别</h2>
                <label class="mdui-radio">
                    <input type="radio" value="1" name="sex" checked/>
                    <i class="mdui-radio-icon"></i>
                    男
                </label>
                <label class="mdui-radio">
                    <input type="radio" value="2" name="sex"/>
                    <i class="mdui-radio-icon"></i>
                    女
                </label>
                <label class="mdui-radio">
                    <input type="radio" value="0" name="sex"/>
                    <i class="mdui-radio-icon"></i>
                    ￥%@#￥%
                </label>
            </div>
            <div class="textfield">
                <h2>是否匿名</h2>
                <label class="mdui-radio">
                    <input type="radio" value="1" name="is_anonymous" checked/>
                    <i class="mdui-radio-icon"></i>
                    是
                </label>
                <label class="mdui-radio">
                    <input type="radio" value="0" name="is_anonymous" checked/>
                    <i class="mdui-radio-icon"></i>
                    否
                </label>
            </div>
            <p>请勿发布违反中国大陆和香港法律的言论，违者后果自负。</p>
            <button type="submit" id="send" class="mdui-btn mdui-btn-raised mdui-ripple mdui-btn-block">悄悄地发布</button>
        </div>
    </form>
</div>
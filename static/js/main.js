/**
 * Created by WispX on 2017/10/26.
 */
$(window).bind("scroll", function () {
    var sTop = $(window).scrollTop();
    var sTop = parseInt(sTop);
    if(sTop < 50) {
        $('#top').addClass('mdui-fab-hide');
    } else {
        $('#top').removeClass('mdui-fab-hide');
    }
});
$(function() {
    loading(true);
    $('.content').load('', {'action': 'index'}, callback);
    var menu = $('.menu a');
    menu.click(function(e) {
        e.preventDefault();
        loading(true);
        var obj = getStrToJson($(this).attr('data-json'));
        $('.content').load($(this).attr('href'), obj, callback);
        menu.each(function() {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
    });
    $('#top').click(function() {
        $('html,body').animate({scrollTop: 0}, 600);
    });
});
function callback() {
    loading(false);
    $('.article').click(function () {
        var inst = new mdui.Dialog('.mdui-dialog');
        // Content
        $('.mdui-dialog-content .span').html($(this).find('.lk-panel-body').html());
        // Author
        $('.mdui-dialog-content .dialog-footer').html($(this).find('.lk-panel-foot').html());
        // TODO Comment
        inst.open();
    });
    $('.page a').click(function(e) {
        e.preventDefault();
        if($(this).hasClass('active')) {
            return false;
        }
        loading(true);
        // 获取当前导航位置
        var obj = getStrToJson($('.menu a.active').attr('data-json'));
        $('.content').load($(this).attr('href'), obj, function() {
            loading(false);
            callback();
        });
    });
    $('form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '?type=send',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function(res) {
                if(res.code == 1) {
                    msg(res.msg, function() {
                        $('#index').click();
                    });
                } else if (res.code == 2) {
                    mdui.alert(res.msg);
                } else {
                    msg(res.msg);
                }
            },
            error: function() {
                msg('请求异常，请稍后重试');
            }
        });
    });
    $('.face').hover(function() {
        var div = $(this).find('div');
        if(div.hasClass('none')) {
            div.removeClass('none');
        } else {
            div.addClass('none');
        }
    });
    $('.face .face-fixed a').click(function () {
        insertAtCursor(document.getElementById('content'), $(this).attr('data-value'));
    });
}
function msg(message, callback) {
    return mdui.snackbar({
        message: message,
        position: 'right-top',
        onClose: callback ? callback : function() {

        },
    });
}
function loading(bool) {
    if(bool) {
        return $('.loading-shade').show();
    }
    return $('.loading-shade').hide();
}
function getStrToJson(str) {
    return eval('(' + str + ')');
}
function insertAtCursor(myField, myValue) {
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = myValue;
        sel.select();
    } else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;

        // 保存滚动条
        var restoreTop = myField.scrollTop;
        myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos, myField.value.length);

        if (restoreTop > 0) {
            myField.scrollTop = restoreTop;
        }

        myField.focus();
        myField.selectionStart = startPos + myValue.length;
        myField.selectionEnd = startPos + myValue.length;
    } else {
        myField.value += myValue;
        myField.focus();
    }
}
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
        ajax('?type=send', $(this).serialize(), function (res) {
            if(res.code == 1) {
                msg(res.msg, function() {
                    $('#index').click();
                }, 2500);
            } else if (res.code == 2) {
                mdui.alert(res.msg);
            } else {
                msg(res.msg);
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
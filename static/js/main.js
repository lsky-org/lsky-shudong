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
        $('.mdui-dialog-content span').html($(this).find('.lk-panel-body').html());
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

/**
 * Created by WispX on 2017/10/26.
 */
$(function() {
    loading(true);
    $('.content').load('', {'action': 'index'}, callback);
    var menu = $('.menu a');
    menu.click(function(e) {
        e.preventDefault();
        loading(true);
        var obj = eval('(' + $(this).attr('data-json') + ')');
        $('.content').load($(this).attr('href'), obj, callback);
        menu.each(function() {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
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
        $('.content').load($(this).attr('href'), {'action': 'index'}, function() {
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

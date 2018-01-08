/**
 * Ajax
 * @param url       请求地址
 * @param data      数据
 * @param callback  请求成功后的回调
 * @param type      请求类型
 * @param dataType  回调数据类型
 * @param async     同步异步
 */
function ajax(url, data, callback, type, dataType, async) {
    $.ajax({
        url: url,
        type: type ? type : 'POST',
        data: data,
        async: async ? async : true,
        dataType: dataType ? dataType : 'JSON',
        beforeSend: function () {
            loading(true);
        },
        success: callback,
        complete: function () {
            loading(false);
        },
        error: function () {
            msg("服务端异常，请稍后重试!");
        }
    });
}
function msg(message, callback, timeout) {
    return mdui.snackbar({
        timeout: timeout ? timeout : 4000,
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

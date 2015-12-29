$(document).on('pjax:send', function() {
    $.fn.editorDridView = layer.load(0, {shade: [0.3,'#fff']});
})
$(document).on('pjax:complete', function() {
    layer.close($.fn.editorDridView);
})
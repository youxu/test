var MenuList = function() {
    var menuInit = function(){
        var menu = {
            box:'.box-primary',
        };

        /**
         * 修改菜单数据
         * @author 晚黎
         * @date   2016-11-04T16:51:00+0800
         */
        $(menu.box).on('click','.editButton',function () {
            var l = $(this).ladda();
            var _item = $(this);
            var _form = $('#editForm');

            $.ajax({
                url:_form.attr('action'),
                type:'post',
                dataType: 'json',
                data:_form.serializeArray(),
                headers : {
                    'X-CSRF-TOKEN': $("input[name='_token']").val()
                },
                beforeSend : function(){
                    l.ladda( 'start' );
                    _item.attr('disabled','true');
                },
                success:function (response) {
                    layer.msg(response.message);
                    setTimeout(function(){
                        window.location.href = '/admin/menu';
                    }, 1000);
                }
            }).fail(function(response) {
                if(response.status == 422){
                    var data = $.parseJSON(response.responseText);
                    var layerStr = "";
                    for(var i in data){
                        layerStr += "<div>"+data[i]+"</div>";
                    }
                    layer.msg(layerStr);
                }
            }).always(function () {
                l.ladda('stop');
                _item.removeAttr('disabled');
            });;
        });
    };

    return {
        init : menuInit
    }
}();
$(function () {
    MenuList.init();
});
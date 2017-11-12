var MenuList = function() {
    var menuInit = function(){
        $('#nestable').nestable({
            "maxDepth":2
        }).on('change',function () {
            var list = window.JSON.stringify($('#nestable').nestable('serialize'));
            console.log(list);
            $.ajax({
                url:'/admin/menu/orderable',
                data:{
                    nestable:list
                },
                dataType:'json',
                success:function (response) {
                    if (response.status) {
                        layer.msg(response.message);
                    }
                }
            });
        });
        var menu = {
            box:'.box-primary',
            createMenu:'.create_menu',
            close:'.close-link',
            createForm:'#createBox',
            middleBox:'.middle-box',
            createButton:'.createButton',
        };

        /**
         * 添加菜单
         * @date   2016-11-04T16:12:58+0800
         */
        $(menu.box).on('click','.createButton',function () {
            var l = $(this).ladda();
            var _item = $(this);
            var _form = $('#createForm');
            $.ajax({
                url:'/admin/menu',
                type:'post',
                dataType: 'json',
                data:_form.serializeArray(),
                headers : {
                    'X-CSRF-TOKEN': $("input[name='_token']").val()
                },
                beforeSend : function(){
                    l.ladda('start');
                    _item.attr('disabled','true');
                },
                success:function (response) {
                    // $("#message").text(response.message);
                    // $('#myModal').modal();
                    layer.msg(response.message);
                    setTimeout(function(){
                        window.location.href = '/admin/menu';
                    }, 1000);
                }
            }).fail(function(response) {
                if(response.status == 422){
                    var data = $.parseJSON(response.responseText);
                    var errStr = "";
                    for(var i in data){
                        errStr += "<div>"+data[i]+"</div>";
                    }
                    layer.msg(errStr);
                    // $("#message").html(errStr);
                    // $("#").modal();
                }
            }).always(function () {
                l.ladda('stop');
                _item.removeAttr('disabled');
            });;
        });
        $('#nestable').on('click','.showInfo',function () {
            var _item = $(this);
            var thisId = _item.attr('data-id');
            var showDiv = $("#showinfo_" + thisId);
            $.ajax({
                url:_item.attr('data-href'),
                dataType:'html',
                success:function (htmlData) {
                    if(showDiv.is(":hidden")){
                        showDiv.html(htmlData).show();
                    }
                    else{
                        showDiv.hide();
                    }
                }
            });
        });
        $("#nestable").on('click','.close-link',function () {
            var thisId = $(this).attr('data-id');
            $('#showinfo_' + thisId).hide();
        });
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
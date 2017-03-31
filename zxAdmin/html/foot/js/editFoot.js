//显示菜品
var pageInfo = {};//分页信息
var $ftbody = $('#orderTable tbody');
function showOrder(curPage) {
    $ftbody.empty();
    var classHtml = $('template#orderInfo').html();
    $.get('data/showFoot.php', {flag: 1,curPage: curPage - 1}, function (data) {
        pageInfo.total = data.total; //总记录数
        pageInfo.page = Math.ceil(pageInfo.total / 10);//页数
        pageInfo.curPage = curPage; //当前页

        $.each(data.list, function () {
            $(classHtml.replace('{{footName}}', this.footName)
                .replace('{{classify}}', this.classify)
                .replace('{{path}}', this.path)
                .replace('{{footNum}}', this.footNum)
                .replace('{{footPrice}}', this.footPrice)
                .replace(/\{\{footId\}\}/g, this.footId)).appendTo($ftbody);
        });
        showPageBar()
    }, 'json')
}
showOrder(1);

function showAginOrder(curPage) {//显示分页
    $ftbody.empty();
    var classHtml = $('template#orderInfo').html();
    var param = {
        footName:$('#footName').val(),
        classify:$('#classify').val(),
        footPrice:$('#footPrice').val(),
        curPage:curPage - 1
    }
    console.log(param);
    $.post('data/searchFoot.php', param, function (data) {
        if(data.flag == '1'){
            pageInfo.total = data.total; //总记录数
            pageInfo.page = Math.ceil(pageInfo.total / 10);//页数
            pageInfo.curPage = curPage; //当前页
            $.each(data.list, function () {
            $(classHtml.replace('{{footName}}', this.footName)
                .replace('{{classify}}', this.classify)
                .replace('{{path}}', this.path)
                .replace('{{footNum}}', this.footNum)
                .replace('{{footPrice}}', this.footPrice)
                .replace(/\{\{footId\}\}/g, this.footId)).appendTo($ftbody);
            });
            showPageBar()
        }else{
            alert("当前条件查询不到销售量，请重新输入查询条件！");
        }
    }, 'json')
}

$('form#searchForm').submit(function () {
    var footName = $('#footName').val();
    var classify = $('#classify').val();
    var footPrice = $('#footPrice').val();
    if(footName==""&&classify==""&&footPrice==""){
        alert("查询条件不能为空");
    }else{
        showAginOrder(1);
    }
    return false;
});

//分页导航条
function showPageBar() {
    var html = "<div><span class='ui-icon ace-icon fa fa-refresh green' onclick='refresh()'></span></div><ul class='pagination'>";
    if (pageInfo.curPage == 1 && pageInfo.page != 1) {
        html += "<li class='disabled'><a href='javascript:;' data-page='1'>首页</a></li>" +
            "<li class='disabled'><a href='javascript:;' aria-label='Previous' data-page='" + (pageInfo.curPage - 1) + "'><span aria-hidden='true'>上一页</span></a></li>" +
            "<li><a href='javascript:;' data-page='" + pageInfo.curPage + "'>" + pageInfo.curPage + "</a></li>" +
            "<li><a href='javascript:;' data-page='" + (pageInfo.curPage + 1) + "'  aria-label='Next'><span aria-hidden='true'>下一页</span></a></li>"+
            "<li><a href='javascript:;' data-page='" + (pageInfo.page) + "' >尾页</a></li></ul>";
    } else if (pageInfo.curPage == 1 && pageInfo.page == 1) {
        html += "<li class='disabled'><a href='javascript:;' data-page='1'>首页</a></li>" +
            "<li class='disabled'><a href='javascript:;' aria-label='Previous' data-page='" + (pageInfo.curPage - 1) + "'><span aria-hidden='true'>上一页</span></a></li>" +
            "<li class='disabled'><a href='javascript:;' data-page='" + pageInfo.curPage + "'>" + pageInfo.curPage + "</a></li>" +
            "<li class='disabled'><a href='javascript:;' data-page='" + (pageInfo.curPage + 1) + "'  aria-label='Next'><span aria-hidden='true'>下一页</span></a></li>"+
            "<li class='disabled'><a href='javascript:;' data-page='" + (pageInfo.page) + "' >尾页</a></li></ul>";
    }else if (pageInfo.curPage == pageInfo.page) {
        html += "<li><a href='javascript:;' data-page='1'>首页</a></li>" +
            "<li><a href='javascript:;' aria-label='Previous' data-page='" + (pageInfo.curPage - 1) + "'><span aria-hidden='true'>上一页</span></a></li>" +
            "<li><a href='javascript:;' data-page='" + pageInfo.curPage + "'>" + pageInfo.curPage + "</a></li>" +
            "<li class='disabled'><a href='javascript:;' data-page='" + (pageInfo.curPage + 1) + "'  aria-label='Next'><span aria-hidden='true'>下一页</span></a></li>"+
            "<li class='disabled'><a href='javascript:;' data-page='" + (pageInfo.page) + "' >尾页</a></li></ul>";
    } else {
        html += "<li><a href='javascript:;' data-page='1'>首页</a></li>" +
            "<li><a href='javascript:;' aria-label='Previous' data-page='" + (pageInfo.curPage - 1) + "'><span aria-hidden='true'>上一页</span></a></li>" +
            "<li><a href='javascript:;' data-page='" + pageInfo.curPage + "'>" + pageInfo.curPage + "</a></li>" +
            "<li><a href='javascript:;' data-page='" + (pageInfo.curPage + 1) + "'  aria-label='Next'><span aria-hidden='true'>下一页</span></a></li>"+
            "<li><a href='javascript:;' data-page='" + (pageInfo.page) + "' >尾页</a></li></ul>";
    }
    html += "<div>一共" + pageInfo.total + "条记录，当前为" + pageInfo.curPage + "/" + pageInfo.page + "</div>";
    $('nav#page').html(html);
}
$('nav#page').on('click', 'a',function (e) {
    var name = $(this).parent('li').attr('class');
    if(name != 'disabled'){
        var page = $(this).data('page');
        showOrder(page);
    }
    e.preventDefault();
});

//编辑菜品
$ftbody.delegate('button', 'click', function (e) {
    $this = $(this);
    var footId = $this.attr('attr-id');
    if ($this.hasClass('see')) {
        $.get('data/showFoot.php',{flag:3,footId:footId},function(data){
            var tableBody = $("#printmeBody");
            tableBody.empty();
            var classHtml = $('template#editFoot').html();
            $.each(data, function () {
                $(classHtml.replace('{{footname}}', this.footName)
                    .replace('{{footNum}}', this.footNum)
                    .replace('{{footPrice}}', this.footPrice)
                    .replace('{{footId}}', this.footId)).appendTo(tableBody);
            });

            $('#dialogsd').removeClass('hidden');
            $('.ui-widget-overlay ').removeClass('hidden');

        },'json');
    }
    else if ($this.hasClass('del')) {
        if (confirm('您确定要取消该菜品吗？')) {
            $.get('./data/showFoot.php',{flag:2,footId:footId},function(data){
                switch (data.flag){
                    case 1:
                        alert("该菜品删除成功!");
                        showOrder(pageInfo.curPage);
                        break;
                    case 2:
                        alert("该菜品删除失败!");
                        break;
                }
            },'json')
        }
    }
    else if ($this.hasClass('editImg')) {
        var tableBody = $("#imgBody");
            tableBody.empty();
        var classHtml = $('template#tempImg').html();
        $(classHtml.replace('{{footId}}', footId)).appendTo(tableBody);
        //上传菜品图片
        $('#imgfile').ace_file_input({
            style:'well',
            btn_choose:'请选择菜品图片上传',
            btn_change:null,
            no_icon:'ace-icon fa fa-cloud-upload',
            droppable:true,
            thumbnail:'large',
        });
        $('#dialogsdImg').removeClass('hidden');
        $('.ui-widget-overlay ').removeClass('hidden');
        $('.subImg').click(function(){
            $.ajaxFileUpload({
                url:"./data/editImg.php?"+ $('#imgForm').serialize(),
                fileElementId:'imgfile',
                secureuri:false,
                dataType:'TEXT',
                success:function(data){
                    alert(data);
                    window.location.reload();
                },
                error: function () {
                    alert("请检查您的网络！");
                }
            });
            return false;
        })
    }
    else if ($this.hasClass('editClass')) {
        //在添加菜品时获取分类
        var $selClass=$('#selClass');
        $.get('../classify/data/showClassify.php',function(data){
            $.each(data, function () {
                $selClass.append("<option value='"+this.classify+"'>"+this.classify+"</option>");
            });
            //选择菜品类别
            $('.chosen-select').chosen({allow_single_deselect:true}); 
                $(window)
                .off('resize.chosen')
                .on('resize.chosen', function() {
                    $('.chosen-select').each(function() {
                         var $this = $(this);
                         $this.next().css({'width': $this.parent().width()});
                    })
            }).trigger('resize.chosen');
        },'json')
        $('#dialogsdClass').removeClass('hidden');
        $('.ui-widget-overlay ').removeClass('hidden');
        $('.subClass').click(function(){
            var param = {
                flag: 2,
                classify: $('#selClass').val(),
                footId:footId
            }
            $.post('./data/editFoot.php', param, function (data) {
                switch (data.flag){
                    case 4:
                        alert('菜品类别修改成功！');
                        window.location.reload();
                        break;
                    case 5:
                        alert('菜品类别修改失败，请检查您的网络！');
                        break;
                    case 6:
                        alert('菜品类别重复，请重新输入！');
                        break;
                    }
            }, 'json')
            return false;
        })
    }
})

function colseDialogsd() {
    $('.dialogsd').addClass('hidden');
    $('.ui-widget-overlay ').addClass('hidden');
}

function refresh(){
    window.location.reload();
}

function subInfo(){
    var param = {
        flag: 1,
        footName:$('#footName').val(),
        footNum:$('#footNum').val(),
        footPrice:$('#footPrice').val(),
        footId:$('#footId').val()
    }
    $.post('./data/editFoot.php', param, function (data) {
        switch (data.flag){
            case 1:
                alert('菜品修改成功！');
                window.location.reload();
                break;
            case 2:
                alert('菜品修改失败，请检查您的网络！');
                break;
            case 3:
                alert('菜品名字重复，请重新输入！');
                break;
        }
    }, 'json')
}

//显示菜品
var pageInfo = {};//分页信息
var $ftbody = $('#orderTable tbody');
function showOrder(curPage) {
    $ftbody.empty();
    var classHtml = $('template#orderInfo').html();
    $.get('data/sales.php', {flag: 1,curPage: curPage - 1}, function (data) {
        pageInfo.total = data.total; //总记录数
        pageInfo.page = Math.ceil(pageInfo.total / 10);//页数
        pageInfo.curPage = curPage; //当前页

        $.each(data.list, function () {
            var totalPrice = (this.footPrice*this.orderNum).toFixed(2);
            $(classHtml.replace('{{eatTel}}', this.eatTel)
                .replace('{{eatTime}}', this.eatTime)
                .replace('{{eatTel}}', this.eatTel)
                .replace('{{footname}}', this.footname)
                .replace('{{footPrice}}', this.footPrice)
                .replace('{{orderNum}}', this.orderNum)
                .replace('{{totalPrice}}', totalPrice)).appendTo($ftbody);
        });
        showPageBar()
    }, 'json')
}
showOrder(1);

function showAginOrder(curPage) {//显示分页
    $ftbody.empty();
    var classHtml = $('template#orderInfo').html();
    var param = {
        startTime:$('#startTime').val(),
        endTime:$('#endTime').val(),
        footName:$('#footName').val(),
        eatTel:$('#eatTel').val(),
        curPage:curPage - 1
    }
    $.post('data/searchOrder.php', param, function (data) {
        if(data.flag == '1'){
            pageInfo.total = data.total; //总记录数
            pageInfo.page = Math.ceil(pageInfo.total / 10);//页数
            pageInfo.curPage = curPage; //当前页
            $.each(data.list, function () {
                var totalPrice = (this.footPrice*this.orderNum).toFixed(2);
                $(classHtml.replace('{{eatTel}}', this.eatTel)
                    .replace('{{eatTime}}', this.eatTime)
                    .replace('{{eatTel}}', this.eatTel)
                    .replace('{{footname}}', this.footname)
                    .replace('{{footPrice}}', this.footPrice)
                    .replace('{{orderNum}}', this.orderNum)
                    .replace('{{totalPrice}}', totalPrice)).appendTo($ftbody);
            });
            showPageBar()
        }else{
            alert("当前条件查询不到销售量，请重新输入查询条件！");
        }
    }, 'json')
}

$('form#searchForm').submit(function () {
    var startTime = $('#startTime').val();
    var endTime = $('#endTime').val();
    if(startTime==""||endTime==""){
        alert("查询时间段不能为空");
    }else if(startTime==endTime) {
        alert("时间区间不能相同，如果要查询某一天的销售量，请输入当天到第二天的时间；例如查询2017-03-25的销售额，请输入查询条件2017-03-25--2017-03-26");
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


function refresh(){
    window.location.reload();
}





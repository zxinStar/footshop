//显示菜品
var pageInfo = {};//分页信息
var $ftbody = $('#orderTable tbody');
function showOrder(curPage) {//显示分类
    $ftbody.empty();
    var classHtml = $('template#orderInfo').html();
    $.get('data/showOrder.php', {flag: 1,curPage: curPage - 1}, function (data) {
        pageInfo.total = data.total; //总记录数
        pageInfo.page = Math.ceil(pageInfo.total / 10);//页数
        pageInfo.curPage = curPage; //当前页

        $.each(data.list, function () {
            $(classHtml.replace('{{orderNo}}', this.orderNo)
                .replace('{{eatName}}', this.eatName)
                .replace('{{eatTel}}', this.eatTel)
                .replace('{{eatNum}}', this.eatNum)
                .replace('{{eatTime}}', this.eatTime)
                .replace('{{memo}}', this.memo)
                .replace(/\{\{orderId\}\}/g, this.orderId)).appendTo($ftbody);
        });
        showPageBar()
    }, 'json')
}
showOrder(1);

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
    var orderId = $this.attr('attr-id');
    if ($this.hasClass('see')) {
        $.get('data/showOrder.php',{flag:3,orderId:orderId},function(data){
            var tableBody = $("#printmeBody .addPrint");
            tableBody.empty();
            var classHtml = $('template#print').html();
            $.each(data, function () {
                $(classHtml.replace('{{footname}}', this.footname)
                    .replace('{{footPrice}}', this.footPrice)
                    .replace('{{orderNum}}', this.orderNum)).appendTo(tableBody);
            });
            
            $('#dialogsd').removeClass('hidden');
            $('.ui-widget-overlay ').removeClass('hidden');
            var trs = $('#printmeBody .addPrint p');
            function total() {
                var sum = 0, num = 0;
                $.each(trs, function () {
                    num=parseInt($(this).find(".number").text());
                    sum+=parseFloat($(this).find(".price").text())*num;
                });
                $('.sales').html("小计："+sum.toFixed(2)+"元");
            }
            total();
        },'json');
    }
    else if ($this.hasClass('del')) {
        if (confirm('您确定要取消该订单吗？')) {
            $.get('./data/showOrder.php',{flag:2,orderId:orderId},function(data){
                switch (data.flag){
                    case 1:
                        alert("该订单取消成功!");
                        showOrder(pageInfo.curPage);
                        break;
                    case 2:
                        alert("该订单取消失败!");
                        break;
                }
            },'json')
        }
    }
})

function colseDialogsd() {
    $('#dialogsd').addClass('hidden');
    $('.ui-widget-overlay ').addClass('hidden');
}

function printme()
{
    window.location.reload();
    document.body.innerHTML=document.getElementById('printmeBody').innerHTML;
    window.print();
}

function refresh(){
    window.location.reload();
}

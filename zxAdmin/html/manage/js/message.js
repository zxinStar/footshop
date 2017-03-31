$.post('./data/message.php',function(data){
    var grid_data = data;
    jQuery(function($) {
    var grid_selector = "#grid-table";
    var pager_selector = "#grid-pager";
    //resize to fit page size
    $(window).on('resize.jqGrid', function () {
        $(grid_selector).jqGrid( 'setGridWidth', $(".page-content").width() );
    })
    //resize on sidebar collapse/expand
    var parent_column = $(grid_selector).closest('[class*="col-"]');
    $(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
        if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
            //setTimeout is for webkit only to give time for DOM changes and then redraw!!!
            setTimeout(function() {
                $(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
            }, 0);
        }
    })
    jQuery(grid_selector).jqGrid({
        subGrid : false, //是否使用suggrid
        subGridOptions : {
            plusicon : "ace-icon fa fa-plus center bigger-110 blue",
            minusicon  : "ace-icon fa fa-minus center bigger-110 blue",
            openicon : "ace-icon fa fa-chevron-right center orange"
        },

        data: grid_data, //判断显示数据名称
        datatype: "local", //数据来源
        height: 370,    //高度
        colNames:['反馈人', '联系方式','反馈内容'], //表头名称，列显示名称，是一个数组对象
        colModel:[
            {name:'userName',index:'userName', width:1,align:'center'},
            {name:'userEmail',index:'userEmail', width:1,align:'center'},
            {name:'feedback',index:'feedback',width:8,sortable:false}
            ], 
        //常用到的属性：name 列显示的名称；index 传到服务器端用来排序用的列名称；width 列宽度；align 对齐方式；sortable 是否可以排序

        viewrecords : true, //定义是否要显示总记录数
        rowNum:10, //在grid上显示记录条数，这个参数是要被传递到后台
        rowList:[5,10,15], //一个下拉选择框，用来改变显示记录数，当选择时会覆盖rowNum参数传递到后台
        pager : pager_selector, //定义翻页用的导航栏，必须是有效的html元素。翻页工具栏可以放置在html页面任意位置
        altRows: true, //设置表格 zebra-striped 值

        multiselect: false, //定义是否可以多选
        multiboxonly: false, //只有当multiselect = true.起作用，当multiboxonly 为ture时只有选择checkbox才会起作用

        loadComplete : function(data) {
            var table = this;
            setTimeout(function(){
                updatePagerIcons(table);
                enableTooltips(table);
            }, 0);
        },

        editurl: "./data/delMes.php",//保存位置
        autowidth: true,
    });
    $(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size

    //switch element when editing inline
    function aceSwitch( cellvalue, options, cell ) {
        setTimeout(function(){
            $(cell) .find('input[type=checkbox]')
            .addClass('ace ace-switch ace-switch-5')
            .after('<span class="lbl"></span>');
        }, 0);
    }

    //navButtons分页修改删除导航条
    jQuery(grid_selector).jqGrid('navGrid',pager_selector,
        {//navbar options底部查看栏的图标
            edit: false,
            editicon : 'ace-icon fa fa-pencil blue', //修改图标
            add: false,
            addicon : 'ace-icon fa fa-plus-circle purple',//添加图标
            del: true,
            delicon : 'ace-icon fa fa-trash-o red', //删除图标
            search: true,
            searchicon : 'ace-icon fa fa-search orange', //搜索图标
            refresh: true,
            refreshicon : 'ace-icon fa fa-refresh green', //刷新图标
            view: true,
            viewicon : 'ace-icon fa fa-search-plus grey', //查看图标
        }, 
        {//edit record form修改编辑框
            closeAfterEdit: true,
            width: 700,
            left: 350,
            top: 100,
            recreateForm: true,
            beforeShowForm : function(e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                style_edit_form(form);
            }
        },
        {//new record form新增编辑框
            width: 700,
            closeAfterAdd: true,
            recreateForm: true,
            viewPagerButtons: false,
            beforeShowForm : function(e) {
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
                .wrapInner('<div class="widget-header" />')
                style_edit_form(form);
            }
        },
        {//delete record form删除框
            width: 500,
            left: 400,
            top: 100,
            recreateForm: true,
            beforeShowForm : function(e) {
                var form = $(e[0]);
                if(form.data('styled')) return false;

                form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
                style_delete_form(form);

                form.data('styled', true);
            },
            afterSubmit: function(data, postData){//从服务器的返回值
                switch(data.responseText){
                    case '1':
                        setTimeout(function () { 
                            window.location.reload();
                        }, 1000);//编辑成功1s后刷新
                        return [false,"该用留言已经删除！",postData.id];
                    case '2':
                        return [false,"该用留言删除失败!",postData.id];
                    default:
                        return [false,"删除失败,请检查您的网络！",postData.id];
                }
            }
        },
        {//search form搜索框
            width: 700,
            left: 350,
            top: 100,
            recreateForm: true,
            multipleSearch: true,
            afterShowSearch: function(e){
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
                style_search_form(form);
            },
            afterRedraw: function(){
                style_search_filters($(this));
            }
         },
         {//view record form查看框
            width: 700,
            left: 350,
            top: 200,
            recreateForm: true,
            beforeShowForm: function(e){
                var form = $(e[0]);
                form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
            }
        }
    )

    function style_edit_form(form) {
        //enable datepicker on "sdate" field and switches for "stock" field
        form.find('input[name=sdate]').datepicker({format:'yyyy-mm-dd' , autoclose:true})
        .end().find('input[name=stock]')
        .addClass('ace ace-switch ace-switch-5').after('<span class="lbl"></span>');
        //don't wrap inside a label element, the checkbox value won't be submitted (POST'ed)
        //.addClass('ace ace-switch ace-switch-5').wrap('<label class="inline" />').after('<span class="lbl"></span>');

        //update buttons classes
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-primary').prepend('<i class="ace-icon fa fa-check"></i>');
        buttons.eq(1).prepend('<i class="ace-icon fa fa-times"></i>')

        buttons = form.next().find('.navButton a');
        buttons.find('.ui-icon').hide();
        buttons.eq(0).append('<i class="ace-icon fa fa-chevron-left"></i>');
        buttons.eq(1).append('<i class="ace-icon fa fa-chevron-right"></i>');
    }

    function style_delete_form(form) {
        var buttons = form.next().find('.EditButton .fm-button');
        buttons.addClass('btn btn-sm btn-white btn-round').find('[class*="-icon"]').hide();//ui-icon, s-icon
        buttons.eq(0).addClass('btn-danger').prepend('<i class="ace-icon fa fa-trash-o"></i>');
        buttons.eq(1).addClass('btn-default').prepend('<i class="ace-icon fa fa-times"></i>')
    }

    function style_search_filters(form) {
        form.find('.delete-rule').val('X');
        form.find('.add-rule').addClass('btn btn-xs btn-primary');
        form.find('.add-group').addClass('btn btn-xs btn-success');
        form.find('.delete-group').addClass('btn btn-xs btn-danger');
    }
    function style_search_form(form) {
        var dialog = form.closest('.ui-jqdialog');
        var buttons = dialog.find('.EditTable')
        buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
        buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
        buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
    }

    function beforeDeleteCallback(e) {
        var form = $(e[0]);
        if(form.data('styled')) return false;

        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_delete_form(form);

        form.data('styled', true);
    }

    function beforeEditCallback(e) {
        var form = $(e[0]);
        form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
        style_edit_form(form);
    }

    //it causes some flicker when reloading or navigating grid
    //it may be possible to have some custom formatter to do this as the grid is being created to prevent this
    //or go back to default browser checkbox styles for the grid

    //replace icons with FontAwesome icons like above
    function updatePagerIcons(table) {
        var replacement =
        {
            'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
            'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
            'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
            'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
        };
        $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){
            var icon = $(this);
            var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

            if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
        })
    }

    function enableTooltips(table) {
        $('.navtable .ui-pg-button').tooltip({container:'body'});
        $(table).find('.ui-pg-div').tooltip({container:'body'});
    }

    //var selr = jQuery(grid_selector).jqGrid('getGridParam','selrow');

    $(document).on('ajaxloadstart', function(e) {
        $(grid_selector).jqGrid('GridUnload');
        $('.ui-jqdialog').remove();
    });
});
},'json')

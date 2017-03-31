$(function(){
	//在添加菜品时获取分类
    var $selClass=$('#selClass');
    function showSelClass(){
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
    }
    showSelClass();

    //添加菜品
    $('#addFoot').validate({
		errorElement: 'div',
		errorClass: 'help-block',
		focusInvalid: false,
		rules: {
            footName:{
                required:true,
                rangelength:[1,30]
            },
            footNum:{
                required:true,
                digits:true
            },
            footPrice:{
                required:true,
                number:true
            }
        },
		messages: {
            footName:{
                required:"菜品名不能为空！",
                rangelength:"类名在1到30个字符之间!"
            },
            footNum:{
                required:"菜品数量不能为空！",
                digits:"菜品数量必须为大于0的整数！"
            },
            footPrice:{
                required:"菜品单价不能为空！",
                number:"菜品单价必须数字！"
            }
        },
		highlight: function (e) {
			$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
		},

		success: function (e) {
			$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
			$(e).remove();
		},

		errorPlacement: function (error, element) {
			if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
				var controls = element.closest('div[class*="col-"]');
				if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
				else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
			}
			else if(element.is('.select2')) {
				error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
			}
			else if(element.is('.chosen-select')) {
				error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
			}
			else error.insertAfter(element.parent());
		},

		submitHandler: function (form) {//通过之后回调
			$.ajaxFileUpload({
	            url:"./data/addFoot.php?"+ $('#addFoot').serialize(),
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
		},
		invalidHandler: function (form) {//不通过回调
			return false;
		}
	});	
})
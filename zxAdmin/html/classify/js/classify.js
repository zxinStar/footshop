$(function(){
	//菜品分类增加
    $('#addClassForm').validate({
		errorElement: 'div',
		errorClass: 'help-block',
		focusInvalid: false,
		rules: {
            addClass:{
                required:true,
                rangelength:[1,30]
            },
            addBlurb:{
                required:true,
                maxlength:300
            }
        },
		messages: {
            addClass:{
                required:"类名不能为空！",
                rangelength:"类名在1到30个字符之间!"
            },
            addBlurb:{
                required:"简介不能为空！",
                maxlength:"简介最多不能超过300个字符!"
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
			$.ajax({
                url: "./data/addClassify.php",
                type: "POST",
                data: $('#addClassForm').serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('main').append("<div id='loading'><img src='img/progress.gif'></div>");
                },
                success: function (data) {
                    $('main div#loading').empty();
                    switch (data.flag) {
                        case 1:
                            alert("该分类已存在,请重新输入!");
                            break;
                        case 2:
                            alert("添加分类成功!");
                            window.location.reload();//刷新当前页面.
                            break;
                        case 3:
                            alert("添加分类失败!");
                            break;
                    }
                },
                error: function () {
                    alert("请检查您的网络！");
                }
            }, 'json');
		},
		invalidHandler: function (form) {//不通过回调
			return false;
		}
	});	
})
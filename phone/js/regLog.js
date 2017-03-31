$(function(){
    //注册
    $('form#loginForm').submit(function () {
        if($('#password').val()==$('#pwAgain').val()){
            $.post('data/userUpload.php', $('form#loginForm').serialize(), function (data) {
                switch (data.flag) {
                    case 1:
                    alert("验证码不正确，请您重新输入！");
                    break;
                    case 2:
                    alert("注册成功!");
                    $.mobile.changePage('#reg');
                    break;
                    case 3:
                    alert("注册失败!");
                    break;
                    case 4:
                    alert("该用户名已经被注册，请修改！");
                    break;
                    case 5:
                    alert("该电话已经被注册，请修改!");
                    break;
                }
            }, 'json');
        }
        else {
            alert("您输入的密码两次不一致,请重新输入！");
        }
        return false;
    });
    //登录
    $('form#regForm').submit(function(){
        $.post('data/receive.php',$('form#regForm').serialize(),function(data){
            switch (data.flag){
                case 1:
                    $.mobile.changePage('myinfo.php');
                    break;
                case 2:
                    alert("用户名或密码不正确，请您重新输入！");
                    break;
                }
            },'json');
        return false;
    })
});

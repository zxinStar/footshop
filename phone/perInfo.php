<!DOCTYPE html>
<html lang="en">
    <?php include("common/head.php"); ?>
<body>
<div data-role="page" id="index">
    <?php include("common/header.php"); ?>
    <main data-role="content">
        <form id="editForm"  data-ajax="false">
            <div data-role="fieldcontain">
                <div>修改密码:</div>
                <label for="oldPassword">旧密码：</label>
                <input type="password" name="oldPassword" id="oldPassword" placeholder="请输入您的旧密码(至少6位)" pattern="\w{6,20}">
                <label for="password">新密码：</label>
                <input type="password" name="password" id="password" placeholder="请输入您的新密码" pattern="\w{6,20}">
                <label for="pwAgain">新密码：</label>
                <input type="password" name="pwAgain" id="pwAgain" placeholder="请再次输入新密码" pattern="\w{6,20}">
                <div style="margin:6px 0;padding:6px 0;border-top:1px dashed #999">修改手机号码:</div>
                <label for="tel">手机：</label>
                <input type="tel" name="tel" id="tel" placeholder="请输入手机.." pattern="" >
            </div>
            <button id="subBtn">修改</button>
            <button type="button" onclick="javascript:history.back();">取消</button>
        </form>
    </main><!--内容-->
    <?php include("common/footer.php"); ?>
</div>
<script>
    
    //获取userName
    $(document).on('pageinit',function(){
        $.get('data/isKey.php',{flag:1},function(data){
            if (data){
                $('#subBtn').click(function(){
                    var oldpw = $('#oldPassword').val();
                    var loginpw = $('#password').val();
                    var pwAgain = $('#pwAgain').val();
                    var userTel = $('#tel').val();
                    if(userTel==''&& oldpw==''){
                        alert('请输入需要修改的内容，联系方式或者密码！');
                    }else if(userTel !=''){
                        var reg = /^(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$/;
                        if(reg.test(userTel)){
                            var param = {
                                flag : 1,
                                userId : data.userId,
                                userTel : userTel
                            }
                            $.post('data/editUserInfo.php', param, function (data) {
                                switch (data.flag) {
                                    case 1:
                                        alert("手机号码已经修改成功！");
                                        window.location.href="myinfo.php";
                                        break;
                                    case 2:
                                        alert("修改失败，请检查您的网络！");
                                        break;
                                    case 3:
                                        alert("该手机号码已经注册过本系统，请重新输入！");
                                        break;
                                }
                            }, 'json');
                        }else{
                            alert('请输入正确的手机号！')
                        }
                    }else{
                        if(loginpw != pwAgain){
                            alert("两次输入的密码不一致！");
                        }else if(loginpw==''||oldpw==''){
                            alert('请输入新密码！')
                        }else{
                            var reg = /^\w{6,20}$/;
                            if(reg.test(oldpw)&&reg.test(loginpw)&&reg.test(pwAgain)){
                                var param = {
                                    flag : 2,
                                    userId : data.userId,
                                    oldpw : oldpw,
                                    loginpw : loginpw
                                }
                                console.log(param);
                                $.post('data/editUserInfo.php', param, function (data) {
                                    switch (data.flag) {
                                        case 4:
                                            alert("新密码已经生效，请重新登录！");
                                            $.get('data/isKey.php',{flag:2},function(data){
                                                if (data){
                                                    location.reload()//刷新页面
                                                }
                                            },'text')
                                            break;
                                        case 5:
                                            alert("修改失败，请检查您的网络！");
                                            break;
                                        case 6:
                                            alert("新密码与旧密码不能一致，请重新输入！");
                                            break;
                                        case 7:
                                            alert("原密码输入不正确，请重新输入！");
                                            break;
                                    }
                                }, 'json');
                            }else{
                                alert('请输入正确的密码：至少6位！')
                            }
                        }
                    }
                    return false;
                })
            }else {
                window.location.href='login.php';
                window.close();
            }
        },'json')
    });
</script>
</body>
</html>
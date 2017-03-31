<!DOCTYPE html>
<html lang="en">
    <?php include("common/head.php"); ?>
<body>
<div data-role="page" id="reg">
    <?php include("common/header.php"); ?>
    <main data-role="content">
        <form id="regForm" data-ajax="false">
            <div data-role="fieldcontain">
                <label for="logName">用户名：</label>
                <input type="text" name="logName" id="logName" placeholder="请输入用户名">
                <label for="logPw">密码：</label>
                <input type="password" name="logPw" id="logPw" placeholder="请输入密码">
            </div>
            <button>登录</button>
            <a href="#index">还未注册，立即注册</a>
        </form>
    </main><!--内容-->
    <?php include("common/footer.php"); ?>
    
    <link rel="stylesheet" href="css/login.css">
    <script src="js/regLog.js"></script>
    <script>
        $(document).on('pageinit',function(){
            $.get('data/isKey.php',{flag:3},function(data){
                if (data){
                    location.href = "myinfo.php";
                }
            },'text')
        });
    </script>
</div>

<div data-role="page" id="index">
    <?php include("common/header.php"); ?>
    <main data-role="content">
        <form id="loginForm"  data-ajax="false">
            <div data-role="fieldcontain">
                <label for="fname">用户名：</label>
                <input type="text" name="fname" id="fname" placeholder="请输入用户名2-8位(汉字，数字和字母)" required pattern="[\u4e00-\u9fa5_a-zA-Z0-9_]{2,8}">
                <label for="password">密码：</label>
                <input type="password" name="password" id="password" placeholder="请输入密码(至少6位)" required pattern="\w{6,20}">
                <label for="pwAgain">重复密码：</label>
                <input type="password" name="pwAgain" id="pwAgain" placeholder="请再次输入密码" required pattern="\w{6,20}">
                <label for="tel">手机：</label>
                <input type="tel" name="tel" id="tel" placeholder="请输入手机.." required pattern="(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$" >
                <label for="vcode">验证码：</label>
                <p style="display:flex;justify-content:space-around;margin: 0">
                    <input type="text" name="vcode" id="vcode" placeholder="请输入验证码..">
                    <img onclick="getVCode()" id="code" src="../admin/data/vCode.php" alt="vcode">
                </p>
            </div>
            <button>注册</button>
            <a href="#reg">已有账号，马上登录</a>
        </form>
    </main><!--内容-->
    <?php include("common/footer.php"); ?>
</div>
<script>
    function getVCode(){
        $('#code').attr("src","../admin/data/vCode.php");
    }
    $.get('data/isKey.php',{flag:1},function(data){
        if (data){
            location.href = "myinfo.php";
        }
    },'json')
</script>
</body>
</html>
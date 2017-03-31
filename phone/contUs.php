<!DOCTYPE html>
<html lang="en">
    <?php include("common/head.php"); ?>
<body>
<div data-role="page" id="index">
    <?php include("common/header.php"); ?>

    <main data-role="content">
        <form id="contForm" data-ajax="false" method="post">
            <div data-role="fieldcontain">
                <label for="fname">姓名：</label>
                <input type="text" name="fname" id="fname" placeholder="请输入姓名">
            </div>
            <div data-role="fieldcontain">
                <label for="email">邮箱：</label>
                <input type="email" name="email" id="email" placeholder="请输入您的邮件地址">
            </div>
            <div data-role="fieldcontain">
                <label for="info">反馈内容:</label>
                <textarea name="info" id="info" placeholder="请输入待反馈的内容，我们将努力做到更好！"></textarea>
            </div>
            <button>提交</button>
        </form>
    </main><!--内容-->

    <?php include("common/footer.php"); ?>
</div>

<script>
$(function(){
    $('form#contForm').submit(function () {
        if($('#info').val() != ''){
            $.post('data/contUs.php', $('form#contForm').serialize(), function (data) {
                switch (data.flag) {
                    case 1:
                        alert("您的反馈我们已经收到，感谢您的反馈！");
                        break;
                    case 2:
                        alert("反馈失败，请重新提交!");
                        break;
                    case 3:
                        alert("留言信息中包含敏感词，请重新输入！");
                        break;
                    case 4:
                        alert("请不要输入无意义的重复内容！");
                        break;
                    case 5:
                        alert("请不要输入全是数字的文字!");
                        break;
                    case 6:
                        alert("输入的留言文字过短！");
                        break;
                }
            }, 'json');
        }
        else {
            alert("请输入反馈的内容后再提交！");
        }
        return false;
    });
});
</script>
</body>
</html>

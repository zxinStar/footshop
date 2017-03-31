
$(function(){
    //背景改变
    var $imgs=$('figure img'),index=1;
    var timer=setInterval(function(){
        $imgs.fadeOut("500").eq(index).stop(true,true).fadeIn("2000");
        if(index<$imgs.length-1) index++;
        else index=0;
    },6000);

    //表单验证
    var regs=[/^\w{6,20}$/,/^\w{6,30}$/];
    var $form=$('main form');
    $form.find('input').each(function(index){
        if(index>1)  return false;
        $(this).blur(function(){
            var val=$(this).val();
            if(!regs[index].test(val)){
                $(this).next().css("display","inline-block");
            }else{
                $(this).next().css("display","none");
            }
        })
    });

    //点击更换验证码
    $form.find('small').click(function(){
       $('#vCode').attr("src","./data/vCode.php");
    });

    //提交数据
    $form.submit(function(e){
        $.ajax({
            url:"./data/admLogin.php",
            type:"POST",
            data:$form.serialize(),
            dataType:'json',
            beforeSend:function(){
                $('main').append("<div><img src='../../img/progress.gif'></div>")
            },
            success:function(data){
                $('main div').empty();
                console.log(data);
                switch (data.flag){
                    case 1:
                        alert("验证码不正确，请您重新输入！");
                        break;
                    case 2:
                        alert("用户名或密码不正确，请您重新输入！");
                        break;
                    case 3:
                        window.location="admIndex.php";
                        break;
                }
            },
            error:function(){
                alert("请检查您的网络！");
            }
        },'json');
        e.preventDefault();
    });
});

<?php
session_start();//开启会话
$img=imagecreatetruecolor(70, 26);//创建真彩色图像资源，大小为70*26
$white=imagecolorallocate($img, 0xFF, 0xFF, 0xFF);//分配一个白色
imagefill($img, 0, 0, $white);//从左上角开始填充白色

//生成随机验证码
$fontContet='';
$string="abcdefghijkmnpqrstuvwxy3456789";
for($i=0;$i<4;$i++){
    //  $code.=rand(0,9);从0到9中产生随机数
    $code=$string[rand(0,strlen($string)-1)];
    $fontContet.=$code;
    $x=($i*100/6)+rand(5,10);//验证码在水平位置随机产生
    $y=rand(5,10);
    $fontColor=imagecolorallocate($img, rand(0,120), rand(0,120), rand(0,120));//给文字添加随机颜色
    imagestring($img, 12, $x, $y, $code, $fontColor);
}
$_SESSION['vCode']=$fontContet;//把验证码放入会话变量中

//加入噪点干扰
for($i=0;$i<100;$i++){
    $pixelColor=imagecolorallocate($img, rand(50,200), rand(50,200), rand(50,200));
    imagesetpixel($img, rand(1,70), rand(1,29),$pixelColor);
}
//画出多条线
for($i=0;$i<3;$i++)
{
    $lineColor=imagecolorallocate($img,rand(80,220),rand(80,220),rand(80,220));//产生随机的颜色
    imageline($img,rand(1,70),rand(1,29),rand(1,70),rand(1,29),$lineColor);
}

//输出验证码
header("content-type:image/png");
imagepng($img);//用函数建立一张png图
imagedestroy($img);//销毁图像，释放与$img关联内存

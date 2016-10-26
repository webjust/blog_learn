<?php
Header("Content-type: image/PNG");


function yzm($width, $height)
{
	/*
	生成验证的步骤：
	1、创建一个画布      imagecreate — 新建一个基于调色板的图像
	2、获取颜色	       imagecolorallocate — 为一幅图像分配颜色
	3、填充背景色          imagefill — 区域填充
	4、写文字      	       imagestring — 水平地画一行字符串
	5、添加杂色的点      imagesetpixel — 画一个单一像素
	（添加干扰线条        imagesetstyle — 设定画线的风格）



	生成图片	  imagejpeg — 输出图象到浏览器或文件。
	 */

	// $width = 100;
	// $height = 50;

	// 1、创建一个画布
	$im = imagecreate($width, $height);

	// 2、获取颜色
	$bgColor = imagecolorallocate($im, mt_rand(180, 255), mt_rand(180, 255), mt_rand(180, 255));

	// 3、填充背景颜色
	imagefill($im, 0, 0, $bgColor);

	// 4、随机生成验证码
	$step = 10;
	$vcode = "";
	$num = 4;

	$x= ($width-$step*$num)/2 ;
	$y=($height-16)/2;

	for($i=0; $i<$num; $i++)
	{
		$fontColor = imagecolorallocate($im, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
		$codestr = mt_rand(0, 9);
		$vcode .= $codestr;
		// 把文字写在画布上
		imagestring($im, 5, $x, $y, $codestr, $fontColor);
		$x += $step;
	}

	// 5、添加杂色
	$pixelNums = 180;
	for($i=0; $i<$pixelNums; $i++)
	{
		$x = mt_rand(0, $width);
		$y = mt_rand(0, $height);
		$pixelColor = imagecolorallocate($im, mt_rand(0, 180), mt_rand(0, 180), mt_rand(0, 180));
		imagesetpixel($im, $x, $y, $pixelColor);
	}

	// 输出图像
	imagejpeg($im);

	// 释放资源
	imagedestroy($im);

	// 把验证码写入Cookie
	setcookie('yzm', $vcode, time()+3600*7);
}

yzm(100, 40);

// 输出验证码
// echo $vcode;
?>
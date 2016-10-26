<?php 
require_once("../comm/config.php");
require_once("../comm/connect.php");

// 声明一个函数用于清除Cookie
function clearCookie()
{
	// 清除Cookie信息
	setcookie('islogin', '', time()-1);
	setcookie('username', '', time()-1);
	setcookie('autologin', '', time()-1);
}

// print_r($_COOKIE);

// var_dump($_POST);

$action = isset($_GET['action'])?$_GET['action']:NULL;
$islogin = isset($_COOKIE['islogin'])?$_COOKIE['islogin']:0;

// var_dump($islogin);

if ($islogin && $action != 'logout') {
	echo "您已经登录！3秒后跳转至后台首页";
	echo "<meta http-equiv='refresh' content='3; url=index.php' />";
	die;
}

if( isset($_POST['sub']))
{
	// 执行登录的验证
	$username = isset($_POST['username'])?trim($_POST['username']):NULL;
	$password = isset($_POST['password'])?trim($_POST['password']):NULL;
	$yzm = isset($_POST['yzm'])?trim($_POST['yzm']):NULL;

	// 判断验证码是否正确
	if (strlen($yzm) == 0 ) {
		echo "请先填写验证码, 3秒后跳转到首页";
		echo "<meta http-equiv='refresh' content='3; url=login.php' />"; die;
	} else{
		if($yzm != $_COOKIE['yzm']){
			echo "<script>alert('请填写正确的验证码'); window.location.href='./login.php'</script>"; die;
		}
	}

	if (strlen($username) == 0) {
		echo "用户名不能为空，3秒后跳转到首页";
		echo "<meta http-equiv='refresh' content='3; url=login.php' />"; die;
	}

	if (strlen($password) == 0) {
		echo "密码不能为空，3秒后跳转到首页";
		echo "<meta http-equiv='refresh' content='3; url=login.php' />"; die;
	}

	// 从数据库中获取用户
	/*
		1、判断用户名是否存在（不存在则提示用户名错误）
		2、判断用户的密码是否正确
	*/

	$sql = "SELECT * FROM user WHERE username = '{$username}'";

	$result = mysqli_query($link, $sql);
	
	if (mysqli_num_rows($result)) {
		// 判断密码是否匹配
		$password_user = mysqli_fetch_assoc($result)['password'];
		if($password_user == md5($password))
		{
			// 设置Cookie值，存储用户登录的信息
			setcookie('islogin', 1, time()+3600*24);
			setcookie('username', $username, time()+3600*24);
			setcookie('password', $password, time()+3600*24);

			// 获取是否自动登录
			$checklogin = isset($_POST['checklogin'])?$_POST['checklogin']:NULL;

			if($checklogin)
			{
				setcookie('autologin', 1, time()+3600*24*7);
			} else{
				setcookie('autologin');
			}

			echo "登录成功, 3秒后跳转到首页";
			echo "<meta http-equiv='refresh' content='3; url=index.php' />";
			die;
		} else{
			echo "登录失败，密码填写错误，3秒后跳转到登录页";
			echo "<meta http-equiv='refresh' content='3; url=login.php' />";
			die;
		}
	} else{
		echo "<script>alert('用户名不存在'); window.location.href='./login.php'</script>"; die;
	}
} elseif($action == 'logout'){
	clearCookie();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>登录面板</title>
		<meta charset="utf-8">
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	 <div class="main">
		<div class="login-form">
			<h1>登录面板</h1>
				<form method="POST" action="login.php">
						<input type="text" name="username" value="" placeholder="输入用户名" />
						<input type="password" name="password" value="" placeholder="输入密码" />
						<input type="text" name="yzm" value="" placeholder="输入验证码" size="4"> <img src='./yzm.php' onclick="this.src='./yzm.php?code='+Math.random()" />
						<div class="submit">
							<input type="submit" name="sub" value="登录后台" />
						</div>
					<p><a href="#">忘记密码 ?</a></p>
				</form>
			</div>
   					<div class="copy-right">
						<p>Copyright &copy; 2014.Company name All rights reserved.</p> 
					</div>
		</div>
</body>
</html>
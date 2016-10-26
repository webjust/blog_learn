<?php
// 引入数据库的连接信息
require_once("../comm/config.php");
// 数据库连接
require_once("../comm/connect.php");

// var_dump($_POST);

if(isset($_POST['sub']))
{
	// 获取要修改的用户的ID
	$id = isset($_POST['id'])?$_POST['id']:NULL;
	$username = isset($_POST['username'])?$_POST['username']:NULL;
	$password = isset($_POST['password'])?$_POST['password']:NULL;

	// 屏蔽非法值
	if (strlen(trim($password)) == 0) {
			echo "<script>alert('密码不能为空'); window.location.href='./user.list.php'</script>";
			die;
	}

	// 准备数据
	$password = md5($password);

	if($id && $password)
	{
		// 更新操作
		$sql = "UPDATE user set username = '{$username}', password = '$password' WHERE u_id = '{$id}'";

		// 执行操作
		$res = mysqli_query($link, $sql);

		if($res && mysqli_affected_rows($link) == 1)
		{
			echo "<script>alert('更新成功'); window.location.href='./user.list.php'</script>"; die;
		} else{
			echo "<script>alert('更新失败'); window.location.href='./user.list.php'</script>"; die;
		}
	}
}
?>
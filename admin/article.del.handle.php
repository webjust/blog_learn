<?php
// 引入数据库的连接信息
require_once("../comm/config.php");
// 数据库连接
require_once("../comm/connect.php");

// 获取要删除的记录的ID
$id = isset($_GET['id'])?$_GET['id']:NULL;

// 没有传递ID值，就跳转回来
if(!$id){
	echo "<script>alert('非法删除');window.location.href='./article.manage.php'</script>";
} else{
	// 非法值判断
	if(!is_numeric($id))
	{
		echo "<script>alert('非法ID值');window.location.href='./article.manage.php'</script>";
	}

	// 第三步：执行删除操作，准备SQL语句
	$sql = "DELETE FROM `article` WHERE id = $id";

	// echo $sql; die;

	// 第四步：执行SQL语句的查询，返回查询结果集
	$result = mysqli_query($link, $sql);

	// 第五步：判断影响行
	if(mysqli_affected_rows($link))
	{
		echo "<script>alert('删除成功');window.location.href='./article.manage.php'</script>";
	} else{
		echo "<script>alert('删除失败');window.location.href='./article.manage.php'</script>";
	}
}



?>
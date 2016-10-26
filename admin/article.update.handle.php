<?php 
// 引入数据库的连接信息
require_once("../comm/config.php");
// 数据库连接
require_once("../comm/connect.php");

$sub = isset($_POST['sub'])?$_POST['sub']:FALSE;

if (!$sub) {
	echo "<script>alert('非法操作');window.location.href='./article.add.php'</script>";
} else{

	// 非法值的判断
	if(empty(trim($_POST['title']))){
		echo "<script>alert('没有填写标题');window.location.href='./article.add.php'</script>";
	}
	if(empty(trim($_POST['author']))){
		echo "<script>alert('没有填写作者');window.location.href='./article.add.php'</script>";
	}
	if(empty(trim($_POST['description']))){
		echo "<script>alert('没有填写简介');window.location.href='./article.add.php'</script>";
	}
	if(empty(trim($_POST['content']))){
		echo "<script>alert('没有填写内容');window.location.href='./article.add.php'</script>";
	}

	// 获取要插入数据库的数据
	$title = $_POST['title'];
	$author = $_POST['author'];
	$description = $_POST['description'];
	$content = $_POST['content'];
	$id = $_POST['id'];

	// 第三步：准备SQL语句
	$sql = "UPDATE `article` SET title = '{$title}', author = '{$author}', description = '{$description}', content = '{$content}' WHERE id = $id";

	// $sql = "INSERT INTO `article` (title, author, description, content, add_date) VALUES('$title', '$author', '$description', '$content', '$add_date')";

	// echo $sql;die;

	// 第四步：执行SQL语句的查询，返回查询结果集
	$result = mysqli_query($link, $sql);

	// 第五步：获取影响的行数
	if(mysqli_affected_rows($link) && $result)
	{
		echo "<script>alert('修改成功');window.location.href='./article.manage.php'</script>";
	} else{
		echo "<script>alert('您没有修改内容啊！或有可能修改失败');window.location.href='./article.manage.php'</script>";
	}

	// 第六步：关闭连接
	mysqli_close($link);
}

?>
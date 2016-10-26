<?php 
// 获取用户的u_id
$u_id = isset($_GET['id'])?$_GET['id']:NULL;

if ($u_id == 1) {
	echo "<script>alert('超级管理员不能删除');window.location.href='./user.list.php'</script>";
}
?>
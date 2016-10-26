<?php

function creatPageNav($page_nums)
{
	// 当前页
	$page = isset($_GET['p'])?$_GET['p']:1;

	// 非法值屏蔽
	if(!is_numeric($page))
	{
		$page = 1;
	}

	// 判断当前页的非法值
	if($page<1){
		$page=1;
	} elseif($page>$page_nums){
		$page=$page_nums;
	}

	$str = "<a href='".$_SERVER['PHP_SELF']."?p=1'>首页</a>";
	$str .= "<a href='".$_SERVER['PHP_SELF']."?p=".($page-1)."'>上一页</a>";
	for($i=1; $i<=$page_nums; $i++)
	{
		$biaozhi = ($page == $i)?"class='active'":NULL;
		$str .= "<a ".$biaozhi."href='".$_SERVER['PHP_SELF']."?p=".$i."'>".$i."</a>";	
	}
	$str .= "<a href='".$_SERVER['PHP_SELF']."?p=".($page+1)."'>下一页</a>";
	$str .= "<a href='".$_SERVER['PHP_SELF']."?p=".$page_nums."'>末页</a>";

	return $str;
}

// echo creatPageNav(5);
<?php

/**
 * 生成分页的按钮
 * @param  [int] $page_nums [总页数]
 * @return [string]         [输出翻页代码]
 */
function createPageNav($page_nums)
{
	// 获取当前页
	$p = isset($_GET['p'])?$_GET['p']:1;

	if (!is_numeric($p)) {
		$p = 1;
	}

	if($p < 1){
		$p = 1;
	} elseif($p > $page_nums){
		$p = $page_nums;
	}


	$str = "<a href='".$_SERVER['PHP_SELF']."?p=1'>首页</a>";
	$str .= "<a href='".$_SERVER['PHP_SELF']."?p=".($p-1)."'>上一页</a>";
	for ($i=1; $i < $page_nums; $i++) { 
		// 当前页的标志
		$biaozhi = ($p==$i)?"class='active'":NULL;

		$str .= "<a ".$biaozhi."href='".$_SERVER['PHP_SELF']."?p=".$p."'>".$i."</a>";
	}
	$str .= "<a href='".$_SERVER['PHP_SELF']."?p=".($p+1)."'>下一页</a>";
	$str .= "<a href='".$_SERVER['PHP_SELF']."?p=".$page_nums."'>末页</a>";

	echo $str;
}

// createPageNav(2, 8);

// var_dump($_SERVER);
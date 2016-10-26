<?php require_once("./comm/header.php") ?>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
	<!-- 当前没有文章，请管理员在后台添加文章 -->
		<div class="post">
			<h1 class="title">关于我们</h1>
			<div class="entry">
				<p>PHP 是一种创建动态交互性站点的强有力的服务器端脚本语言。PHP 是免费的，并且使用广泛。对于像微软 ASP 这样的竞争者来说，PHP 无疑是另一种高效率的选项。</p>
			</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li id="search">
				<h2><b class="text1">Search</b></h2>
				<form method="get" action="article.search.php">
					<fieldset>
					<input type="text" id="s" name="key" value="" />
					<input type="submit" id="x" value="Search" />
					</fieldset>
				</form>
			</li>
		</ul>
	</div>
	<!-- end sidebar -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
<?php require_once("./comm/footer.php") ?>
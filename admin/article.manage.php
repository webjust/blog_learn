<?php
// 引入数据库的连接信息
require_once("../comm/config.php");
// 数据库连接
require_once("../comm/connect.php");
// 引入函数库
require_once("../comm/funcs.php");

/*
翻页的完成的内容：
1、使用面向过程写一遍
2、封装成一个函数（需要翻页的地方，就直接调用我们封装好的翻页的函数）

一页显示2条，一共有5条数据，应该有3页
实现效果：
首页   上一页  1 2 3  下一页  最后一页

翻页实现的步骤（原理）：
1、SQL实现每页显示2条数据
SELECT * FROM `article` LIMIT 偏移量, 查询条数
    select * from article LIMIT 0, 2
    select * from article LIMIT 2, 2
    select * from article LIMIT 4, 2

声明变量：每页显示数量
$pageNum = 2

当前页：$_GET['p']

2、计算偏移量

当前页    偏移量       每页显示的数量        计算偏移量
1            0              2                   (1-1)*2  
2            2              2                   (2-1)*2
3            4              2                   (3-1)*2

得出：偏移量 = (当前页-1)*每页显示的数量

3、总页数 = 总条数/每页的数量

总条数 SQL语句：

*/
// 每页显示的数量
$pageNum = 2;

// 查询总条数
$sql = "SELECT COUNT(*) FROM `article`";
$ret_rows = mysqli_query($link, $sql);
$page_count = mysqli_fetch_row($ret_rows)[0];

// 计算总页数
$page_nums = ceil($page_count/$pageNum);

// 获取当前页码
$page = isset($_GET['p'])?$_GET['p']:1;

// 判断当前页
if($page < 1)
{
    $page = 1;
}
elseif($page > $page_nums)
{
    $page = $page_nums;
}

// 计算偏移量
$offset = ($page-1)*$pageNum;

// 第三步：准备SQL语句
$sql = "SELECT * FROM `article` LIMIT $offset, $pageNum";

// 第四步：执行SQL语句的查询，返回查询结果集
$result = mysqli_query($link, $sql);

// var_dump($result);die;

// 第五步：处理结果集
$arr = array();
if($result && mysqli_num_rows($result))
{
    while($ret = mysqli_fetch_assoc($result))
    {
        $arr[] = $ret;
    }
}

/*echo "<pre>";
print_r($arr);
echo "</pre>";
*/
// 第六步：释放结果集
mysqli_free_result($result);

// 第七步：关闭连接
mysqli_close($link);


// 引入后台的头部文件
require_once("./comm/a_header.php");
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    文章管理
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->

        <div class="row">
            <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>标题</th>
                        <th>作者</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arr as $val): ?>
                    <tr>
                        <td><?php echo $val['id'] ?></td>
                        <td><?php echo $val['title'] ?></td>
                        <td><?php echo $val['author'] ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $val['add_date']) ?></td>
                        <td>
                            <a href="article.del.handle.php?id=<?php echo $val['id'] ?>" class="btn btn-danger btn-sm">删除</a>
                            <a href="article.update.php?id=<?php echo $val['id'] ?>" class="btn btn-info btn-sm">修改</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="page" style="text-align: center;">
                <?php echo creatPageNav($page_nums) ?>
            </div>
            
            </div>
        </div>
        
<?php require_once("./comm/a_footer.php") ?>
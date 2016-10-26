<?php
// 引入数据库的连接信息
require_once("../comm/config.php");
// 数据库连接
require_once("../comm/connect.php");
// 引入函数库
require_once("../comm/funcs.php");

// 每页显示的数量
$pageNum = 5;

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
$sql = "SELECT * FROM `user` LIMIT $offset, $pageNum";

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
                    用户列表
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
                        <th>用户名</th>
                        <th>等级</th>
                        <th>时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arr as $val): ?>
                    <tr>
                        <td><?php echo $val['u_id'] ?></td>
                        <td><?php echo $val['username'] ?></td>
                        <td><?php echo $val['level'] ?></td>
                        <td><?php echo date('Y-m-d H:i:s', $val['add_date']) ?></td>
                        <td>
                            <a href="user.del.handle.php?id=<?php echo $val['u_id'] ?>" class="btn btn-danger btn-sm">删除</a>
                            <a href="user.update.php?id=<?php echo $val['u_id'] ?>" class="btn btn-info btn-sm">修改密码</a>
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
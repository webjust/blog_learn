<?php
// 引入数据库的连接信息
require_once("../comm/config.php");
// 数据库连接
require_once("../comm/connect.php");

// 第三步：执行删除操作，准备SQL语句
// $sql = "UPDATE `article` SET title = $title";

// echo $sql; die;

$id = isset($_GET['id'])?$_GET['id']:NULL;
// echo $id;die;

// 第三步：查询指定的ID的数据
$sql = "SELECT * FROM `article` WHERE id = $id";
// echo $sql;die;

// 第四步：执行SQL语句的查询，返回查询结果集
$result = mysqli_query($link, $sql);

// 第五步：处理结果集
$ret = mysqli_fetch_array($result);

// echo "<pre>";
// print_r($ret);
// echo "</pre>";

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
                    修改文章
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->

        <div class="row">
            <div class="col-md-12">
            <!-- 文章提交的表单 -->
            <form role="form" action="article.update.handle.php" method="post">
                <table class="table">
                    <tr>
                        <td>标题：</td>
                        <td><input type="text" name="title" style="width: 500px;" value="<?php echo $ret['title'] ?>" /></td>
                    </tr>
                    <tr>
                        <td>作者：</td>
                        <td><input type="text" name="author" value="<?php echo $ret['author'] ?>" /></td>
                    </tr>
                    <tr>
                        <td>简介：</td>
                        <td><textarea name="description" cols="120" rows="3"><?php echo $ret['description'] ?></textarea></td>
                    </tr>
                    <tr>
                        <td>内容：</td>
                        <td><textarea name="content" cols="120" rows="10"><?php echo $ret['content'] ?></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="sub" value="提交" class="btn btn-primary" /></td>
                    </tr>
                </table>
                <!-- 设置一个隐藏域，传递ID -->
                <input type="hidden" name="id" value="<?php echo $ret['id'] ?>">
            </form>
            </div>
        </div>
        
<?php require_once("./comm/a_footer.php") ?>
<?php
// 引入后台的头部文件
require_once("./comm/a_header.php");
?>
<div id="page-wrapper">
    <div id="page-inner">


        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    发布文章
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->

        <div class="row">
            <div class="col-md-12">
            <!-- 文章提交的表单 -->
            <form role="form" action="article.add.handle.php" method="post">
                <table class="table">
                    <tr>
                        <td>标题：</td>
                        <td><input type="text" name="title" style="width: 500px;" /></td>
                    </tr>
                    <tr>
                        <td>作者：</td>
                        <td><input type="text" name="author" /></td>
                    </tr>
                    <tr>
                        <td>简介：</td>
                        <td><textarea name="description" cols="120" rows="3"></textarea></td>
                    </tr>
                    <tr>
                        <td>内容：</td>
                        <td><textarea name="content" cols="120" rows="10"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="sub" value="提交" class="btn btn-primary" /></td>
                    </tr>
                </table>
            </form>
            </div>
        </div>
        
<?php require_once("./comm/a_footer.php") ?>
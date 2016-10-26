<?php
// 设置字符集
header("Content-type:text/html; charset=utf-8");

// 第一步：连接数据库
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("连接数据库失败：".mysqli_connect_error());

// 第二步：字符集设置
mysqli_set_charset($link, "utf8");
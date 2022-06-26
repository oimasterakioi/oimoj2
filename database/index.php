<?php
$servername="localhost";
$username="root";
$password="root";
$dbname="app_uoj233";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("数据库出现错误，请联系 oimaster！" . $conn->connect_error);
}

require('user.php');
require('problem.php');
require('contest.php');
require('blog.php');
require('submission.php');
require('other.php');

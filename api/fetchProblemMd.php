<?php
require('../html/index.php');
require('../database/index.php');
if(isset($_GET['id']) == false){
    die('{"success": "没有指定题目"}');
}
$id = intval($_GET['id']);
if(hasPermission($_SESSION['username'], $id) == false){
    die('{"success": "没有权限"}');
}

$ret = array("statement" => getStatement($id));
echo json_encode($ret);
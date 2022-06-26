<?php
require('../html/index.php');
require('../database/index.php');
if(isset($_POST['id']) == false){
    die('{"success": "没有指定题目"}');
}
if(isset($_POST['statement']) == false){
    die('{"success": "没有题面"}');
}
$id = intval($_POST['id']);
if(hasPermission($_SESSION['username'], $id) == false){
    die('{"success": "没有权限"}');
}

$modify = writeStatement($id, $_POST['statement']);
if($modify)
    echo '{"success": "ok"}';
else
    echo '{"success": "failed"}';
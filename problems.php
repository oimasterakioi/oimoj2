<?php
require('html/index.php');
require('database/index.php');
$page = $_GET['page'];
$page = intval($page);
if(isset($page) == false || $page == 0){
    $page = 1;
}

$problemInOnePage = 50;
$from = ($page - 1) * $problemInOnePage;
$to = $page * $problemInOnePage;

echoHeader('题库');
echoNav();
echoTwoCol();
$rows = getProblemList($from, $to);
$parsedList = array();
foreach($rows as $row){
    if(isProblemVisibleToUser($row['id'], $_SESSION['username']) == false)
        continue;
    $parsedRow = array();
    foreach($row as $column => $value){
        if($column == 'title'){
            // add link
            $parsedRow[$column] = '<a href="showProblem.php?id='.$row['id'].'">'.changeToVue($value).'</a>';
        }
        else{
            $parsedRow[$column] = changeToVue($value);
        }
    }
    $parsedList[] = $parsedRow;
}
echoTable(array("id" => "编号", "title" => "标题", "zan" => "评分", "ac_num" => "AC", "submit_num" => "提交", "hard" => "难度"), $parsedList, "title",  "main");
echoBoard('右侧公告板', "# markdown\n欢迎使用**Markdown**和\$\KaTeX\$！", "right");
echoFooter();
<?php
require('html/index.php');
require('database/index.php');
echoHeader('新建题目');
echoNav();
if(isset($_SESSION['username']) == false || isAdmin($_SESSION['username']) == false){
    echoMessage('error', 'times circle outline', '错误', '您没有权限。');
}
else if(getMethod() == "GET"){
    echoNav();
    echoCenterForm('新建题目', '新建', 'newProblem.php');
    echoFormInput('title', 'text', '题目名称');
}
else{
    $title = $_POST['title'];
    $user = $_SESSION['username'];

    $id = createProblem($title, $user);
    if($id == false){
        echoMessage('error', 'times circle outline', '错误', '题目创建失败。');
    }
    else{
        echoMessage('success', 'check circle outline', '成功', '题目创建成功。3 秒后将会重定向到题目页面。');
        echoRedirect('showProblem.php?id='.$id, 3);
    }
}
echoFooter();
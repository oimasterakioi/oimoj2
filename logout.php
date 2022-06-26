<?php
require('html/index.php');
require('database/index.php');
echoHeader('登出');
if(isset($_SESSION['username']) == false){
    echoNav();
    echoMessage('error', 'times circle outline', '登出失败', '您还没有登录。');
    echoRedirect('/login.php', 3);
}
else if(getMethod() == "GET"){
    echoNav();
    echoCenterForm('登出', '确认登出', 'logout.php');
}
else{
    $username = $_SESSION['username'];
    unset($_SESSION['username']);
    echoNav();
    echoMessage('success', 'check circle outline', '登出成功', '再见，'.$username.'，期待下次再见！');
    echoRedirect('/', 3);
    session_destroy();
}
echoFooter();
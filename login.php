<?php
require('html/index.php');
require('database/index.php');
echoHeader('登录');
if(isset($_SESSION['username'])){
    echoNav();
    echoMessage('error', 'times circle outline', '怎么回事？', '您已经登录。');
    echoRedirect('/', 3);
}
else if(getMethod() == "GET"){
    echoNav();
    echoCenterForm('登录', '登录', 'login.php');
    echoFormInput('username', 'text', '用户名');
    echoFormInput('password', 'password', '密码');
    $_SESSION['loginver'] = true;
}
else{
    if(isset($_SESSION['loginver']) == false){
        echoNav();
        echoMessage('error', 'times circle outline', '登录失败', '用户名或密码错误。');
        echoRedirect('/login.php', 3);
    }
    else{
        unset($_SESSION['loginver']);
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(login($username, $password)){
            if(isBanned($username)){
                echoNav();
                echoMessage('error', 'times circle outline', '登录失败', '用户被封禁。');
            }
            else{
                $_SESSION['username'] = $username;
                echoNav();
                echoMessage('success', 'check circle outline', '登录成功', '欢迎回来，'.$username.'。');
                echoRedirect('/', 3);
            }
        }
        else{
            echoNav();
            echoMessage('error', 'times circle outline', '登录失败', '用户名或密码错误。');
            echoRedirect('/login.php', 3);
        }
    }
}
echoFooter();
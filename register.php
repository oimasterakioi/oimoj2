<?php
require('html/index.php');
require('database/index.php');
echoHeader('注册');
if(isset($_SESSION['username'])){
    echoNav();
    echoMessage('error', 'times circle outline', '怎么回事？', '您已经登录。');
    echoRedirect('/', 3);
}
else if(getMethod() == "GET"){
    echoNav();
    echoCenterForm('注册', '注册', 'register.php');
    echoFormInput('username', 'text', '用户名');
    echoFormInput('email', 'email', '邮箱');
    echoFormInput('password', 'password', '密码');
    echoFormInput('password2', 'password', '密码确认');
    $_SESSION['registerver'] = true;
}
else{
    if(isset($_SESSION['registerver']) == false){
        echoNav();
        echoMessage('error', 'times circle outline', '注册失败', '网络出现了一些问题，请再注册一次。');
        echoRedirect('/register.php', 3);
    }
    else if(isset($_SESSION['code']) && isset($_POST['code'])){
        if($_SESSION['code'] != $_POST['code']){
            echoNav();
            echoMessage('error', 'times circle outline', '注册失败', '验证码错误。');
            echoRedirect('/register.php', 3);
        }
        else{
            unset($_SESSION['registerver']);
            unset($_SESSION['code']);

            $username = $_SESSION['regusername'];
            $email = $_SESSION['regemail'];
            $password = $_SESSION['regpassword'];
            $remote_addr = $_SERVER['REMOTE_ADDR'];
            $http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];

            register($username, $email, $password, $remote_addr, $http_x_forwarded_for);
            
            if(isExist($username)){
                $_SESSION['username'] = $username;
                echoNav();
                echoMessage('success', 'check circle outline', '注册成功', '欢迎来到˚∆˚OJ，'.$username.'。');
                echoRedirect('/', 3);
            }
            else{
                echoNav();
                echoMessage('error', 'times circle outline', '注册失败', '出现了一些错误，请再试一次。如果无法解决，请联系oimaster。');
                echoRedirect('/register.php', 3);
            }
        }
    }
    else{
        unset($_SESSION['registerver']);
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        if($password != $password2){
            echoNav();
            echoMessage('error', 'times circle outline', '注册失败', '两次输入密码不一致。');
            echoRedirect('/register.php', 3);
        }
        // username contains 26 letters, numbers, underline
        else if(preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username) == false){
            echoNav();
            echoMessage('error', 'times circle outline', '注册失败', '用户名只能包含字母、数字、下划线，且长度在3-20之间。');
            echoRedirect('/register.php', 3);
        }
        // password contains 6-20 letters, numbers
        else if(preg_match('/^[a-zA-Z0-9]{6,20}$/', $password) == false){
            echoNav();
            echoMessage('error', 'times circle outline', '注册失败', '密码只能包含6-20个字母、数字，且长度在6-20之间。');
            echoRedirect('/register.php', 3);
        }
        // email is valid
        else if(preg_match('/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-]+(\.[a-zA-Z0-9_\-]+)*\.[a-zA-Z0-9]{2,6}$/', $email) == false){
            echoNav();
            echoMessage('error', 'times circle outline', '注册失败', '邮箱格式不正确。');
            echoRedirect('/register.php', 3);
        }
        // username exists
        else if(isExist($username)){
            echoNav();
            echoMessage('error', 'times circle outline', '注册失败', '用户名已存在。');
            echoRedirect('/register.php', 3);
        }
        // email exists
        else if(isExistEmail($email)){
            echoNav();
            echoMessage('error', 'times circle outline', '注册失败', '邮箱已存在。');
            echoRedirect('/register.php', 3);
        }
        else{
            $code = rand(100000, 999999);
            sendMail($email, '验证码 - ˚∆˚OJ', '您的验证码是' . $code .'。祝您刷题愉快！');

            $_SESSION['regusername'] = $username;
            $_SESSION['regemail'] = $email;
            $_SESSION['regpassword'] = $password;
            $_SESSION['code'] = $code;
            
            echoNav();
            echoMessage('success', 'check circle outline', '邮件发送成功', '注册验证码已经发送到了您的垃圾箱。');
            echoCenterForm('注册', '注册', 'register.php');
            echoFormInput('code', 'text', '验证码');
            $_SESSION['registerver'] = true;
        }
    }
}
echoFooter();
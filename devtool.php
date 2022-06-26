<?php
require('html/index.php');
require('database/index.php');
echoHeader('警告');
if($_SESSION['devtool'] == false){
    echoNav();
    echoMessage('info', 'question circle outline', '怎么回事？', '你为什么会在这里出现？');
}
else if(getMethod() == "POST"){
    if($_POST['sorry'] != '我以后不会在这里使用开发者工具了。'){
        if(strpos($_POST['sorry'], '*') !== false || strpos($_POST['sorry'], 'x') !== false || strpos($_POST['sorry'], 'fuck') !== false || strpos($_POST['sorry'], '傻') !== false || strpos($_POST['sorry'], '逼') !== false || strpos($_POST['sorry'], '日') !== false || strpos($_POST['sorry'], '囸') !== false || strpos($_POST['sorry'], '草') !== false || strpos($_POST['sorry'], '艹') !== false || strpos($_POST['sorry'], '肏') !== false || strpos($_POST['sorry'], '妈') !== false || strpos($_POST['sorry'], 'md') !== false){
            if(isset($_SESSION['username'])){
                // ban the user
                setBan($_SESSION['username']);
                $username = $_SESSION['username'];
                unset($_SESSION['username']);
                echoNav();
                echoMessage('error', 'times circle outline', '严重警告', '你的输入中包含不良词汇。');
                echoMessage('info', 'frown outline', '坏消息', '账号 '.$username.' 已被封禁。');
            }
            else{
                echoNav();
                echoMessage('error', 'times circle outline', '严重警告', '你的输入中包含不良词汇。');
            }
            echoCenterForm('反思', '提交', 'devtool.php');
            echoFormInput('sorry', 'text', '我以后不会在这里使用开发者工具了。');
        }
        else{
            echoNav();
            echoMessage('error', 'times circle outline', '输入错误', '请重新输入');
            echoCenterForm('反思', '提交', 'devtool.php');
            echoFormInput('sorry', 'text', '我以后不会在这里使用开发者工具了。');
        }
    }
    else{
        echoNav();
        unset($_SESSION['devtool']);
        echoMessage('success', 'check circle outline', '很好', '知错就改，值得学习！您现在可以自由地访问了。3 秒后，您将会被重定向到主页。');
        echoRedirect('/', 3);
    }
}
else{
    echoNav();
    echoMessage('warning', 'info circle', '啊，那里，不可以的', '请不要尝试使用开发者工具破坏网站。如果您发现了漏洞，请联系 oimaster。您将会被锁定在这个页面。要想解除，请输入以下文字。');
    echoCenterForm('反思', '提交', 'devtool.php');
    echoFormInput('sorry', 'text', '我以后不会在这里使用开发者工具了。');
}
fillPaste();
echoFooter();
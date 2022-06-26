<?php
session_start();

ini_set('display_errors', 0);
ini_set('error_reporting', E_ALL);

if(isset($_SESSION['devtool']) && $_SERVER['PHP_SELF']!='/devtool.php'){
    header('location: /devtool.php');
    die();
}
// $currentUser = 'oimaster';
$data = array();
function getMethod(){
    return $_SERVER['REQUEST_METHOD'];
}
function sendMail($to,$title,$content){
    require_once("phpmailer/class.phpmailer.php");
    require_once("phpmailer/class.smtp.php");
    $mail = new PHPMailer();
    // $mail->SMTPDebug = 1;
    $mail->isSMTP();
    $mail->SMTPAuth=true;
  
    $mail->Host = 'smtp.yeah.net';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->Hostname = 'yun.oimaster.ml';
    $mail->CharSet = 'UTF-8';
    $mail->FromName = 'OI-Master Online Judge';
    $mail->Username ='oi_master@yeah.net';
    $mail->Password = 'おRこいおこXあすMYいきSNこCLこTCすおき';
    $mail->From = 'oi_master@yeah.net';
    $mail->isHTML(true);
    $mail->addAddress($to,'OI-Master Online Judge');
    $mail->Subject = $title;
    $mail->Body = $content;
    // $mail->addAttachment('./file.txt','text.txt');
    $status = $mail->send();
    if($status)
        return true;
    else
        return false;
}

function getRandStr($length){
    $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $len = strlen($str)-1;
    $randstr = '';
    for($i=0;$i<$length;$i++) {
        $num=mt_rand(0,$len);
        $randstr .= $str[$num];
    }
    return $randstr;
}

function echoHeader($title){
    require('header.php');
    require('noDev.php');
}
function echoFooter(){
    global $data;
    require('footer.php');
}
function echoIcon($icon){
    echo "<i class=\"$icon icon\"></i>";
}
function changeToVue($content){
    global $data;
    $key = getRandStr(rand(3, 30));
    
    $data = array_merge($data, array($key => $content));
    return "{{".$key."}}";
}
function echoNav(){
    $currentUser = $_SESSION['username'];
    require('nav.php');
}
function echoBoard($header, $content, $direction, $id=""){
    require('board.php');
}
function echoSubmitForm($problem_id, $contest_id = ""){
    require('submitForm.php');
}
function echoTwoCol(){
    require('twoCol.php');
}
function echoCenterForm($header, $action, $page){
    require('centerForm.php');
}
function echoFormInput($name, $type, $placeholder){
    require('formInput.php');
}
function echoMessage($type, $icon, $header, $content){
    require('message.php');
}
function echoRedirect($to, $sec){
    require('autoRedirect.php');
}
function fillPaste(){
    require('fillPaste.php');
}
function echoTable($columns, $rows, $mainAlign, $direction){
    require('table.php');
}

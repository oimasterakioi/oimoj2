<?php
require('../html/index.php');
require('../database/index.php');
$username = $_SESSION['username'];
$problem_id = $_POST['problem_id'];
$contest_id = $_POST['contest_id'];
if(isset($contest_id) == false)
    $contest_id = "";

// get file in post
$file = $_FILES['code'];
// get file name
$fileName = $file['name'];
// get file size
$fileSize = $file['size'];

// size <= 10K
if ($fileSize > 10240) {
    echo '{"success": "文件太大"}';
    die();
}

function endsWith($a, $b) {
    return substr_compare($a, $b, -strlen($b)) === 0;
}

// not *.cpp
if (!endsWith($fileName, '.cpp')) {
    echo '{"success": "文件不是C++代码"}';
    die();
}

// save to /opt/uoj/web/app/storage/submission/[random]/answer.code
$random = getRandStr(50);

$submissiontmp = '/opt/uoj/web/app/storage/submission/answer.code';
if (!move_uploaded_file($file['tmp_name'], $submissiontmp)) {
    echo '{"success": "文件上传失败'.$submissiontmp.'"}';
    die();
}

// zip answer.code to submission.zip
$submissionzip = "/opt/uoj/web/app/storage/submission/$random.zip";
$zip = new ZipArchive();
if ($zip->open($submissionzip, ZipArchive::CREATE) === TRUE) {
    $zip->addFile($submissiontmp, 'answer.code');
    $zip->close();

    // delete answer.code
    unlink($submissiontmp);
    
    if(submit($problem_id, $contest_id, $username, $submissionzip, $fileSize))
        echo '{"success": "ok"}';
    else
        echo '{"success": "提交失败"}';
} else {
    echo '{"success": "文件压缩失败"}';
    die();
}
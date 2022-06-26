<?php
// submissions
// id    problem_id    contest_id    submit_time    submitter    content    language    tot_size    judge_time    result    status    result_error    score    used_time    used_memory    is_hidden    status_details

function submit($problem_id, $contest_id="", $submitter, $file, $size){
    global $conn;

    $problem_id = $conn->real_escape_string($problem_id);
    if($contest_id != "")
        $contest_id = $conn->real_escape_string($contest_id);
    $submitter = $conn->real_escape_string($submitter);
    $content = array("file_name" => $file, "config" => array(array("answer_language", "C++11"), array("problem_id", $problem_id)));
    $content = json_encode($content);
    $content = $conn->real_escape_string($content);
    $size = $conn->real_escape_string($size);
    $is_hidden = 0;

    if(contest_id != "")
        $sql = "INSERT INTO submissions (problem_id, contest_id, submit_time, submitter, content, tot_size, is_hidden, language) VALUES ('$problem_id', '$contest_id', NOW(), '$submitter', '$content', '$size', '$is_hidden', 'C++11')";
    else
        $sql = "INSERT INTO submissions (problem_id, contest_id, submit_time, submitter, content, tot_size, is_hidden, language) VALUES ('$problem_id', NULL, NOW(), '$submitter', '$content', '$size', '$is_hidden', 'C++11')";
    $result = $conn->query($sql);

    if($result)
        return true;
    else
        return false;

}
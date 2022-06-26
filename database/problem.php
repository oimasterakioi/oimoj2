<?php
// table problems
// id	title	is_hidden	submission_requirement	extra_config	zan	ac_num	submit_num	hard	
// submission_requirement: [{"name":"answer","type":"source code","file_name":"answer.code"}]
// table problems_contents
// id	statement_md
// table problems_permissions
// username	problem_id
// table problems_tags
// problem_id	tag


function createProblem($title, $creater){
    global $conn;

    $title = $conn->real_escape_string($title);
    $creater = $conn->real_escape_string($creater);

    $sql = "INSERT INTO problems (title, submission_requirement) VALUES ('$title', '[{\"name\":\"answer\",\"type\":\"source code\",\"file_name\":\"answer.code\"}]')";
    $result = $conn->query($sql);

    if($result){
        $sql = "SELECT id FROM problems WHERE title='$title'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $problem_id = $row['id'];

        $sql = "INSERT INTO problems_permissions (username, problem_id) VALUES ('$creater', '$problem_id')";
        $result = $conn->query($sql);

        if($result){
            $sql = "INSERT INTO problems_contents (id, statement_md) VALUES ('$problem_id', '## 题目描述\n在这里填写您的题面！祝您出题愉快！')";
            $result = $conn->query($sql);
            if($result){
                return $problem_id;
            }
            else{
                return false;
            }
        }
        else
            return false;
    }
    else
        return false;
}
function addCreator($username, $problem_id){
    global $conn;

    $username = $conn->real_escape_string($username);
    $problem_id = $conn->real_escape_string($problem_id);

    $sql = "INSERT INTO problems_permissions (username, problem_id) VALUES ('$username', '$problem_id')";
    $result = $conn->query($sql);

    if($result)
        return true;
    else
        return false;
}
function removeCreator($username, $problem_id){
    global $conn;

    $username = $conn->real_escape_string($username);
    $problem_id = $conn->real_escape_string($problem_id);

    $sql = "DELETE FROM problems_permissions WHERE username='$username' AND problem_id='$problem_id'";
    $result = $conn->query($sql);

    if($result)
        return true;
    else
        return false;
}
function updateTag($problem_id, $tag){
    global $conn;

    // split tag into array by ',' and remove space
    $tag = explode(',', $tag);
    $tag = array_map('trim', $tag);
    $tag = array_unique($tag);

    // remove all tags of this problem
    $sql = "DELETE FROM problems_tags WHERE problem_id='$problem_id'";
    $result = $conn->query($sql);

    if($result){
        // add new tags
        $flag = true;
        
        foreach($tag as $t){
            $sql = "INSERT INTO problems_tags (problem_id, tag) VALUES ('$problem_id', '$t')";
            $result = $conn->query($sql);
            if(!$result)
                $flag = false;
        }
        return $flag;
    }
    else
        return false;
}
function writeStatement($problem_id, $statement_md){
    global $conn;

    $problem_id = $conn->real_escape_string($problem_id);
    $statement_md = $conn->real_escape_string($statement_md);

    $sql = "UPDATE problems_contents SET statement_md='$statement_md' WHERE id='$problem_id'";
    $result = $conn->query($sql);

    if($result)
        return true;
    else
        return false;
}

function hasPermission($username, $problem_id){
    global $conn;

    if(isset($username) == false)
        return false;
    if(isAdmin($username))
        return true;

    $username = $conn->real_escape_string($username);
    $problem_id = $conn->real_escape_string($problem_id);

    $sql = "SELECT * FROM problems_permissions WHERE username='$username' AND problem_id='$problem_id'";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
        return true;
    else
        return false;
}
function getProblemList($from, $to){
    global $conn;

    $from = $conn->real_escape_string($from);
    $to = $conn->real_escape_string($to);
    $sql = "SELECT * FROM problems ORDER BY id DESC LIMIT $from, $to";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $problems = array();
        while($row = $result->fetch_assoc()){
            $problems[] = $row;
        }
        return $problems;
    }
    else
        return false;
}
function getTitle($problem_id){
    global $conn;

    $problem_id = $conn->real_escape_string($problem_id);

    $sql = "SELECT * FROM problems WHERE id='$problem_id'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['title'];
    }
    else
        return false;
}
function getStatement($problem_id){
    global $conn;

    $problem_id = $conn->real_escape_string($problem_id);

    $sql = "SELECT * FROM problems_contents WHERE id='$problem_id'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['statement_md'];
    }
    else
        return false;
}
function getTags($problem_id){
    global $conn;

    $problem_id = $conn->real_escape_string($problem_id);

    $sql = "SELECT * FROM problems_tags WHERE problem_id='$problem_id'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $tags = array();
        while($row = $result->fetch_assoc()){
            $tags[] = $row['tag'];
        }
        return $tags;
    }
    else
        return false;
}
function isHidden($problem_id){
    global $conn;

    $problem_id = $conn->real_escape_string($problem_id);

    $sql = "SELECT * FROM problems WHERE id='$problem_id'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($row['is_hidden'] == 1)
            return true;
        else
            return false;
    }
    else
        return false;
}
function getZan($problem_id){
    global $conn;

    $problem_id = $conn->real_escape_string($problem_id);

    $sql = "SELECT * FROM problems WHERE id='$problem_id'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['zan'];
    }
    else
        return false;
}
function isProblemVisibleToUser($problem_id, $username){
    global $conn;

    if(isHidden($problem_id) == false)
        return true;
    else{
        if(hasPermission($username, $problem_id))
            return true;
        else
            return false;
    }
}

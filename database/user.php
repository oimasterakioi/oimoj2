<?php
// database: user_info
// usergroup	username	email	password	rating	qq	ac_num	register_time	remote_addr	http_x_forwarded_for	motto	last_online	contribution	overall	

function register($username, $email, $password, $remote_addr, $http_x_forwarded_for){
    global $conn;

    $username = $conn->real_escape_string($username);
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);
    $remote_addr = $conn->real_escape_string($remote_addr);
    $http_x_forwarded_for = $conn->real_escape_string($http_x_forwarded_for);

    $sql = "INSERT INTO user_info (username, email, password, remote_addr, http_x_forwarded_for) VALUES ('$username', '$email', '$password', '$remote_addr', '$http_x_forwarded_for')";
    $result = $conn->query($sql);

    if($result)
        return true;
    else
        return false;
}
function login($username, $password){
    global $conn;

    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    $sql = "SELECT * FROM user_info WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
        return true;
    else
        return false;
}

function isExist($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
        return true;
    else
        return false;
}
function isExistEmail($email){
    global $conn;

    $email = $conn->real_escape_string($email);

    $sql = "SELECT * FROM user_info WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
        return true;
    else
        return false;
}
function isAdmin($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username' AND usergroup='S'";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
        return true;
    else
        return false;
}
function isBanned($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username' AND usergroup='B'";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
        return true;
    else
        return false;
}

function getEmail($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['email'];
    }
    else
        return false;
}
function getRating($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['rating'];
    }
    else
        return false;
}
function getQQ($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['qq'];
    }
    else
        return false;
}
function getACNum($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['ac_num'];
    }
    else
        return false;
}
function getRegisterTime($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['register_time'];
    }
    else
        return false;
}
function getRemoteAddr($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['remote_addr'];
    }
    else
        return false;
}
function getHttpXForwardedFor($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['http_x_forwarded_for'];
    }
    else
        return false;
}
function getMotto($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['motto'];
    }
    else
        return false;
}
function getLastOnline($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['last_online'];
    }
    else
        return false;
}
function getContribution($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['contribution'];
    }
    else
        return false;
}
function getOverall($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['overall'];
    }
    else
        return false;
}
function setBan($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "UPDATE user_info SET usergroup='B' WHERE username='$username'";
    $result = $conn->query($sql);

    if($result)
        return true;
    else
        return false;
}
function setUser($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "UPDATE user_info SET usergroup='U' WHERE username='$username'";
    $result = $conn->query($sql);

    if($result)
        return true;
    else
        return false;
}
function setAdmin($username){
    global $conn;

    $username = $conn->real_escape_string($username);

    $sql = "UPDATE user_info SET usergroup='A' WHERE username='$username'";
    $result = $conn->query($sql);

    if($result)
        return true;
    else
        return false;
}

if(isBanned($_SESSION['username'])){
    unset($_SESSION['username']);
}
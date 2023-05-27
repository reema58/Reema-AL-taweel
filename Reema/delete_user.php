<?php



session_start();

//|| !isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin'
if (!isset($_SESSION['user_id']) ) {
    header("Location: login.php");
    exit();
}


if (!isset($_GET['id'])) {
    if($_SESSION['user_type'] == 1){
        header("Location: admin.php");
        exit();
    }
    else {
        header("Location: user.php");
        exit(); 
    }
   

}


$userId = $_GET['id'];


$mysqli = new mysqli('localhost', 'root', '', 'project');


if ($mysqli->connect_error) {
    die('Connection Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}


$stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);


if ($stmt->execute()) {

    if($_SESSION['user_type'] == 1){
        header("Location:  admin.php");
        exit();
    }
    else {
        header("Location:  login.php");
        exit(); 
    }
    //header("Location: admin.php?error=deleteerror");
    //exit();
}
else {
    if($_SESSION['user_type'] == 1){
        header("Location:  admin.php?error=deleteerror");
        exit();
    }
    else {
        header("Location: user.php?error=deleteerror");
        exit(); 
    }
}

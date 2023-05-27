<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$userType = $_POST['user_type'];




if (empty($name) || empty($email) || empty($password) || empty($userType)) {
    
    header("Location: register.php?error=emptyfields");
    exit();
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    
    header("Location: register.php?error=invalidemail");
    exit();
}

$hashedPassword = md5($password); 


$mysqli = new mysqli('localhost', 'root', '', 'project');


if ($mysqli->connect_error) {
    die('Connection Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}


$stmt = $mysqli->prepare("INSERT INTO users (name, email, password, is_admin) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $name, $email, $hashedPassword, $userType);


if ($stmt->execute()) {
    
    header("Location: login.php?registration=success");
    exit();
} else {
    
    header("Location: register.php?error=databaseerror");
    exit();
}
?>
<?php

session_start();

//|| !isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin'
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


if (!isset($_GET['id'])) {
    header("Location: admin.php");
    exit();
}


$userId = $_GET['id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $mysqli = new mysqli('localhost', 'root', '', 'project');

    
    if ($mysqli->connect_error) {
        die('Connection Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
    }

    
    $stmt = $mysqli->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $password, $userId);

    
    if ($stmt->execute()) {
        
        header("Location: admin.php");
        exit();
    } else {
    
        header("Location: edit_user.php?id=$userId&error=updateerror");
        exit();
    }
}


$mysqli = new mysqli('localhost', 'root', '', 'project');


if ($mysqli->connect_error) {
    die('Connection Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}


$stmt = $mysqli->prepare("SELECT id, name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);


$stmt->execute();


$result = $stmt->get_result();


if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
} else {
    
    header("Location: admin.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-top:100px;
            font-size:50px;
        }

        form {
            text-align: center;
            margin-top:100px;
           
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 300px;
            padding: 5px;
            font-size: 16px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            display: block;
            width: 450px;
            padding: 10px;
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-left:500px;
        }

        input[type="submit"]:hover {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
    <h1>Edit User</h1>
    <form action="edit_user.php?id=<?php echo $userId; ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php

$mysqli->close();


?>

<?php

session_start();


if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 1) {
    header("Location: login.php");
    exit();
}


$mysqli = new mysqli('localhost', 'root', '', 'project');


if ($mysqli->connect_error) {
    die('Connection Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$query = "SELECT id, name, email ,password FROM users";
$result = $mysqli->query($query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <style>
        body {
          font-family: Arial, sans-serif;
          margin: 0;
          padding: 0;
          background-color: #F5F5F5;
        }
    
        .header {
          background-color: #333;
          padding: 20px;
          text-align: center;
          color: white;
        }
    
        .header h1 {
          margin: 0;
          font-size: 28px;
          font-weight: 600;
        }
    
    
        .user-management-container {
          width: 1000px;
          margin: 50px auto;
          padding: 20px;
          background-color: white;
          border: 1px solid #ccc;
          border-radius: 5px;
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .user-management-container .del{ width: 100px; }
        .user-management-container h2 {
          margin-top: 0;
          text-align:center;
          color:#4CAF50;
                }
    
        .user-management-container p {
          margin-bottom: 20px;
        }
    
        table {
          width: 100%;
          border-collapse: collapse;
        }
    
        th, td {
          padding: 10px;
          text-align: left;
          border-bottom: 1px solid #ccc;
        }
    
        .actions {
          display: flex;
          gap: 10px;
        }
    
        .actions a {
          text-decoration: none;
          color: #4CAF50;
        }
    
        .password,
        .email {
          font-style: italic;
          color: #888;
          display: none;
        }
    
        .footer {
          background-color: #333;
          color: white;
          padding: 20px;
          text-align: center;
          font-size: 14px;
          margin-top:400px;
        }
        .delete-confirmation {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.5);
        }
    
        .delete-confirmation-content {
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          background-color: white;
          padding: 20px;
          border-radius: 5px;
          text-align: center;
        }
    
        .delete-confirmation-buttons {
          margin-top: 20px;
        }
    
        .delete-confirmation-buttons button {
          background-color: #4CAF50;
          color: white;
          border: none;
          padding: 10px 20px;
          margin-right: 10px;
          cursor: pointer;
          border-radius: 5px;
        }
    
      </style>

</head>
<body>


      <div class="header">
        <h1>User Management</h1>
         
      </div>
    
      <div class="user-management-container">
        <h2>User List</h2>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <th>Actions</th>
            </tr>
         
          
        <!-- </table> -->
      </div>




        <?php
      
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    
                    <td class="del">
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>">Delete</a>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="4">No user records found.</td>
            </tr>
            <?php
        }
        ?>



         </thead>
    </table>
    </div>
    <div class="footer">
        <p>All rights reserved &copy; 2023</p>
      </div>
</body>
    
  
</html>

<?php

$mysqli->close();
?>



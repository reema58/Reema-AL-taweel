<!DOCTYPE html>
<html>
<head>
    <title>Create New Account</title>
    <style>
    /* Updated styling with a professional touch */
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
      display: flex;
      margin-bottom: 70px;
      padding-bottom: 40px; 
    }

    .header h1 {
      margin: 0;
      font-size: 30px;
      font-weight: 600;
      padding-top:19px;
      padding-left:450px ;

      /* padding-left:500px ; */
    }

    .header .button-container {
      margin-top: 20px;
      padding-left:150px ;
      width: 300px; 
    }

    .header .button-container button {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      margin-right: 10px;
      /* margin: 0; */
      cursor: pointer;
      border-radius: 5px;
      width:150px;
    }

    .login-container {
      width: 300px;
      margin: 50px auto;
      padding: 20px;
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      
    }

    .login-container label ,
    .login-container input[type="text"],
    .login-container input[type="password"],
    .login-container input[type="submit"] {
      display: block;
      width: 100%;
      margin-bottom: 40px;
     
    }
    .login-container label {margin-bottom:5px}

    .login-container input[type="text"],
    .login-container input[type="password"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .login-container input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px;
      cursor: pointer;
      border-radius: 5px;
    }

    select{
      width: 300px;
      height: 30px;
    }
    .footer {
      background-color: #333;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 14px;
    }
  </style>
</head>
<body>

<div class="header">
    <h1>Your gateway to user management</h1>
    <div class="button-container">
      <button onclick="window.location.href = 'login.php';">Login</button>
    </div>
  </div>

  <div class="login-container">
    <form action="register_process.php" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email:</label>
      <input type="text" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="user_type">User Type:</label>
        <select id="user_type" name="user_type">
            <option value="2">Regular User</option>
            <option value="1">Administrator</option>
        </select><br><br>

      <input type="submit" value="Sign Up">
    </form>
  </div>

  <div class="footer">
    <p>All rights reserved &copy; 2023 REEMA</p>
  </div>


</body>
</html>

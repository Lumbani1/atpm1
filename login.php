<!DOCTYPE html> 

<?php
// Start the session
session_start();

// Create a connection to the database
include "conn.php";



// Check if the login form has been submitted
if (isset($_POST["username"]) AND isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare a SQL statement to select the user from the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Login successful, store user details in session variables
        $row = mysqli_fetch_assoc($result);
        $_SESSION["name"] = $row["name"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["user_type"] = $row["user_type"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["id"] = $row["id"];
        $_SESSION["payment"];
        


        // Redirect to homepage or another page
        if ($row["user_type"] == "student") {
            header("Location: student/index.php");
            exit();
        } else if ($row["user_type"] == "work_supervisor") {
            header("Location: work_supervisor/index.php");
            exit();
        }
        else if ($row["user_type"] == "academic_supervisor") {
            header("Location: academic_supervisor/index.php");
            exit();
          }

        else if($row["user_type"] == "coordinator") {

            header("Location: coordinator/index.php");
            exit();
          }

        else if($row["user_type"] == "accounts") {

            header("Location: accounts/index.php");
            exit();
          }
       

    }
     
      else if(mysqli_num_rows($result)<1)
      {

            // echo "<script> alert('Wrong Username or password')</script>";

        header("Location: login.php?error=Incorrect Username or password");
        exit();
      }
       
    }
     
// Close the database connection
mysqli_close($conn);


?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./assets/css/login_style.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Sign in</title>

    <style type="text/css">
     

    </style>
    <script>

        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var toggleCheckbox = document.getElementById("togglePassword");
            if (toggleCheckbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</head>

<body style="background-image: url(./unilia.jpg); background-size: cover; background-repeat: no-repeat;">

    <p  class="title">UNILIA LAWS CAMPUS TEACHING PRACTICES AND ATTACHMENT MANAGEMENT SYSTEM</p>
<div class="main">


   
    <form class="form1" method="POST" action="login.php" onsubmit="return validatePassword();">
        <p class="logo"> <img src="logo.jpg"></p>
              <p class="label" align="center">Enter Your Username</p>
        <input class="input" type="text" align="center" placeholder="Username" name="username" required>
        <p class="label" align="center">Enter Your Password</p>
        <input class="pass" type="password" align="center" placeholder="Password" name="password" id="password" required><br>
       
        <label for="togglePassword"> <input type="checkbox" id="togglePassword" onclick="togglePasswordVisibility()">Show password</label>
        <br><br>
        <button class="submit" type="submit">Sign In</button>

<div class="error">
    <?php if(isset($_GET['error'])) { echo $_GET['error']; } ?>
</div>


        <p class="forgot" align="center"><a href="./forgot">Forgot Password?</p>

    </form>
</div>
</body>

</html>





<?php

session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: admin/admin.php");
    exit;
}

require_once 'config.php';

$username = $password = $role = "";
$username_err = $password_err = $role_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["login"])){

    // Check if username is empty
    $err = 0;
    $fail = "";

    if(empty(trim($_POST["username"]))){
        $fail .= "<p>Please enter username.</p>";
        $err++;
    } else{
        $username = strtolower(trim($_POST["username"]));
    }

    if(empty($_POST["user"])){
        $fail .= "<p>Please select role.</p>";
        $err++;
    } else{
        $role = $_POST["user"];
    }
    // Check if password is empty
    if(empty($_POST["password"])){
        $fail .= "<p>Please enter your password.</p>";
        $err++;
    } else{
        $password = $_POST["password"];
    }
    
    // Validate credentials
    if($err == 0){
        // Prepare a select statement
        switch($role){
            case 'admin': 
                $table = 'admin';
                $id = 'admin_id';
                break;
            
            case 'doctor':
                $table = 'doctor';
                $id = 'doctor_id';
                break;

            case 'nurse':
                $table = 'nurse';
                $id = 'nurse_id';
                break;

            case 'receptionist': 
                $table = 'receptionist';
                $id = 'receptionist_id';
                break;

            default:
                $table = 'doctor';
                $id = 'doctor_id';
                break;
        }

        $sql = "SELECT `password`,`$id`, `email` FROM `$table` WHERE (`$id`= '$username' OR `email`= '$username' )";

        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            $data = mysqli_fetch_assoc($result);
            $data = $data ? (object)$data : null;
            if($data->password==base64_encode($password) ){

                //if ok
                session_start();
                
                //Store user info in session value
                $user = "SELECT * FROM `$table` WHERE (`$id`= '$username' OR `email`= '$username' )";
                $result = mysqli_query($conn, $user);
                
                $userinfo = mysqli_fetch_assoc($result);
                $userinfo = $userinfo ? (object)$userinfo : null;
                
                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username;  
                $_SESSION["email"] = $data->email;                            
                $_SESSION["userinfo"] = $userinfo;
                logger($userinfo->email,"logged in");

                // Redirect user to welcome page
                if($table == 'receptionist'){
                    header("location: secretary/secretary.php");
                }elseif($table == 'doctor'){
                    header("location: doctor/doctor.php");
                }elseif($table == 'nurse'){
                    header("location: nurse/nurse.php");
                }elseif($table == 'admin'){
                    header("location: admin/admin.php");
                }

            }else{
                // Display an error message if password is not valid
                $fail .= "<p>The password you entered was not valid.</p>";
            }
        }else{
            // Display an error message if username doesn't exist
            $fail .= "<p>No account found with that username.</p>";
        }				
    }
    // Close connection
    mysqli_close($conn);
}
?>
<html>
    <head>
        <title>Electronic Medical Record</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=RocknRoll+One&display=swap" rel="stylesheet">
    </head>

    <body>
        <div class="logo">
        <img src="images/image1.jpg">
       
        </div>
        <div class="effect">
                
        </div>
        <div class="row">
            <div class="column">
               <strong> Welcome to<br> Afrimed.
                    Please<br> enter your login <br>details to begin.</strong>
                    <div class="effect2">
        
                    </div>
            </div>
            
            <div class="column1">
                <form method="POST">
                    <h1><strong>Login</strong></h1>
                    <input type="radio" id="admin" name="user" value="admin">
                    <label for="admin"><strong>Administrator</strong></label>
                    <input type="radio" id="doctor" name="user" value="doctor">
                    <label for="doctor"><strong>Doctor</strong></label>
                    <input type="radio" id="nurse" name="user" value="nurse">
                    <label for="nurse"><strong>Nurse</strong></label>
                    <br>
                    <input type="radio" id="s_staff" name="user" value="receptionist">
                    <label for="s_staff"><strong>Secretary</strong></label>
                    <br><br>
                
                    <input type="text" id="username" name="username" placeholder="username"><br>
                    
                    <input type="password" id="pwd" name="password"  placeholder="password">
                        <?php 
                            if(!empty($fail)){
                               echo '<div class="alert-danger vertical-align: middle; align-self: center; width: 50% !important; top: 140px;"><h3>Error Messages</h3> '.$fail.'</div>';
                            }
                        ?>
                  <button id="btn" type="submit" name="login">LOGIN</button>
                </form>
            </div>
          </div>
  
    </body>
</html>
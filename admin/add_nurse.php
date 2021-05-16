<?php 
  require_once "../base.php";
    
if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'ADD'){
            
    $id = 'n-'.rand(100,999).'-'.rand(100,999);
    $err = 0;     
        
    if(!empty($_POST['nur_password']) && $_POST['nur_password'] == $_POST['nur_cpassword']){
        $password = base64_encode($_POST['nur_password']);
    }else{
        $err++;
        $fail = "Passwords dont match";
    }

    if($err == 0){
        $sql = "SELECT `nurse_id` from `nurse` WHERE `nurse_id`  = '$id'";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result)==0){
                $sql = "INSERT INTO `nurse` (`nurse_id`, `name`, `email`, `phone`, `address`,`password`) VALUES ('$id','$_POST[nur_name]','$_POST[nur_email]','$_POST[nur_phone]','$_POST[nur_address]','$password')";
                if( mysqli_query($conn, $sql)){
                    $fail = "New Nurse has been added";
                }else{
                    $fail = "Error, Try again";
                }
            }
        }
    }
}
?>
<html>
    <head>
        <title>Electronic Medical Record</title>
        <link href="assets/style1.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=RocknRoll+One&display=swap" rel="stylesheet">

    </head> 
    <body>
       
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

         

        <?php include "header.php" ?>
        <?php include "sidebar.php" ?>
        
        <div class = "body">
            <div class="admin-head">
        <p>ADMIN | NURSE </p>   
       </div>
           <br>
            <br>
            <div class="form-class" style ="padding: 32px;">
            <p>Add Nurse</p>
            <?php 
                if(!empty($fail)){
                    alert($fail);
                }
            ?>
            <br>
            <form action="" method="POST">
                <label for="nurse_name">Nurse Name</label>
                <input type="text" id="nurse_name" name="nur_name" placeholder="Enter Nurse Name">
            <br>
            <label for="nurse_email">Nurse Email</label>
            <input type="text" id="nurse_email" name="nur_email" placeholder="Enter Nurse Email ">
            <br>
            <label for="nurse_phone">Nurse Phone number</label>
            <input type="text" id="nurse_phone" name="nur_phone" placeholder="Enter Nurse Phone Number">
            <br>
            <label for="nurse_address"> Nurse Address</label>
        <input type="text" id="nurse_address" name="nur_address" placeholder="Enter Nurse Address">
                <br>
                <label for="nurse_password">Password</label>
                <input type="password" id="nurse_password" name="nur_password" placeholder="Enter Password"><br>
                <label for="nurse_cpassword">Confirm Password</label>
                <input type="password" id="nurse_cpassword" name="nur_cpassword" placeholder="Confirm Password">
                <br>
                <input type="submit" name="triggers" value="ADD">
            </form>
            </div>
            <br>
            <hr style="color: lightgray;">
            </div>
        </div>
            </body>
            </html>
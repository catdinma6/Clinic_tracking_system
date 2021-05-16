<?php 
  require_once "../base.php";
    
if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'ADD'){
            
    $id = 's-'.rand(100,999).'-'.rand(100,999);
    $err = 0;     
        
    if(!empty($_POST['secre_password']) && $_POST['secre_password'] == $_POST['secre_cpassword']){
        $password = base64_encode($_POST['secre_password']);
    }else{
        $err++;
        $fail = "Passwords dont match";
    }

    if($err == 0){
        $sql = "SELECT `receptionist_id` from `receptionist` WHERE `receptionist_id`  = '$id'";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result)==0){
                $sql = "INSERT INTO `receptionist` (`receptionist_id`, `name`, `email`, `phone`, `address`,`password`) VALUES ('$id','$_POST[secre_name]','$_POST[secre_email]','$_POST[secre_phone]','$_POST[secre_address]','$password')";
                if( mysqli_query($conn, $sql)){
                    $fail = "New secretary has been added";
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
        <p>ADMIN | SECRETARY </p>   
       </div>
           <br>
            <br>
            <div class="form-class" style ="padding: 32px;">
            <p>Add Secretary</p>
                <br>
            <?php 
                if(!empty($fail)){
                    alert($fail);
                }
            ?>
            <form action="" method="POST">
                <label for="secretary_name">Secretary Name</label>
                <input type="text" id="secretary_name" name="secre_name" placeholder="Enter Secretary Name">
            <br>
            <label for="secretary_email">Secretary Email</label>
            <input type="text" id="secretary_email" name="secre_email" placeholder="Enter Secretary Email ">
            <br>
            <label for="secretary_phone">Secretary Phone number</label>
            <input type="text" id="secretary_phone" name="secre_phone" placeholder="Enter Secretary Phone Number">
            <br>
            <label for="secretary_address"> Secretary Address</label>
        <input type="text" id="secretary_address" name="secre_address" placeholder="Enter Secretary Address">
                <br>
                <label for="secretary_password">Password</label>
                <input type="password" id="secretary_password" name="secre_password" placeholder="Enter Password"><br>
                <label for="secretary_cpassword">Confirm Password</label>
                <input type="password" id="secretary_cpassword" name="secre_cpassword" placeholder="Confirm Password">
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
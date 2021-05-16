<?php 
  require_once "../base.php";
    
if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'ADD'){
            
    $id = 'p-'.rand(100,999).'-'.rand(100,999);//generates the patient id
    $err = 0;     
        
    if($err == 0){
        $sql = "SELECT `patient_id` from `patient` WHERE `patient_id`  = '$id'";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result)==0){
                $sql = "INSERT INTO `patient` (`patient_id`, `name`, `addedby`, `email`,`dob`,`gender`, `phone`, `address`,`medical_history`) VALUES ('$id','$_POST[pat_name]','$userinfo->email','$_POST[pat_email]','$_POST[pat_dob]','$_POST[pat_gender]','$_POST[pat_phone]','$_POST[pat_add]','$_POST[comment]')";
                if( mysqli_query($conn, $sql)){
                    $fail = "New patient has been added";
                }else{
                    $fail = "Error, Try again ".mysqli_error($conn);
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
            <p>ADMIN | PATIENT</p>
            </div>
                    <br>
            <br>
        <div class="form-class">
            <br>
            <p>Add Patient</p>
            <?php 
                if(!empty($fail)){
                    alert($fail);
                }
            ?>
            <br>
            <form method="POST">

        <label for="patient_name">Patient Name</label>
        <input type="text" id="patient_name" name="pat_name">
    <br>
    <label for="patient_phone">Patient Contact number</label>
    <input type="text" id="patient_phone" name="pat_phone">
    <br>
    <label for="patient_email">Patient Email</label>
    <input type="text" id="patient_email" name="pat_email">
    <br>
    <label for="patient_age"> Patient Date Of Birth</label>
    <input type="date" id="patient_dob" name="pat_dob">
    <br>
    <label for="gender">Gender</label>
    <br>
    <br>
    <input type="radio" id="male" name="pat_gender" value="male">
    <label for="male">Male</label>
    <input type="radio" id="female" name="pat_gender" value="female">
    <label for="female">Female</label>
    <br>
    <br>
    <label for="patient_address">Patient Address</label>
    <input type="text" id="patient_address" name="pat_add">

    <label for="history">Medical History</label>
    <br>
    <textarea rows="4" cols="40" name="comment">
        Enter Patient Medical History(if any)
    </textarea>
        <br>
        
        <input type="submit" name="triggers" value="ADD">
    </div>

            </form>

        </div>
        </body>
        </html>
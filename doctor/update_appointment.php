<?php
    require_once '../base.php';
    //nurses on duty

    $id = (!empty($_GET["id"])) ? $_GET["id"] : '';

    $sql = "SELECT * FROM `appointment` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    $appointments = [];
    if(!empty($result)){
        while ($entry = mysqli_fetch_object($result)) {
           $appointments = $entry;
        }
    }
    if(!empty($appointments)){

            if(!empty($appointments->receptionist_id)){
                $sql = "SELECT `name` FROM `receptionist` WHERE `receptionist_id` = '$appointments->receptionist_id'";
                $result = mysqli_query($conn, $sql);
                $doctor = mysqli_fetch_object($result);
                $appointments->receptionist = $doctor->name;
            }else{
                $appointments->receptionist = 'admin';
            }
            if(!empty($appointments->patient_id)){
                $sql = "SELECT `name` FROM `patient` WHERE `patient_id` = '$appointments->patient_id'";
                $result = mysqli_query($conn, $sql);
                $doctor = mysqli_fetch_object($result);
                $appointments->patient = $doctor->name;
            }else{
                $appointments->patient = '';
              }

            if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'Update'){
                $sql = "UPDATE `appointment` SET `report` = '$_POST[report]' ,`next_app_date` = '$_POST[next_app_date]'  WHERE `id` = '$id' ";
                if( mysqli_query($conn, $sql)){
                    $fail = "Appointment Report Updated";
                }else{
                    
                    $fail = "Try again";
                }
            }

    }else{
        header("Location: all_appointment.php");
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

    <body>

          <div class = "body">
            <div class="admin-head">
             <p>DOCTOR | APPOINTMENT</p>
              
            <?php 
                if(!empty($fail)){
                    alert($fail);
                }
            ?>
             </div>
             <br>
         <div class="form-class" style ="padding: 32px;">
           
             <p>Update Appointment Data</p>
             <br>
             <form method="POST">
       <br>
       <label for="secretary_name">Secretary Name</label>
       <input type="text" id="secretary_name"  readonly value="<?php echo $appointments->receptionist ?>">
       <br>
     <label for="patient_name">Patient Name</label>
     <input type="text" id="patient_name" readonly value="<?php echo $appointments->patient ?>">
     <br>
     <label for="next_appointment_date">Next Appointment Date</label>
     <input type="date" id="next_appointment_date" value="<?php echo $appointments->next_app_date; ?>" name="next_app_date" >
 
     <label for="history">Report</label>
     <br>
     <textarea rows="4" cols="40" name="report"><?php echo $appointments->report ?></textarea>
         <br>
         
         <input type="submit" name="triggers" value="Update">
     </div>
 
             </form>
 
         </div>
         </body>
         </html>
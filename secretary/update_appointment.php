<?php
    require_once '../base.php';

    $id = (!empty($_GET["id"])) ? $_GET["id"] : '';
    //SELECT * FROM `appointment` as a LEFT JOIN `billing` as b ON a.id = b.appointment_id WHERE a.id = '4';
    $sql = "SELECT * FROM `appointment` as a LEFT JOIN `billing` as b ON a.id = b.appointment_id WHERE a.id = '$id'";
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

                    //check if billing info exists
                    $sql = "SELECT * FROM `billing` WHERE `appointment_id` = '$id' ";

                    //perform query 
                    $result = mysqli_query($conn, $sql);
                    $request =  mysqli_fetch_object($result);
                    if(!empty($request)){
                        print_r($request);
                        echo 'exists';
                        $query = "UPDATE `billing` SET `consultation_fee` = '$_POST[con_fee]', `lab_test` = '$_POST[lab_test]', `purchases` = '$_POST[purchases]' WHERE `appointment_id` = '$id'";
                        mysqli_query($conn, $query);
                    }else{
                        $query2 = "INSERT INTO `billing` (`appointment_id`,`consultation_fee`,`lab_test`, `purchases`) VALUES 
                        ('$id','$_POST[con_fee]','$_POST[lab_test]','$_POST[purchases]')";
                        //echo $query2;
                        mysqli_query($conn, $query2);
                    }

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
             <p>SECRETARY | APPOINTMENT</p>
              
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
         <label for="billing">Billing</label><br>
        <label for="c_fee">Consultation Fee</label>
        <input type="text" id="c_fee" value="<?php  echo (!empty($appointments->consultation_fee)) ? $appointments->consultation_fee : ''; ?> "  name="con_fee">
        					
        <label for="test">Lab Test</label>
        <input type="text" id="test" value="<?php  echo (!empty($appointments->lab_test)) ? $appointments->lab_test : ''; ?> "  name="lab_test">
        					
        <label for="Purchases">Purchases eg. Drugs </label>
        <input type="text" id="purchases" value="<?php  echo (!empty($appointments->purchases)) ? $appointments->purchases : ''; ?> "  name="purchases">

         <input type="submit" name="triggers" value="Update">
     </div>
    </form>
 
         </div>
         </body>
         </html>
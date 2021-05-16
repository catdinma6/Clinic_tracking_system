<?php
    require_once '../base.php';

    $id = (!empty($_GET["id"])) ? $_GET["id"] : '';
    $sql = "SELECT * FROM `patient` WHERE `patient_id` = '$id' ";

    $result = mysqli_query($conn, $sql);
    $patient = [];
    if(!empty($result)){

        while ($entry = mysqli_fetch_object($result)) {
           $patient = $entry;
        }

        if(!empty($patient)){
            
            $sql = "SELECT * FROM `appointment` as a LEFT JOIN `billing` as b ON a.id = b.appointment_id WHERE a.patient_id = '$patient->patient_id'";
            $result = mysqli_query($conn, $sql);
            $appointments = [];
            if(!empty($result)){
                while ($entry = mysqli_fetch_object($result)) {
                   $appointments[] = $entry;
                }

                if(!empty($appointments)){
                    foreach($appointments as $value){
                        if(!empty($value->receptionist_id)){
                            $sql = "SELECT `name` FROM `receptionist` WHERE `receptionist_id` = '$value->receptionist_id'";
                            $result = mysqli_query($conn, $sql);
                            $doctor = mysqli_fetch_object($result);
                            $value->receptionist = $doctor->name;
                        }else{
                          $value->receptionist = 'admin';
                        }
                    }
                }
            
            }

            $sql = "SELECT * FROM `admission` WHERE `patient_id` = '$patient->patient_id' ";
            $result = mysqli_query($conn, $sql);
            $admissions = [];
            if(!empty($result)){
                while ($entry = mysqli_fetch_object($result)) {
                $admissions[] = $entry;
                }

                if(!empty($admissions)){
                    foreach($admissions as $value){
                        $value->out = strtotime($value->discharge_date) < strtotime(date("Y-m-d H:i:s")) ? true : false ;
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
        <p>DOCTOR | PATIENT PROFILE </p>   
          </div>
          <br><br>
            <p> Here is the medical record for the patient</p>
            <h3> <strong> Patient Name: </strong> <?php echo $patient->name ?></h3> <br>

            <h3> <strong> Patient Phone: </strong> <?php echo $patient->phone ?></h3>
            <br>
            <h3> <strong> Patient Email: </strong> <?php echo $patient->email ?></h3> <br>
            
            <h3> <strong> Patient DOB: </strong> <?php echo $patient->dob ?></h3> <br>

            <h3> <strong> Patient Gender: </strong> <?php echo $patient->gender ?></h3> <br> 
            
            <h3> <strong> Patient Adddress: </strong> <?php echo $patient->address ?></h3> <br>
            
            <h3> <strong> Patient Medical History: </strong> <?php echo $patient->medical_history ?></h3>

          <br>
          <hr style="color: grey;">
          <br>
          <h3 style="text-align: center;">All TIME APPOINTMENTS </h3>
          <br>
          <hr style="color: grey;">
          <div class="table">
              <table>
              <thead>
                  <tr>
                    <th class="center">SN</th>
                    <th>RECORDED BY</th>
                    <th>REPORT</th>
                    <th>APP DATE</th>
                    <th>NEXT APP DATE</th>
                    <th>ACTION</th>
                    
                </tr>
            </thead>
            <?php 
                if(!empty($appointments)){
                    $count = 1;
                    foreach($appointments as $app){
            ?>       
                <tr class='odd gradeX'>
                <td><?php echo $count++ ?></td>
                <td><?php echo $app->receptionist ?></td>
                <td><?php echo $app->report ?></td>
                <td><?php echo $app->app_date ?></td>
                <td><?php echo $app->next_app_date ?></td>
                <td class="center">
            <?php 
                echo "<button class='dropbtn'><a href= 'update_appointment.php?id=$app->id' style='color: white;'>UPDATE INFO</a></button>";
            ?>
                </td>
            </tr>
            <?php
                    }
                }else{
                    echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>No appointments</p>";
                }
            ?>
              </table>
          </div>

          <h3 style="text-align: center;">Admission History </h3>
          <br>
          <hr style="color: grey;">
          <div class="table">
              <table>
              <thead>
                  <tr>
                      <th class="center">SN</th>
                      <th>ROOM NUM</th>
                      <th>REPORT</th>
                      <th>ADMITTED DATE</th>
                      <th>DISCHARGE DATE</th>
                      <th>STATUS</th>
                      <th>ACTION</th>
                      
                  </tr>
                  
                  <?php 
                                            if(!empty($admissions)){
                                                $count = 1;
                                                foreach($admissions as $app){
                                        ?>       
                                            <tr class='odd gradeX'>
                                                <td><?php echo $count++ ?></td>
                                                <td><?php echo $app->room_id ?></td>
                                                <td><?php echo $app->report ?></td>
                                                <td><?php echo $app->admitted_date ?></td>
                                                <td><?php echo $app->discharge_date ?></td>
                                                <td><?php echo ($app->out) ? "Discharged" : "In Admission" ?></td>
                                                <td class="center">
                                                    <?php 
                                                        
                                                        echo "<button class='dropbtn'><a href= 'update_admission.php?id=$app->id' style='color: white;'>UPDATE INFO</a></button>";
                                                        
                
                                                    ?>
                                                </td>
                                            </tr>
                                                  
                                        <?php
                                                }
                                            }else{
                                                echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>No admissions</p>";
                                            }
                                        ?>
                
              </table>
          </div>
        </div>
    </body>
</html>
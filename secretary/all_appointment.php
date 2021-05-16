<?php
    require_once '../base.php';
    //nurses on duty
    $sql = "SELECT * FROM `appointment` ORDER BY `app_date` ASC ";
    $result = mysqli_query($conn, $sql);
    $appointments = [];
    if(!empty($result)){
        while ($entry = mysqli_fetch_object($result)) {
           $appointments[] = $entry;
        }
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
            if(!empty($value->patient_id)){
                $sql = "SELECT `name` FROM `patient` WHERE `patient_id` = '$value->patient_id'";
                $result = mysqli_query($conn, $sql);
                $doctor = mysqli_fetch_object($result);
                $value->patient = $doctor->name;
            }else{
              $value->patient = '';
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
        <p>SECRETARY | APPOINTMENTS </p>   
          </div>


          
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
                    <th>PATIENT</th>
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
                                                <td><?php echo $app->patient ?></td>
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
          </div>
          </body>
          </html>
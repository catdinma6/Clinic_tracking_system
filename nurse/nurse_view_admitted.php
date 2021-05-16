<?php
    require_once '../base.php';
    
    $sql = "SELECT * FROM `admission` ORDER BY `admitted_date` DESC ";
    $result = mysqli_query($conn, $sql);
    $admissions = [];
    if(!empty($result)){
        while ($entry = mysqli_fetch_object($result)) {
           $admissions[] = $entry;
        }
    }
    if(!empty($admissions)){
        foreach($admissions as $value){
            if(!empty($value->patient_id)){
                $sql = "SELECT `name` FROM `patient` WHERE `patient_id` = '$value->patient_id'";
                $result = mysqli_query($conn, $sql);
                $doctor = mysqli_fetch_object($result);
                $value->patient = $doctor->name;
            }
            $value->out = strtotime($value->discharge_date) < strtotime(date("Y-m-d H:i:s")) ? true : false ;
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
        <p>NURSE | ADMISSIONS </p>   
          </div>


          
          <br>
          <hr style="color: grey;">
          <br>
          <h3 style="text-align: center;">Admitted Patients </h3>
          <br>
          <hr style="color: grey;">
          <div class="table">
              <table>
              <thead>
                  <tr>
                      <th class="center">SN</th>
                      <th>PATIENT</th>
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
                                                <td><?php echo $app->patient ?></td>
                                                <td><?php echo $app->room_id ?></td>
                                                <td><?php echo $app->report ?></td>
                                                <td><?php echo $app->admitted_date ?></td>
                                                <td><?php echo $app->discharge_date ?></td>
                                                <td><?php echo ($app->out) ? "Discharged" : "In Admission" ?></td>
                                                <td class="center">
                                                    <?php 
                                                        
                                                        echo "<button class='dropbtn'><a href= 'nurse_update_admission.php?id=$app->id' style='color: white;'>UPDATE INFO</a></button>";
                                                        
                
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
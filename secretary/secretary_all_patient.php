<?php
    require_once '../base.php';
    //patients

    $sql = "SELECT * FROM `patient` ORDER BY dateadded DESC ";
    $result = mysqli_query($conn, $sql);
    if(!empty($result)){
      $patients = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <p>SECRETARY | PATIENTS</p>   
          </div>


          
          <br>
          <hr style="color: grey;">
          <br>
          <h3 style="text-align: center;">All Patients </h3>
          <br>
          <hr style="color: grey;">
          <div class="table">
              <table>
              <thead>
                  <tr>
                      <th class="center">SN</th>
                      <th>PATIENT NAME</th>
                      <th>PATIENT CONTACT NUM</th>
                      <th>PATIENT EMAIL</th>
                      <th>GENDER</th>
                      <th>ADDRESS</th>
                      <th>Medical History</th>
                      <th>DATE ADDED</th>
                      
                  </tr>
                  
              </thead>
              <?php 
                                            if(!empty($patients)){
                                                $count = 1;
                                                foreach($patients as $patient){
                                        ?>       
                                            <tr class='odd gradeX'>
                                                <td><?php echo $count++ ?></td>
                                                <td><?php echo $patient['name'] ?></td>
                                                <td><?php echo $patient['phone'] ?></td>
                                                <td><?php echo $patient['email'] ?></td>
                                                <td><?php echo $patient['gender'] ?></td>
                                                <td><?php echo $patient['address'] ?></td>
                                                <td><?php echo $patient['medical_history'] ?></td>
                                                <td><?php echo $patient['dateadded'] ?></td>
                                            </tr>
                                                  
                                        <?php
                                                }
                                            }else{
                                                echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>No Patients in Database</p>";
                                            }
                                        ?>              
              </table>
          </div>
          </div>
          </body>
          </html>
<?php 

    require_once '../base.php';
    //patients
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['patient_search'])){

        $val = $_POST['p_search'];
        $sql = "SELECT * FROM `patient` WHERE `name` LIKE '%$val%' ORDER BY dateadded DESC ";
        $result = mysqli_query($conn, $sql);
        if(!empty($result)){
        $patients = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <p>NURSE | VIEW PATIENTS </p>   
       </div>
           <br>
            <br>
            <div class="doc_spec" style="padding: 32px;">
            <form action="" method="post">
                <label for="search" >Search by Patient Name</label><br>
                <input type="text" value="<?php echo (!empty($val) ? $val : '') ?>" name="p_search">
                <br>
                <input type="submit" name="patient_search" value="Search">
            </form>
            </div>
            <br>
            
            <?php 
                if(!empty($patients)){
            ?>  
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
                          <th>PATIENT PROFILE</th>
                          
                      </tr>
                      
                  </thead>
                  <?php 
                                                
                                                if(!empty($patients)){
                                                    $count = 1;
                                                    foreach($patients as $patient){
                                            ?>       
                                                <tr class=''>
                                                    <td><?php echo $count++ ?></td>
                                                    <td><?php echo $patient['name'] ?></td>
                                                    <td><?php echo $patient['phone'] ?></td>
                                                    <td><?php echo $patient['email'] ?></td>
                                                    <td><?php echo $patient['gender'] ?></td>
                                                    <td><?php echo $patient['address'] ?></td>
                                                    <td><?php echo $patient['medical_history'] ?></td>
                                                    <td><?php echo $patient['dateadded'] ?></td>
                                                    <td class="">
                                                    <?php 
                                                        
                                                        echo "<button class='dropbtn'><a href= 'patient_profile.php?id=$patient[patient_id]' style='color: white;'>PATIENT PROFILE</a></button>";
                                                        
                                                    ?>
                                                </td>
                                                </tr>
                                                      
                                            <?php
                                                    }
                                                }else{
                                                    echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>Not Found</p>";
                                                }
                                            ?>              
                  </table>
              </div>
            <?php
                }else{
                    echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>Search Patient by Name</p>";
                }
            ?>
        </div>
            </body>
            </html>
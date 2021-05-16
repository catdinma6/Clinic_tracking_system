<?php 
  require_once "../base.php";

  $sql_nur = "SELECT COUNT(`nurse_id`) as num FROM nurse";
  $sql_sec = "SELECT COUNT(`receptionist_id`) as num FROM receptionist";

  $nurs = mysqli_fetch_assoc(mysqli_query($conn, $sql_nur));
  $secs = mysqli_fetch_assoc(mysqli_query($conn, $sql_sec));
  $nurs = $nurs['num'];
  $secs = $secs['num'];
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
            <p>ADMIN | SUPPORT STAFFS </p>  
         
            </div>
            <div class="container">
          <div class="row">
              <div class="column">
                <div class="card">
                  <i class="fa fa-user-md"></i>
                  <br>
                  <h2>Nurses</h2>
                  <br>
                  <p style="font-size: 16px;"><a href = "all_nurses.php">Total Nurses: <?php echo $nurs; ?></a></p>
                  
                <br>
                  <p style="font-size: 16px;"><a href = "add_nurse.php">Add a Nurse </a></p>
             
                </div>
              </div>
            
              <div class="column">
                  <div class="card">
                      <i class="fa fa-user-nurse"></i>
                      <br>
                    <h2>Secretaries</h2>
                    <br>
                    <p style="font-size: 16px;"><a href = "all_secretary.php">Total Secretaries:  <?php echo $secs; ?> </a></p>
                    <br>
                    <p style="font-size: 16px;"><a href = "add_secretary.php">Add a Secretary </a></p>
                    
                  </div>
                </div>
              
                
                  </div>
                   </div>
              </div>


          </body>
          </html>
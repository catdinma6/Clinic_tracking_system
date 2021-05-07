
<?php 
  require_once "../base.php";
?>
<html>
    <head>
        <title>Doctor Dashboard</title>
        <link href="assets/style1.css" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=RocknRoll+One&display=swap" rel="stylesheet">

    </head>
    <body>
       
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

     
        <?php include "header.php" ?>
        <?php include "sidebar.php" ?>

        </div>
        <div class = "body">
          <div class="admin-head">
        <p>DOCTOR | DASHBOARD </p>   
          </div>
        <div class="container">
            
<div class="row">
    <div class="column">
      <div class="card">
        <i class="fa fa-user-md"></i>
        <br>
        <h2>My Profile</h2>
        <br>
        <p><a href = "edit-profile.php">Update Profile</a></p>
   
      </div>
    </div>
  
    <div class="column">
        <div class="card">
            <i class="fa fa-calendar-check"></i>
            <br>
          <h2>My Appointments</h2>
          <br>
          <p><a href = "all_appointment.php">View Appointments history</a></p>
          
        </div>
      </div>
  
        </div>
         </div>
    </div>
    </body>
    </html>
<?php
  require_once "../base.php";
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
          <br>
          <div class="admin-head">   
        <p>ADMIN | DOCTORS </p>  
          </div> 
        <div class="container">
            
<div class="row">
    <div class="column">
      <div class="card">
        <i class="fa fa-user-md"></i>
        <br>
        <br>
        <h2><a href="doctor-specilization.php">Doctors Specialization</a></h2>
        <br>
       
   
      </div>
    </div>
  
    <div class="column">
        <div class="card">
            <i class="fa fa-user-nurse"></i>
            <br>
            <br>
          <h2> <a href="add-doctor.php">Add Doctors</a></h2>
          <br>
        
          
        </div>
      </div>
    
      <div class="column">
        <div class="card">
            <i class="fa fa-users"></i>
            <br>   <br>
          <h2><a href="manage-doctors.php">Manage Doctors</a></h2>
          <br>
         
          
        </div>
      </div>
        </div>
         </div>
    </div>

    </body>
    </html>
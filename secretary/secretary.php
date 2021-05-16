<?php 
  require_once '../base.php';
    
  $sql_pat = "SELECT COUNT(`patient_id`) as num FROM patient";

  $pats = mysqli_fetch_assoc(mysqli_query($conn, $sql_pat));

  $pats = $pats['num'];
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

        </div>
        <div class = "body">
          <br>
          <div class="admin-head">   
        <p>SECRETARY | DASHBOARD </p>  
          </div> 
        <div class="container">
            
<div class="row">
    <div class="column">
      <div class="card">
        <i class="fa fa-user-md"></i>
        <br>
        <h2><a href = "secretary_edit_profile.php">Update Profile</h2>
        <br>
   
      </div>
    </div>
    
      <div class="column">
        <div class="card">
            <i class="fa fa-users"></i>
            <br>
          <h2 >Manage Patients</h2>
          <br>
          <p><a href = "secretary_all_patient.php">Total Patients: <?php echo $pats;?>  </a></p>
          
        </div>
      </div>
        </div>
         </div>
    </div>
    </body>
    </html>
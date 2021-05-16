<?php
    require_once '../base.php';

    $id = (!empty($_GET["id"])) ? $_GET["id"] : '';

    $sql = "SELECT * FROM `admission` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $sql);
    $admission = [];
    if(!empty($result)){
        while ($entry = mysqli_fetch_object($result)) {
           $admission = $entry;
        }
    }
    if(!empty($admission)){
            if(!empty($admission->patient_id)){
                $sql = "SELECT `name` FROM `patient` WHERE `patient_id` = '$admission->patient_id'";
                $result = mysqli_query($conn, $sql);
                $doctor = mysqli_fetch_object($result);
                $admission->patient = $doctor->name;
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'Update'){
                $sql = "UPDATE `admission` SET `report` = '$_POST[report]' ,`discharge_date` = '$_POST[discharge_date]'  WHERE `id` = '$id' ";
                echo $sql;
                if( mysqli_query($conn, $sql)){
                    $fail = "Admission Updated";
                }else{
                    $fail = "Try again";
                }
            }

    }

?>
<html>
    <head>
        <title>Update Admission</title>
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
             <p>DOCTOR | ADMISSION</p>
             </div>
             <br>
         <div class="form-class" style ="padding: 32px;">
           
             <p>Update Admission Data</p>
             
             <?php 
                   if(!empty($fail)){
                       alert($fail);
                   }
               ?>
             <br>
             <form method="POST">
       <br>
     <label for="patient_name">Patient Name</label>
     <input type="text" id="patient_name"  readonly value="<?php echo $admission->patient ?>">
     <br>
     <label for="discharge_date">Discharge Date</label>
     <input type="date" id="discharge_date" value="<?php echo $admission->discharge_date ?>" name="discharge_date">
 
     <label for="history">Report</label>
     <br>
     <textarea rows="4" cols="40" name="report"><?php echo $admission->report ?></textarea>
         <br>
         <input type="submit" name="triggers" value="Update">
     </div>
 
             </form>
 
         </div>
         </body>
         </html>
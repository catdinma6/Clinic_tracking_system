<?php

            require_once '../base.php';//checks if the file has been included if not include.

            //get patients
            $sql = "SELECT * FROM `patient` ORDER BY `name` ASC ";
            $result = mysqli_query($conn, $sql);//performs query against a database
            $patients = [];
            if(!empty($result)){
                while ($entry = mysqli_fetch_object($result)) {//returns the current row of a result-set
                $patients[] = $entry;
                }
            }
            
            //get rooms
            $sql = "SELECT * FROM `room` WHERE `type` != `status` ";
            $result = mysqli_query($conn, $sql);
            $rooms = [];
            if(!empty($result)){
                while ($entry = mysqli_fetch_object($result)) {
                $rooms[] = $entry;
                }
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'ADD'){//Returns the request method used to access the page 
                        
                        $sql = "SELECT * FROM `admission` WHERE `patient_id` = '$_POST[patient]' ORDER BY `dateadded` DESC LIMIT 1";
                        $result = mysqli_query($conn, $sql);
                        $results =  mysqli_fetch_assoc($result);//Fetch results row as an associative array:
                        $admissions = [];
                        if(!empty($results)){
                                $admissions = mysqli_fetch_object($result);
                                if(!empty($admissions)){
                                    $check = strtotime($admissions->discharge_date) > strtotime(date("Y-m-d H:i:s")) ? true : false ;
                                    if($check){
                                        $fail = "Patient already has ongoing admission";
                                    }else{
                                        if(addRoom($_POST['room'])){
                                            $sql = "INSERT INTO `admission` (`patient_id`,`room_id`, `report`, `admitted_date`, `discharge_date`) VALUES ('$_POST[patient]','$_POST[room]','$_POST[report]','$_POST[admitted_date]','$_POST[discharge_date]')";
                                            echo $sql;
                                            if( mysqli_query($conn, $sql)){
                                                $fail = "New admission has been booked";
                                            }else{
                                                $fail = "Error, Try again";
                                            }
                                        }else{
                                            $fail = "Error, Choose another room please";
                                        }
                                    }
                                }
                        }else{
                            
                            if(addRoom($_POST['room'])){
                                $sql = "INSERT INTO `admission` (`patient_id`,`room_id`, `report`, `admitted_date`, `discharge_date`) VALUES ('$_POST[patient]','$_POST[room]','$_POST[report]','$_POST[admitted_date]','$_POST[discharge_date]')";
                                if( mysqli_query($conn, $sql)){
                                    $fail = "New admission has been booked";
                                }else{
                                    $fail = "Error, Try again";
                                }
                            }else{
                                $fail = "Error, Choose another room please";
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
    <body>

          <div class = "body">
            <div class="admin-head">
             <p>ADMIN | ADMISSION</p>
             </div>
             <br>
         <div class="form-class" style ="padding: 32px;">
           
             <p>Add New Admission</p>
               
               <?php 
                   if(!empty($fail)){
                       alert($fail);
                   }
               ?>
             <br>
             <form method="POST">
     <label for="choose_patient"> Patient</label>
     <select id="choose_pat" name="patient">
     <option selected disabled value=''>Choose Patient</option>
        <?php 
            if(!empty($patients)){
                foreach($patients as $patient){
                    echo  "<option value='$patient->patient_id'>$patient->name</option>";
                }
            }else{
                echo  "<option value=''>No Patients</option>";
            }   
        ?>    
       </select>
       <br>
       <label for="choose_room"> Room</label>
       <select id="choose_room" name="room">
       <option selected disabled value=''>Choose Room</option>
        <?php 
        if(!empty($rooms)){
            foreach($rooms as $doc){
            echo  "<option value='$doc->room_id'>Room $doc->room_id - Size: $doc->type heads</option>";
            }
        }else{
            echo  "<option value=''>No rooms available</option>";
        }   
        ?>  
      </select>
<br>
     <label for="app_date">Admitted Date</label>
     <input type="date" id="admitted_date" name="admitted_date">
     <br>
     <label for="next_app_date">Discharged Date</label>
     <input type="date" id="discharge_date" name="discharge_date">
 
     <label for="history">Report</label>
     <br>
     <textarea rows="4" cols="40" name="report"></textarea>
         <br>
         <input type="submit" name="triggers" value="ADD">
     </div>
 
             </form>
 
         </div>
         </body>
         </html>
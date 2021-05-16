<?php
            require_once '../base.php';
            
            //get doctors
            $sql = "SELECT * FROM `doctor` INNER JOIN `specialization` ON  doctor.specialization = specialization.id  ORDER BY `specialization`";
            $result = mysqli_query($conn, $sql);
            $docs = [];
            if(!empty($result)){
                while ($entry = mysqli_fetch_object($result)) {
                $docs[] = $entry;
                }
            }
    
            //get patients
            $sql = "SELECT * FROM `patient` ORDER BY `name` ASC ";
            $result = mysqli_query($conn, $sql);
            $patients = [];
            if(!empty($result)){
                while ($entry = mysqli_fetch_object($result)) {
                $patients[] = $entry;
                }
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'ADD'){
                
                        $sql = "INSERT INTO `appointment` (`receptionist_id`,`doctor_id`,`patient_id`, `report`, `app_date`, `next_app_date`) VALUES ('$userinfo->receptionist_id','$_POST[doctor]','$_POST[patient]','$_POST[report]','$_POST[app_date]','$_POST[next_app_date]')";

                        if( mysqli_query($conn, $sql)){
                            $fail = "New appointment has been booked";
                        }else{
                            $fail = "Error, Try again";
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
             <p>SECRETARY | APPOINTMENT</p>
             </div>
             <br>
         <div class="form-class" style ="padding: 32px;">
           
             <p>Add New Appointment</p>
             
            <?php 
                if(!empty($fail)){
                    alert($fail);
                }
            ?>
             <br>
             <form action="" method="POST">
                <label for="choose_doc"> Doctor</label>
                <select id="choose_doctor" name="doctor">
                <option selected disabled value=''>Choose Doctor</option>
                <?php 
                    if(!empty($docs)){
                        foreach($docs as $doc){
                            echo  "<option value='$doc->doctor_id'>$doc->name - ".ucfirst($doc->value)." </option>";
                        }
                    }else{
                        echo  "<option value=''>No docs</option>";
                    }   
                ?>     
                </select>
     <br>
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
     <label for="app_date">Appointment Date</label>
     <input type="date" id="app_date" value="<?php echo date("Y/m/d") ?>" name="app_date">
     <br>
     <label for="next_app_date">Next Appointment Date</label>
     <input type="date" id="next_app_date" name="next_app_date">
 
     <label for="history">Report</label>
     <textarea rows="4" cols="40" name="report"></textarea>
    <br>
         
    <input type="submit" name="triggers" value="ADD">
     </div>
 
             </form>
 
         </div>
         </body>
         </html>
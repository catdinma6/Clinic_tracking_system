<?php 
    require_once '../base.php';

    
    if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['get_report'])){
        $sql = "SELECT * FROM `appointment` WHERE( DATE(app_date) BETWEEN DATE('$_POST[from_date]') AND DATE('$_POST[to_date]'))";
        $result = mysqli_query($conn, $sql);
        $appointments = [];
        if(!empty($result)){
            while ($entry = mysqli_fetch_object($result)) {
            $appointments[] = $entry;
            }
        }
        if(!empty($appointments)){
            foreach($appointments as $value){
                if(!empty($value->receptionist_id)){
                    $sql = "SELECT `name` FROM `receptionist` WHERE `receptionist_id` = '$value->receptionist_id'";
                    $result = mysqli_query($conn, $sql);
                    $doctor = mysqli_fetch_object($result);
                    $value->receptionist = $doctor->name;
                }else{
                $value->receptionist = 'admin';
                }
                if(!empty($value->patient_id)){
                    $sql = "SELECT `name` FROM `patient` WHERE `patient_id` = '$value->patient_id'";
                    $result = mysqli_query($conn, $sql);
                    $doctor = mysqli_fetch_object($result);
                    $value->patient = $doctor->name;
                }else{
                $value->patient = '';
                }
            }
        }
        $from = $_POST['from_date'];
        $to = $_POST['to_date'];
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
        <p>ADMIN | REPORTS </p>   
       </div>
           <br>
            <br>
            <div class="doc_spec" style="padding: 32px;">
                <h2>Between Dates Reports</h2>
                <br>
            <form action="" method="post">
                <label for="from_date" >From Date:</label><br>
                <input type="date" name="from_date" value="<?php echo (!empty($from)) ? $from : '' ?>">
                <label for="to_date" >To Date:</label>
                <br>
                <input type="date" name="to_date" value="<?php echo (!empty($from)) ? $to : '' ?>">
                <br>
                <input type="submit" name="get_report" value="Submit">
            </form>
            </div>
            <br>

        <?php 
            if(!empty($appointments)){
        ?>  
              <div class="table">
            <table>
              <thead>
                  <tr>
                    <th class="center">SN</th>
                    <th>RECORDED BY</th>
                    <th>PATIENT</th>
                    <th>REPORT</th>
                    <th>APP DATE</th>
                    <th>NEXT APP DATE</th>
                    <th>ACTION</th>
                    
                </tr>
                
            </thead>
            <?php 
                                            if(!empty($appointments)){
                                                $count = 1;
                                                foreach($appointments as $app){
                                        ?>       
                                            <tr class='odd gradeX'>
                                                <td><?php echo $count++ ?></td>
                                                <td><?php echo $app->receptionist ?></td>
                                                <td><?php echo $app->patient ?></td>
                                                <td><?php echo $app->report ?></td>
                                                <td><?php echo $app->app_date ?></td>
                                                <td><?php echo $app->next_app_date ?></td>
                                                <td class="center">
                                                    <?php 
                                                        
                                                        echo "<button class='dropbtn'><a href= 'update_appointment.php?id=$app->id' style='color: white;'>UPDATE INFO</a></button>";
                                                        
                                                    ?>
                                                </td>
                                            </tr>
                                                  
                                        <?php
                                                }
                                            }else{
                                                echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>No appointments</p>";
                                            }
                                        ?>
              </table>
          </div>
        <?php
            }else{
                echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>Select Report Date</p>";
            }
        ?>
        </div>
    </body>
</html>
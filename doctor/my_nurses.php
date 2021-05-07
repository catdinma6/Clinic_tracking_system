<?php
    require_once '../base.php';
    //nurses on duty
    $sql = "SELECT n.name as name, n.doctor_id as doctor_id, n.nurse_id as nurse_id, d.name as doc, n.email as email, n.address as address, n.phone as phone FROM `nurse` as n LEFT JOIN `doctor` as d on n.doctor_id = d.doctor_id WHERE n.doctor_id = '$userinfo->doctor_id' ORDER BY d.name ";
    $result = mysqli_query($conn, $sql);
    if(!empty($result)){
        $nurses = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'unassign'){
        $sql = "UPDATE `nurse` SET `doctor_id` = '' WHERE `nurse_id` = '$_POST[nurse_id]' ";
        if( mysqli_query($conn, $sql)){
            $fail = "Nurse successfully Unassigned";
        }else{
            
            $fail = "Try again";
        }
    }

?>
<html>
    <head>
        <title>Assigned Nurses</title>
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
        <p>DOCTOR | NURSES </p>   
          </div>


          
          <br>
          <hr style="color: grey;">
          <br>
          <h3 style="text-align: center;"> Assigned Nurses </h3>
          <?php 
                if(!empty($fail)){
                    alert($fail);
                }
            ?>
          <br>
          <hr style="color: grey;">
          <div class="table">
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>EMAIL</th>
                                                <th>PHONE</th>
                                                <th>ADDRESS</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            if(!empty($nurses)){
                                                $count = 1;
                                                foreach($nurses as $nurse){
                                        ?>       
                                            <tr class='odd gradeX'>
                                                <td><?php echo $count++ ?></td>
                                                <td><?php echo $nurse['nurse_id'] ?></td>
                                                <td><?php echo ucwords($nurse['name']) ?></td>
                                                <td><?php echo $nurse['email'] ?></td>
                                                <td><?php echo $nurse['phone'] ?></td>
                                                <td><?php echo $nurse['address'] ?></td>
                                                <td class="center">
                                                    <?php 

                                                        if(!empty($nurse['doctor_id'])){
                                                            echo "
                                                            <form action='my_nurses.php' method='post'>
                                                                <input type='hidden' name='nurse_id' value='$nurse[nurse_id]' />
                                                                <button type='submit' name='triggers' value='unassign' class='dropbtn'>UnAssign</button>
                                                            </form>
                                                            ";
                                                        }

                                                    ?>
                                                </td>
                                            </tr>
                                                  
                                        <?php
                                                }
                                            }else{
                                                echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>No Nurses assigned</p>";
                                            }
                                        ?>
                                        </tbody>
                                    </table>           
          </div>
          </div>
          </body>
          </html>
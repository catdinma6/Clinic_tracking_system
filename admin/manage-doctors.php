<?php
    require_once '../base.php';
    
    //select all doctors
    $sql = "SELECT * FROM `doctor` INNER JOIN `specialization` ON  doctor.specialization = specialization.id ";
    $result = mysqli_query($conn, $sql);
    if(!empty($result)){
        $doctors = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <p>ADMIN | MANAGE DOCTORS</p>   
       </div>
           <br>
            <br>
          
            <br>
            <hr style="color: grey;">
            <br>
            <h3 style="text-align: center;">Manage Doctors </h3>
            <br>
            <hr style="color: grey;">
            <div class="table">
                <table>
                <thead>
                    <tr>
                        <th class="center">Doctor ID</th>
                        <th>Specialization</th>
                        <th>Doctor Name</th>
                        <th>Doctor Email</th>
                        <th>Doctor Contact no</th>
                        <th>Doctor Address</th>
                        <th>Action</th>
                        
                    </tr>
                    
                </thead>
                <?php 
                    if(!empty($doctors)){
                        foreach($doctors as $doc){
                ?>
                  <tr>
                    <td><?php echo $doc['doctor_id'] ?></td>
                    <td><?php echo $doc['value'] ?></td>
                    <td><?php echo ucwords($doc['name']) ?></td>
                    <td><?php echo $doc['email'] ?></td>
                    <td><?php echo $doc['phone'] ?></td>
                    <td><?php echo $doc['address'] ?></td>
                    <td> <button class="dropbtn"><a href= "edit-profile.php?id=<?php echo $doc['doctor_id']; ?>" style="color: white;">UPDATE INFO</a></button></td>
                   
                  </tr>
                                                  
                <?php
                        }
                    }else{
                        echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>No doctors added</p>";
                    }
                ?>
                </table>
            </div>
            </div>
            </body>
            </html>
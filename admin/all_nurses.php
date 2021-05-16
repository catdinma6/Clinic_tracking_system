<?php
    require_once '../base.php';
    //nurses on duty
    $sql = "SELECT n.name as name, n.doctor_id as doctor_id, n.nurse_id as nurse_id, d.name as doc, n.email as email, n.address as address, n.phone as phone, n.dateadded as dateadded FROM `nurse` as n LEFT JOIN `doctor` as d on n.doctor_id = d.doctor_id ORDER BY n.dateadded DESC ";
    $result = mysqli_query($conn, $sql);
    if(!empty($result)){
        $nurses = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'delete'){
        $sql = "DELETE FROM `nurse` WHERE `nurse_id` = '$_POST[nurse_id]' ";
        //echo $sql;
        if( mysqli_query($conn, $sql)){
            $fail = "Nurse data has been deleted!";
        }else{
            
            $fail = "Try again";
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
        
        <div class = "body">
          <div class="admin-head">
        <p>ADMIN | NURSES </p>   
          </div>


          
          <br>
          <hr style="color: grey;">
          <br>
          <h3 style="text-align: center;">All Nurses </h3>
          <br>
          <hr style="color: grey;">
          <div class="table">
              <table>
              <thead>
                  <tr>
                      <th class="center">SN</th>
                      <th>ID</th>
                      <th>DOCTOR ASSIGNED</th>
                      <th>NAME</th>
                      <th>EMAIL</th>
                      <th>PHONE</th>
                      <th>ADDRESS</th>
                      <th>DATE ADDED</th>
                      <th>Status</th>
                      <th>ACTION</th>
                  </tr>
                  
              </thead>

              <?php 
                if(!empty($nurses)){
                  $count = 1;
                  foreach($nurses as $nurse){
              ?>                     
                <tr> <td><?php echo $count++ ?></td>
                <td><?php echo $nurse['nurse_id'] ?></td>
                <td><?php echo $nurse['doc'] ?></td>
                <td><?php echo $nurse['name'] ?></td>
                <td><?php echo $nurse['email'] ?></td>
                <td><?php echo $nurse['phone'] ?></td>
                <td><?php echo $nurse['address'] ?></td>
                <td><?php echo $nurse['dateadded'] ?></td>
                 <td>
                 <?php 

                      if(empty($nurse['doctor_id'])){
                        echo '<a class="btn waves-effect waves-light disabled">Available<a>';
                      }else{
                          echo '<a class="btn waves-effect waves-light disabled">Unavailable<a>';
                      }
                      
                      ?>
                 </td>
                <td>
                    <?php
                      echo "
                      <form action='all_nurses.php' method='post'>
                          <input type='hidden' name='nurse_id' value='$nurse[nurse_id]' />
                          <button type='submit' style='margin-top: 5px;' name='triggers' value='delete' class='dropbtn'>Delete</button>
                      </form>
                      ";
                    ?>
                </td>
              </tr>
              <?php
                  }
                }else{
                    echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>No Nurses available</p>";
                }
              ?>
            </table>
          </div>
          </div>
          </body>
          </html>
<?php
    require_once '../base.php';
    //nurses on duty
    $sql = "SELECT * FROM `receptionist`";
    $result = mysqli_query($conn, $sql);
    if(!empty($result)){
        $secretaries = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'delete'){
        $sql = "DELETE FROM `receptionist` WHERE `receptionist_id` = '$_POST[receptionist_id]' ";
        //echo $sql;
        if( mysqli_query($conn, $sql)){
            $fail = "Secretary data has been deleted!";
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
          <p>ADMIN | SECRETARY </p>   
            </div>
            <br>
            <hr style="color: grey;">
            <br>
            <h3 style="text-align: center;">All Secretaries </h3>
            <br>
            <hr style="color: grey;">
            <div class="table">
                <table>
                <thead>
                    <tr>
                        <th class="center">SN</th>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th>ADDRESS</th>
                        <th>DATE ADDED</th>
                        <th>ACTION</th>
                        
                    </tr>
                    
                </thead>
                <?php 
                if(!empty($secretaries)){
                  $count = 1;
                  foreach($secretaries as $secs){
              ?>                     
                <tr> <td><?php echo $count++ ?></td>
                <td><?php echo $secs['receptionist_id'] ?></td>
                <td><?php echo $secs['name'] ?></td>
                <td><?php echo $secs['email'] ?></td>
                <td><?php echo $secs['phone'] ?></td>
                <td><?php echo $secs['address'] ?></td>
                <td><?php echo $secs['dateadded'] ?></td>
                 <td>
                <td>
                    <?php
                      echo "
                      <form action='all_secretary.php' method='post'>
                          <input type='hidden' name='receptionist_id' value='$secs[receptionist_id]' />
                          <button type='submit' style='margin-top: 5px;' name='triggers' value='delete' class='dropbtn'>Delete</button>
                      </form>
                      ";
                    ?>
                </td>
              </tr>
              <?php
                  }
                }else{
                    echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>No secretaries available</p>";
                }
              ?>
                </table>
            </div>
            </div>
            </body>
            </html>
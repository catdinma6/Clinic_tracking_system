<?php
    require_once '../base.php';
    //nurses on duty
    $sql = "SELECT* FROM `room` ORDER BY `room_id`";
    $result = mysqli_query($conn, $sql);
    if(!empty($result)){
        $rooms = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <p>DOCTOR | ROOMS </p>   
          </div>


          
          <br>
          <hr style="color: grey;">
          <br>
          <h3 style="text-align: center;">View All Rooms </h3>
          <br>
          <hr style="color: grey;">
          <div class="table">
              <table>
              <thead>
                  <tr>
                      <th class="center">SN</th>
                      <th>ROOM NUMBER</th>
                      <th>SIZE</th>
                      <th>PATIENTS AVAILABLE</th>
                      <th>DATE ADDED</th>
                      <th>ACTION</th>
                     
                      
                  </tr>
                  
              </thead>

              <?php 
                                            if(!empty($rooms)){
                                                $count = 1;
                                                foreach($rooms as $room){
                                        ?>       
                                            <tr class='odd gradeX'>
                                                <td><?php echo $count++ ?></td>
                                                <td><?php echo $room['room_id'] ?></td>
                                                <td><?php echo $room['type'] ?></td>
                                                <td><?php echo $room['status'] ?></td>
                                                <td><?php echo $room['dateadded'] ?></td>
                                                <td class="center">
                                                    <?php 
                                                        echo "<button class='dropbtn'><a href= 'update_room.php?id=$room[room_id]' style='color: white;'>UPDATE INFO</a></button>"; 
                                                        echo "<button class='dropbtn'><a href= 'view_each_rooms.php?id=$room[room_id]' style='color: white;'>VIEW ROOM</a></button>";
                                                        
                                                    ?>
                                                </td>
                                            </tr>
                                                  
                                        <?php
                                                }
                                            }else{
                                                echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>No rooms found</p>";
                                            }
                                        ?>
                <td>
                    
                    
                </td>
               
              </tr>
              </table>
          </div>
          </div>
          </body>
          </html>
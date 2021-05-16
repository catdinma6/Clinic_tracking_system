<?php
    require_once '../base.php';
    

    $id = (!empty($_GET["id"])) ? $_GET["id"] : '';

    $sql = "SELECT * FROM `room` WHERE `room_id` = '$id'";
    $result = mysqli_query($conn, $sql);
    $room = [];
    if(!empty($result)){
        while ($entry = mysqli_fetch_object($result)) {
           $room = $entry;
        }
    }
    if(!empty($room)){

            if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'Update'){
                if($_POST['type'] < $_POST['status']){
                    $fail = "Room size cannot accomodate this number";
                }else{
                    $sql = "UPDATE `room` SET `type` = '$_POST[type]' ,`status` = '$_POST[status]'  WHERE `room_id` = '$id' ";
                    if( mysqli_query($conn, $sql)){
                        $fail = "Room Updated";
                    }else{
                        $fail = "Try again";
                    }
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
             <p>SECRETARY | ROOM</p>
             </div>
             <br>
         <div class="form-class" style ="padding: 32px;">
           
             <p>Update Room Data</p>
               <?php 
                   if(!empty($fail)){
                       alert($fail);
                   }
               ?>
             <br>
             <form method="POST">
                <!-- <label for="choose_doc">Add New Room</label> -->
              <input type="text" value="<?php echo $room->room_id ?>" readonly placeholder="Room Number">
              <br>
              <input value="<?php echo $room->type ?>" type="text" name="type" placeholder="Room Size"><br>
              <input type="text"  value="<?php echo $room->status ?>"  name="status" placeholder="No of Patients in Room"><br>
     
         
         <input type="submit" name="triggers" value="Update">
     </div>
 
             </form>
 
         </div>
         </body>
         </html>
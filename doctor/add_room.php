<?php

            require_once '../base.php';

            if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['triggers'] == 'Add'){
                
                        $sql = "INSERT INTO `room` (`type`) VALUES ('$_POST[type]')";

                        if( mysqli_query($conn, $sql)){
                            $fail = "New room has been added";
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
             <p>DOCTOR | ROOMS</p>
             </div>
             <br>
         <div class="form-class" style ="padding: 32px;">
           
             <p>Add  New Room</p>
               <?php 
                   if(!empty($fail)){
                       alert($fail);
                   }
               ?>
             <br>
             <form method="POST">
                <!-- <label for="choose_doc">Add New Room</label> -->
              <input type="text" name="type" placeholder="Add new room">
     
         
         <input type="submit" name="triggers" value="Add">
     </div>
 
             </form>
 
         </div>
         </body>
         </html>
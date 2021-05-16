<?php
    require_once '../base.php';
    //patients

    $sql = "SELECT * FROM `log` ORDER BY date_added DESC ";
    $result = mysqli_query($conn, $sql);
    if(!empty($result)){
      $logs = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
            <p>ADMIN | USER LOGS </p>  
         
            </div>
            <br>
            <div class="container">



<table class="table">
    <thead>
        <tr>
            <th class="center">#</th>
            <th>User</th>
            <th>Action</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        if(!empty($logs)){
            $count = 1;
                foreach($logs as $log){
    ?>       
        <tr class='odd gradeX'>
            <td><?php echo $count++ ?></td>
            <td><?php echo $log['user'] ?></td>
            <td><?php echo $log['action'] ?></td>
            <td><?php echo $log['date_added'] ?></td>
        </tr>                                     
    <?php
                }
            }else{
            echo "<p style='margin-left:30px;margin-right:30px;' class='text-light bg-danger text-center'>No Logs in Database</p>";
            }
    ?>
    </tbody>
</table>
</div>
</div>
</body>
</html>
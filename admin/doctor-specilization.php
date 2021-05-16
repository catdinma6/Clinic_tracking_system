<?php 
  require_once "../base.php";

  if(isset($_POST['doc_specialization'])){
    $sql = "INSERT INTO specialization (`value`) VALUES ('$_POST[doc_spec]')";
    if(mysqli_query($conn,$sql)){
        $fail="Specialization added";
    }else{
        $fail=mysqli_error($conn);
    }
  }
  $results = [];
  $result = mysqli_query($conn, "SELECT * FROM specialization");
  if(!empty($result)){
      while ($arr =  mysqli_fetch_array($result,1)){
        $results[] = $arr;
      }
  }
  if($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['delete'])){
    $sql = "DELETE FROM `specialization` WHERE `id` = '$_POST[spec_id]' ";
    //echo $sql;
    if( mysqli_query($conn, $sql)){
        $fail = "Specialization has been deleted!";
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
        <p>ADMIN | DOCTOR SPECIALIZATION </p>   
        <?php 
                if(!empty($fail)){
                    alert($fail);
                }
            ?>
       </div>
           <br>
            <br>
            <form action=""  method="post">
                <div class="doc_spec">
                    <label for="doctor_specialization" >Doctor Specialization</label>
                    <input type="text" name="doc_spec" placeholder="Enter Doctor Specialization" required style="color: lightgray;">
                    <br>
                    <input type="submit" name="doc_specialization" value="ADD">
                </div>
            </form>
            <br>
            <hr style="color: grey;">
            <br>
            <p>Manage Doctor Specialization</p>
            <div class="table">
                <table>
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Specialization</th>
                        <th class="hidden-xs">Creation Date</th>
                        <th>Action</th>
                    </tr>
                    
                </thead>
                <?php
                    if(!empty($result)){
                        foreach($result as $res){
                ?>
                <tr>
                    <td><?php echo $res['id'] ?></td>
                    <td><?php echo $res['value'] ?></td>
                    <td><?php echo $res['dateadded'] ?></td>
                    <td>
                    <?php
                      echo "
                      <form action='doctor-specilization.php' method='post'>
                          <input type='hidden' name='spec_id' value='$res[id]' />
                          <button type='submit' style='margin-top: 5px;' name='delete' class='dropbtn'>Delete</button>
                      </form>
                      ";
                    ?>
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
                  <tr>
                    
                   
                  </tr>
                </table>
            </div>
            </div>
            </body>
            </html>
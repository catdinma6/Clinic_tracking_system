
<?php 
  require_once "../base.php";

    $id = (!empty($userinfo->nurse_id)) ? $userinfo->nurse_id : '';
    if(!empty($id)){
        $sql = "SELECT * FROM nurse";
        $result = mysqli_query($conn, $sql);
        if(!empty($result)){
            $nurse = mysqli_fetch_assoc($result);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['what'] == 'Update'){
            $sql = "UPDATE `nurse` SET `name` = '$_POST[d_name]', `phone` = '$_POST[d_phone]', `address` = '$_POST[d_address]' WHERE `email` = '$_POST[d_email]' ";
            if( mysqli_query($conn, $sql)){
                $fail = "Data has been updated. Please login again";
            }else{
                $fail = "Error, Try again ".mysqli_error($conn);
            }
            
        }

    }else{
        $fail = "No Nurse Found";
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
        <p>NURSE | EDIT NURSE PROFILE</p>
        
        <?php 
                if(!empty($fail)){
                    alert($fail);
                }
            ?>
        </div>
        <br>
        <div class="form-class">
         
        <form action="" method="POST">
							
                            <div class="doc_spec">
                                <br>
                                <label for="doc_name">Nurse Name</label>
                                <input type="text" id="doc_name" name="d_name" value="<?php echo $nurse['name'] ?>" placeholder="Enter Nurse Name">
                            <br>
                                <label for="doc_name">Doctor Assigned</label>
                                <input type="text" id="doc_name" readonly value="<?php echo $nurse['doctor_id'] ?>" />
                            <br>
                            <label for="d_email">Nurse Email</label>
                            <input type="text" id="doc_email" name="d_email" value="<?php echo $nurse['email'] ?>" readonly  placeholder="Enter Nurse Email ">
                            <br>
                            <label for="d_phone">Nurse Contact number</label>
                            <input type="text" id="doc_phone" name="d_phone" value="<?php echo $nurse['phone'] ?>" placeholder="Enter Nurse Contact Number">
                            
                            <br>
                            <label for="doc_address"> Nurse Home Address</label>
                                    <input type="text" id="doc_address" name="d_address" value="<?php echo $nurse['address'] ?>" placeholder="Enter Nurse Home Address">
                            <input type="submit" name="what" value="Update">
                            </div>
                            </form>
    </div>
            </form>
        </div>
        </body>
        </html>
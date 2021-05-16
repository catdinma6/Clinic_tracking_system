
<?php 
  require_once "../base.php";

    $id = (!empty($userinfo->receptionist_id)) ? $userinfo->receptionist_id : '';
    if(!empty($id)){
        $sql = "SELECT * FROM receptionist";
        $result = mysqli_query($conn, $sql);
        if(!empty($result)){
            $receptionist = mysqli_fetch_assoc($result);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['what'] == 'Update'){
            $sql = "UPDATE `receptionist` SET `name` = '$_POST[d_name]', `phone` = '$_POST[d_phone]', `address` = '$_POST[d_address]' WHERE `email` = '$_POST[d_email]' ";
            if( mysqli_query($conn, $sql)){
                $fail = "Data has been updated. Please login again";
            }else{
                $fail = "Error, Try again ".mysqli_error($conn);
            }
            
        }

    }else{
        $fail = "No secretary Found";
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
        <p>Secretary | EDIT PROFILE</p>
        
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
                                <label for="doc_name">Secretary Name</label>
                                <input type="text" id="doc_name" name="d_name" value="<?php echo $receptionist['name'] ?>" placeholder="Enter receptionist Name">
                            <br>
                            <label for="d_email">Secretary Email</label>
                            <input type="text" id="doc_email" name="d_email" value="<?php echo $receptionist['email'] ?>" readonly  placeholder="Enter receptionist Email ">
                            <br>
                            <label for="d_phone">Secretary Contact number</label>
                            <input type="text" id="doc_phone" name="d_phone" value="<?php echo $receptionist['phone'] ?>" placeholder="Enter receptionist Contact Number">
                            
                            <br>
                            <label for="doc_address"> Secretary Home Address</label>
                                    <input type="text" id="doc_address" name="d_address" value="<?php echo $receptionist['address'] ?>" placeholder="Enter receptionist Home Address">
                            <input type="submit" name="what" value="Update">
                            </div>
                            </form>
    </div>
            </form>
        </div>
        </body>
        </html>
<?php 
  require_once "../base.php";

  $sql = "SELECT * FROM specialization";
  $result = mysqli_query($conn, $sql);
    if(!empty($result)){
        $specs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    
    if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['what'] == 'Submit'){
        $err = 0;     
        $id = "d-".rand(100,999).'-'.rand(100,999);
        
        if(!empty($_POST['d_password']) && $_POST['d_password'] == $_POST['d_cpassword']){
            $password = base64_encode($_POST['d_password']);
        }else{
            $err++;
            $fail = "Passwords dont match";
        }

        if($err == 0){
            $sql = "SELECT `doctor_id` from `doctor` WHERE `doctor_id`  = '$id'";
            if($result = mysqli_query($conn, $sql)){
                if(mysqli_num_rows($result)==0){
                    $sql = "INSERT INTO `doctor` (`doctor_id`, `name`, `email`, `phone`, `address`,`password`,`specialization`) VALUES 
                    ('$id','$_POST[d_name]','$_POST[d_email]','$_POST[d_phone]','$_POST[d_address]','$password','$_POST[spec]')";
                    if( mysqli_query($conn, $sql)){
                        $fail = "New doctor has been added";
                    }else{
                        $fail = "Error, Try again ".mysqli_error($conn);
                    }
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
        
        <div class = "body">
            <div class="admin-head">
        <p>ADMIN | DOCTOR </p>   
       </div>
           <br>
            <br>
            <div class="form-class" style ="padding: 32px;">
            <p>Add Doctor</p>
            <?php 
                if(!empty($fail)){
                    alert($fail);
                }
            ?>
            <br>
            <form action="" method="POST">
							
            <div class="doc_spec">
                <label for="doctor_specialization" >Doctor Specialization</label>
                <select id="specialization" name="spec">
                
                <?php 
                    if(!empty($specs)){
                        foreach($specs as $spec){
                    ?>      
                    <option value="<?php echo $spec['id'] ?>"><?php echo ucwords($spec['value']); ?></option>
                <?php 
                        }
                    }else{
                        echo "<option value=''>Empty</option>";
                    }
                ?>
                </select>
                <br>
                <label for="doc_name">Doctor Name</label>
                <input type="text" id="doc_name" name="d_name" placeholder="Enter Doctor Name">
            <br>
            <label for="d_email">Doctor Email</label>
            <input type="text" id="doc_email" name="d_email" placeholder="Enter Doctor Email ">
            <br>
            <label for="d_phone">Doctor Contact number</label>
            <input type="text" id="doc_phone" name="d_phone" placeholder="Enter Doctor Contact Number">
            
            <br>
            <label for="doc_address"> Doctor Home Address</label>
                    <input type="text" id="doc_address" name="d_address" placeholder="Enter Doctor Home Address">
                <br>
                <label for="doc_password">Password</label>
                <input type="password" id="doc_password" name="d_password" placeholder="Enter Password"><br>
                <label for="doc_cpassword">Confirm Password</label>
                <input type="password" id="doc_cpassword" name="d_cpassword" placeholder="Confirm Password">
                <br>
                <input type="submit" name="what" value="Submit">
            </div>
            </form>
            <br>
            <hr style="color: lightgray;">
            </div>
            </div>
            </body>
            </html>
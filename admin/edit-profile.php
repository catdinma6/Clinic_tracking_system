
<?php 
  require_once "../base.php";

  $sql = "SELECT * FROM specialization";
  $result = mysqli_query($conn, $sql);
    if(!empty($result)){
        $specs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    $id = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if(!empty($id)){
        $sql = "SELECT * FROM doctor INNER JOIN `specialization` on doctor.specialization = specialization.id WHERE `doctor_id` = '$id'";
        $result = mysqli_query($conn, $sql);
        if(!empty($result)){
            $doctor = mysqli_fetch_assoc($result);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['what'] == 'Update'){
            $sql = "UPDATE `doctor` SET `name` = '$_POST[d_name]', `phone` = '$_POST[d_phone]', `address` = '$_POST[d_address]', `specialization` = '$_POST[spec]' WHERE `email` = '$_POST[d_email]' ";
            if( mysqli_query($conn, $sql)){
                $fail = "New doctor has been updated";
            }else{
                $fail = "Error, Try again ".mysqli_error($conn);
            }
            
        }

    }else{
        $fail = "No doctor Found";
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
        <p>ADMIN | UPDATE DOCTOR RECORD</p>
        
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
                                <label for="doctor_specialization" >Doctor Specialization</label>
                                <select id="specialization" name="spec">
                                
                                <?php 
                                    if(!empty($specs)){
                                        foreach($specs as $spec){
                                    ?>      
                                    <option <?php echo ($spec['id'] == $doctor['value'] ? 'selected' : '') ?> value="<?php echo $spec['id'] ?>"><?php echo ucwords($spec['value']); ?></option>
                                <?php 
                                        }
                                    }else{
                                        echo "<option value=''>Empty</option>";
                                    }
                                ?>
                                </select>
                                <br>
                                <label for="doc_name">Doctor Name</label>
                                <input type="text" id="doc_name" name="d_name" value="<?php echo $doctor['name'] ?>" placeholder="Enter Doctor Name">
                            <br>
                            <label for="d_email">Doctor Email</label>
                            <input type="text" id="doc_email" name="d_email" value="<?php echo $doctor['email'] ?>" readonly  placeholder="Enter Doctor Email ">
                            <br>
                            <label for="d_phone">Doctor Contact number</label>
                            <input type="text" id="doc_phone" name="d_phone" value="<?php echo $doctor['phone'] ?>" placeholder="Enter Doctor Contact Number">
                            
                            <br>
                            <label for="doc_address"> Doctor Home Address</label>
                                    <input type="text" id="doc_address" name="d_address" value="<?php echo $doctor['address'] ?>" placeholder="Enter Doctor Home Address">
                            <input type="submit" name="what" value="Update">
                            </div>
                            </form>
    </div>
            </form>
        </div>
        </body>
        </html>

<?php 
  require_once "../base.php";

  $sql = "SELECT * FROM specialization";
  $result = mysqli_query($conn, $sql);
    if(!empty($result)){
        $specs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    $id = (!empty($_GET['id'])) ? $_GET['id'] : '';
    if(!empty($id)){
        $sql = "SELECT * FROM patient WHERE `patient_id` = '$id'";
        $result = mysqli_query($conn, $sql);
        if(!empty($result)){
            $patient = mysqli_fetch_assoc($result);
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST' and $_POST['what'] == 'Update'){
            $sql = "UPDATE `patient` SET `name` = '$_POST[pat_name]', `phone` = '$_POST[pat_phone]', `address` = '$_POST[pat_address]', `medical_history` = '$_POST[medical_history]' WHERE `patient_id` = '$id' ";
            if( mysqli_query($conn, $sql)){
                $fail = "Patient has been updated";
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
        <p>DOCTOR | UPDATE PATIENT RECORD</p>
        
        <?php 
                if(!empty($fail)){
                    alert($fail);
                }
            ?>
        </div>
        <br>
        <div class="form-class">
         
        <form action="" method="POST">
							
        <label for="patient_name">Patient Name</label>
        <input type="text" id="patient_name" value="<?php echo $patient['name'] ?>"  name="pat_name">
    <br>
    <label for="patient_phone">Patient Contact number</label>
    <input type="text" id="patient_phone" value="<?php echo $patient['phone'] ?>" name="pat_phone">
    <br>
    <label for="patient_email">Patient Email</label>
    <input type="text" id="patient_email" value="<?php echo $patient['email'] ?>" readonly name="pat_email">
    <br>
    <label for="patient_age"> Patient Date Of Birth</label>
    <input type="date" id="patient_dob" value="<?php echo $patient['dob'] ?>" readonly name="pat_dob">
    <br>
    <label for="gender">Gender</label>
    <br>
    <br>
    <input type="radio" id="male" name="pat_gender" <?php echo ($patient['gender'] == 'male') ? 'checked' : ''; ?> value="male">
    <label for="male">Male</label>
    <input type="radio" id="female" name="pat_gender" <?php echo ($patient['gender'] == 'female') ? 'checked' : ''; ?> value="female">
    <label for="female">Female</label>
    <br>
    <br>
    <label for="patient_address">Patient Address</label>
    <input type="text" id="patient_address" value = "<?php echo $patient['address'] ?>" name="pat_add">
    <label for="history">Medical History</label>
    <br>
    <textarea rows="4" cols="40" name="medical_history" >
    <?php echo $patient['medical_history']; ?>
    </textarea>
        <input type="submit" name="what" value="Update">
        </div>
    </form>
    </div>
            </form>
        </div>
        </body>
        </html>

      
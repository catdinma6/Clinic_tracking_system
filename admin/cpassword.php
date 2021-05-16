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
        <p>ADMIN | CHANGE PASSWORD </p>   
       </div>
       <br>
       <br>
       <h2 style="margin-left: 35px;">Change Password</h2>
                  <br>
            <br>
            <div class="doc_spec" style="padding: 32px;">
               
                <label for="current password" >Current Password</label><br>
                <input type="password" name="current_password" placeholder="Enter Current Password">
                <br>
                <label for="new password" >New Password</label><br>
                <input type="password" name="new_password" placeholder="New Password">
                <br>
                <label for="confirm password" >Confirm Password</label><br>
                <input type="password" name="confirm_password" placeholder="Confirm Password">
                <br>
                <input type="submit" value="Submit">
            </div>
            <br>
            </div>
            </body>
            </html>
<?php

function alert($alert = ''){
    echo "
        <div style='alert-info vertical-align: middle; align-self: center; width: 50% !important; top: 140px;'>$alert</div>
    ";
}

function logger($user = '', $action = ''){
    global $conn;
        $sql = "INSERT INTO `log`(`user`,`action`) VALUES ('$user','$action')";
        mysqli_query($conn,$sql);
        echo mysqli_error($conn);
}


function addRoom($roomid){
    global $conn;
    $sql = "SELECT * FROM `room` WHERE `room_id` = '$roomid'";
      $result = mysqli_query($conn, $sql);
      $room = [];
      $lat = false;
      if(!empty($result)){
            while ($entry = mysqli_fetch_object($result)) {
                $room = $entry;
            }
          $status = $room->status;
          $type = $room->type;
          if($type > $status){
              $status++;
              $sql = "UPDATE `room` SET `status` = '$status'  WHERE `room_id` = '$roomid' ";
  
              if(mysqli_query($conn, $sql)){
                $lat =  true;
              }
          }else{
            $lat = false;
          }
      }
      return $lat;
  }
/* Database credentials*/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'medical');
 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
<?php
// variables to connect to database. this will only work on the teacher's account. I'll have to enter my info
    $db_server_Name = "localhost:3306";
    $db_user_name = "root";
    $db_password = 'Leasure12$';
    $db_name = "if0_37344754_login_credentials";

// $dbconn= mysqli_connect($db_server_Name, $db_user_name, $db_password, $db_name);
// if(!$dbconn){
    // echo "Connection failed.";
// }
// 
try {
    $conn = new PDO("mysql:host=$db_server_Name ;dbname=if0_37344754_login_credentials", $db_user_name, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
  ?>

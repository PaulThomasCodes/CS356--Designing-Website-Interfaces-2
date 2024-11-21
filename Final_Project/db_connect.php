<?php
// variables to connect to database. this will only work on the teacher's account. I'll have to enter my info
    $db_server_Name = "sql303.infinityfree.com";
    $db_user_name = "if0_37344754";
    $db_password = '07RtTRICoj ';
    $db_name = "if0_37344754_tbl_spacecraft_id";

$dbconn= mysqli_connect($db_server_Name, $db_user_name, $db_password, $db_name);
if(!$dbconn){
    echo "Connection failed.";
}
?>

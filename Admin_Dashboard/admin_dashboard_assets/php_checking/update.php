<?php
session_start();
include_once "../../../config.php";
$incoming_id = 600628041;
$outgoing_id = $_POST['freelancer'];

$sql = mysqli_query($conn,"UPDATE message SET state = 'read' WHERE incoming_msg_id ={$incoming_id} AND outgoing_msg_id ={$outgoing_id} AND state = 'unread' ");
if($sql){
    echo "success";
}else{
    echo mysqli_error($conn);
}


?>
<?php
include_once("../config.php");

if(isset($_GET['action'])){
    $action = $_GET['action'];
}

if($action == 'delete'){
    $booking_id = $_POST['booking_id'];
    $output = array();
    $sql = "UPDATE booking SET booking_status='0' WHERE booking_id = '$booking_id'";
    // $sql = "DELETE FROM booking WHERE booking_id = '$booking_id'";
    if($conn->query($sql)){
        $output['status'] = 'success';
        $output['message'] = 'รายการจองได้ลบสำเร็จแล้ว!';
    }
    else{
        $output['status'] = 'error';
        $output['message'] = 'Something went wrong in deleting the member';
    }

    echo json_encode($output);

}
?>


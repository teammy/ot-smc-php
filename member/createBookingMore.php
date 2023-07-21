<?php
include_once("../config.php");

if (isset($_POST)) {
    $output = array();
    if (BookingCreateMore()) {
        $output['status'] = 'success';
        $output['message'] = 'จองสำเร็จแล้ว!';
    } else {
        $output['status'] = 'error';
        $output['message'] = 'Something went wrong in deleting the member';
    }

    echo json_encode($output);
}

function BookingCreateMore()
{
    global $conn;

    $user_booking_id = $_POST['input-name'];
    $booking_id_random = rand(100000, 999999);
    $booking_date_select = $_POST['booking_date_input'];
    $ot_select = $_POST['ot_select'];
    $user_booking_phone = $_POST['user_phone'];
    $position_id =  $_POST['position'];
    $ward_id = $_POST['ward'];
    $booking_status = $_POST['booking_status'];

    //   $check_already_sql = "SELECT booking_id FROM booking WHERE booking_date=? AND ot_time_select=?";
    //   $show_doc_com = getSingleRecord($check_already_sql, 'si', [$booking_date_select, $ot_select]);

    //   if ($show_doc_com) {
    //     echo "Already!!";
    //   } else {
    $sql = "INSERT INTO booking SET booking_id_random=?,user_booking_id=?,booking_date=?,ot_time_select=?,user_phone=?,position_id=?,ward_id=?,booking_status=?,user_reserve_id=?";
    $booking_on_create = modifyRecord($sql, 'sisisiiii', [$booking_id_random, $user_booking_id, $booking_date_select, $ot_select, $user_booking_phone, $position_id, $ward_id, $booking_status,$user_booking_id]);


    return $booking_on_create;
}

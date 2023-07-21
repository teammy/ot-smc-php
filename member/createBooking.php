<?php
include_once("../config.php");

function SlotCreate()
{
  if(isset($_SESSION['user']['id'],$_POST['dateSelect'],$_SESSION['user']['position_id'],$_SESSION['user']['ward_id'],$_POST['slot'],$_POST['user_phone'])) {

  $user_booking_id = $_SESSION['user']['id'];
  $booking_date_select = $_POST['dateSelect'];
  $user_booking_phone = $_POST['user_phone'];
  $position_id =  $_SESSION['user']['position_id'];
  $ward_id = $_SESSION['user']['ward_id'];
  $booking_status = 1;
  $ot_time_select = 2;

  $sql = "INSERT INTO booking SET user_booking_id=?,booking_date=?,user_phone=?,position_id=?,ward_id=?,booking_status=?,user_reserve_id=?,ot_time_select=?";
  $booking_on_create = modifyRecord($sql, 'issiiiii', [$user_booking_id, $booking_date_select, $user_booking_phone, $position_id, $ward_id, $booking_status, $user_booking_id, $ot_time_select]);

  return $booking_on_create;
  }
  else {
    echo "Something went wrong";
  }
}

if (isset($_POST)) {
  $output = array();

  if (SlotCreate()) {
    $output['status'] = 'success';
    $output['message'] = 'บันทึกข้อมูลสำเร็จ!';
  } else {
    $output['status'] = 'error';
    $output['message'] = 'Something went wrong in deleting the member';
  }

  echo json_encode($output);
}


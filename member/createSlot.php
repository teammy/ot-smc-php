<?php
include_once("../config.php");


function SlotCreate()
{
  $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  $positionIds =  [22, 89, 126];
  $allSuccess = true;


  foreach ($positionIds as $positionId) {
    foreach ($days as $day) {
      $otCount = $_POST[$day . '_' . $positionId];
      if (!empty($otCount)) {
        $sql = "SELECT * FROM ot_reservations WHERE day_of_week=? AND position_id=?";
        $existingRecord = getSingleRecord($sql, 'si', [$day, $positionId]);

        if($existingRecord) {
          $sql = "UPDATE ot_reservations SET ot_count=? WHERE day_of_week=? AND position_id=?";
          $slot_update = modifyRecord($sql, 'isi', [$otCount, $day, $positionId]);
          if (!$slot_update) {
            $allSuccess = false;
            break 2;
          }
          continue;
        } else {
          $sql = "INSERT INTO ot_reservations SET day_of_week=?,ot_count=?,position_id=?";
          $slot_create = modifyRecord($sql, 'sii', [$day, $otCount, $positionId]);
          if (!$slot_create) {
            $allSuccess = false;
            break 2;
          }
        }

       
      }
    }
  }
  return $allSuccess;
}

if (isset($_POST)) {
  $output = array();
  error_log(print_r($_POST, true));
  if (SlotCreate()) {
    $output['status'] = 'success';
    $output['message'] = 'บันทึกข้อมูลสำเร็จ!';
  } else {
    $output['status'] = 'error';
    $output['message'] = 'Something went wrong in deleting the member';
  }

  echo json_encode($output);
}


//   $user_booking_id = $_SESSION['user']['id'];
//   $booking_id_random = rand(100000, 999999);
//   $booking_date_select = $_POST['booking_date_input'];
//   $ot_select = $_POST['ot_select'];
//   $user_booking_phone = $_POST['user_phone'];
//   $position_id =  $_SESSION['user']['position_id'];
//   $ward_id = $_SESSION['user']['ward_id'];
//   $booking_status = $_POST['booking_status'];

// //   $check_already_sql = "SELECT booking_id FROM booking WHERE booking_date=? AND ot_time_select=?";
// //   $show_doc_com = getSingleRecord($check_already_sql, 'si', [$booking_date_select, $ot_select]);

// //   if ($show_doc_com) {
// //     echo "Already!!";
// //   } else {
//     $sql = "INSERT INTO booking SET booking_id_random=?,user_booking_id=?,booking_date=?,ot_time_select=?,user_phone=?,position_id=?,ward_id=?,booking_status=?,user_reserve_id=?";
//     $booking_on_create = modifyRecord($sql, 'sisisiiii', [$booking_id_random, $user_booking_id, $booking_date_select, $ot_select, $user_booking_phone, $position_id, $ward_id, $booking_status,$user_booking_id]);
    
//     return $booking_on_create;

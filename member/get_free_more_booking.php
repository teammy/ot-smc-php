<?php
include('../config.php');
$user_no = $_SESSION['user']['id'];
$position_id = $_SESSION['user']['position_id'];

// $posit_more_booking = $_GET['position_id'];


$arr = array("1", "2", "3");

$booking_date_select = $_GET['date_select'];

$date_now = new DateTime($booking_date_select);
$date_now->add(DateInterval::createFromDateString('yesterday'));
$yesterday = $date_now->format('Y-m-d');

// $sql_yesterday = "SELECT ot_time_select FROM booking WHERE booking_date='$yesterday' AND user_booking_id='$user_no' AND ot_time_select='3'";
// $query_yesterday = mysqli_query($conn, $sql_yesterday);
// $count_yesterday = mysqli_num_rows($query_yesterday);
// echo $count_yesterday;


// while ($result_yst = mysqli_fetch_assoc($query_yesterday)) {
//     echo $result_yst['ot_time_select'];
// }

//echo $count_yesterday;



// $sql = "SELECT * FROM booking where booking_date='$booking_date_select'";

$sql = "SELECT * FROM booking where booking_date='$booking_date_select'";

//$sql = "SELECT * FROM booking where booking_date='$booking_date_select' AND position_id=22";


$query = mysqli_query($conn, $sql);
$rowcount = mysqli_num_rows($query);
while ($result = mysqli_fetch_assoc($query)) {
    $ot_array[] = $result['ot_time_select'];
}


// reture free slot

if ($rowcount > 0) {

    $valid_array = array_diff($arr, $ot_array);
    $export_im = implode(',', $valid_array);

    $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN ($export_im)";
    $query_valid_array = mysqli_query($conn, $sql_valid_array);
    $json = array();
    while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
        array_push($json, $result2);
    }
    echo json_encode($json);
} else {
    $sql2 = "SELECT * FROM ot_time_group";
    $query = mysqli_query($conn, $sql2);
    $json = array();
    while ($result = mysqli_fetch_assoc($query)) {
        array_push($json, $result);
    }
    echo json_encode($json);
}

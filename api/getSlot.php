<?php
include('../config.php');

if (!isset($_SESSION['user']['position_id'])) {
  echo "Session position_id is not set";
  exit;
}
$datename = $_GET['datename'];
$formatdate = $_GET['formatdate'];
// echo $datename;
// echo $formatdate;

$sql = getSingleRecord("SELECT ot_count FROM ot_reservations WHERE day_of_week=? AND position_id=?", "si", [$datename, $_SESSION['user']['position_id']]);
if ($sql === false) {
  echo "Query failed";
  exit;
}

$sql_step2 = "SELECT COUNT(*) as bookFree FROM booking WHERE booking_date=? AND position_id=? AND user_booking_id IN (?)";
$sql_book = getSingleRecord($sql_step2, "sii", [$formatdate, $_SESSION['user']['position_id'],$_SESSION['user']['id']]);

if ($sql_book['bookFree'] == '1') {
  echo "0";
} else {
$free_slot = $sql['ot_count'] - $sql_book['bookFree'];
echo $free_slot;
}

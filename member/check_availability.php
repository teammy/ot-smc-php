<?php
include('../config.php');

$date = $_POST['date_select'];
$positionId = $_POST['positionId'];

$sql = "SELECT COUNT(*) as count FROM `booking` WHERE `booking_date`=? AND `position_id`=? ";
$result = getSingleRecord($sql, "si", [$date, $positionId]);

$response = ["available" => $result['count'] < $OTCount];
echo json_encode($response);
?>
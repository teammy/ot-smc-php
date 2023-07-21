<?php

session_start(); // start session
// connect to database
$conn = new mysqli("10.10.12.113", "tsm", "ktn@tsm", "db_ot_smc");
$conn->set_charset('utf8');
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set('Asia/Bangkok');
// define global constants
define('ROOT_PATH', realpath(dirname(__FILE__))); // path to the root folder
define('INCLUDE_PATH', realpath(dirname(__FILE__) . '/includes')); // Path to includes folder
define('BASE_URL', 'http://localhost:5500/'); // the home url of the website
// include('vendor/autoload.php');

$year = date("Y") + 543;
$time = substr($year, 2, 4);

$web_des = "ระบบจองโอที";


function thai_date($datetime, $format, $clock)
{
	list($date, $time) = explode(' ', $datetime);
	list($H, $i, $s) = explode(':', $time);
	list($Y, $m, $d) = explode('-', $date);
	$Y = $Y + 543;

	$month = array(
		'0' => array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฏาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤษจิกายน', '12' => 'ธันวาคม'),
		'1' => array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค.', '04' => 'เม.ย.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.')
	);
	if ($clock == false)
		return $d . ' ' . $month[$format][$m] . ' ' . $Y;
	else
		return $d . ' ' . $month[$format][$m] . ' ' . $Y . ' เวลา ' . $H . ':' . $i . ' น.';
}

function thai_month($date, $format)
{
	list($Y, $m, $d) = explode('-', $date);
	$Y = $Y + 543;

	$month = array(
		'0' => array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฏาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤษจิกายน', '12' => 'ธันวาคม'),
		'1' => array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค.', '04' => 'เม.ย.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.')
	);
	return $d . ' ' . $month[$format][$m] . ' ' . $Y;
}


function getMultipleRecords($sql, $types = null, $params = [])
{
	global $conn;
	$stmt = $conn->prepare($sql);

	if($stmt === false) {
		die('prepare() failed: ' . htmlspecialchars($conn->error));
	}

	if (!empty($params)) { // parameters must exist before you call bind_param() method
		$stmt->bind_param($types, ...$params);
	}
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_all(MYSQLI_ASSOC);
	$stmt->close();
	return $user;
}

function getSingleRecord($sql, $types, $params)
{
	global $conn;
	$stmt = $conn->prepare($sql);
	$stmt->bind_param($types, ...$params);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	$stmt->close();
	return $user;
}

function modifyRecord($sql, $types, $params)
{
	global $conn;
	$stmt = $conn->prepare($sql);
	$stmt->bind_param($types, ...$params);
	$result = $stmt->execute();
	$stmt->close();
	return $result;
}

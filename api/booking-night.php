<?php
header("Access-Controls-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$dbh = new PDO('mysql:host=localhost;dbname=tsm_otcenter;charset=utf8', 'tsm_otcenter', 'admin1037');
try {
    $posit_id = $_GET['positid'];

    if ($posit_id==27 || $posit_id==89 || $posit_id==126 || $posit_id==51) {
        $sql = 'SELECT b.*,CONCAT(u.person_firstname," ",u.person_lastname) as person_name from booking b
        INNER JOIN users u ON b.user_booking_id = u.id
        WHERE b.ot_time_select=1 AND b.booking_status=1 AND b.position_id IN (27,89,126,51)';
    } else {
        $sql = 'SELECT b.*,CONCAT(u.person_firstname," ",u.person_lastname) as person_name from booking b
        INNER JOIN users u ON b.user_booking_id = u.id
        WHERE b.ot_time_select=1 AND b.booking_status=1 AND b.position_id IN (22)';
    }

    $attractions = array();
    // foreach ($dbh->query('SELECT * from booking WHERE ot_time_select=1 AND position_id='.$posit_id.'') as $row) {
        foreach ($dbh->query($sql) as $row) {

        $result = array(
            'title' => 'เวรดึก',
            'id' => $row['booking_id'],
            'user_booking_id' => $row['user_booking_id'],
            'start' => $row['booking_date'],
            'posit_id' => $row['position_id'],
            'phone' => $row['user_phone'],
            'name' => $row['person_name']
        );
       array_push($attractions, $result);
    }
    $json = json_encode($attractions);

   echo json_encode($attractions);
    $dbh = null;
    
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>
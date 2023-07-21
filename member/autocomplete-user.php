<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
include('../config.php');

if (!isset($_GET['idUser'])) {
    $json = [];
} else {
    $id_user = $_GET['idUser'];
    $sql = "SELECT u.id,concat(u.person_firstname,' ',u.person_lastname) as flname,po.position_name,os.ward_name FROM users u
    INNER JOIN office_sit os ON u.office_id = os.ward_id 
    INNER JOIN position po ON u.position_id = po.position_id
    WHERE u.id=$id_user AND po.position_id IN (22,89)";

    $result = $conn->query($sql);
    $json = [];
    while ($row = $result->fetch_assoc()) {
        $user = array(
            'id' => $row['id'], 
            'posit_name' => $row['position_name'],
            'ward_name' => $row['ward_name'],
        );
    }
    echo json_encode($user);
}



?>

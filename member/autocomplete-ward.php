<?php
include('../config.php');

if (!isset($_GET['searchWard'])) {
    $json = [];
} else {
    $search = $_GET['searchWard'];
    $sql = "SELECT * FROM office_sit 
                WHERE ward_name LIKE '%" . $search . "%' 
                LIMIT 10";
    $result = $conn->query($sql);
    $json = [];
    while ($row = $result->fetch_assoc()) {
        $json[] = ['id' => $row['ward_id'], 'text' => $row['ward_name']];
    }
}

echo json_encode($json);

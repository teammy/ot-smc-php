<?php
include('../config.php');

if(!isset($_GET['searchTerm'])){ 
    $json = [];
} else{
    $search = $_GET['searchTerm'];
    // $sql = "SELECT users.id,concat(users.person_firstname,' ',users.person_lastname) as flname FROM users"; 
    $sql = "SELECT users.id,concat(users.person_firstname,' ',users.person_lastname) as flname,email,username FROM users 
            WHERE person_firstname LIKE '%".$search."%' AND position_id IN (22,89)"; 
    $result = $conn->query($sql);
    $json = [];
    while($row = $result->fetch_assoc()){
        $json[] = ['id'=>$row['id'], 'text'=>$row['flname']];
    }
}
echo json_encode($json);

?>
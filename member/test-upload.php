<?php

// for ($i=1; $i<=31; $i++) { 
//     $sql.=" CASE when DAY(booking.booking_date)=".$i." THEN ot_time_group.initial END as d".$i;
//   if ($i<31) {
//     $sql.=",";
//   }
// }


$sql = "SELECT user_booking_id,CONCAT(person_firstname,' ',person_lastname) as lname,total_ot,position_name";

$sql.=" FROM (SELECT
  booking.user_booking_id,
  users.person_firstname,
  users.person_lastname,
  position.position_name";
$sql.=" FROM
  booking
  INNER JOIN
  ot_time_group
  ON 
    booking.ot_time_select = ot_time_group.ot_time_id
  INNER JOIN
  users
  ON 
    booking.user_booking_id = users.id
  INNER JOIN
  office_sit
  ON 
    booking.ward_id = office_sit.ward_id
  INNER JOIN
  position
  ON 
    booking.position_id = position.position_id
  WHERE booking.position_id=89
  AND MONTH(booking.booking_date)=8
) as tbl_out 
GROUP BY user_booking_id";

echo $sql."<br/>";
?>
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

if ($position_id == 27 || $position_id == 89 || $position_id == 126 || $position_id == 51) {
    $sql_count = "SELECT * FROM booking where booking_date='$booking_date_select' AND position_id IN (27,89,126,51) AND booking_status=1";
} else {
    $sql_count = "SELECT * FROM booking where booking_date='$booking_date_select' AND position_id='$position_id' AND booking_status=1";

}


$query = mysqli_query($conn, $sql_count);
$rowcount = mysqli_num_rows($query);

while ($result = mysqli_fetch_assoc($query)) {
    $user_array[] = $result['user_booking_id'];
    $ot_array[] = $result['ot_time_select'];
}


// reture free slot

if ($rowcount > 0) {

    $valid_array = array_diff($arr, $ot_array);
    $export_not_match = implode(',', $valid_array);

    $match_array = array_intersect($arr, $ot_array);
    $export_match = implode(',', $match_array);

    $user_match = array_intersect($user_array,array($user_no));
    $ot_match1 = array_intersect(array("1"), $ot_array);
    $ot_match2 = array_intersect(array("2"), $ot_array);

    // echo '<h2>user_array</h2>';
    // echo '<pre>'.print_r($user_array, true).'</pre>';
    // echo '<h2>ot_array</h2>';
    // echo '<pre>'.print_r($ot_array, true).'</pre>';
    // echo '<pre>'.$user_array[0].'</pre>';
    // echo '<pre>'.print_r($ot_match1,true).'</pre>';
    // print_r(array("1")) ;
    
    //print_r($user_match);

// echo $export_match;

    if (array("1") == $ot_array) {
        if ($user_array == array($user_no)) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (3)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
        }
            echo json_encode($json);
        }else {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (2,3)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            echo json_encode($json);
        }
    } elseif (array("2") == $ot_array) {
        if ($user_array == array($user_no)) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (3)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
        }
            echo json_encode($json);
            
        }else {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (1,3)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            echo json_encode($json);
        }
    } elseif (array("3") == $ot_array) {
        if ($user_array == array($user_no)) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (1,2)";
        $query_valid_array = mysqli_query($conn, $sql_valid_array);
        $json = array();
        while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
            array_push($json, $result2);
        }
        echo json_encode($json);
        } else {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (1,2)";
        $query_valid_array = mysqli_query($conn, $sql_valid_array);
        $json = array();
        while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
            array_push($json, $result2);
        }
        echo json_encode($json);
        }
        
    } elseif (array("1", "2") == $ot_array || array("2", "1") == $ot_array) {
        $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (3)";
        $query_valid_array = mysqli_query($conn, $sql_valid_array);
        $json = array();
        while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
            array_push($json, $result2);
        }
        echo json_encode($json);   
        
    } elseif (array("1", "3") == $ot_array || array("3", "1") == $ot_array) {

    //    if ($user_array[0] == $user_no && $ot_array[0] == 3) {
    //         $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (2)";
    //         $query_valid_array = mysqli_query($conn, $sql_valid_array);
    //         $json = array();
    //         while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
    //             array_push($json, $result2);
    //         }
    //         echo "bug";
    //         echo json_encode($json);
        if ($user_array == array($user_no,$user_no) && $ot_array == array("1","3")) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id NOT IN (1,2,3)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            
            echo json_encode($json);
        } elseif ($user_array == array($user_no,$user_no) && $ot_array == array("3","1")) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id NOT IN (1,2,3)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            
            echo json_encode($json);
        } elseif ($user_array[0] == $user_no && $ot_array[0] == array("3")) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (2)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            
            echo json_encode($json);
        }
        elseif ($user_array[0] == $user_no && $ot_match1 == array("1")) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id NOT IN (1,2,3)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }

            echo json_encode($json);
        } elseif ($user_array[1] == $user_no && $ot_match1 == array("1")) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (2)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }

            echo json_encode($json);
        } 
        
        
        elseif ($user_array[1] == array($user_no) && $ot_match1 == array("3")) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (2)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            
            echo json_encode($json);    
        } else {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (2)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
           // echo "bug";
            echo json_encode($json);
        }
    } elseif ((array("2", "3") == $ot_array) || (array("3", "2") == $ot_array)) {


        if ($user_array[0] == $user_no && $ot_array[0] == 3) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (1)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            echo json_encode($json);
        } elseif ($user_match == array($user_no) && $ot_match2 == array("2") ) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id NOT IN (1,2,3)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            echo json_encode($json);
        } elseif ($user_array == array($user_no,$user_no) && $ot_array == array("2","3")) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id NOT IN (1,2,3)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            echo json_encode($json);
        } elseif ($user_array[0] == $user_no) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (1)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            echo json_encode($json);
        } elseif ($user_array[1] == $user_no) {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id NOT IN (1,2,3)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            echo json_encode($json);    
        }   else {
            $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (1)";
            $query_valid_array = mysqli_query($conn, $sql_valid_array);
            $json = array();
            while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
                array_push($json, $result2);
            }
            echo json_encode($json);
        }
    } 

    // if ($export_match == 1) {
    //     $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN (3)";
    //     $query_valid_array = mysqli_query($conn, $sql_valid_array);
    //     $json = array();
    //     while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
    //         array_push($json, $result2);
    //     }
    //     echo json_encode($json);
    // } else {
    //     $sql_valid_array = "SELECT * FROM ot_time_group WHERE ot_time_id IN ($export_not_match)";
    //     $query_valid_array = mysqli_query($conn, $sql_valid_array);
    //     $json = array();
    //     while ($result2 = mysqli_fetch_assoc($query_valid_array)) {
    //         array_push($json, $result2);
    //     }
    //     echo json_encode($json);
    // }
} else {
    $sql2 = "SELECT * FROM ot_time_group";
    $query = mysqli_query($conn, $sql2);
    $json = array();
    while ($result = mysqli_fetch_assoc($query)) {
        array_push($json, $result);
    }
    echo json_encode($json);
}

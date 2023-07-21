<?php
// if user is NOT logged in, redirect them to login page
if (!isset($_SESSION['user'])) {
  header("location: " . BASE_URL . "login.php");
}
// if user is logged in and this user is NOT an admin user, redirect them to landing page


// if (isset($_SESSION['user']['role'])) {
//   if ($_SESSION['user']['role'] == 'user') {
//     header("location: " . BASE_URL);
//   }
// }

$now = date('Y-m-d H:i:s');
if (isset($_POST['submit_to_com'])) {
  updateStatusToCom();
}

if (isset($_POST['submit_on_job_com'])) {
  updateStatusOnjobCom();
}

if (isset($_POST['submit_on_job'])) {
  updateStatusOnjob();
}

if (isset($_POST['submit_com_to_dc'])) {
  updateStatusComToDC();
}

if (isset($_POST['submit_dc_to_user'])) {
  updateStatusDCToUser();
}

if (isset($_POST['change_pw'])) {
  changePassword();
}

if (isset($_POST['change-profile'])) {
  updateProfile();
}

if (isset($_POST['booking-more-create'])) {
  BookingMoreCreate();
}



// checks if logged in admin user can update post
function canUpdatePost($post_id = null)
{
  global $conn;

  if (in_array('update-post', $_SESSION['userPermissions'])) {
    if ($_SESSION['user']['role'] === "Author") { // author can update only posts that they themselves created
      $sql = "SELECT user_id FROM posts WHERE id=?";
      $post_result = getSingleRecord($sql, 'i', [$post_id]);
      $post_user_id = $post_result['user_id'];

      // if current user is the author of the post, then they can update the post
      // if ($post_user_id === $user_id) {
      //   return true;
      // } else { // if post is not created by this author
      //   return false;
      // }
    } else { // if user is not author
      return true;
    }
  } else {
    return false;
  }
}

// accepts user id and post id and checks if user can publis/unpublish a post
function canPublishPost()
{
  if (in_array(['permission_name' => 'publish-post'], $_SESSION['userPermissions'])) {
    // echo "<pre>"; print_r($_SESSION['userPermissions']); echo "</pre>"; die();
    return true;
  } else {
    return false;
  }
}

function canDeletePost()
{
  if (in_array('delete-post', $_SESSION['userPermissions'])) {
    return true;
  } else {
    return false;
  }
}
function canCreateUser()
{
  if (in_array('create-user', $_SESSION['userPermissions'])) {
    return true;
  } else {
    return false;
  }
}
function canUpdateUser()
{
  if (in_array('update-user', $_SESSION['userPermissions'])) {
    return true;
  } else {
    return false;
  }
}
function canDeleteUser()
{
  if (in_array('delete-user', $_SESSION['userPermissions'])) {
    return true;
  } else {
    return false;
  }
}
function canCreateRole($role_id)
{
  if (in_array('create-role', $_SESSION['userPermissions'])) {
    return true;
  } else {
    return false;
  }
}
function canUpdateRole($role_id)
{
  if (in_array('update-role', $_SESSION['userPermissions'])) {
    return true;
  } else {
    return false;
  }
}
function canDeleteRole($user_id, $post_id)
{
  if (in_array('delete-role', $_SESSION['userPermissions'])) {
    return true;
  } else {
    return false;
  }
}

function getAllMember()
{
  $sql = "SELECT 
    u.id,u.cid,
    u.person_firstname,
    u.person_lastname,
    os.ward_name,
    po.position_name,
    u.username,
    u.pwd
  FROM users u
  LEFT JOIN office_sit os 
  ON u.office_id = os.ward_id
  LEFT JOIN position po
  ON u.position_id = po.position_id
  WHERE u.position_id IN (22,27,89,126,51)
  ";
  $member_result = getMultipleRecords($sql);
  return $member_result;
}

function getSingleMember($user_id)
{
  $sql = "SELECT 
    u.id,u.cid,u.email,u.person_tel,
    u.person_firstname,
    u.person_lastname,
    os.*,
    po.*
  FROM users u
  LEFT JOIN office_sit os 
  ON u.office_id = os.ward_id
  LEFT JOIN position po
  ON u.position_id = po.position_id
  WHERE u.id=?";
  $member_getsingle = getSingleRecord($sql, 's', [$user_id]);
  return $member_getsingle;
}

function getAllDoc()
{
  $sql = "SELECT dc.doc_no,dc.last_status,dc.id,dc.subject_doc,dc.important,u.person_firstname,u.person_lastname,dc.createdon,sd.status_id,sd.status_name
    FROM document dc
    LEFT JOIN users u
    ON dc.user_no = u.id
    LEFT JOIN status_doc sd
    ON dc.doc_no = sd.doc_no
    WHERE dc.last_status='1'
    ORDER BY dc.id DESC
    ";
  $all_doc_result = getMultipleRecords($sql);
  return $all_doc_result;
}

function getAllDocForDel()
{
  $sql = "SELECT dc.doc_no,dc.last_status,dc.id,dc.subject_doc,dc.important,u.person_firstname,u.person_lastname,dc.createdon,sd.status_id,sd.status_name
    FROM document dc
    LEFT JOIN users u
    ON dc.user_no = u.id
    LEFT JOIN status_doc sd
    ON dc.doc_no = sd.doc_no
    WHERE dc.last_status='1'
    ORDER BY dc.id DESC
    ";
  $del_dc_doc_result = getMultipleRecords($sql);
  return $del_dc_doc_result;
}

function updateStatusOnjob()
{
  global $now;

  $status_id = $_POST['submit_on_job'];
  $status_name = $_POST['status_name'];
  $docno = $_POST['doc_no'];
  $user_no = $_SESSION['user']['id'];
  $sql = "INSERT INTO status_doc SET status_id=?,status_name=?,doc_no=?,updated_status=?,user_no_update_status=?";
  $sql2 = "UPDATE document SET last_status=? WHERE doc_no=?";
  $update_on_job = modifyRecord($sql, 'sssss', [$status_id, $status_name, $docno, $now, $user_no]);
  $update_on_doc = modifyRecord($sql2, 'ss', [$status_id, $docno]);

  if ($update_on_job) {
    header("location: " . BASE_URL . "member/dc-doc-all.php");
  }
}

function updateStatusComToDC()
{
  global $now;

  $filename = $_FILES['file_com_to_dc']['name'];
  $file_com_to_dc_status = $_POST['status_file_com_to_dc'];
  $note_com_to_dc = $_POST['note_com_to_dc'];
  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  $file = $_FILES['file_com_to_dc']['tmp_name'];
  $path1 = '../upload';
  $user_no = $_SESSION['user']['id'];
  $new_name = rand(100000, 999999) . "." . $extension;

  $status_id = $_POST['submit_com_to_dc'];
  $status_name = $_POST['status_name'];
  $docno = $_POST['doc_no'];
  $sql = "INSERT INTO status_doc SET status_id=?,status_name=?,doc_no=?,updated_status=?,user_no_update_status=?";
  $sql2 = "UPDATE document SET last_status=?,note_com_to_dc=? WHERE doc_no=?";
  $update_on_job = modifyRecord($sql, 'sssss', [$status_id, $status_name, $docno, $now, $user_no]);
  $update_on_doc = modifyRecord($sql2, 'sss', [$status_id, $note_com_to_dc, $docno]);

  if (!in_array($extension, ['zip', 'pdf', 'docx', 'doc', 'xlsx', 'xls', 'rar', 'jpg', 'jpeg', 'png'])) {
    echo "You file extension must be .zip, .pdf or .docx";
  } elseif ($_FILES['file_com_to_dc']['size'] > 100000000) { // file shouldn't be larger than 1Megabyte
    echo "File too large!";
  } else {
    // move the uploaded (temporary) file to the specified destination
    if (move_uploaded_file($file, "$path1/$new_name")) {
      $sql3 = "INSERT INTO file_management SET file_path=?,doc_no=?,update_at=?,user_no=?,file_com_to_dc=?";
      $result2 = modifyRecord($sql3, 'sssss', [$new_name, $docno, $now, $user_no, $file_com_to_dc_status]);
      // move_uploaded_file($file, $destination);
      if ($result2) {
        echo "File uploaded successfully";
      }
    } else {
      echo "Failed to upload file.";
    }
  }

  if ($update_on_job) {
    header("location: " . BASE_URL . "member/com-on-job.php");
  }
}

// to com - from com

function updateStatusToCom()
{
  global $now;

  $filename = $_FILES['file_to_com']['name'];
  $file_to_com_status = $_POST['status_file_to_com'];
  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  $file = $_FILES['file_to_com']['tmp_name'];
  $path1 = '../upload';
  $user_no = $_SESSION['user']['id'];
  $new_name = rand(100000, 999999) . "." . $extension;

  $note_dc_to_com = $_POST['note_dc_to_com'];
  $status_id = $_POST['submit_to_com'];
  $status_name = $_POST['status_name'];
  $docno = $_POST['doc_no'];
  $sql = "INSERT INTO status_doc SET status_id=?,status_name=?,doc_no=?,updated_status=?,user_no_update_status=?";
  $sql2 = "UPDATE document SET last_status=?,note_dc_to_com=? WHERE doc_no=?";
  modifyRecord($sql, 'sssss', [$status_id, $status_name, $docno, $now, $user_no]);
  $update_on_job = modifyRecord($sql2, 'sss', [$status_id, $note_dc_to_com, $docno]);


  if (!in_array($extension, ['zip', 'pdf', 'docx', 'doc', 'xlsx', 'xls', 'rar', 'jpg', 'jpeg', 'png'])) {
    echo "You file extension must be .zip, .pdf or .docx";
  } elseif ($_FILES['file_to_com']['size'] > 100000000) { // file shouldn't be larger than 1Megabyte
    echo "File too large!";
  } else {
    // move the uploaded (temporary) file to the specified destination
    if (move_uploaded_file($file, "$path1/$new_name")) {
      $sql3 = "INSERT INTO file_management SET file_path=?,doc_no=?,update_at=?,user_no=?,file_to_com=?";
      $result2 = modifyRecord($sql3, 'sssss', [$new_name, $docno, $now, $user_no, $file_to_com_status]);
      // move_uploaded_file($file, $destination);
      if ($result2) {
        echo "File uploaded successfully";
      }
    } else {
      echo "Failed to upload file.";
    }
  }

  if ($update_on_job) {
    header("location: " . BASE_URL . "member/dc-on-job.php");
  }
}


//-- end to com --

function getDocForDC($docno)
{

  $sql = "SELECT d.*,f.file_path,u.person_firstname,u.person_lastname,o.ward_name,sd.updated_status
    FROM document d 
    LEFT JOIN file_management f 
    ON d.doc_no = f.doc_no 
    LEFT JOIN users u 
    ON d.user_no = u.id
    LEFT JOIN office_sit o
    ON u.office_id = o.ward_id
    LEFT JOIN status_doc sd
    ON d.last_status = sd.status_id AND d.doc_no = sd.doc_no
    WHERE d.doc_no=?";
  $show_doc_dc = getSingleRecord($sql, 's', [$docno]);
  return $show_doc_dc;
}

function getUserFinal($docno)
{

  $sql = "SELECT sd.updated_status,u.person_firstname,person_lastname
              FROM status_doc sd
              LEFT JOIN users u 
              ON sd.user_no_update_status = u.id
              WHERE sd.status_id='6' AND sd.doc_no=?";
  $get_user_final = getSingleRecord($sql, 's', [$docno]);
  return $get_user_final;
}

function getUserDConjob($docno)
{

  $sql = "SELECT sd.updated_status,u.person_firstname,person_lastname
              FROM status_doc sd
              LEFT JOIN users u 
              ON sd.user_no_update_status = u.id
              WHERE sd.status_id='2' AND sd.doc_no=?";
  $get_user_DConjob = getSingleRecord($sql, 's', [$docno]);
  return $get_user_DConjob;
}

function getUserDCtoCom($docno)
{

  $sql = "SELECT sd.updated_status,u.person_firstname,person_lastname
              FROM status_doc sd
              LEFT JOIN users u 
              ON sd.user_no_update_status = u.id
              WHERE sd.status_id='3' AND sd.doc_no=?";
  $get_user_DCtoCom = getSingleRecord($sql, 's', [$docno]);
  return $get_user_DCtoCom;
}



function getUserComToDC($docno)
{

  $sql = "SELECT sd.updated_status,u.person_firstname,person_lastname
              FROM status_doc sd
              LEFT JOIN users u 
              ON sd.user_no_update_status = u.id
              WHERE sd.status_id='5' AND sd.doc_no=?";
  $get_user_ComToDC = getSingleRecord($sql, 's', [$docno]);
  return $get_user_ComToDC;
}

function getDocToCom($docno)
{
  $sql = "SELECT d.*,f.*,u.person_firstname,u.person_lastname,o.ward_name
    FROM document d 
    LEFT JOIN file_management f 
    ON d.doc_no = f.doc_no 
    LEFT JOIN users u 
    ON d.user_no = u.id
    LEFT JOIN office_sit o
    ON u.office_id = o.ward_id
    WHERE d.doc_no=? ";
  $show_doc_com = getSingleRecord($sql, 's', [$docno]);
  return $show_doc_com;
}

function getFileDCToCom($docno)
{
  $sql = "SELECT f.*,d.doc_no
    FROM file_management f 
		LEFT JOIN document d
		ON d.doc_no = f.doc_no
    WHERE d.doc_no=$docno AND f.file_to_com=1 ";
  $file_dc_to_com = getMultipleRecords($sql);
  return $file_dc_to_com;
}

function getFileDCToUser($docno)
{
  $sql = "SELECT f.*
    FROM file_management f 
		LEFT JOIN document d
		ON d.doc_no = f.doc_no
    WHERE d.doc_no=$docno AND f.file_dc_to_user=1 ";
  $file_dc_to_user = getMultipleRecords($sql);
  return $file_dc_to_user;
}

function getFileUserToDC($docno)
{
  $sql = "SELECT f.*
    FROM file_management f 
		LEFT JOIN document d
		ON d.doc_no = f.doc_no
    WHERE d.doc_no=$docno AND f.file_from_user=1 ";
  $file_user_to_dc = getMultipleRecords($sql);
  return $file_user_to_dc;
}


function getFileComToDC($docno)
{
  $sql = "SELECT f.*
    FROM file_management f 
		LEFT JOIN document d
		ON d.doc_no = f.doc_no
    WHERE d.doc_no=$docno AND f.file_com_to_dc=1 ";
  $file_com_to_dc = getMultipleRecords($sql);
  return $file_com_to_dc;
}

function getAllDoc_DC_onjob()
{
  $sql = "SELECT dc.doc_no,dc.last_status,dc.id,dc.subject_doc,dc.important,u.person_firstname,u.person_lastname,dc.createdon,sd.status_name,sd.status_id
    FROM document dc
    LEFT JOIN users u
    ON dc.user_no = u.id
    LEFT JOIN status_doc sd
    ON dc.last_status = sd.status_id
    AND dc.doc_no = sd.doc_no
    WHERE dc.last_status='2' OR dc.last_status='3' OR dc.last_status='4' OR dc.last_status='5'
    ORDER BY dc.id DESC
    ";
  $dc_onjob_result = getMultipleRecords($sql);
  return $dc_onjob_result;
}

function getAllDoc_Com_onjob()
{
  $sql = "SELECT dc.doc_no,dc.last_status,dc.id,dc.subject_doc,dc.important,u.person_firstname,u.person_lastname,dc.createdon,sd.status_name,sd.status_id
    FROM document dc
    LEFT JOIN users u
    ON dc.user_no = u.id
    LEFT JOIN status_doc sd
    ON dc.last_status = sd.status_id
    AND dc.doc_no = sd.doc_no
    WHERE dc.last_status='4'
    ";
  $com_onjob_result = getMultipleRecords($sql);
  return $com_onjob_result;
}


function getAllDoc_DC_finish()
{
  $sql = "SELECT dc.doc_no,dc.last_status,dc.id,dc.subject_doc,dc.important,u.person_firstname,u.person_lastname,dc.createdon,sd.status_name,sd.status_id,sd.updated_status
    FROM document dc
    LEFT JOIN users u
    ON dc.user_no = u.id
    LEFT JOIN status_doc sd
    ON dc.last_status = sd.status_id
    AND dc.doc_no = sd.doc_no
    WHERE dc.last_status='6'
    ORDER BY updated_status DESC
    ";
  $dc_finish_result = getMultipleRecords($sql);
  return $dc_finish_result;
}

function getAllDoc_com_finish()
{
  $sql = "SELECT dc.doc_no,dc.last_status,dc.id,dc.subject_doc,dc.important,u.person_firstname,u.person_lastname,dc.createdon,sd.status_name,sd.status_id
    FROM document dc
    LEFT JOIN users u
    ON dc.user_no = u.id
    LEFT JOIN status_doc sd
    ON dc.last_status = sd.status_id
    AND dc.doc_no = sd.doc_no
    WHERE dc.last_status='5'
    ";
  $finish_com_result = getMultipleRecords($sql);
  return $finish_com_result;
}

function getAllDoc_FromDC()
{
  $sql = "SELECT dc.doc_no,dc.last_status,dc.id,dc.subject_doc,dc.important,u.person_firstname,u.person_lastname,dc.createdon,sd.status_id,sd.status_name
    FROM document dc
    LEFT JOIN users u
    ON dc.user_no = u.id
    LEFT JOIN status_doc sd
    ON dc.doc_no = sd.doc_no
    WHERE dc.last_status='3' AND sd.status_id='3'
    ";
  $doc_from_dc = getMultipleRecords($sql);
  return $doc_from_dc;
}


function updateStatusOnjobCom()
{
  global $now;

  $status_id = $_POST['submit_on_job_com'];
  $status_name = $_POST['status_name'];
  $docno = $_POST['doc_no'];
  $user_no = $_SESSION['user']['id'];
  $sql = "INSERT INTO status_doc SET status_id=?,status_name=?,doc_no=?,updated_status=?,user_no_update_status=?";
  $sql2 = "UPDATE document SET last_status=? WHERE doc_no=?";
  $update_on_job = modifyRecord($sql, 'sssss', [$status_id, $status_name, $docno, $now, $user_no]);
  modifyRecord($sql2, 'ss', [$status_id, $docno]);

  if ($update_on_job) {
    header("location: " . BASE_URL . "member/com-doc-all.php");
  }
}


function updateStatusDCToUser()
{
  global $now;

  $filename = $_FILES['file_dc_to_user']['name'];
  $file_dc_to_user_status = $_POST['status_file_dc_to_user'];
  $note_dc_to_user = $_POST['note_dc_to_user'];
  $extension = pathinfo($filename, PATHINFO_EXTENSION);
  $file = $_FILES['file_dc_to_user']['tmp_name'];
  $path1 = '../upload';
  $user_no = $_SESSION['user']['id'];
  $new_name = rand(100000, 999999) . "." . $extension;

  $status_id = $_POST['submit_dc_to_user'];
  $status_name = $_POST['status_name'];
  $docno = $_POST['doc_no'];
  $sql = "INSERT INTO status_doc SET status_id=?,status_name=?,doc_no=?,updated_status=?,user_no_update_status=?";
  $sql2 = "UPDATE document SET last_status=?,note_dc_to_user=? WHERE doc_no=?";
  $update_on_job = modifyRecord($sql, 'sssss', [$status_id, $status_name, $docno, $now, $user_no]);
  $update_on_doc = modifyRecord($sql2, 'sss', [$status_id, $note_dc_to_user, $docno]);

  if (!in_array($extension, ['zip', 'pdf', 'docx', 'doc', 'xlsx', 'xls', 'rar', 'jpg', 'jpeg', 'png'])) {
    echo "You file extension must be .zip, .pdf or .docx";
  } elseif ($_FILES['file_com_to_dc']['size'] > 100000000) { // file shouldn't be larger than 1Megabyte
    echo "File too large!";
  } else {
    // move the uploaded (temporary) file to the specified destination
    if (move_uploaded_file($file, "$path1/$new_name")) {
      $sql3 = "INSERT INTO file_management SET file_path=?,doc_no=?,update_at=?,user_no=?,file_dc_to_user=?";
      $result2 = modifyRecord($sql3, 'sssss', [$new_name, $docno, $now, $user_no, $file_dc_to_user_status]);
      // move_uploaded_file($file, $destination);
      if ($result2) {
        echo "File uploaded successfully";
      }
    } else {
      echo "Failed to upload file.";
    }
  }

  if ($update_on_job) {
    header("location: " . BASE_URL . "member/dc-on-job.php");
  }
}


function getDetailBudgetY($docno)
{
  global $conn;
  $sql = "SELECT y.value_year
	FROM budget_y b_y
	LEFT JOIN years y
	ON b_y.budget_year = y.id_year
	WHERE b_y.doc_no=$docno";
  $getbudgetY = getMultipleRecords($sql);
  return $getbudgetY;
}

function getDetailBudgetM($docno)
{
  global $conn;
  $sql = "SELECT m.value_month
	FROM budget_m b_m
	LEFT JOIN months m
	ON b_m.budget_month = m.id_month
	WHERE b_m.doc_no=$docno";
  $getbudgetM = getMultipleRecords($sql);
  return $getbudgetM;
}


function updateProfile()
{
  global $now;

  $user_no = $_POST['change-profile'];
  $fname = $_POST['firstname'];
  $lname = $_POST['lastname'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $office = $_POST['office_id'];
  $position = $_POST['position_id'];

  $sql = "UPDATE users SET person_firstname=?,person_lastname=?,person_tel=?,position_id=?,office_id=?,updated_at=? WHERE id=" . $user_no . "";
  $update_profile = modifyRecord($sql, 'sssiis', [$fname, $lname, $phone, $position, $office, $now]);

  if ($update_profile) {
    header("location: " . BASE_URL . "member/user-profile.php?user_id=" . $user_no . "");
  }
}


function changePassword()
{
  global $now;
  $user_no = $_POST['change_pw'];
  $npw = $_POST['newpassword'];

  $sql = "UPDATE users SET pwd=?,updated_at=? WHERE id=$user_no";
  $change_pw = modifyRecord($sql, 'ss', [$npw, $now]);

  if ($change_pw) {
    header("location: " . BASE_URL . "member/user-profile.php?user_id=" . $user_no . "");
  }
}

function getAllOffice()
{

  $sql = "SELECT * FROM office_sit";
  $get_all_office = getMultipleRecords($sql);

  return $get_all_office;
}

function getAllPosition()
{

  $sql = "SELECT * FROM position WHERE position_id IN (22,27,89,126)";
  $get_all_position = getMultipleRecords($sql);

  return $get_all_position;
}


function countTotalToday()
{
  global $conn;

  $sql = "SELECT COUNT(*) as counterToday
  from document 
  where DATE(createdon) = DATE(NOW())
  ";

  $countTotalToday = mysqli_query($conn, $sql);
  $dataToday = mysqli_fetch_assoc($countTotalToday);

  return $dataToday;
}

function countTotalWeek()
{
  global $conn;

  $sql = "SELECT COUNT(*) as counterWeek
  from document 
  where YEARWEEK(createdon) = YEARWEEK(NOW())  
  ";
  $countTotalWeek = mysqli_query($conn, $sql);
  $dataWeek = mysqli_fetch_assoc($countTotalWeek);
  return $dataWeek;
}

function countTotalMonth()
{
  global $conn;

  $sql = "SELECT COUNT(*) as counterMonth
  from document 
  where MONTH(createdon) = MONTH(NOW())  
  ";
  $countTotalMonth = mysqli_query($conn, $sql);
  $dataMonth = mysqli_fetch_assoc($countTotalMonth);
  return $dataMonth;
}

function BookingCreate()
{
  global $conn;

  $user_booking_id = $_SESSION['user']['id'];
  $booking_id_random = rand(100000, 999999);
  $booking_date_select = $_POST['booking_date_input'];
  $ot_select = $_POST['ot_select'];
  $user_booking_phone = $_POST['user_phone'];
  $position_id =  $_SESSION['user']['position_id'];
  $ward_id = $_SESSION['user']['ward_id'];
  $booking_status = $_POST['booking-create'];

  $check_already_sql = "SELECT booking_id FROM booking WHERE booking_date=? AND ot_time_select=?";
  $show_doc_com = getSingleRecord($check_already_sql, 'si', [$booking_date_select, $ot_select]);

  if ($show_doc_com) {
    echo "Already!!";
  } else {
    $sql = "INSERT INTO booking SET booking_id_random=?,user_booking_id=?,booking_date=?,ot_time_select=?,user_phone=?,position_id=?,ward_id=?,booking_status=?";
    $booking_on_create = modifyRecord($sql, 'sisisiii', [$booking_id_random, $user_booking_id, $booking_date_select, $ot_select, $user_booking_phone, $position_id, $ward_id, $booking_status]);


    return $booking_on_create;

    if ($booking_on_create) {
      // echo '<script type="text/javascript">Swal.fire("Any fool can use a computer")</script>';
      // header("location: " . BASE_URL . "member/booking-success.php");
    } else {
    }
  }
}


function BookingMoreCreate()
{
  global $conn;

  $user_reserve_id = $_SESSION['user']['id'];
  $user_booking_id = $_POST['name'];
  $booking_id_random = rand(100000, 999999);
  $booking_date_select = $_POST['booking_date_input'];
  $ot_select = $_POST['ot_select'];
  $user_booking_phone = $_POST['user_phone'];
  $position_id =  $_POST['position_name'];
  $ward_id = $_SESSION['user']['ward_id'];
  $booking_status = $_POST['booking-more-create'];

  $check_already_sql = "SELECT booking_id FROM booking WHERE booking_date=? AND ot_time_select=?";
  $show_doc_com = getSingleRecord($check_already_sql, 'si', [$booking_date_select, $ot_select]);

  if ($show_doc_com) {
    echo "Already!!";
  } else {
    $sql = "INSERT INTO booking SET booking_id_random=?,user_booking_id=?,booking_date=?,ot_time_select=?,user_phone=?,position_id=?,ward_id=?,booking_status=?,user_reserve_id=?";
    $booking_on_create = modifyRecord($sql, 'sisisiiii', [$booking_id_random, $user_booking_id, $booking_date_select, $ot_select, $user_booking_phone, $position_id, $ward_id, $booking_status, $user_reserve_id]);

    if ($booking_on_create) {
      echo '<script type="text/javascript">Swal.fire("Any fool can use a computer")</script>';
      // header("location: " . BASE_URL . "member/booking-more-success.php");
    }
  }
}

function getAllBooking()
{

  $sql = "SELECT
	bo.booking_id,
	bo.booking_date,
	itg.ot_time_name,
	users.person_firstname,
	users.person_lastname,
	position.position_name,
	bo.booking_create 
FROM
	booking AS bo
	LEFT JOIN ot_time_group AS itg ON bo.ot_time_select = itg.ot_time_id
	INNER JOIN users ON bo.user_booking_id = users.id
	INNER JOIN position ON bo.position_id = position.position_id
  WHERE booking_status='1'";
  $get_all_booking = getMultipleRecords($sql);

  return $get_all_booking;
}

function getAllMyBooking()
{

  $sql = "SELECT
	bo.booking_id,
	bo.booking_date,
	itg.ot_time_name,
	users.person_firstname,
	users.person_lastname,
	position.position_name,
	bo.booking_create 
FROM
	booking AS bo
	LEFT JOIN ot_time_group AS itg ON bo.ot_time_select = itg.ot_time_id
	INNER JOIN users ON bo.user_booking_id = users.id
	INNER JOIN position ON bo.position_id = position.position_id
  WHERE booking_status='1' AND user_booking_id=" . $_SESSION['user']['id'] . " AND MONTH(booking_date)=MONTH(NOW() + INTERVAL 1 MONTH)";
  $get_all_my_booking = getMultipleRecords($sql);

  return $get_all_my_booking;
}



function BookingCreateSuccess()
{

  $user_booking_id = $_SESSION['user']['id'];

  $sql = "SELECT
  bo.booking_id,
  bo.booking_date,
  itg.ot_time_name,
  users.person_firstname,
  users.person_lastname,
  position.position_name,
  bo.booking_create,
  bo.user_phone
FROM
  booking AS bo
  LEFT JOIN ot_time_group AS itg ON bo.ot_time_select = itg.ot_time_id
  INNER JOIN users ON bo.user_booking_id = users.id
  INNER JOIN position ON bo.position_id = position.position_id
  WHERE bo.user_booking_id=? 
  ORDER BY booking_create DESC
  ";
  $get_BookingCreateSuccess = getSingleRecord($sql, 's', [$user_booking_id]);

  return $get_BookingCreateSuccess;
}

function BookingCreateMoreSuccess()
{

  $user_booking_id = $_SESSION['user']['id'];

  $sql = "SELECT
  bo.booking_id,
  bo.booking_date,
  itg.ot_time_name,
  users.person_firstname,
  users.person_lastname,
  position.position_name,
  bo.booking_create,
  bo.user_phone
FROM
  booking AS bo
  LEFT JOIN ot_time_group AS itg ON bo.ot_time_select = itg.ot_time_id
  INNER JOIN users ON bo.user_booking_id = users.id
  INNER JOIN position ON bo.position_id = position.position_id
  WHERE bo.user_booking_id=? 
  ORDER BY booking_create DESC
  ";
  $get_BookingCreateMoreSuccess = getSingleRecord($sql, 's', [$user_booking_id]);

  return $get_BookingCreateMoreSuccess;
}

function ReportExcel($select_posit, $select_m)
{

  $sql = "SELECT user_booking_id,user_phone,
CONCAT(person_firstname,' ',person_lastname) as lname,ward_name,
position_name,
	GROUP_CONCAT(d1) as d1, GROUP_CONCAT(d2) as d2, GROUP_CONCAT(d3) as d3, GROUP_CONCAT(d4) as d4, GROUP_CONCAT(d5) as d5, GROUP_CONCAT(d6) as d6, GROUP_CONCAT(d7) as d7, GROUP_CONCAT(d8) as d8, GROUP_CONCAT(d9) as d9, GROUP_CONCAT(d10) as d10, GROUP_CONCAT(d11) as d11, GROUP_CONCAT(d12) as d12, GROUP_CONCAT(d13) as d13, GROUP_CONCAT(d14) as d14, GROUP_CONCAT(d15) as d15, GROUP_CONCAT(d16) as d16, GROUP_CONCAT(d17) as d17, GROUP_CONCAT(d18) as d18, GROUP_CONCAT(d19) as d19, GROUP_CONCAT(d20) as d20, GROUP_CONCAT(d21) as d21, GROUP_CONCAT(d22) as d22, GROUP_CONCAT(d23) as d23, GROUP_CONCAT(d24) as d24, GROUP_CONCAT(d25) as d25, GROUP_CONCAT(d26) as d26, GROUP_CONCAT(d27) as d27, GROUP_CONCAT(d28) as d28, GROUP_CONCAT(d29) as d29, GROUP_CONCAT(d30) as d30, GROUP_CONCAT(d31) as d31,
  count(user_booking_id) as total_ot
FROM 
(
	SELECT
	booking.user_booking_id,
  booking.user_phone,
	users.person_firstname,
	users.person_lastname,
  office_sit.ward_name,
	position.position_name, 
    CASE when DAY(booking.booking_date)=1 THEN ot_time_group.initial END as d1, CASE when DAY(booking.booking_date)=2 THEN ot_time_group.initial END as d2, CASE when DAY(booking.booking_date)=3 THEN ot_time_group.initial END as d3, CASE when DAY(booking.booking_date)=4 THEN ot_time_group.initial END as d4, CASE when DAY(booking.booking_date)=5 THEN ot_time_group.initial END as d5, CASE when DAY(booking.booking_date)=6 THEN ot_time_group.initial END as d6, CASE when DAY(booking.booking_date)=7 THEN ot_time_group.initial END as d7, CASE when DAY(booking.booking_date)=8 THEN ot_time_group.initial END as d8, CASE when DAY(booking.booking_date)=9 THEN ot_time_group.initial END as d9, CASE when DAY(booking.booking_date)=10 THEN ot_time_group.initial END as d10, CASE when DAY(booking.booking_date)=11 THEN ot_time_group.initial END as d11, CASE when DAY(booking.booking_date)=12 THEN ot_time_group.initial END as d12, CASE when DAY(booking.booking_date)=13 THEN ot_time_group.initial END as d13, CASE when DAY(booking.booking_date)=14 THEN ot_time_group.initial END as d14, CASE when DAY(booking.booking_date)=15 THEN ot_time_group.initial END as d15, CASE when DAY(booking.booking_date)=16 THEN ot_time_group.initial END as d16, CASE when DAY(booking.booking_date)=17 THEN ot_time_group.initial END as d17, CASE when DAY(booking.booking_date)=18 THEN ot_time_group.initial END as d18, CASE when DAY(booking.booking_date)=19 THEN ot_time_group.initial END as d19, CASE when DAY(booking.booking_date)=20 THEN ot_time_group.initial END as d20, CASE when DAY(booking.booking_date)=21 THEN ot_time_group.initial END as d21, CASE when DAY(booking.booking_date)=22 THEN ot_time_group.initial END as d22, CASE when DAY(booking.booking_date)=23 THEN ot_time_group.initial END as d23, CASE when DAY(booking.booking_date)=24 THEN ot_time_group.initial END as d24, CASE when DAY(booking.booking_date)=25 THEN ot_time_group.initial END as d25, CASE when DAY(booking.booking_date)=26 THEN ot_time_group.initial END as d26, CASE when DAY(booking.booking_date)=27 THEN ot_time_group.initial END as d27, CASE when DAY(booking.booking_date)=28 THEN ot_time_group.initial END as d28, CASE when DAY(booking.booking_date)=29 THEN ot_time_group.initial END as d29, CASE when DAY(booking.booking_date)=30 THEN ot_time_group.initial END as d30, CASE when DAY(booking.booking_date)=31 THEN ot_time_group.initial END as d31
FROM
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
	WHERE booking.position_id=$select_posit
	AND MONTH(booking.booking_date)=$select_m
  AND booking.booking_status='1'
) as tbl_out 
GROUP BY user_booking_id";

  $export_excel = getMultipleRecords($sql);
  return $export_excel;
}

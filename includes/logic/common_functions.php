<?php
// Accept a user ID and returns true if user is admin and false if otherwise
function isAdmin($user_id)
{
  global $conn;
  $sql = "SELECT * FROM users WHERE id=? AND role_id='6' LIMIT 1";
  $user = getSingleRecord($sql, 'i', [$user_id]); // get single user from database
  if (!empty($user)) {
    return true;
  } else {
    return false;
  }
}

function loginById($user_id)
{
  global $conn;
  $sql = "SELECT u.id, u.role_id, u.username,u.person_firstname,u.person_tel,u.person_lastname, po.* , r.name as role , o.* FROM users u 
            LEFT JOIN roles r ON u.role_id=r.id
            LEFT JOIN office_sit o ON u.office_id = o.ward_id
            LEFT JOIN position po ON u.position_id = po.position_id
            WHERE u.id=? 
            LIMIT 1";
  $user = getSingleRecord($sql, 'i', [$user_id]);

  if (!empty($user)) {
    // put logged in user into session array
    $_SESSION['user'] = $user;
    $_SESSION['success_msg'] = "You are now logged in";

    // if user is admin, redirect to dashboard, otherwise to homepage
    if ($user['role_id']==8) {
      header('location: ./member/booking.php');
    } else {
      header('location: ./member/booking.php');
    }
  }
}

// Accept a user object, validates user and return an array with the error messages
function validateUser($user, $ignoreFields)
{
  global $conn;
  $errors = [];

  // password confirmation
  if (isset($user['passwordConf']) && ($user['password'] !== $user['passwordConf'])) {
    $errors['passwordConf'] = "รหัสผ่านไม่ตรงกัน";
  }
  
  // if passwordOld was sent, then verify old password
  if (isset($user['passwordOld']) && isset($user['user_id'])) {
    $sql = "SELECT * FROM users WHERE id=? LIMIT 1";
    $oldUser = getSingleRecord($sql, 'i', [$user['user_id']]);
    $prevPasswordHash = $oldUser['password'];
    if (!password_verify($user['passwordOld'], $prevPasswordHash)) {
      $errors['passwordOld'] = "The old password does not match";
    }
  }


  if (in_array('signup_btn',$ignoreFields)) {
    $sql = "SELECT cid FROM users WHERE cid=? limit 1";
    $oldCid = getSingleRecord($sql,'s',[$user['cid']]);
    if (!empty($oldCid['cid']) && $oldCid['cid'] == $user['cid']) { // if cid exists
      $errors['cid'] = "เลขบัตรนี้ถูกใช้งานแล้ว";
    }
  }

  // the email should be unique for each user for cases where we are saving admin user or signing up new user
  if (in_array('save_user', $ignoreFields) || in_array('signup_btn', $ignoreFields)) {
    $sql = "SELECT * FROM users WHERE username=? LIMIT 1";
    $oldUser = getSingleRecord($sql, 's', [$user['username']]);
    // if (!empty($oldUser['email']) && $oldUser['email'] === $user['email']) { // if user exists
    //   $errors['email'] = "อีเมลถูกใช้งานแล้ว";
    // }

    if (!empty($oldUser['username']) && $oldUser['username'] === $user['username']) { // if user exists
      $errors['username'] = "ชื่อนี้ถูกใช้งานแล้ว";
    }

}

  // required validation
  foreach ($user as $key => $value) {
    if (in_array($key, $ignoreFields)) {
      continue;
    }
    if (empty($user[$key])) {
      $errors[$key] = "กรุณากรอกข้อมูล";
    }
  }
  return $errors;


}

// upload's user profile profile picture and returns the name of the file
function uploadProfilePicture()
{
  // if file was sent from signup form ...
  if (!empty($_FILES) && !empty($_FILES['profile_picture']['name'])) {
    // Get image name
    $profile_picture = date("Y.m.d") . $_FILES['profile_picture']['name'];
    // define Where image will be stored
    $target = ROOT_PATH . "/assets/images/" . $profile_picture;
    // upload image to folder
    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target)) {
      return $profile_picture;
      exit();
    } else {
      echo "Failed to upload image";
    }
  }
}

function validateRole($role, $ignoreFields)
{
  global $conn;
  $errors = [];
  foreach ($role as $key => $value) {
    if (in_array($key, $ignoreFields)) {
      continue;
    }
    if (empty($role[$key])) {
      $errors[$key] = "This field is required";
    }
  }
  return $errors;
}
?>
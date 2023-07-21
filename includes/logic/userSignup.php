<?php
include(INCLUDE_PATH . "/logic/common_functions.php");
// variable declaration
$username = "";
$errors  = [];
// SIGN UP USER
if (isset($_POST['signup_btn'])) {
	// validate form values
	$errors = validateUser($_POST, ['signup_btn']);

	// receive all input values from the form. No need to escape... bind_param takes care of escaping
	$username = $_POST['username'];
	$first_name = $_POST['yourFName'];
	$last_name = $_POST['yourLName'];
	$cid = $_POST['cid'];
	$position_id = $_POST['select-position'];
	$ward_id = $_POST['select-ward'];
	$password = $_POST['password']; /// password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt the password before saving in the database
	$created_at = date('Y-m-d H:i:s');

	// if no errors, proceed with signup
	if (count($errors) === 0) {
		// insert user into database
		$query = "INSERT INTO users SET username=?, person_firstname=?,person_lastname=?, pwd=?, created_at=? ,cid=? , position_id=?,office_id=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('ssssssss', $username, $first_name,$last_name, $password, $created_at,$cid,$position_id,$ward_id);
		$result = $stmt->execute();
		if ($result) {
		  $user_id = $stmt->insert_id;
			$stmt->close();
			loginById($user_id); // log user in
		 } else {
			 $_SESSION['error_msg'] = "Database error: Could not register user";
		}
	 }
}

if (isset($_POST['login_btn'])) {
	// validate form values
	$errors = validateUser($_POST, ['login_btn']);
	$username = $_POST['username'];
	$password = $_POST['password']; // don't escape passwords.

	if (empty($errors)) {
		$sql = "SELECT * FROM users WHERE username=? AND position_id IN (22,126,89,27,7,51)";
		$user = getSingleRecord($sql, 's', [$username]);

		if (!empty($user)) { // if user was found
			if ($user['pwd'] == $password) { // if password matches
				// log user in
				loginById($user['id']);
			} else { // if password does not match
				$_SESSION['error_msg'] = "รหัสผ่านไม่ถูกต้อง";
			}
		} else { // if no user found
			$_SESSION['error_msg'] = "ชื่อผู้ใช้งานไม่ถูกต้อง";
		}
	}
}

?>
<?php

 // ACTION: Create Document
if (isset($_POST['add_doc'])) {
	createDoc();
}


function createDoc(){
    global  $conn;

       // receive form values
		$subject_doc = $_POST['subject_doc'];
		$type_patient = $_POST['type_patient'];
		$important = $_POST['important'];
		$demand = $_POST['demand'];
		$type_report = $_POST['type_report'];
		$reason_detail = $_POST['reason_detail'];
		$report_detail = $_POST['report_detail'];
		$rand_doc_no = rand(100000,999999);
		$user_no = $_SESSION['user']['id'];
		$created_at = date('Y-m-d H:i:s');
		$phone = $_POST['phone'];
		$send_email = $_POST['input_sendemail'];
		$send_hosxp = $_POST['input_sendhosxp'];
		$file_from_user = $_POST['status_id'];
		
		// $file_template = uploadFileTemplate();

		// upload statment
		$filename = $_FILES['file_template']['name'];
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		$file = $_FILES['file_template']['tmp_name'];
		$path1= '../upload';
		$new_name = rand(100000,999999).".".$extension;

		$sql = "INSERT INTO document SET subject_doc=?, 
		type_patient=?, 
		important=?,
		demand=?,
		phone=?,
		type_report=?,
		reason_detail=?,
		report_detail=?,
		createdon=?,
		doc_no=?,
		user_no=?,
		send_email=?,
		send_hosxp=?";
       $result = modifyRecord($sql, 'sssssssssssss', [$subject_doc,$type_patient,$important,$demand,$phone,$type_report,$reason_detail,$report_detail,$created_at,$rand_doc_no,$user_no,$send_email,$send_hosxp]);
	   
	   	// file upload
	  	if (!in_array($extension, ['zip', 'pdf', 'docx','doc','xlsx','xls','rar','jpg','jpeg','png'])) {
			echo "You file extension must be .zip, .pdf or .docx";
		} elseif ($_FILES['file_template']['size'] > 100000000) { // file shouldn't be larger than 1Megabyte
			echo "File too large!";
		} else {
			// move the uploaded (temporary) file to the specified destination
			if (move_uploaded_file($file,"$path1/$new_name")) {
				$sql2 = "INSERT INTO file_management SET file_path=?,doc_no=?,update_at=?,user_no=?,file_from_user=?";
				$result2 = modifyRecord($sql2, 'sssss', [$new_name,$rand_doc_no,$created_at,$user_no,$file_from_user]);
				// move_uploaded_file($file, $destination);
				if ($result2) {
					echo "File uploaded successfully";
				}
			} else {
				echo "Failed to upload file.";
			}
		}

		// add status
		$status_name = $_POST['status_name'];
		$status_id = $_POST['status_id'];
		$sql2 = "INSERT INTO status_doc SET status_id=?,status_name=?,doc_no=?,updated_status=?,user_no_update_status=?";
		$result2 = modifyRecord($sql2,'ssssi',[$status_id,$status_name,$rand_doc_no,$created_at,$user_no]);

		foreach ($_POST['budget_year'] as $key => $value) {
			$budget_year = $_POST['budget_year'][$key];
			$sql = "INSERT INTO budget_y SET doc_no=?,budget_year=?";
			$result = modifyRecord($sql,'ss',[$rand_doc_no,$budget_year]);
		} 

		foreach ($_POST['budget_month'] as $key => $value) {
			$budget_month = $_POST['budget_month'][$key];
			$sql = "INSERT INTO budget_m SET doc_no=?,budget_month=?";
			$result = modifyRecord($sql,'ss',[$rand_doc_no,$budget_month]);
		} 
  
	   if ($result) {
         $_SESSION['success_msg'] = "ยื่นคำร้องสำเร็จแล้ว กรุณารอเจ้าหน้าที่ดำเนินการ";
         header("location: " . BASE_URL . "index.php");
         exit(0);
       } else {
         $_SESSION['error_msg'] = "Something went wrong. Could not save in Database";
       }

}

function getUserFinal($docno) {

    $sql = "SELECT sd.updated_status,u.person_firstname,person_lastname
              FROM status_doc sd
              LEFT JOIN users u 
              ON sd.user_no_update_status = u.id
              WHERE sd.status_id='6' AND sd.doc_no=?";
    $get_user_final = getSingleRecord($sql,'s',[$docno]);
    return $get_user_final;
  }

function getUserDoc(){
    global $conn;
    $sql = "SELECT d.*,s.status_id,s.status_name,s.updated_status FROM document AS d 
	LEFT JOIN status_doc AS s
	ON d.doc_no = s.doc_no AND d.last_status = s.status_id
	WHERE user_no = ".$_SESSION['user']['id']."";
    $listuserdoc = getMultipleRecords($sql);
    return $listuserdoc;
}

function getAllDocForDC(){
    global $conn;
    $sql = "SELECT d.*,u.person_firstname,u.person_lastname,s.status_name,s.status_id FROM document AS d
	LEFT JOIN users AS u
	ON d.user_no = u.id
	LEFT JOIN status_doc AS s
	ON d.doc_no = s.doc_no";
    $listalldoc = getMultipleRecords($sql);
    return $listalldoc;
}

function getAllDocForCom(){
    global $conn;
    $sql = "SELECT * FROM document";
    $listalldoc = getMultipleRecords($sql);
    return $listalldoc;
}

function getDetailDocForDC($docno){
    global $conn;
    $sql = "SELECT d.*,f.file_path,u.person_firstname,u.person_lastname,u.office_id,o.ward_name,sd.updated_status
	FROM document d 
	LEFT JOIN file_management f 
	ON d.doc_no = f.doc_no 
	LEFT JOIN users u 
	ON d.user_no = u.id
	LEFT JOIN office_sit o
	ON u.office_id = o.ward_id
	LEFT JOIN status_doc sd
 	ON d.last_status = sd.status_id
	WHERE d.doc_no=? LIMIT 1";
    $showdoc = getSingleRecord($sql,'s',[$docno]);
    return $showdoc;
}

function getDetailBudgetY($docno){
    global $conn;
    $sql = "SELECT y.value_year
	FROM budget_y b_y
	LEFT JOIN years y
	ON b_y.budget_year = y.id_year
	WHERE b_y.doc_no=$docno";
    $getbudgetY = getMultipleRecords($sql);
    return $getbudgetY;
}

function getDetailBudgetM($docno){
    global $conn;
    $sql = "SELECT m.value_month
	FROM budget_m b_m
	LEFT JOIN months m
	ON b_m.budget_month = m.id_month
	WHERE b_m.doc_no=$docno";
    $getbudgetM = getMultipleRecords($sql);
    return $getbudgetM;
}

function getFileDCToUser($docno) {
    $sql = "SELECT f.*
    FROM file_management f 
		LEFT JOIN document d
		ON d.doc_no = f.doc_no
    WHERE d.doc_no=$docno AND f.file_dc_to_user=1 ";
    $file_dc_to_user = getMultipleRecords($sql);
    return $file_dc_to_user;
  }



function uploadDoc(){
	
	// name of the uploaded file
	$filename = $_FILES['file_template']['name'];
	
	// get the file extension
	$extension = pathinfo($filename, PATHINFO_EXTENSION);
	// $name = pathinfo($filename, PATHINFO_FILENAME);

	// the physical file on a temporary uploads directory on the server
	$file = $_FILES['file_template']['tmp_name'];

	$path1= '../upload/';
	$new_name = rand(100000,999999).".".$extension;

	if (!in_array($extension, ['zip', 'pdf', 'docx','doc','xlsx','xls','rar','jpg','jpeg','png'])) {
		echo "You file extension must be .zip, .pdf or .docx";
	} elseif ($_FILES['file_template']['size'] > 100000000) { // file shouldn't be larger than 1Megabyte
		echo "File too large!";
	} else {
		// move the uploaded (temporary) file to the specified destination
		if (move_uploaded_file($file,"$path1/$new_name")) {
			$rand_doc_no = rand(100000,999999);
			$sql2 = "INSERT INTO file_management SET file_path=?,doc_no=?";
			$result2 = modifyRecord($sql2, 'ss', [$new_name,$rand_doc_no]);
			// move_uploaded_file($file, $destination);
			if ($result2) {
				echo "File uploaded successfully";
			}
		} else {
			echo "Failed to upload file.";
		}
	}
}



?>
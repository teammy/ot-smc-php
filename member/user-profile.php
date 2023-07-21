<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');

$user_id = $_GET['user_id'];
$member_getsingle = getSingleMember($user_id);
$get_all_office = getAllOffice();
$get_all_position = getAllPosition();
if ($_SESSION['user']['id'] == "") {
  header("Location: ../index.php");
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>แก้ไขข้อมูลส่วนตัว - <?php echo $web_des; ?></title>
  <link href="assets/img/favicon.png" rel="icon">

  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->


  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL . 'assets/vendor/bootstrap-icons/bootstrap-icons.css' ?>" rel="stylesheet">
  <link href="<?php echo BASE_URL . 'assets/vendor/boxicons/css/boxicons.min.css' ?>" rel="stylesheet">
  <link href="<?php echo BASE_URL . 'assets/vendor/quill/quill.snow.css' ?>" rel="stylesheet">
  <link href="<?php echo BASE_URL . 'assets/vendor/quill/quill.bubble.css' ?>" rel="stylesheet">
  <link href="<?php echo BASE_URL . 'assets/vendor/remixicon/remixicon.css' ?>" rel="stylesheet">
  <link href="<?php echo BASE_URL . 'assets/vendor/simple-datatables/style.css' ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/admin-style.css' ?>">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="<?php echo BASE_URL . 'assets/js/bootbox.min.js' ?>"></script>
  <script type="text/javascript" src="deleteRecord.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
  <script type="text/javascript">
    $(document).ready(function() {
      $("#office_id").select2({
        theme: "bootstrap-5",
      });
    });
  </script>

</head>

<body>

  <?php include(INCLUDE_PATH . "/layouts/admin_header.php"); ?>

  <?php include(INCLUDE_PATH . "/layouts/admin_sidebar.php"); ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>โปรไฟล์</h1>

    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
              </svg>
              <h2><?php echo $member_getsingle['person_firstname'] . ' ' . $member_getsingle['person_lastname']; ?></h2>
              <h3><?php echo $member_getsingle['position_name']; ?></h3>

            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">ข้อมูลทั่วไป</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">แก้ไขโปร์ไฟล์</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">แก้ไขรหัสผ่าน</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">ข้อมูลส่วนตัว</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">ชื่อ-สกุล</div>
                    <div class="col-lg-9 col-md-8"><?php echo $member_getsingle['person_firstname'] . ' ' . $member_getsingle['person_lastname']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ตำแหน่ง</div>
                    <div class="col-lg-9 col-md-8"><?php echo $member_getsingle['position_name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">หน่วยงาน</div>
                    <div class="col-lg-9 col-md-8"><?php echo $member_getsingle['ward_name']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">เบอร์โทร</div>
                    <div class="col-lg-9 col-md-8"><?php echo $member_getsingle['person_tel']; ?></div>
                  </div>


                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="member-all.php">


                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">ชื่อ</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstname" type="text" class="form-control" id="firstname" value="<?php echo $member_getsingle['person_firstname']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">นามสกุล</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" class="form-control" id="lastname" value="<?php echo $member_getsingle['person_lastname']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">หน่วยงาน</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="office_id" id="office_id">
                          <?php foreach ($get_all_office as $key => $value) :
                            if ($value['ward_id'] == $member_getsingle['ward_id']) { ?>
                              <option selected="selected" value="<?php echo $value['ward_id']; ?>"><?php echo $value['ward_name']; ?></option>
                            <?php } else { ?>
                              <option value="<?php echo $value['ward_id']; ?>"><?php echo $value['ward_name']; ?></option>
                          <?php }
                          endforeach ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="position_id" class="col-md-4 col-lg-3 col-form-label">ตำแหน่ง</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select" name="position_id" id="position_id">
                          <?php foreach ($get_all_position as $key => $value) :
                            if ($value['position_id'] == $member_getsingle['position_id']) { ?>
                              <option selected="selected" value="<?php echo $value['position_id']; ?>"><?php echo $value['position_name']; ?></option>
                            <?php } else { ?>
                              <option value="<?php echo $value['position_id']; ?>"><?php echo $value['position_name']; ?></option>
                          <?php }
                          endforeach ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">เบอร์โทร</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo $member_getsingle['person_tel']; ?>">
                      </div>
                    </div>




                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="change-profile" value="<?php echo $user_id; ?>">บันทึก</button>
                    </div>


                </div>



                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">รหัสผ่านใหม่</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">ยืนยันรหัสผ่านใหม่</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="change_pw" value="<?php echo $user_id; ?>">เปลี่ยนรหัสผ่าน</button>
                  </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
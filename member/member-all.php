<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');

$member_result = getAllMember();
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Admin</title>
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
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.3.0/dist/style.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/admin-style.css' ?>">

</head>

<body>

  <?php include(INCLUDE_PATH . "/layouts/admin_header.php"); ?>

  <?php include(INCLUDE_PATH . "/layouts/admin_sidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>สมาชิกทั้งหมด</h1>

    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>

                    <th scope="col">ชื่อ-สกุล</th>
                    <th scope="col">ตำแหน่ง</th>
                    <th scope="col">หน่วยงาน</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($member_result as $key => $value) : ?>
                    <tr>

                      <td><?php echo $value['person_firstname'] . ' ' . $value['person_lastname']; ?></td>
                      <td><?php echo $value['position_name']; ?></td>
                      <td><?php echo $value['ward_name']; ?></td>
                      <td><?php echo $value['username']; ?></td>
                      <td><?php echo $value['pwd']; ?></td>

                      <td class="text-end">
                        <a href="<?php echo BASE_URL . 'member/user-profile.php?user_id=' . $value['id']; ?>" class="btn btn-primary"><i class="bi bi-list-ul me-1e"></i> ข้อมูลผู้ใช้</a>

                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
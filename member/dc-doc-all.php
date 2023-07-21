<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');

$all_doc_result = getAllDoc();
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
  <link href="<?php echo BASE_URL . 'assets/vendor/simple-datatables/style.css' ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/admin-style.css' ?>">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="<?php echo BASE_URL . 'assets/js/bootbox.min.js' ?>"></script>
  <script type="text/javascript" src="deleteRecord.js"></script>

</head>

<body>

  <?php include(INCLUDE_PATH . "/layouts/admin_header.php"); ?>

  <?php include(INCLUDE_PATH . "/layouts/admin_sidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>คำร้องที่ขอรายงาน</h1>

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
                    <th scope="col">เลขที่</th>
                    <th scope="col">ความเร่งด่วน</th>
                    <th scope="col">หัวข้อ</th>
                    <th scope="col">ชื่อ-สกุล ผู้ยื่น</th>
                    <th scope="col" class="text-center">วันที่ยื่น</th>
                    <th scope="col" class="text-center">สถานะ</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $year = date("Y") + 543;
                  $time = substr($year, 2, 4);
                  foreach ($all_doc_result as $key => $value) : ?>
                    <tr>
                      <th scope="row"><?php echo $time . '' . str_pad($value['id'], 5, '0', STR_PAD_LEFT); ?></th>
                      <td>
                        <?php if ($value['important'] == 'ด่วน') {  ?>
                          <button type="button" class="btn btn-warning btn-sm"><?php echo $value['important']; ?></button>
                        <?php } elseif ($value['important'] == 'ด่วนมาก') { ?>
                          <button type="button" class="btn btn-danger btn-sm"><?php echo $value['important']; ?></button>
                        <?php } else { ?>
                          <button type="button" class="btn btn-primary btn-sm"><?php echo $value['important']; ?></button>
                        <?php } ?>
                      </td>
                      <td><?php echo $value['subject_doc']; ?></td>
                      <td><?php echo $value['person_firstname'] . ' ' . $value['person_lastname']; ?></td>
                      <td class="text-center"><?php echo thai_date($value['createdon'], 1, false); ?></td>
                      <?php if ($value['status_id'] == '1') { ?>
                        <td class="text-center">
                          <h5><span class="badge rounded-pill bg-danger fw-normal"><?php echo $value['status_name']; ?></span></h5>
                        </td>
                      <?php } elseif ($value['status_id'] == '2') { ?>
                        <td>
                          <h5><span class="badge rounded-pill bg-warning fw-normal"><?php echo $value['status_name']; ?></span></h5>
                        </td>
                      <?php } elseif ($value['status_id'] == '6') { ?>
                        <td>
                          <h5><span class="badge rounded-pill bg-success fw-normal"><?php echo $value['status_name']; ?></span></h5>
                        </td>
                      <?php } else {
                      } ?>
                      <td class="text-end">

                        <a href="dc-show-doc.php?doc_no=<?php echo $value["doc_no"]; ?>"><button type="button" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>รับงาน</button></a>

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
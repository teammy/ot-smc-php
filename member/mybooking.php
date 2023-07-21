<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');

$get_all_my_booking = getAllMyBooking();
if ($_SESSION['user']['id'] == "") {
  header("Location: ../index.php");
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>รายการจองของคุณ - <?php echo $web_des; ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->


  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Sarabun&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo BASE_URL . 'assets/vendor/bootstrap-icons/bootstrap-icons.css' ?>" rel="stylesheet">
  <link href="<?php echo BASE_URL . 'assets/vendor/boxicons/css/boxicons.min.css' ?>" rel="stylesheet">
  <link href="<?php echo BASE_URL . 'assets/vendor/quill/quill.snow.css' ?>" rel="stylesheet">
  <link href="<?php echo BASE_URL . 'assets/vendor/quill/quill.bubble.css' ?>" rel="stylesheet">
  <link href="<?php echo BASE_URL . 'assets/vendor/remixicon/remixicon.css' ?>" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.3.0/dist/style.min.css" rel="stylesheet">
  <script src="<?php echo BASE_URL . 'node_modules/sweetalert2/dist/sweetalert2.min.js' ?>"></script>
  <link rel="stylesheet" href="<?php echo BASE_URL . 'node_modules/sweetalert2/dist/sweetalert2.min.css' ?>">
  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/admin-style.css' ?>">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script src="<?php echo BASE_URL . 'assets/js/bootbox.min.js' ?>"></script>
  <script type="text/javascript" src="deleteRecord.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body>

  <?php include(INCLUDE_PATH . "/layouts/admin_header.php"); ?>

  <?php include(INCLUDE_PATH . "/layouts/admin_sidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>รายการจองของคุณ</h1>

    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!-- Table with stripped rows -->
              <table class="table datatable" id="datatablesSimple">
                <thead>
                  <tr>
                    <th scope="col">วันที่จอง</th>
                    <th scope="col">เวร</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $year = date("Y") + 543;
                  $time = substr($year, 2, 4);
                  foreach ($get_all_my_booking as $key => $value) : ?>
                    <tr>
                      <td><?php echo $value['booking_date']; ?></td>
                      <td><?php echo $value['ot_time_name']; ?></td>

                      <td>
                        <button class="btn btn-sm btn-danger delete_product" data-id="<?php echo $value['booking_id']; ?>">ยกเลิกเวร</button>
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
<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');

// $onjob_result = getAllDoc_Com_onjob();

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
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


  <!-- Full Calendar JS CSS -->
  <link href="<?php echo BASE_URL . 'lib-calendar/main.css' ?>" rel='stylesheet' />
  <script src="<?php echo BASE_URL . 'lib-calendar/main.js' ?>"></script>
  <script src="<?php echo BASE_URL . 'lib-calendar/ot-calendar-script.js' ?>"></script>

  <style>
    #script-warning {
      display: none;
      background: #eee;
      border-bottom: 1px solid #ddd;
      padding: 0 10px;
      line-height: 40px;
      text-align: center;
      font-weight: bold;
      font-size: 12px;
      color: red;
    }

    #loading {
      display: none;
      position: absolute;
      top: 10px;
      right: 10px;
    }

    #calendar {
      max-width: 1100px;
      margin: 40px auto;
      padding: 0 10px;
    }
  </style>

</head>

<body>


  <?php include(INCLUDE_PATH . "/layouts/admin_header.php"); ?>

  <?php include(INCLUDE_PATH . "/layouts/admin_sidebar.php"); ?>


  <main id="main" class="main">



    <div class="pagetitle">
      <h1>ปฏิทินการจอง</h1>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="col-lg-3">
                <select id="selector" class="form-select mt-3">
                  <!-- <option value="all">กรุณาเลือกตำแหน่ง</option>
                <option value="7">นวก.คอม</option>
                <option value="22">พยาบาล</option>
                <option value="89">พนักงานช่วยเหลือคนไข้</option> -->



                  <option value="22" selected>พยาบาลวิชาชีพ</option>
                  <option value="27">ตำแหน่งอื่นๆ (PN,NA,EMT,Paramedic)</option>
                </select>
              </div>
              <div id="loading"></div>
              <div id='calendar'></div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <script>
  </script>


  <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
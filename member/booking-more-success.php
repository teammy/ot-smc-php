<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');

$get_BookingCreateSuccess = BookingCreateMoreSuccess();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>จอง OT</title>


    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/bootstrap-icons/bootstrap-icons.css' ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/boxicons/css/boxicons.min.css' ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/quill/quill.snow.css' ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/quill/quill.bubble.css' ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/remixicon/remixicon.css' ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/simple-datatables/style.css' ?>" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/admin-style.css' ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <style>
        .ui-datepicker-prev {
            display: none;
        }

        .ui-datepicker-next {
            display: none;
        }
    </style>


</head>

<body>

    <?php include(INCLUDE_PATH . "/layouts/admin_header.php"); ?>

    <?php include(INCLUDE_PATH . "/layouts/admin_sidebar.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>ทำรายการจอง</h1>

        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-danger bg-danger text-light border-0" role="alert">
                                <i class="bi bi-check-circle me-1"></i> การจองสำเร็จแล้ว
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">วันที่จอง</label>
                                <div class="col-sm-10">
                                    <div class="card-text mt-2 fw-semibold"><?php echo thai_month($get_BookingCreateSuccess['booking_date'], 1); ?></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">เวร OT ที่จอง</label>
                                <div class="col-sm-10">
                                    <div class="card-text mt-2 fw-semibold"><?php echo $get_BookingCreateSuccess['ot_time_name']; ?></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อสกุลผู้จอง</label>
                                <div class="col-sm-10">
                                    <div class="card-text mt-2 fw-semibold"><?php echo $get_BookingCreateSuccess['person_firstname']; ?></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">เบอร์ติดต่อ</label>
                                <div class="col-sm-10">
                                    <div class="card-text mt-2 fw-semibold"><?php echo $get_BookingCreateSuccess['user_phone']; ?></div>
                                </div>
                            </div>

                            <a href="../member/booking.php">กลับหน้าหลัก</a>


                        </div>
                    </div>

                </div>
            </div>
        </section>


    </main><!-- End #main -->

    <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
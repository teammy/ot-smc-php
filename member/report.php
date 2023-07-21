<?php
include('../config.php');
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
            <h1>สรุปตารางเวร</h1>

        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>

                            <div>
                                <form action="export_table.php" method="post">

                                    <div class="row mb-4">
                                        <label for="report_select_month" class="col-sm-2 col-form-label">เลือกเดือน</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" name="report_select_month" id="report_select_month">
                                                <option value="1">มกราคม</option>
                                                <option value="2">กุมภาพันธ์</option>
                                                <option value="3">มีนาคม</option>
                                                <option value="4">เมษายน</option>
                                                <option value="5">พฤษภาคม</option>
                                                <option value="6">มิถุนายน</option>
                                                <option value="7">กรกฎาคม</option>
                                                <option value="8">สิงหาคม</option>
                                                <option value="9">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤศจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="report_select_year" class="col-sm-2 col-form-label">ปี</label>
                                        <div class="col-sm-10">
                                            <div><?php echo date("Y") + 543; ?> </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="report_position_id" class="col-sm-2 col-form-label">เลือกตำแหน่ง</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" name="report_position_id" id="report_position_id">
                                                <option value="22">พยาบาล (RN)</option>                     
                                                <option value="89">ผู้ช่วยเหลือคนไข้ (NA)</option>
                                                <option value="126">ผู้ช่วยพยาบาล (PN)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary" name="go-to-excel">ดูตารางเวร</button>
                                            <input type="hidden" name="hidden_export" value="1">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');


$_SESSION['report_select_m'] = $_POST['report_select_month'];
$_SESSION['report_posit_id'] = $_POST['report_position_id'];


if (isset($_POST['hidden_export'])) {
    $export_excel = ReportExcel($_SESSION['report_posit_id'], $_SESSION['report_select_m']);
}


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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#export-menu button').bind("click", function() {
                var target = $(this).attr('id');
                switch (target) {
                    case 'export-to-excel':
                        $('#hidden-type').val(target);
                        //alert($('#hidden-type').val());
                        $('#export-form').submit();
                        $('#hidden-type').val('');
                        break
                }
            });
        });
    </script>



</head>

<body>

    <?php include(INCLUDE_PATH . "/layouts/admin_header.php"); ?>

    <?php include(INCLUDE_PATH . "/layouts/admin_sidebar.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>รายงานการจอง OT</h1>

        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="card-title float-start">ตารางเวรการจอง OT ประจำเดือน </div>
                            <div>
                                <div id="export-menu" class="float-end mt-3">
                                    <button class="btn btn-primary" id="export-to-excel"><i class="bi bi-cloud-arrow-down"></i> Export excel</button>
                                </div>
                                <form action="export_excel.php" method="post" id="export-form">
                                    <input type="hidden" value='' id='hidden-type' name='ExportType' />
                                </form>

                                <table border="1" class="table table-bordered">
                                    <thead>
                                        <tr class="info">
                                            <th>ชื่อ-สกุล</th>
                                            <th>วอร์ด</th>
                                            <th>ตำแหน่ง</th>
                                            <?php
                                            for ($x = 1; $x <= 31; $x++) {
                                                echo "<th>$x</th>";
                                            }
                                            ?>
                                            <th>OT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($export_excel as $key => $value) :
                                            $i++;
                                        ?>


                                            <tr>
                                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $i; ?>"><?php echo $value['lname']; ?></a></td>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-<?php echo $i; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">ข้อมูลส่วนตัว</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>โทร.<?php echo $value['user_phone']; ?></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <td>
                                                    <?php echo $value['ward_name']; ?>
                                                </td>
                                                <td><?php echo $value['position_name']; ?></td>
                                                <?php
                                                for ($x = 1; $x <= 31; $x++) {
                                                    echo "<td>" . $value["d" . $x] . "</td>";
                                                }
                                                ?>
                                                <td><?php echo $value['total_ot']; ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
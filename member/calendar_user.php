<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');

// $onjob_result = getAllDoc_Com_onjob();
if ($_SESSION['user']['id'] == "") {
    header("Location: ../index.php");
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>ปฏิทินการจองทั้งหมด - <?php echo $web_des; ?></title>
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
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="<?php echo BASE_URL . 'assets/js/bootbox.min.js' ?>"></script>


    <!-- Full Calendar JS CSS -->
    <link href="<?php echo BASE_URL . 'lib-calendar/main.css' ?>" rel='stylesheet' />
    <script src="<?php echo BASE_URL . 'lib-calendar/main.js' ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let selector = document.querySelector("#selector");
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'th',
                initialDate: moment().add(1, "months").toDate(),
                eventOrder: true,
                headerToolbar: {
                    start: '',
                    center: 'title',
                    end: ''
                },
                eventDidMount: function(arg) {

                    // console.log(val);
                    // if (!(arg.event.extendedProps.posit_id==val)) {
                    //     arg.el.style.display = "none";
                    // } else {

                    // }
                    // var icon = arg.event.extendedProps.icon;


                    // console.log(arg.event.extendedProps.icon);
                    // if (info.event.extendedProps.icon) {
                    //     $(info.el).find('.fc-event-title').prepend("<i class='fa fa-" + icon + "' data-toggle='tooltip' title='Test'></i>");
                    // }
                },
                eventSources: [{
                        url: '../api/booking-night.php',
                        method: 'GET',
                        extraParams: {
                            positid: '<?php echo $_SESSION['user']['position_id']; ?>'
                        },
                        failure: function() {
                            // alert('there was an error while fetching events!');
                            //console.log();
                        },
                        color: '#356BF8', // a non-ajax option
                        textColor: 'white' // a non-ajax option
                    }, {
                        url: '../api/booking-day.php',
                        method: 'GET',
                        extraParams: {
                            positid: '<?php echo $_SESSION['user']['position_id']; ?>'
                        },
                        failure: function() {
                            // alert('there was an error while fetching events!');
                            //console.log();
                        },
                        color: '#FF8E00', // a non-ajax option
                        textColor: 'white' // a non-ajax option
                    },
                    {
                        url: '../api/booking-afternoon.php',
                        method: 'GET',
                        extraParams: {
                            positid: '<?php echo $_SESSION['user']['position_id']; ?>'
                        },
                        failure: function() {
                            // alert('there was an error while fetching events!');
                            //console.log();
                        },
                        color: '#3BCEAC', // a non-ajax option
                        textColor: 'white' // a non-ajax option
                    }


                ]


            });
            calendar.render();


        });
    </script>

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
            <h1>ปฏิทินการจองทั้งหมด</h1>
        </div><!-- End Page Title -->



        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="container text-center position-relative" style="max-width: 1100px;">
                                <div class="row row-cols-auto position-absolute top-0 end-0 pt-5">
                                    <div class="col">
                                        <div class="rounded rounded-2" style="width:50px; height:20px; background-color:#356BF8;"></div>เวรดึก
                                    </div>
                                    <div class="col">
                                        <div class="rounded rounded-2" style="width:50px; height:20px; background-color:#FF8E00;"></div>เวรเช้า
                                    </div>
                                    <div class="col">
                                        <div class="rounded rounded-2" style="width:50px; height:20px; background-color:#3BCEAC;"></div>เวรบ่าย
                                    </div>
                                </div>
                            </div>

                            <div id="loading"></div>
                            <div id='calendar'>

                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </section>

    </main><!-- End #main -->


    <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
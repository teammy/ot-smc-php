<?php
include('../config.php');

$selectedDate = '2023-07-17'; // example, this will be the date the user selected
$dateTime = new DateTime($selectedDate);
$selectedDay = $dateTime->format('l');



if ($_SESSION['user']['id'] == "") {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>ทำรายการจอง - <?php echo $web_des; ?></title>


    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/bootstrap-icons/bootstrap-icons.css' ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/boxicons/css/boxicons.min.css' ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/quill/quill.snow.css' ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/quill/quill.bubble.css' ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/remixicon/remixicon.css' ?>" rel="stylesheet">
    <link href="<?php echo BASE_URL . 'assets/vendor/simple-datatables/style.css' ?>" rel="stylesheet">
    <script src="<?php echo BASE_URL . 'node_modules/sweetalert2/dist/sweetalert2.min.js' ?>"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'node_modules/sweetalert2/dist/sweetalert2.min.css' ?>">



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
                            <h5 class="card-title"></h5>

                            <div>
                                <!-- <h2>ปิดการจอง...</h2> -->
                                <form id="bookForm" method="POST">
                                    <div class="row mb-4">
                                        <label for="inputText" class="col-sm-2 col-form-label">เลือกวันที่</label>
                                        <div class="col-sm-10">
                                            <!-- <input type="text" class="form-control" name="datepicker" id="datepicker"> -->
                                            <input type="text" class="form-control" name="booking_date" id="booking_date">
                                            <input type="hidden" id="booking_date_input" name="booking_date_input" value="">
                                            <input type="hidden" name="positionId" id="positionId" value="<?php echo $_SESSION['user']['position_id']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="inputText" class="col-sm-2 col-form-label">เลือก OT ที่ต้องการ</label>

                                        <div class="col-sm-10" id="radioButtonContainer">

                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="inputText" class="col-sm-2 col-form-label">เบอร์โทร</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="user_phone" id="user_phone" value="<?php echo $_SESSION['user']['person_tel']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10" id="submitDiv">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <script>
                                $(function() {

                                    // var d = new Date("date ");
                                    // var toDay = d.getDate() + '/' +
                                    //     (d.getMonth() + 1) + '/' +
                                    //     (d.getFullYear() + 543);

                                    // $("#booking_date").datepicker({
                                    //     showButtonPanel: false,
                                    //     defaultDate: "+1m",
                                    //     duration: 'fast',
                                    //     altField: "#booking_date_input",
                                    //     altFormat: "yy-mm-dd",
                                    //     dateFormat: "dd/mm/yy",
                                    //     stepMonths: 0,
                                    //     dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
                                    //     dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
                                    //     monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                                    //     monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
                                    // });
                                });
                            </script>
                            <!-- <script>
                                $(document).ready(function() {

                                    $('#bookForm').submit(function(e) {
                                        let x = document.forms['bookForm']['ot_select'].value;
                                        if (x == "") {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'ไม่สามารถทำรายการ! เนื่องจากไม่พบ OT ที่คุณเลือก'
                                            })
                                            return false;
                                        } else {
                                            e.preventDefault() // -> อันนี้สำคัญต้องใส่ เพื่อไม่หน้ามันรีโหลด
                                            var form = $(this)
                                            $.ajax({
                                                url: 'createBooking.php',
                                                method: 'POST',
                                                dataType: 'JSON',
                                                data: form.serialize(), /// -> ค่าของฟอร์มทั้งหมด                                          
                                            }).done(function(res) {
                                                Swal.fire({
                                                    position: 'center',
                                                    icon: 'success',
                                                    title: res.message,
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(() => {
                                                    window.location = "./booking.php";
                                                })
                                            }).fail(function(err) {
                                                alert(err.message)
                                            })
                                        }
                                    })

                                    // on change province
                                    $('#booking_date').change(function() {
                                        var date = $("#booking_date_input").val();
                                        $("#booking_date_input").val(date).trigger("change");
                                    });

                                    $("#booking_date_input").bind("change", function() {

                                        $.get('check_availability.php', {
                                            date_select: $(this).val()
                                        }, function(data) {

                                            var result = JSON.parse(data);

                                            $.each(result, function(index, item) {
                                                html = '';
                                                html += '' +
                                                    '<input type="radio" class="btn-check" name="ot_select"  autocomplete="off" id="ot_select' + item.ot_time_id + '" value="' + item.ot_time_id + '">' +
                                                    '<label class="btn btn-outline-danger me-2" id="ot_select_value" for="ot_select' + item.ot_time_id + '">' + item.ot_time_name + '</label>' +
                                                    '';
                                                $('#result').append(html);
                                            });

                                        });
                                        $("#result").empty();
                                    });

                                });
                            </script> -->

                            <script>
                                $(document).ready(function() {
                                    var formattedDate;
                                    function fetchDataForDay(dataName, formatDate) {
                                        $.ajax({
                                            url: "../api/getSlot.php", // TODO: replace with your server script URL
                                            data: {
                                                datename: dataName, // Pass the selected date to the server script
                                                formatdate: formatDate 
                                            },
                                            success: function(result) {
                                                // The server responded successfully, log the result
                                                console.log(result);

                                                // Clear any previous radio buttons
                                                $('#radioButtonContainer').html("");

                                                // Create the specified number of radio buttons
                                                for (var i = 1; i <= result; i++) {
                                                    // Create a radio button dynamically
                                                    var radioButton = $('<input>');

                                                    // Set the radio button properties
                                                    radioButton.attr('type', 'radio');
                                                    radioButton.attr('class', 'btn-check');
                                                    radioButton.attr('name', 'otSlot');
                                                    radioButton.attr('id', 'otSlot' + i);
                                                    radioButton.attr('value', i);

                                                    // Add an onchange event handler to the radio button
                                                    radioButton.on('change', function() {
                                                        // If a radio button is selected, show the submit button
                                                        $('#submitOT').show();
                                                    });

                                                    // Create a label for the radio button
                                                    var label = $('<label>');
                                                    label.attr('for', 'otSlot' + i);
                                                    label.attr('class', 'btn btn-outline-danger me-2');
                                                    label.text("OT " + i);

                                                    // Add the radio button and label to the DOM
                                                    $('#radioButtonContainer').append(radioButton, label);
                                                }

                                                // Add a submit button
                                                var submitButton = $('<button>');
                                                submitButton.attr('id', 'submitOT');
                                                submitButton.attr('class', 'btn btn-primary');
                                                submitButton.text("บันทึก");
                                                submitButton.hide(); // Initially hide the submit button

                                                // Add a click event handler to the submit button
                                                submitButton.on('click', function(event) {
                                                    // Get the selected slot
                                                    event.preventDefault();
                                                    var selectedSlot = $('input[name="otSlot"]:checked').val();
                                                    var userPhone = $('input[name="user_phone"]').val();
                                                    // Make an AJAX request to your reservation script
                                                    var formatDate = $('#submitOT').data('date');

                                                    $.ajax({
                                                        url: "../member/createBooking.php",
                                                        method: "POST",
                                                        data: {
                                                            dateSelect: formatDate,
                                                            slot: selectedSlot,
                                                            user_phone:userPhone
                                                        },
                                                        dataType: "JSON",
                                                        success: function(reservationResult) {
                                                            // The server responded successfully, log the result
                                                            // console.log(reservationResult);
                                                            if(reservationResult.status == 'success') {
                                                                Swal.fire({
                                                                    title: reservationResult.message,
                                                                    icon: 'success',
                                                                    showConfirmButton: false,
                                                                    text: reservationResult.message,
                                                                    timer: 1500
                                                                }).then((result) => {
                                                                    location.reload();
                                                                })
                                                            } else {
                                                                Swal.fire({
                                                                    icon: 'error',
                                                                    title: 'Oops...',
                                                                    text: reservationResult.message,
                                                                })
                                                            
                                                            }
                                                        },
                                                        error: function(reservationResult) {
                                                            // The server responded with an error, log the error
                                                            console.log(error);
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Oops...',
                                                                text: 'Something went wrong!',
                                                            })
                                                        }
                                                    });
                                                });

                                                
                                                // Add a submit button Div
                                                $('#submitDiv').append(submitButton);

                                                // Add the submit button to the DOM
                                                // $('#radioButtonContainer').append(submitButton);
                                            }
                                        });
                                    }

                                    $("#booking_date").datepicker({
                                        showButtonPanel: false,
                                        defaultDate: "+1m",
                                        duration: 'fast',
                                        altField: "#booking_date_input",
                                        altFormat: "yy-mm-dd",
                                        dateFormat: "dd/mm/yy",
                                        stepMonths: 0,
                                        dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
                                        dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
                                        monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
                                        monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
                                        onSelect: function(dateText) {
                                            var date = $(this).datepicker('getDate');
                                            var timezoneOffset = date.getTimezoneOffset() * 60000;
                                            var formattedDate = (new Date(date - timezoneOffset)).toISOString().split('T')[0];
                                            $('#submitOT').data('date', formattedDate); 
                                            var dayOfWeek = date.getDay(); // Sunday - Saturday : 0 - 6
                                            var dayOfName = date.toLocaleDateString('en-US', {
                                                weekday: 'long'
                                            }); // Sunday - Saturday : 0 - 6

                                            $('#submitOT').hide();

                                            if (dayOfWeek >= 0 && dayOfWeek <= 6) {
                                                fetchDataForDay(dayOfName, formattedDate);
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
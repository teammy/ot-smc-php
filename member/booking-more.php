<?php
include('../config.php');
if ($_SESSION['user']['id'] == "") {
    header("Location: ../index.php");
} elseif ($_SESSION['user']['role_id'] == "8") {
    header("Location: ../member/calendar_user.php");
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

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
            <h1>ทำรายการจองให้ผู้อื่น</h1>

        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"></h5>

                            <div>
                                <h2>ปิดการจอง...</h2>
                                <!-- <form id="bookFormMore" method="POST">
                                <div class="row mb-4">
                                        <label for="inputText" class="col-sm-2 col-form-label">เลือกวันที่จอง</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="booking_date" id="booking_date">
                                            <input type="hidden" id="booking_date_input" name="booking_date_input" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="inputText" class="col-sm-2 col-form-label">เลือก OT</label>

                                        <div class="col-sm-10" id="result">

                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="input-name" class="col-sm-2 col-form-label">เลือกผู้ปฏิบัติงาน</label>
                                        <div class="col-sm-10">
                                            <select id="input-name" name="input-name" class="form-control select2"></select>


                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="inputText" class="col-sm-2 col-form-label">ตำแหน่ง</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="position" id="position" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="inputText" class="col-sm-2 col-form-label">หน่วยงาน</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="ward" id="ward" disabled>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="inputText" class="col-sm-2 col-form-label">เบอร์โทร</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="user_phone" id="user_phone">
                                        </div>
                                    </div>

                                    





                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary" name="booking-more-create" value="1">บันทึก</button>
                                            <input type="hidden" value="1" name="booking_status">
                                        </div>
                                    </div>
                                </form> -->
                            </div>

                            <script>
                                $(function() {

                                    var d = new Date("date ");
                                    var toDay = d.getDate() + '/' +
                                        (d.getMonth() + 1) + '/' +
                                        (d.getFullYear() + 543);

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
                                        monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
                                    });
                                });
                            </script>
                            <script>
                                $(document).ready(function() {

                                    $('#input-name').select2({
                                        theme: "bootstrap-5",
                                        type: "GET",
                                        allowClear: true,
                                        placeholder: 'ค้นหาชื่อ',
                                        ajax: {
                                            url: '../member/require_user.php',
                                            dataType: 'json',
                                            data: function(data) {
                                                return {
                                                    searchTerm: data.term // search term
                                                };
                                            },
                                            processResults: function(response) {
                                                return {
                                                    results: response
                                                };
                                            }
                                        }
                                    });

                                    $('#input-name').on('select2:select', function(e) {


                                        var requestOptions = {
                                            method: 'GET',
                                            redirect: 'follow'
                                        };
                                        var url = '../member/autocomplete-user.php?idUser=' + e.params.data.id;

                                        fetch(url, requestOptions)
                                            .then(response => response.text())
                                            .then(result => {
                                                //console.log(result);
                                                var jsonObj = JSON.parse(result);
                                                document.getElementById("position").value = jsonObj.posit_name;
                                                document.getElementById("ward").value = jsonObj.ward_name;
                                            })
                                            .catch(error => console.log('error', error));
                                    })
                                    $('#bookFormMore').submit(function(e) {
                                        e.preventDefault() // -> อันนี้สำคัญต้องใส่ เพื่อไม่หน้ามันรีโหลด
                                        var form = $(this)
                                        $.ajax({
                                            url: 'createBookingMore.php',
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
                                                window.location = "./mybooking.php";
                                            })
                                        }).fail(function(err) {
                                            alert(err.message)
                                        })
                                    })





                                    // $('#select-field-ward').select2({
                                    //     theme: "bootstrap-5",
                                    //     allowClear: true,
                                    //     placeholder: 'ค้นหาหน่วยงาน',
                                    //     ajax: {
                                    //         url: '../member/autocomplete-ward.php',
                                    //         dataType: 'json',
                                    //         delay: 250,
                                    //         data: function(data) {
                                    //             return {
                                    //                 searchWard: data.term // search term
                                    //             };
                                    //         },
                                    //         processResults: function(response) {
                                    //             return {
                                    //                 results: response
                                    //             };
                                    //         }
                                    //     }
                                    // });

                                    // on change province
                                    $('#booking_date').change(function() {
                                        var wardId = $("#booking_date_input").val();
                                        $("#booking_date_input").val(wardId).trigger("change");
                                        // var want_select_date = $(this).val();
                                    });


                                    $("#booking_date_input").bind("change", function() {
                                        var positId = $("#position_name").val();
                                        $.get("get_free_more_booking.php", {
                                                date_select: $(this).val(),
                                                position_id: positId
                                            },
                                            function(data) {
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
                            </script>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
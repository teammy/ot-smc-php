<?php
include('../config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <title>จองโอที SMC - ตั้งค่าการจองโอที</title>


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

  <?php include(INCLUDE_PATH . "/layouts/admin_sidebar.php");


  $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  $positionIds = [22, 89, 126];
  $existingData = [];

  foreach ($positionIds as $positionId) {
    foreach ($days as $day) {
      $sql = "SELECT * FROM ot_reservations WHERE day_of_week=? AND position_id=?";
      $existingRecord = getSingleRecord($sql, 'si', [$day, $positionId]);
      $existingData[$day . '_' . $positionId] = $existingRecord ? $existingRecord['ot_count'] : '';
    }
  }

  ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>ตั้งค่าการจองโอที</h1>

    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <div>
                <form id="slotForm" method="post">
                  <div class="row">
                    <div class="col-md-4">
                      <h4>พยาบาล (RN)</h4>
                      <div class="row mb-3">
                        <label for="Monday_22" class="form-label col-sm-2">จันทร์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Monday_22" name="Monday_22" value="<?php echo $existingData['Monday_22']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Tuesday_22" class="form-label col-sm-2">อังคาร</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Tuesday_22" name="Tuesday_22" value="<?php echo $existingData['Tuesday_22']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Wednesday_22" class="form-label col-sm-2">พุธ</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Wednesday_22" name="Wednesday_22" value="<?php echo $existingData['Wednesday_22']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Thursday_22" class="form-label col-sm-2">พฤหัสบดี</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Thursday_22" name="Thursday_22" value="<?php echo $existingData['Thursday_22']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Friday_22" class="form-label col-sm-2">ศุกร์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Friday_22" name="Friday_22" value="<?php echo $existingData['Friday_22']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Saturday_22" class="form-label col-sm-2">เสาร์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Saturday_22" name="Saturday_22" value="<?php echo $existingData['Saturday_22']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Sunday_22" class="form-label col-sm-2">อาทิตย์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Sunday_22" name="Sunday_22" value="<?php echo $existingData['Sunday_22']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <h4>ผู้ช่วยพยาบาล (PN)</h4>
                      <div class="row mb-3">
                        <label for="Monday_126" class="form-label col-sm-2">จันทร์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Monday_126" name="Monday_126" value="<?php echo $existingData['Monday_126']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Tuesday_126" class="form-label col-sm-2">อังคาร</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Tuesday_126" name="Tuesday_126" value="<?php echo $existingData['Tuesday_126']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Wednesday_126" class="form-label col-sm-2">พุธ</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Wednesday_126" name="Wednesday_126" value="<?php echo $existingData['Wednesday_126']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Thursday_126" class="form-label col-sm-2">พฤหัสบดี</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Thursday_126" name="Thursday_126" value="<?php echo $existingData['Thursday_126']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Friday_126" class="form-label col-sm-2">ศุกร์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Friday_126" name="Friday_126" value="<?php echo $existingData['Friday_126']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Saturday_126" class="form-label col-sm-2">เสาร์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Saturday_126" name="Saturday_126" value="<?php echo $existingData['Saturday_126']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Sunday_126" class="form-label col-sm-2">อาทิตย์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Sunday_126" name="Sunday_126" value="<?php echo $existingData['Sunday_126']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <h4>ผู้ช่วยเหลือคนไข้ (NA)</h4>
                      <div class="row mb-3">
                        <label for="Monday_89" class="form-label col-sm-2">จันทร์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Monday_89" name="Monday_89" value="<?php echo $existingData['Monday_89']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Tuesday_89" class="form-label col-sm-2">อังคาร</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Tuesday_89" name="Tuesday_89" value="<?php echo $existingData['Tuesday_89']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Wednesday_89" class="form-label col-sm-2">พุธ</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Wednesday_89" name="Wednesday_89" value="<?php echo $existingData['Wednesday_89']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Thursday_89" class="form-label col-sm-2">พฤหัสบดี</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Thursday_89" name="Thursday_89" value="<?php echo $existingData['Thursday_89']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Friday_89" class="form-label col-sm-2">ศุกร์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Friday_89" name="Friday_89" value="<?php echo $existingData['Friday_89']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Saturday_89" class="form-label col-sm-2">เสาร์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Saturday_89" name="Saturday_89" value="<?php echo $existingData['Saturday_89']; ?>">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="Sunday_89" class="form-label col-sm-2">อาทิตย์</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="Sunday_89" name="Sunday_89" value="<?php echo $existingData['Sunday_89']; ?>">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-4">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">บันทึก</button>
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

  <script>
    $('#slotForm').submit(function(e) {
      e.preventDefault()
      var form = $(this)
      console.log(form.serialize())
      $.ajax({
        url: 'createSlot.php',
        method: 'POST',
        dataType: 'JSON',
        data: form.serialize(),
      }).done(function(res) {
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: res.message,
          showConfirmButton: false,
          timer: 1500
        }).then(() => {
          location.reload();
        })
      }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("AJAX request failed: ", textStatus, ", ", errorThrown);
      })

    })
  </script>

  <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
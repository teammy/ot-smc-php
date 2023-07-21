<?php include('config.php'); ?>
<?php include(INCLUDE_PATH . '/logic/userSignup.php');

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>ลืมรหัสผ่าน - <?php echo $web_des; ?></title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css" />
  <!-- Custome styles -->
  <link rel="stylesheet" href="./assets/css/admin-style.css">

  <script type="text/javascript" charset="utf8" src="./assets/js/jquery-3.6.0.min.js"></script> <!-- Jquery JS -->

  <script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex py-4 justify-content-center">
                <a href="<?php echo BASE_URL; ?>" class="logo d-flex align-items-center w-auto">
                  <h2>ระบบจองโอที</h2>
                  <span class="d-none d-lg-block"></span>
                </a>
              </div>
              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">หากลืมรหัสผ่าน</h5>
                    <p class="text-center">แอดไลน์เพื่อขอแก้ไขรหัสผ่าน</p>
                  </div>
                  <hr>


                  <div class="col-12">
                    <div class="form-group">
                      <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <p>Line ID : @056elncl<br />(ใส่ @ ข้างหน้าด้วย)</p>
                        <img src="<?php echo BASE_URL . 'qrcode.jpg' ?>" height="180" width="180">
                        <h2></h2>


                      </div>
                    </div>
                  </div>


                </div>
              </div>



            </div>
          </div>
        </div>

      </section>

    </div>
  </main>



  <?php include(INCLUDE_PATH . "/layouts/footer.php"); ?>
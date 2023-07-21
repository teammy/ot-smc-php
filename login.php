<?php
include('config.php');
include(INCLUDE_PATH . '/logic/userSignup.php');
?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>เข้าสู่ระบบ - <?php echo $web_des; ?></title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css" />
  <!-- Custome styles -->
  <link rel="stylesheet" href="./assets/css/admin-style.css">

  <!-- <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> -->

  <!-- <script type="text/javascript" src="./assets/js/bootstrap.min.js"></script> -->

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
                  <h2>ระบบจองโอที SMC</h2>
                  <span class="d-none d-lg-block"></span>
                </a>
              </div>
              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">เข้าสู่ระบบ</h5>
                    <p class="text-center">(เข้าสู่ระบบโดยใช้ชื่อผู้ใช้งานและรหัสผ่านของ P4P ได้)</p>
                  </div>
                  <hr>
                  <form class="row g-3" action="<?php echo BASE_URL; ?>login.php" method="post">

                    <div class="col-12">
                      <?php include(INCLUDE_PATH . "/layouts/messages.php") ?>
                      <div class="form-group <?php echo isset($errors['username']) ? 'has-error' : '' ?>">
                        <label for="username" class="form-label">ชื่อผู้ใช้งาน (Username)</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input type="text" name="username" class="form-control" id="username" required>
                          <?php if (isset($errors['username'])) : ?>
                            <div class="invalid-feedback">Please enter your username.</div>
                            <span class="help-block"><?php echo $errors['username'] ?></span>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group <?php echo isset($errors['password']) ? 'has-error' : '' ?>">
                        <label for="password" class="form-label">รหัสผ่าน</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <?php if (isset($errors['password'])) : ?>
                          <span class="help-block"><?php echo $errors['password'] ?></span>
                        <?php endif; ?>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                    </div>


                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login_btn">เข้าสู่ระบบ</button>
                    </div>
                    <div class="col-12">
                      <p class="mb-0">ไม่มีบัญชี? <a href="./signup.php">สมัครสมาชิก</a></p>
                      <p class="mb-0">ลืมรหัสผ่าน? <a href="./repwd.php">คลิกที่นี่</a></p>
                    </div>
                  </form>

                </div>
              </div>



            </div>
          </div>
        </div>

      </section>

    </div>
  </main>



  <?php include(INCLUDE_PATH . "/layouts/footer.php"); ?>
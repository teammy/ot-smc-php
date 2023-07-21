<?php include('config.php'); ?>
<?php include(INCLUDE_PATH . '/logic/userSignup.php');

// print_r($errors['username']);
// print_r($errors['cid']);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>สมัครสมาชิก - <?php echo $web_des; ?></title>
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

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">สมัครสมาชิก</h5>
                    <p class="text-center">กรุณาใช้ข้อมูลที่เป็นความจริงในการสมัครสมาชิก</p>
                  </div>

                  <form class="row g-3" action="signup.php" method="post" enctype="multipart/form-data">
                    <div class="col-12">
                      <label for="yourName" class="form-label">ชื่อ</label>
                      <input type="text" name="yourFName" class="form-control" id="yourFName" required>
                      <div class="invalid-feedback">กรุณาใส่ชื่อ!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="form-label">นามสกุล</label>
                      <input type="text" name="yourLName" class="form-control" id="yourLName" required>
                      <div class="invalid-feedback">กรุณาใส่นามสกุล!</div>
                    </div>

                    <div class="col-12 <?php echo isset($errors['cid']) ? 'has-error' : '' ?>">
                      <label for="cid" class="form-label">เลขบัตรประชาชน</label>
                      <input type="text" name="cid" class="form-control" id="cid" maxlength="13" required>
                      <?php if (isset($errors['cid'])) : ?>
                        <span class="help-block text-danger"><i class="bi bi-exclamation-triangle"></i> <?php echo $errors['cid'] ?></span>
                      <?php endif; ?>
                    </div>

                    <div class="col-12">
                      <label for="person_phone" class="form-label">เบอร์โทร</label>
                      <input type="number" name="person_phone" class="form-control" id="person_phone" required>
                      <div class="invalid-feedback">กรุณาใส่เบอร์โทรติดต่อ!</div>
                    </div>

                    <div class="col-12">
                      <label for="select-position" class="form-label">ตำแหน่ง</label>
                      <select class="form-select" aria-label="Default select example" name="select-position" required>
                        <option selected>-- เลือกตำแหน่ง --</option>
                        <option value="22">พยาบาลวิชาชีพ (RN)</option>
                        <option value="27">นักวิชาการสาธารณสุข (Paramedic)</option>
                        <option value="89">พนักงานช่วยเหลือคนไข้ (NA)</option>
                        <option value="126">ผู้ช่วยพยาบาล (PN)</option>
                        <option value="51">เจ้าพนักงานสาธารณสุข (EMT)</option>

                      </select>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="select-ward" class="form-label">หน่วยงาน</label>
                      <select class="form-select" aria-label="Default select example" name="select-ward" required>
                        <option selected>-- เลือกหน่วยงาน --</option>
                        <option value="25">งานเวชศาสตร์ฉุกเฉินและนิติเวช</option>
                        <option value="2">สำนักงานการพยาบาล</option>
                        <option value="26">งานอายุรกรรม</option>
                        <option value="27">งานศัลยกรรม</option>
                        <option value="29">งานกุมารเวชกรรม</option>
                        <option value="30">งานสูติ-นรีเวชกรรม</option>
                        <option value="31">งานจักษุวิทยา</option>
                        <option value="32">งานโสต ศอ นาสิก</option>
                        <option value="33">งานจิตเวช</option>
                        <option value="34">งานรังสีวิทยา</option>
                        <option value="35">งานพยาธิวิทยา</option>
                        <option value="36">งานวิสัญญี</option>
                        <option value="43">งานผู้ป่วยอุบัติเหตุและฉุกเฉิน</option>
                        <option value="44">งานผู้ป่วยนอก</option>
                        <option value="45">งานห้องผู้ป่วยหนัก</option>
                        <option value="46">งานห้องคลอด</option>
                        <option value="47">งานห้องผ่าตัด</option>
                        <option value="48">งานวิสัญญีพยาบาล</option>
                        <option value="49">หอผู้ป่วยอายุรกรรมชาย</option>
                        <option value="50">หอผู้ป่วยอายุรกรรมหญิง</option>
                        <option value="51">หอผู้ป่วยศัลยกรรมชาย</option>
                        <option value="52">หอผู้ป่วยศัลยกรรมหญิง</option>
                        <option value="53">หอผู้ป่วยสูติ-นรีเวชกรรม</option>
                        <option value="54">งานการพยาบาลจิตเวช</option>
                        <option value="55">หอผู้ป่วยกุมารเวชกรรม</option>
                        <option value="56">หอผู้ป่วยศัลยกรรมกระดูกชาย</option>
                        <option value="58">งานควบคุมและป้องกันการติดเชื้อ</option>
                        <option value="59">งานตรวจและรักษาพยาบาลพิเศษด้านจักษุ</option>
                        <option value="61">หออภิบาลทารกแรกเกิดวิกฤต (NICU)</option>
                        <option value="62">งานฝากครรภ์เเละวางแผนครอบครัว</option>
                        <option value="66">งานเวชปฏิบัติครอบครัวและชุมชน</option>
                        <option value="67">งานป้องกันควบคุมโรคระบาด</option>
                        <option value="69">งานพัฒนาระบบบริการปฐมภูมิและสนับสนุนเครือข่าย</option>
                        <option value="70">งานส่งเสริมสุขภาพและฟื้นฟู</option>
                        <option value="79">ไตเทียม</option>
                        <option value="83">หอผู้ป่วยพิเศษสลากฯ</option>
                      </select>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>
                    <div class="text-success">
                      <hr>
                    </div>
                    <div class="col-12  <?php echo isset($errors['username']) ? 'has-error' : '' ?>">
                      <label for="yourUsername" class="form-label">ชื่อผู้ใช้งาน (Username)</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" id="yourUsername" required>

                      </div>
                      <?php if (isset($errors['username'])) : ?>
                        <div class="help-block text-danger"><i class="bi bi-exclamation-triangle"></i> <?php echo $errors['username'] ?></div>
                      <?php endif; ?>
                    </div>


                    <div class="col-12 <?php echo isset($errors['password']) ? 'has-error' : '' ?>">
                      <label for="password" class="form-label">รหัสผ่าน</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <?php if (isset($errors['password'])) : ?>
                        <span class="help-block text-danger"><i class="bi bi-exclamation-triangle"></i> <?php echo $errors['password'] ?></span>
                      <?php endif; ?>
                    </div>
                    <div class="col-12 <?php echo isset($errors['passwordConf']) ? 'has-error' : '' ?>">
                      <label for="passwordConf" class="form-label">ยืนยันรหัสผ่าน</label>
                      <input type="password" name="passwordConf" class="form-control" id="passwordConf" required>
                      <?php if (isset($errors['passwordConf'])) : ?>
                        <span class="help-block text-danger"><i class="bi bi-exclamation-triangle"></i> <?php echo $errors['passwordConf'] ?></span>
                      <?php endif; ?>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="signup_btn" type="submit">สมัครสมาชิก</button>
                    </div>
                    <div class="col-12">
                      <p class="mb-0">คุณมีข้อมูลใช้งานอยู่แล้ว? <a href="./login.php">เข้าสู่ระบบ</a></p>
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

  <?php include(INCLUDE_PATH . "/layouts/footer.php") ?>
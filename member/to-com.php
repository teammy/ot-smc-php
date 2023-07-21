<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');
$docno = $_GET['doc_no'];
$show_doc_dc = getDocForDC($docno);
include(INCLUDE_PATH . "/layouts/admin_header.php");
include(INCLUDE_PATH . "/layouts/admin_sidebar.php");
$year = date("Y") + 543;
$time = substr($year, 2, 4);
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>ส่งต่อศูนย์คอม / รายละเอียดคำร้องเลขที่ <?php echo $time . '' . str_pad($show_doc_dc['id'], 5, '0', STR_PAD_LEFT); ?></title>
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

</head>

<body>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>ส่งต่อศูนย์คอม / รายละเอียดคำร้องเลขที่ <?php echo $time . '' . str_pad($show_doc_dc['id'], 5, '0', STR_PAD_LEFT); ?></h1>

    </div><!-- End Page Title -->

    <section class="section">


      <div class="card">
        <div class="card-body">
          <form method="POST" action="dc-doc-all.php">
            <h5 class="card-title text-end">

            </h5>

            <!-- Horizontal Form -->

            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">เรื่อง</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo $show_doc_dc['subject_doc']; ?></div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">ความเร่งด่วน</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo $show_doc_dc['important']; ?></div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">ประเภทผู้ป่วย</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo $show_doc_dc['type_patient']; ?></div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">ความต้องการข้อมูล</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo $show_doc_dc['reason_detail']; ?>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi reiciendis iure, facilis vitae ea dolores perspiciatis quam dolor. Sequi quas unde minus. Obcaecati voluptates eaque illo magnam explicabo eos repudiandae!</div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">ลักษณะรายงาน</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo $show_doc_dc['report_detail']; ?></div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">ช่วงเวลาของข้อมูล</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo $show_doc_dc['reason_detail']; ?>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi reiciendis iure, facilis vitae ea dolores perspiciatis quam dolor. Sequi quas unde minus. Obcaecati voluptates eaque illo magnam explicabo eos repudiandae!</div>

              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">เหตุผลในการขอข้อมูล</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo $show_doc_dc['reason_detail']; ?>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi reiciendis iure, facilis vitae ea dolores perspiciatis quam dolor. Sequi quas unde minus. Obcaecati voluptates eaque illo magnam explicabo eos repudiandae!</div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">รายละเอียดข้อมูลที่ต้องการ</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo $show_doc_dc['reason_detail']; ?>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi reiciendis iure, facilis vitae ea dolores perspiciatis quam dolor. Sequi quas unde minus. Obcaecati voluptates eaque illo magnam explicabo eos repudiandae!</div>
              </div>
            </div>
            <hr />
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">ข้อมูลผู้ขอ</label>
              <div class="col-sm-10">
                <div class="card-text mt-2">
                  <p>ชื่อ-สกุล: <?php echo $show_doc_dc['person_firstname'] . ' ' . $show_doc_dc['person_lastname']; ?></p>
                  <p>หน่วยงาน: <?php echo $show_doc_dc['ward_name']; ?></p>
                  <p>โทร: <?php echo $show_doc_dc['phone']; ?></p>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่เขียนคำร้อง</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo thai_date($show_doc_dc['createdon'], 1, true); ?></div>
              </div>
            </div>

            <hr />

            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">ข้อความถึงศูนย์คอม</label>
              <div class="col-sm-10">
                <div class="card-text mt-2">
                  <textarea class="form-control" rows="3" name="note-to-com">

                    </textarea>
                </div>
              </div>
            </div>

            <div class="text-center">


              <input type="hidden" name="status_name" value="กำลังดำเนินการ">
              <input type="hidden" name="doc_no" value="<?php echo $show_doc_dc['doc_no']; ?>">
              <button type="submit" class="btn btn-primary" name="submit_on_job" value="2">ส่งต่อศูนย์คอม</button>


            </div>



          </form><!-- End Horizontal Form -->

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
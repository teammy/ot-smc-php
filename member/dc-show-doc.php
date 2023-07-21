<?php
include('../config.php');
include(ROOT_PATH . '/member/middleware.php');
$docno = $_GET['doc_no'];
$show_doc_dc = getDocForDC($docno);
$get_user_final = getUserFinal($docno);
$get_user_DConjob = getUserDConjob($docno);
$file_dc_to_user = getFileDCToUser($docno);
$file_user_to_dc = getFileUserToDC($docno);
$file_com_to_dc = getFileComToDC($docno);
$get_user_DCtoCom = getUserDCtoCom($docno);
$file_dc_to_com = getFileDCToCom($docno);
$get_user_ComToDC = getUserComToDC($docno);
$getbgy = getDetailBudgetY($docno);
$getbgm = getDetailBudgetM($docno);
include(INCLUDE_PATH . "/layouts/admin_header.php");
include(INCLUDE_PATH . "/layouts/admin_sidebar.php");
$year = date("Y") + 543;
$time = substr($year, 2, 4);
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>รายละเอียดคำร้องเลขที่ <?php echo $time . '' . str_pad($show_doc_dc['id'], 5, '0', STR_PAD_LEFT); ?></title>
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
      <h1>รายละเอียดคำร้องเลขที่ <?php echo $time . '' . str_pad($show_doc_dc['id'], 5, '0', STR_PAD_LEFT); ?></h1>

    </div><!-- End Page Title -->

    <section class="section">


      <div class="card">
        <div class="card-body">
          <form method="POST" action="dc-doc-all.php">
            <h5 class="card-title text-end">
              <input type="hidden" name="status_name" value="กำลังดำเนินการ">
              <input type="hidden" name="doc_no" value="<?php echo $show_doc_dc['doc_no']; ?>">

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
                <div class="card-text mt-2"><?php echo $show_doc_dc['demand']; ?></div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">ลักษณะรายงาน</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo $show_doc_dc['type_report']; ?> : <?php echo $show_doc_dc['send_email']; ?></div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">ช่วงเวลาของข้อมูล</label>
              <div class="col-sm-10">
                <div class="card-text mt-2">

                  <p>ปีงบประมาณ :
                    <?php
                    foreach ($getbgy as $key => $value_y) :

                      echo $value_y['value_year'] . ',';
                    endforeach; ?>
                  </p>
                  <p>เดือน :
                    <?php
                    foreach ($getbgm as $key => $value_m) :
                      echo $value_m['value_month'] . ',';
                    endforeach;
                    ?>
                  </p>

                </div>

              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">เหตุผลในการขอข้อมูล</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo $show_doc_dc['reason_detail']; ?></div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label">รายละเอียดข้อมูลที่ต้องการ</label>
              <div class="col-sm-10">
                <div class="card-text mt-2"><?php echo $show_doc_dc['report_detail']; ?></div>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">ไฟล์ Template</label>
              <div class="col-sm-10">
                <?php
                foreach ($file_user_to_dc as $key => $value) :
                  if ($value['file_path'] == '') {
                  } else { ?>
                    <a href="<?php echo BASE_URL . 'upload/' . $value['file_path']; ?>" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i>&nbspดาวน์โหลด</a>
                <?php }
                endforeach; ?>
              </div>
            </div>

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
            <?php if ($show_doc_dc['last_status'] == '3') { ?>
              <h5 class="card-title">รายละเอียดผู้รับงาน</h5>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">ผู้รับงาน</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2">
                    <p><?php echo $get_user_DConjob['person_firstname'] . ' ' . $get_user_DConjob['person_lastname']; ?></p>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่รับงาน</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2"><?php echo thai_date($get_user_DConjob['updated_status'], 1, true); ?></div>
                </div>
              </div>
              <hr />
              <!-- dc to com -->
              <h5 class="card-title">รายละเอียดส่งถึงศูนย์คอม</h5>
              <div class="row mb-3">

                <label for="inputEmail3" class="col-sm-2 col-form-label">ข้อมูลถึงศูนย์คอมพิวเตอร์</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2">
                    <p><?php echo $show_doc_dc['note_dc_to_com']; ?></p>

                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่ส่งข้อมูล</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2"><?php echo thai_date($show_doc_dc['updated_status'], 1, true); ?></div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">ผู้ส่งข้อมูล</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2"><?php echo $get_user_DCtoCom['person_firstname'] . ' ' . $get_user_DCtoCom['person_lastname']; ?></div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">ไฟล์แนบ</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2">

                    <p>
                      <?php
                      foreach ($file_dc_to_com as $key => $value) :
                        if ($value['file_path'] == '') {
                        } else { ?>
                          <a href="<?php echo BASE_URL . 'upload/' . $value['file_path']; ?>" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i>&nbspดาวน์โหลด</a>
                      <?php }
                      endforeach; ?>
                    </p>
                  </div>
                </div>
              </div>

              <!-- end dc to com -->
            <?php } elseif ($show_doc_dc['last_status'] == '4') {  ?>
              <!-- com to dc -->
              <h5 class="card-title">รายละเอียดผู้รับงาน</h5>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">ผู้รับงาน</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2">
                    <p><?php echo $get_user_DConjob['person_firstname'] . ' ' . $get_user_DConjob['person_lastname']; ?></p>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่รับงาน</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2"><?php echo thai_date($get_user_DConjob['updated_status'], 1, true); ?></div>
                </div>
              </div>
              <hr />
              <h5 class="card-title">รายละเอียดส่งถึงศูนย์คอม</h5>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">ข้อมูลส่งถึงศูนย์คอม</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2">

                    <p><?php echo $show_doc_dc['note_dc_to_com']; ?></p>

                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">ผู้ส่งข้อมูล</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2">
                    <p><?php echo $get_user_DCtoCom['person_firstname'] . ' ' . $get_user_DCtoCom['person_lastname']; ?></p>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่ส่งข้อมูล</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2"><?php echo thai_date($show_doc_dc['updated_status'], 1, true); ?></div>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">ไฟล์แนบ</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2">

                    <p>
                      <?php
                      foreach ($file_dc_to_com as $key => $value) :
                        if ($value['file_path'] == '') {
                        } else { ?>
                          <a href="<?php echo BASE_URL . 'upload/' . $value['file_path']; ?>" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i>&nbspดาวน์โหลด</a>
                      <?php }
                      endforeach; ?>
                    </p>

                  </div>
                </div>
              </div>
              <hr />

              <!-- end com to dc -->
            <?php } elseif ($show_doc_dc['last_status'] == '2') { ?>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">ผู้รับงาน</label>
                <div class="col-sm-10">
                  <div class="card-text mt-2">
                    <p><?php echo $get_user_DConjob['person_firstname'] . ' ' . $get_user_DConjob['person_lastname']; ?></p>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่รับงาน</label>
                  <div class="col-sm-10">
                    <div class="card-text mt-2"><?php echo thai_date($get_user_DConjob['updated_status'], 1, true); ?></div>
                  </div>
                </div>
                <hr />

                <!-- dc to user -->

              <?php } elseif ($show_doc_dc['last_status'] == '6') { ?>

                <?php if (isset($get_user_ComToDC['updated_status'])) { ?>



                  <h5 class="card-title">รายละเอียดส่งถึงศูนย์คอม</h5>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ข้อมูลถึงศูนย์คอม</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2">

                        <p><?php echo $show_doc_dc['note_dc_to_com']; ?></p>

                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่ส่งข้อมูล</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2"><?php echo thai_date($get_user_DCtoCom['updated_status'], 1, true); ?></div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ผู้ส่งข้อมูล</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2">
                        <p><?php echo $get_user_DCtoCom['person_firstname'] . ' ' . $get_user_DCtoCom['person_lastname']; ?></p>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ไฟล์แนบ</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2">

                        <p>
                          <?php
                          foreach ($file_dc_to_com as $key => $value) :
                            if ($value['file_path'] == '') {
                            } else { ?>
                              <a href="<?php echo BASE_URL . 'upload/' . $value['file_path']; ?>" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i>&nbspดาวน์โหลด</a>
                          <?php }
                          endforeach; ?>
                        </p>

                      </div>
                    </div>
                  </div>
                  <hr />
                  <h5 class="card-title">รายละเอียดส่งกลับจากศูนย์คอม</h5>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ข้อความจากศูนย์คอม</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2">
                        <p><?php echo $show_doc_dc['note_com_to_dc']; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่ส่งมอบงาน</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2"><?php echo thai_date($get_user_ComToDC['updated_status'], 1, true); ?></div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">ผู้ส่งมอบงาน</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2"><?php echo $get_user_ComToDC['person_firstname'] . ' ' . $get_user_ComToDC['person_lastname']; ?></div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ไฟล์แนบ</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2">

                        <p>
                          <?php
                          foreach ($file_com_to_dc as $key => $value) :
                            if ($value['file_path'] == '') {
                            } else { ?>
                              <a href="<?php echo BASE_URL . 'upload/' . $value['file_path']; ?>" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i>&nbspดาวน์โหลด</a>
                          <?php }
                          endforeach; ?>
                        </p>

                      </div>
                    </div>
                  </div>
                  <hr />

                  <h5 class="card-title">รายละเอียดส่งมอบงาน</h5>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ข้อมูลถึงศูนย์คอม</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2">

                        <p><?php echo $show_doc_dc['note_dc_to_user']; ?></p>

                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่ส่งข้อมูล</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2"><?php echo thai_date($get_user_final['updated_status'], 1, true); ?></div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ผู้ส่งข้อมูล</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2">
                        <p><?php echo $get_user_final['person_firstname'] . ' ' . $get_user_final['person_lastname']; ?></p>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ไฟล์แนบ</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2">

                        <p>
                          <?php
                          foreach ($file_dc_to_user as $key => $value) :
                            if ($value['file_path'] == '') {
                            } else { ?>
                              <a href="<?php echo BASE_URL . 'upload/' . $value['file_path']; ?>" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i>&nbspดาวน์โหลด</a>
                          <?php }
                          endforeach; ?>
                        </p>

                      </div>
                    </div>
                  </div>
                  <hr />

                <?php } else { ?>
                  <h5 class="card-title">รายละเอียดส่งมอบงาน</h5>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ข้อมูลถึงผู้ขอ</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2">

                        <p><?php echo $show_doc_dc['note_dc_to_user']; ?></p>

                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่ส่งข้อมูล</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2"><?php echo thai_date($get_user_final['updated_status'], 1, true); ?></div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ผู้ส่งข้อมูล</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2">
                        <p><?php echo $get_user_final['person_firstname'] . ' ' . $get_user_final['person_lastname']; ?></p>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">ไฟล์แนบ</label>
                    <div class="col-sm-10">
                      <div class="card-text mt-2">

                        <p>
                          <?php
                          foreach ($file_dc_to_user as $key => $value) :
                            if ($value['file_path'] == '') {
                            } else { ?>
                              <a href="<?php echo BASE_URL . 'upload/' . $value['file_path']; ?>" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i>&nbspดาวน์โหลด</a>
                          <?php }
                          endforeach; ?>
                        </p>

                      </div>
                    </div>
                  </div>
                  <hr />
                <?php } ?>

              <?php } elseif ($show_doc_dc['last_status'] == '1') { ?>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-lg" name="submit_on_job" value="2">ตกลงรับงาน</button>
                </div>
              <?php } elseif ($show_doc_dc['last_status'] == '5') { ?>
                <h5 class="card-title">รายละเอียดส่งถึงศูนย์คอม</h5>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">ข้อมูลถึงศูนย์คอม</label>
                  <div class="col-sm-10">
                    <div class="card-text mt-2">

                      <p><?php echo $show_doc_dc['note_dc_to_com']; ?></p>

                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่ส่งข้อมูล</label>
                  <div class="col-sm-10">
                    <div class="card-text mt-2"><?php echo thai_date($get_user_DCtoCom['updated_status'], 1, true); ?></div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">ผู้ส่งข้อมูล</label>
                  <div class="col-sm-10">
                    <div class="card-text mt-2">
                      <p><?php echo $get_user_DCtoCom['person_firstname'] . ' ' . $get_user_DCtoCom['person_lastname']; ?></p>
                    </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">ไฟล์แนบ</label>
                  <div class="col-sm-10">
                    <div class="card-text mt-2">

                      <p>
                        <?php
                        foreach ($file_dc_to_com as $key => $value) :
                          if ($value['file_path'] == '') {
                          } else { ?>
                            <a href="<?php echo BASE_URL . 'upload/' . $value['file_path']; ?>" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i>&nbspดาวน์โหลด</a>
                        <?php }
                        endforeach; ?>
                      </p>

                    </div>
                  </div>
                </div>
                <hr />
                <h5 class="card-title">รายละเอียดส่งกลับจากศูนย์คอม</h5>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">ข้อความจากศูนย์คอม</label>
                  <div class="col-sm-10">
                    <div class="card-text mt-2">
                      <p><?php echo $show_doc_dc['note_com_to_dc']; ?></p>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">วันที่ส่งกลับข้อมูล</label>
                  <div class="col-sm-10">
                    <div class="card-text mt-2"><?php echo thai_date($get_user_ComToDC['updated_status'], 1, true); ?></div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">ผู้ส่งกลับข้อมูล</label>
                  <div class="col-sm-10">
                    <div class="card-text mt-2"><?php echo $get_user_ComToDC['person_firstname'] . ' ' . $get_user_ComToDC['person_lastname']; ?></div>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">ไฟล์แนบ</label>
                  <div class="col-sm-10">
                    <div class="card-text mt-2">

                      <p>
                        <?php
                        foreach ($file_com_to_dc as $key => $value) :
                          if ($value['file_path'] == '') {
                          } else { ?>
                            <a href="<?php echo BASE_URL . 'upload/' . $value['file_path']; ?>" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i>&nbspดาวน์โหลด</a>
                        <?php }
                        endforeach; ?>
                      </p>

                    </div>
                  </div>
                </div>

              <?php } ?>
          </form><!-- End Horizontal Form -->

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include(INCLUDE_PATH . "/layouts/admin_footer.php"); ?>
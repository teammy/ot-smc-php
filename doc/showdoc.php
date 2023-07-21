<?php 
include("../config.php");
include(ROOT_PATH . '/includes/logic/common_functions.php');
include(INCLUDE_PATH . "/logic/docLogic.php"); 


$docno = $_GET['docno']; 
$showdoc = getDetailDocForDC($docno);

$getbgy = getDetailBudgetY($docno);

$getbgm = getDetailBudgetM($docno);
$get_user_final = getUserFinal($docno);
$file_dc_to_user = getFileDCToUser($docno);

include(INCLUDE_PATH . "/layouts/navbar.php");

 ?>



<main class="container" style="padding-top:30px;">

    <div class="pagetitle">
    <?php $year = date("Y")+543; 
                $time = substr($year,2,4); ?>
      <h1>รายการคำร้องเลขที่ <?php echo $time.''.str_pad($showdoc['id'],5,'0',STR_PAD_LEFT); ?></h1>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">เรื่อง</label>
                    <div class="col-sm-10">
                    
                    <div class="card-text mt-2"><?php echo $showdoc['subject_doc']; ?></div>
                    </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">ความเร่งด่วน</label>
                    <div class="col-sm-10">
                    <div class="card-text mt-2"><?php echo $showdoc['important']; ?></div>
                    </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">ประเภทผู้ป่วย</label>
                    <div class="col-sm-10">
                    
                    <div class="card-text mt-2"><?php echo $showdoc['type_patient']; ?></div>
                    </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">ความต้องการข้อมูล</label>
                    <div class="col-sm-10">
                    
                   <div class="card-text mt-2"><?php echo $showdoc['demand']; ?></div>
                    </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">ลักษณะรายงาน</label>
                    <div class="col-sm-10">
                    
                    <div class="card-text mt-2"><?php echo $showdoc['type_report']; ?> : <?php echo $showdoc['send_email']; ?> <?php echo $showdoc['send_hosxp']; ?></div>
                    </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">ช่วงเวลาของข้อมูล</label>
                    <div class="col-sm-10">
                    <div class="card-text mt-2">ปีงบประมาณ :
                    <?php 
                        foreach ($getbgy as $key => $value_y) : 
                        
                    echo $value_y['value_year'].','; 
                        endforeach; ?>
                    </div>
                    <div class="card-text mt-2">เดือน : 
                    <?php 
                        foreach ($getbgm as $key => $value_m) : 
                            echo $value_m['value_month'].','; 
                         endforeach; 
                    ?>
                    </div>
                    </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">เหตุผลในการขอข้อมูล</label>
                    <div class="col-sm-10">
                    <div class="card-text mt-2"><?php echo $showdoc['reason_detail']; ?></div>
                    </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">รายละเอียดข้อมูลที่ต้องการ</label>
                    <div class="col-sm-10">
                    <div class="card-text mt-2"><?php echo $showdoc['report_detail']; ?></div>
                    </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">วันที่ยื่นคำร้อง</label>
                    <div class="col-sm-10">
                    <div class="card-text mt-2"><?php echo thai_date($showdoc['createdon'],1,true); ?></div>
                    </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">ไฟล์ Template</label>
                    <div class="col-sm-10">
                        <?php if ($showdoc['file_path']=='') { ?>
                        <?php } else { ?>
                            <a href="<?php echo BASE_URL .'upload/'.$showdoc['file_path']; ?>" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i>&nbspดาวน์โหลด</a>
                        <?php } ?>
                </div>
            </div>
            
            <hr>
            <?php if ($showdoc['last_status']=='6') { ?>
                <h5 class="card-title">รายละเอียดส่งมอบงาน</h5>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label fw-bold">ข้อมูลจากศูนย์ข้อมูล</label>
                    <div class="col-sm-10">
                    <div class="card-text mt-2"><?php echo $showdoc['note_dc_to_user']; ?></div>
                    </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label fw-bold">ผู้ส่งมอบงาน</label>
                    <div class="col-sm-10">
                    <div class="card-text mt-2"><?php echo $get_user_final['person_firstname'].' '.$get_user_final['person_lastname']; ?></div>
                    </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label fw-bold">วันที่ส่งข้อมูล</label>
                    <div class="col-sm-10">
                    <div class="card-text mt-2"><?php echo thai_date($showdoc['updated_status'],1,true); ?></div>
                    </div>
            </div>

            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label fw-bold">ไฟล์แนบจากศูนย์ข้อมูล</label>
                    <div class="col-sm-10">
                        <ul class="list-unstyled">
                        <?php 
                            foreach ($file_dc_to_user as $key => $value) :
                        if ($value['file_path']=='') { ?>

                        <?php } else { ?>
                            <li class="mb-2"><a href="<?php echo BASE_URL .'upload/'.$value['file_path']; ?>" class="btn btn-success"><i class="bi bi-arrow-down-circle"></i>&nbspดาวน์โหลด</a></li>
                        <?php } 
                        endforeach
                        ?>

                    </ul>
                </div>
              </div>
            <?php } ?>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

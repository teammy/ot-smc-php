<?php 
include("../config.php");
include(ROOT_PATH . '/includes/logic/common_functions.php');
include(INCLUDE_PATH . "/logic/docLogic.php"); 

$listfordc = getAllDocForDC();
$listuserdoc = getUserDoc();

include(INCLUDE_PATH . "/layouts/navbar.php");

?>

<main class="container" style="padding-top: 30px;">

<div class="pagetitle">
  <h1>รายการคำร้อง</h1>
</div><!-- End Page Title -->

<section class="section">
<div class="row">
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            
        <h5 class="card-title">
            แสดงรายการคำร้องทั้งหมดของคุณ
        </h5>
    
        <table class="table" id="example" style="width:100%">
            <thead>
                <tr>
                  <th>เลขที่คำร้อง</th>
                  <th>ความเร่งด่วน</th> 
                        <th>เรื่อง</th>
                        <th>วันที่ขอรายงาน</th>
                        <th>สถานะ</th>
                        <th>วันที่ส่งมอบงาน</th>
                        <th></th>
                </tr>
              </thead>
              <tbody>

            <?php 
                 foreach ($listuserdoc as $key => $value) : ?>        
                <tr>
                <?php $year = date("Y")+543; 
                $time = substr($year,2,4); ?>    
               
                    <td><?php echo $time.''.str_pad($value['id'],5,'0',STR_PAD_LEFT); ?> </td>

                    <td>
                        <?php if ($value['important'] == 'ด่วน') {  ?> 
                        <button type="button" class="btn btn-warning btn-sm"><?php echo $value['important']; ?></button>
                       <?php } elseif ($value['important'] == 'ด่วนมาก') { ?>
                        <button type="button" class="btn btn-danger btn-sm"><?php echo $value['important']; ?></button>
                        <?php } else {?>
                        <button type="button" class="btn btn-primary btn-sm"><?php echo $value['important']; ?></button>
                        <?php } ?>
                    </td>
                    <td><?php echo $value['subject_doc']; ?></td>
                    <?php if (($_SESSION['user']['role'])=='user') { ?>
                    <td><?php echo thai_date($value['createdon'],1,false); ?></td>
                    <?php } else { ?>
                    <td><?php echo $value['person_firstname'].' '.$value['person_lastname']; ?></td>
                    <?php } ?>
                    <td><h5><?php if ($value['last_status'] == '1') {  ?> 
                        <span class="badge rounded-pill bg-danger fw-normal"><?php echo $value['status_name']; ?></span>
                       <?php } elseif ($value['last_status'] == '2') { ?>
                        <span class="badge rounded-pill bg-warning text-dark fw-normal"><?php echo $value['status_name']; ?></span>
                        <?php } elseif ($value['last_status'] == '6') { ?>
                        <span class="badge rounded-pill bg-success fw-normal"><?php echo $value['status_name']; ?></span>
                        <?php } else { ?>
                            <span class="badge rounded-pill bg-warning text-dark fw-normal">กำลังดำเนินการ</span>
                        <?php } ?>
                        </h5></td>
                    <td>
                        <?php if ($value['last_status'] == '6') { ?>
                            <?php echo thai_date($value['updated_status'],1,false); ?>
                        <?php } ?>
                    </td>
                    <td class="text-end"><a href="<?php echo BASE_URL . 'doc/showdoc.php?docno='.$value['doc_no'].'' ?>" class="btn btn-info"><i class="bi bi-three-dots-vertical"></i>รายละเอียด</a></td>
                    
                </tr>
            <?php endforeach;  ?>

   
      
            </tbody>
        </table>
        </div><!-- end card-body -->
    </div><!--end card-->
    </div>
</div>
        </section>

</main><!-- End #main -->

    <?php include(INCLUDE_PATH . "../layouts/footer.php"); ?>
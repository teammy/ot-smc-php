<?php 
include("../config.php");
include(ROOT_PATH . '/includes/logic/common_functions.php');
include(INCLUDE_PATH . "/logic/docLogic.php"); 
include(INCLUDE_PATH . "/layouts/navbar.php"); 
?>

<script src="<?php echo BASE_URL . 'assets/js/bootstrap-multiselect.js' ?>"></script>
<link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/bootstrap-multiselect.css' ?>">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


<script>
function ShowHideDiv8() {
        var chkYes8 = document.getElementById("sendemail");
        var dvtext8 = document.getElementById("collapse_sendemail");
        var chkYes9 = document.getElementById("sendhosxp");
        var dvtext9 = document.getElementById("collapse_sendhosxp");
        var input_sendemail = document.getElementById("input_sendemail");
        
        if (chkYes8.checked == true ) {
          dvtext8.style.display = "block";
          input_sendemail.setAttribute('required','');
        } else {
          dvtext8.style.display = "none";
        }
      }

      $(document).ready(function() {
        $('#budget_year,#budget_month').multiselect({
            buttonClass: 'form-select',
            nnumberDisplayed: 1,
            includeSelectAllOption: true,
            selectAllText: 'เลือกทั้งหมด',
            nonSelectedText: 'ยังไม่มีตัวเลือก',
            allSelectedText: 'เลือกทั้งหมด'
        });
        
          });
</script>

<main class="container" style="padding-top: 30px;">

<div class="pagetitle">
  <h1>เขียนคำร้อง</h1>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">กรุณาตรวจสอบข้อมูลให้ถูกต้องก่อนยื่นคำร้อง เพื่อความรวดเร็วในการดำเนินงานของเจ้าหน้าที่</h5>
          <form method="post" action="adddoc.php" class="row g-3" enctype="multipart/form-data">
          <div class="mb-3">  
            <label for="subject_doc" class="form-label fw-bolder"><span class="text-danger">*</span> เรื่อง</label>
            <input type="text" class="form-control" id="subject_doc" name="subject_doc" required>
          </div>

          <!-- start ประเภทผู้ปวย -->
          <label for="" class="form-label fw-bolder"><span class="text-danger">*</span> ประเภทผู้ป่วย </label>
          <div class="mb-2">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="type_patient" id="opd" value="ผู้ปวยนอก" checked>
              <label class="form-check-label" for="opd">ผู้ปวยนอก</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="type_patient" id="ipd" value="ผู้ปวยใน">
              <label class="form-check-label" for="ipd">ผู้ปวยใน</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="type_patient" id="ipdopd" value="ผู้ปวยในและนอก">
              <label class="form-check-label" for="ipdopd">ผู้ปวยในและนอก</label>
            </div>
          </div>

          <!-- start ความเร่งด่วน -->
          
          <label for="" class="form-label fw-bolder"><span class="text-danger">*</span> ความเร่งด่วน </label>
          <div class="mb-3">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="important" id="normal" value="ปกติ" checked>
              <label class="form-check-label" for="normal">ปกติ</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="important" id="quick" value="ด่วน">
              <label class="form-check-label" for="quick">ด่วน</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="important" id="express" value="ด่วนมาก">
              <label class="form-check-label" for="express">ด่วนมาก</label>
            </div>
          </div>

          <!-- start ความต้องการ -->
          <label for="" class="form-label fw-bolder"><span class="text-danger">*</span> ความต้องการ</label>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="demand" id="pertime" value="ขอเฉพาะครั้ง" checked>
              <label class="form-check-label" for="pertime">ขอเฉพาะครั้ง</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="demand" id="permonth" value="ขอประจำ(รายเดือน)">
              <label class="form-check-label" for="permonth">ขอประจำ (รายเดือน)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="demand" id="perquarter" value="ขอประจำ(รายไตรมาส)">
              <label class="" for="perquarter">ขอประจำ (รายไตรมาส)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="demand" id="peryear" value="ขอประจำ(รายปี)">
              <label class="" for="peryear">ขอประจำ (รายปี)</label>
            </div>
          </div>

          <!-- start ลักษณะรายงาน -->
          <label for="" class="form-label fw-bolder"><span class="text-danger">*</span> ลักษณะรายงาน</label>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" onclick="ShowHideDiv8()" name="type_report" id="sendpaper" value="พิมพ์ลงกระดาษ" checked>
              <label class="form-check-label" for="sendpaper">พิมพ์ลงกระดาษ</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" onclick="ShowHideDiv8()" name="type_report" id="sendfile" value="บันทึกลงไฟล์">
              <label class="form-check-label" for="sendfile">บันทึกลงไฟล์ (pdf,word,excel)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" onclick="ShowHideDiv8()" name="type_report" id="sendemail" value="ส่งทาง Email">
              <label class="form-check-label" for="sendemail">
                ส่งทาง Email
              </label>
            </div>
            <div class="collapse" id="collapse_sendemail" style="display: none;">
              <input type="text" class="form-control col-md-2" id="input_sendemail" name="input_sendemail" placeholder="กรุณากรอก email ที่ต้องการส่งข้อมูล" >
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" onclick="ShowHideDiv8()" name="type_report" id="sendhosxp" value="จดหมาย HosXP">
              <label class="form-check-label" for="sendhosxp">
                ส่งทางจดหมาย HosXP
              </label>
            </div>
            <div class="collapse" id="collapse_sendhosxp" style="display: none;">
              <input type="text" class="form-control" id="input_sendhosxp" name="input_sendhosxp" placeholder="กรุณากรอกชื่อผู้ใช้งานใน hosxp" >
            </div>
          </div>

          <!-- start ช่วงเวลาของข้อมูล -->
          <label for="" class="form-label fw-bolder"><span class="text-danger">*</span> ช่วงเวลาของข้อมูล </label>
 
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 me-3 col-form-label">ปีงบประมาณ</label>
              <div class="col-sm-4">
              <select class="form-select select2" style="width: 100%;"  id='budget_year' name="budget_year[]"  multiple="multiple">
            
            <?php 
            $start = "1";
            $sql = "SELECT * FROM years ORDER BY value_year DESC";
            $result = mysqli_query($conn, $sql) or die("Error in query : $sql" .mysqli_error($conn));
            while($row = mysqli_fetch_array($result)) {
              if($start == $row["id_year"])
              {
                $start = "selected";
              }
              else
              {
                $start = "";
              }
              ?>
              <option value="<?php echo $row['id_year'];?>"><?php echo $row['value_year'];?>
              
            </option>
          <?php } ?>
        </select>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 me-3 col-form-label">เดือน</label>
              <div class="col-sm-4">
              <select class="form-select select2" style="width: 100%;"  id='budget_month' name="budget_month[]"  multiple="multiple">
            
            <?php 
            $sql = "SELECT * FROM months";
            $result2 = mysqli_query($conn, $sql) or die("Error in query : $sql" .mysqli_error($conn));
            while($row2 = mysqli_fetch_array($result2)) {
              if($start == $row2["id_month"])
              {
                $start = "selected";
              }
              else
              {
                $start = "";
              }
              ?>
              <option value="<?php echo $row2['id_month'];?>"><?php echo $row2['value_month'];?>
              
            </option>
          <?php } ?>
        </select>
              </div>
            </div>

        

          

          <!-- start เหตุผลการขอข้อมูล -->
          <div class="mb-3">
            <label for="reason_detail" class="form-label fw-bolder"><span class="text-danger">*</span> เหตุผลการขอข้อมูล </label>
            <textarea class="form-control" id="reason_detail" name="reason_detail" rows="3" required></textarea>
          </div>

          <!-- start รายละเอียดของข้อมูลที่ต้องการ -->
          <div class="mb-3">
            <label for="report_detail" class="form-label fw-bolder">รายละเอียดของข้อมูลที่ต้องการ</label>
            <textarea class="form-control" id="report_detail" name="report_detail" rows="3"></textarea>
          </div>

          <!-- start แนบไฟล์ Template -->
          <div class="mb-3">
            <label for="formFileMultiple" class="form-label fw-bolder">แนบไฟล์ Template (ถ้ามี)</label>
            <input class="form-control" type="file" id="formFileMultiple" name="file_template">
          </div>
        
          <div class="col-md-4">
            <label for="" class="form-label fw-bolder">ผู้ขอข้อมูล</label>
            <input type="text" class="form-control" name="person_name" id="exampleFormControlInput1" value="<?php echo $_SESSION['user']['person_firstname'].' '.$_SESSION['user']['person_lastname']; ?>" readonly>
          </div>
          <div class="col-md-4">
            <label for="" class="form-label fw-bolder">ฝ่าย/กลุ่มงาน</label>
            <input type="text" class="form-control" name="depart_name" id="exampleFormControlInput1" value="<?php echo $_SESSION['user']['office_sit']; ?>" readonly>         
          </div>
          <div class="col-md-4">
            <label for="" class="form-label fw-bolder">เบอร์โทร</label>
            <input type="text" class="form-control" id="phone" name="phone">         
          </div>
          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary" name="add_doc">ส่งข้อมูล</button>
          </div>
          </div><!-- End Container -->
          <input type="hidden" name="status_id" value="1">
          <input type="hidden" name="status_name" value="ขอรายงาน">
        </form>
        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->

<?php include(INCLUDE_PATH . "../layouts/footer.php") ?>
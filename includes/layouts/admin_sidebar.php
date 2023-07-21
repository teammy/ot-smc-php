 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

   <ul class="sidebar-nav" id="sidebar-nav">


     <?php if ($_SESSION['user']['role_id'] == '8') { ?>


    

       <li class="nav-item">
         <a class="nav-link collapsed" href="<?php echo BASE_URL . 'member/booking.php'; ?>">
           <i class="bi bi-plus-circle"></i>
           <span>ทำรายการจอง</span>
         </a>
       </li><!-- End Register Page Nav -->

       <li class="nav-item">
         <a class="nav-link collapsed" href="<?php echo BASE_URL . 'member/mybooking.php'; ?>">
           <i class="bi bi-list-task"></i>
           <span>รายการจองของคุณ</span>
         </a>
       </li><!-- End Login Page Nav -->

       <li class="nav-item">
         <a class="nav-link collapsed" href="<?php echo BASE_URL . 'member/user-profile.php?user_id=' . $_SESSION['user']['id']; ?>">
           <i class="bi bi-gear"></i>
           <span>แก้ไขข้อมูลส่วนตัว</span>
         </a>
       </li><!-- End Profile Page Nav -->
       <li class="nav-item">
         <a class="nav-link collapsed" href="<?php echo BASE_URL . 'logout.php'; ?>">
           <i class="bi bi-box-arrow-right"></i>
           <span>ออกจากระบบ</span>
         </a>
       </li><!-- End Blank Page Nav -->
     <?php } else if ($_SESSION['user']['role_id'] == '2') { ?>

      <!-- End Contact Page Nav -->

       <li class="nav-item">
         <a class="nav-link collapsed" href="<?php echo BASE_URL . 'member/booking.php'; ?>">
           <i class="ri ri-add-circle-line"></i>
           <span>ทำรายการจอง</span>
         </a>
       </li>

       <!-- <li class="nav-item">
         <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
           <i class="ri ri-add-circle-line"></i><span>ทำรายการจอง</span><i class="bi bi-chevron-down ms-auto"></i>
         </a>
         <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
           <li>
             <a href="">
               <i class="bi bi-circle"></i><span>ทำรายการจองส่วนตัว</span>
             </a>
           </li>
           <li>
             <a href="">
               <i class="bi bi-circle"></i><span>ทำรายการจองผู้อื่น</span>
             </a>
           </li>
         </ul>
       </li> -->
       


       <li class="nav-item">
         <a class="nav-link collapsed" href="<?php echo BASE_URL . 'member/mybooking.php'; ?>">
           <i class="bi bi-envelope"></i>
           <span>รายการจองของคุณ</span>
         </a>
       </li><!-- End Contact Page Nav -->



       <li class="nav-item">
         <a class="nav-link collapsed" href="<?php echo BASE_URL . 'member/report.php'; ?>">
           <i class="bi bi-envelope"></i>
           <span>สรุปตารางเวร</span>
         </a>
       </li><!-- End Contact Page Nav -->
       <li class="nav-item">
         <a class="nav-link collapsed" href="<?php echo BASE_URL . 'member/ot-slot.php'; ?>">
           <i class="bi bi-envelope"></i>
           <span>ตั้งค่าการจองโอที</span>
         </a>
       </li><!-- End Contact Page Nav -->
       <li class="nav-item">
         <a class="nav-link collapsed" href="<?php echo BASE_URL . 'member/member-all.php'; ?>">
           <i class="bi bi-envelope"></i>
           <span>จัดการสมาชิก</span>
         </a>
       </li><!-- End Contact Page Nav -->
       <li class="nav-item">
         <a class="nav-link collapsed" href="<?php echo BASE_URL . 'member/user-profile.php?user_id=' . $_SESSION['user']['id']; ?>">
           <i class="bi bi-gear"></i>
           <span>แก้ไขข้อมูลส่วนตัว</span>
         </a>
       </li><!-- End Contact Page Nav -->

       <li class="nav-item">
         <a class="nav-link collapsed" href="<?php echo BASE_URL . 'logout.php'; ?>">
           <i class="bi bi-box-arrow-right"></i>
           <span>ออกจากระบบ</span>
         </a>
       </li><!-- End Blank Page Nav -->
     <?php } else {
      } ?>
   </ul>

 </aside><!-- End Sidebar-->
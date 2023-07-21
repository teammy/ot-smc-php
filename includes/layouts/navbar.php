<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>UserAccounts - Home</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/bootstrap.min.css' ?>" />
  <link rel="stylesheet" href="<?php echo BASE_URL . 'node_modules/bootstrap-icons/font/bootstrap-icons.css' ?>" />
  <!-- Custome styles -->
  <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/admin-style.css' ?>">
  <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/datatables.min.css' ?>">

  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> <!-- Jquery JS -->
  <script type="text/javascript" charset="utf8" src="<?php echo BASE_URL . 'assets/datatables.min.js' ?>"></script>
  <script type="text/javascript" src="<?php echo BASE_URL . 'assets/js/bootstrap.min.js' ?>"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "pageLength": 25,
        "language": {
          "search": "ค้นหา:",
          "lengthMenu": "แสดงข้อมูล _MENU_ ต่อหน้า",
          "paginate": {
            "first": "หน้าแรก",
            "last": "หน้าสุดท้าย",
            "next": "ถัดไป",
            "previous": "ก่อนหน้า"
          }
        }
      });
    });
  </script>


</head>

<body>

  <nav class="navbar mainnav navbar-expand-lg">
    <div class="container-fluid">
      <h1 class="brand">
        <a href="index.php"><i class="bi bi-menu-button-wide me-2">
          </i></a>ระบบจองโอที รพ.สมเด็จพระเจ้าตากสินมหาราช
      </h1>

      <?php if (isset($_SESSION['user']['role'])) {
        if ($_SESSION['user']['role'] == 'user') {
      ?>

          <div class="d-flex justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item mx-1">
                <a class="nav-link" aria-current="page" href="<?php echo BASE_URL ?>">หน้าแรก</a>
              </li>
              <li class="nav-item mx-1">
                <a class="nav-link" href="<?php echo BASE_URL . 'doc/adddoc.php' ?>">เขียนคำร้อง</a>
              </li>
              <li class="nav-item mx-1">
                <a class="nav-link" href="<?php echo BASE_URL . 'doc/listdoc.php' ?>">รายการคำร้อง</a>
              </li>

              <li class="nav-item mx-1">
                <a class="nav-link" href="http://intranet.tsm.go.th/wp-content/uploads/--2022-02-15_12-01-55_956218.pdf">คู่มือการใช้งาน</a>
              </li>

              <li class="nav-item mx-1 dropdown">

                <a class="btn btn-primary nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-person-circle"></i> <?php echo $_SESSION['user']['username'] ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">

                  <li><a class="dropdown-item" href="<?php echo BASE_URL . 'logout.php' ?>">ออกจากระบบ</a></li>
                </ul>
              </li>

            </ul>

          </div>
        <?php } else { ?>
          <div class="d-flex justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item mx-1">
                <a class="nav-link" aria-current="page" href="<?php echo BASE_URL ?>">หน้าแรก</a>
              </li>
              <li class="nav-item mx-1">
                <a class="nav-link" href="<?php echo BASE_URL . 'member/dashboard.php' ?>">ระบบหลังบ้าน</a>
              </li>
              <li class="nav-item mx-1 dropdown">

                <a class="btn btn-primary nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="bi bi-person-circle"></i> <?php echo $_SESSION['user']['username'] ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">

                  <li><a class="dropdown-item" href="<?php echo BASE_URL . 'logout.php' ?>">ออกจากระบบ</a></li>
                </ul>
              </li>

            </ul>

          </div>
        <?php }
      } else { ?>

        <div class="d-flex justify-content-end">

          <a class="btn btn-outline-primary d-lg-inline-block d-flex me-3" href="<?php echo BASE_URL . 'signup.php' ?>" role="button">สมัครสมาชิก</a>
          <a class="btn btn-primary d-lg-inline-block d-flex" href="<?php echo BASE_URL . 'login.php' ?>" role="button">เข้าสู่ระบบ</a>
        </div>
      <?php } ?>






    </div>
    <!--container-->
  </nav>
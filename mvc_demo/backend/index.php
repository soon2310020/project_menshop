<?php
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");

//mục đích của file index.php gốc của ứng dụng
//cần phải xử lý url trên trình duyệt để nhúng được class
//controller tương ứng, sau đó khởi tạo đối tượng từ class
//vừa nhúng, và gọi action tương ứng

//theo mô hình mvc, url của bạn đang có dạng là:
//index.php?controller=book&action=list
//lấy ra tham số controller và action từ trình duyệt
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'category';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

//giả sử url đang là:
//index.php?controller=book&action=create
//$controller=book
//$action=create

//Nhúng được file BookController.php vào
$controller = ucfirst($controller); //Book
$controller .= "Controller"; //BookController
//đường dẫn của file BookController.php đang nằm tại vị trí:
//controllers/BookController.php
$path_controller = "controllers/$controller.php";
//controller/BookController.php

//kiểm tra nếu đường dẫn ko tồn tại, thì báo trang ko tồn tại
if (file_exists($path_controller) == false) {
    die("<!DOCTYPE html>
<html lang=\"en\">

<head>

  <meta charset=\"utf-8\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
  <meta name=\"description\" content=\"\">
  <meta name=\"author\" content=\"\">

  <title>SB Admin 2 - 404</title>

  <!-- Custom fonts for this template-->
  <link href=\"assets/vendor/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" type=\"text/css\">
  <link href=\"https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i\" rel=\"stylesheet\">

  <!-- Custom styles for this template-->
  <link href=\"assets/css/sb-admin-2.min.css\" rel=\"stylesheet\">

</head>

<body id=\"page-top\">


    <!-- Content Wrapper -->
    <div id=\"content-wrapper\" class=\"d-flex flex-column\">
      <!-- Main Content -->
      <div id=\"content\">
        <!-- Begin Page Content -->
        <div class=\"container-fluid\">

          <!-- 404 Error Text -->
          <div class=\"text-center\">
            <div class=\"error mx-auto\" data-text=\"404\">404</div>
            <p class=\"lead text-gray-800 mb-5\">Page Not Found</p>
            <p class=\"text-gray-500 mb-0\">controller is not found</p>
            <a href=\"index.php?controller=category&action=dashboard\">&larr; Back to Dashboard</a>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class=\"scroll-to-top rounded\" href=\"#page-top\">
    <i class=\"fas fa-angle-up\"></i>
  </a>

  <!-- Logout Modal-->
  <div class=\"modal fade\" id=\"logoutModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h5 class=\"modal-title\" id=\"exampleModalLabel\">Ready to Leave?</h5>
          <button class=\"close\" type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">×</span>
          </button>
        </div>
        <div class=\"modal-body\">Select \"Logout\" below if you are ready to end your current session.</div>
        <div class=\"modal-footer\">
          <button class=\"btn btn-secondary\" type=\"button\" data-dismiss=\"modal\">Cancel</button>
          <a class=\"btn btn-primary\" href=\"login.html\">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src=\"assets/vendor/jquery/jquery.min.js\"></script>
  <script src=\"assets/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>

  <!-- Core plugin JavaScript-->
  <script src=\"assets/vendor/jquery-easing/jquery.easing.min.js\"></script>

  <!-- Custom scripts for all pages-->
  <script src=\"assets/js/sb-admin-2.min.js\"></script>

</body>

</html>
");
}

require_once "$path_controller";

//khởi tạo đối tượng sau khi nhúng file
$object = new $controller(); //$object = new BookController()

if (method_exists($object, $action) == false) {
    die("<!DOCTYPE html>
<html lang=\"en\">

<head>

  <meta charset=\"utf-8\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
  <meta name=\"description\" content=\"\">
  <meta name=\"author\" content=\"\">

  <title>SB Admin 2 - 404</title>

  <!-- Custom fonts for this template-->
  <link href=\"assets/vendor/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" type=\"text/css\">
  <link href=\"https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i\" rel=\"stylesheet\">

  <!-- Custom styles for this template-->
  <link href=\"assets/css/sb-admin-2.min.css\" rel=\"stylesheet\">

</head>

<body id=\"page-top\">


    <!-- Content Wrapper -->
    <div id=\"content-wrapper\" class=\"d-flex flex-column\">
      <!-- Main Content -->
      <div id=\"content\">
        <!-- Begin Page Content -->
        <div class=\"container-fluid\">

          <!-- 404 Error Text -->
          <div class=\"text-center\">
            <div class=\"error mx-auto\" data-text=\"404\">404</div>
            <p class=\"lead text-gray-800 mb-5\">Page Not Found</p>
            <p class=\"text-gray-500 mb-0\">$action method is not found in $controller</p>
            <a href=\"index.php?controller=category&action=dashboard\">&larr; Back to Dashboard</a>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class=\"scroll-to-top rounded\" href=\"#page-top\">
    <i class=\"fas fa-angle-up\"></i>
  </a>

  <!-- Logout Modal-->
  <div class=\"modal fade\" id=\"logoutModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h5 class=\"modal-title\" id=\"exampleModalLabel\">Ready to Leave?</h5>
          <button class=\"close\" type=\"button\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">×</span>
          </button>
        </div>
        <div class=\"modal-body\">Select \"Logout\" below if you are ready to end your current session.</div>
        <div class=\"modal-footer\">
          <button class=\"btn btn-secondary\" type=\"button\" data-dismiss=\"modal\">Cancel</button>
          <a class=\"btn btn-primary\" href=\"login.html\">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src=\"assets/vendor/jquery/jquery.min.js\"></script>
  <script src=\"assets/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>

  <!-- Core plugin JavaScript-->
  <script src=\"assets/vendor/jquery-easing/jquery.easing.min.js\"></script>

  <!-- Custom scripts for all pages-->
  <script src=\"assets/js/sb-admin-2.min.js\"></script>

</body>

</html>");
}
//index.php?controller=book&action=create
$object->$action();
?>
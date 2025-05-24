<?php
session_start();


// Require file Common
require_once './commons/env.php';      
require_once './commons/function.php';  
// Require Controllers
require_once './controllers/HomeController.php';
require_once './controllers/ProductController.php';
require_once './admin/controllers/DashboardController.php';

// Require Models
require_once './models/User.php';
require_once './models/CategoryModel.php';
require_once './models/ProductModel.php';


// Lấy tham số 'act' từ URL
$act = $_GET['act'] ?? '/';

require_once './views/layouts/layout_top.php';
// Điều hướng request
match ($act) {
  '/' => (new HomeController())->index(),
  'home' => (new HomeController())->index(),
  'page' => (new ProductController())->store(),
  'product-detail' => (new ProductController())->detail($_GET['id']),
  'profile' => (new HomeController())->getProfile(),
  'login' => (new HomeController())->login(),
  'handle-login' => (new HomeController())->handleLogin(),
  'adminDashboard' => (new DashboardController())->index(),
  'clientHome' => (new HomeController())->clientHome(),
  default => header("Location: ./?act=home")
};
require_once './views/layouts/layout_bottom.php';

// namptnampt

<?php
session_start();

// Require file Common
require_once './commons/env.php';       // Khai báo biến môi trường
require_once './commons/function.php';  // Hàm hỗ trợ

// Require Controllers
require_once './controllers/HomeController.php';
require_once './admin/controllers/DashboardController.php';

require_once './controllers/ProductController.php';



// Require Models
require_once './models/User.php';
require_once './models/ProductModel.php';

// Route
$act = $_GET['act'] ?? '/';
require_once './views/layouts/layout_top.php';

// Điều hướng request
match ($act) {
  '/' => (new HomeController())->index(),
  'home' => (new HomeController())->index(),
  'page' => (new HomeController())->getAll(),
  'profile' => (new HomeController())->getProfile(),
  'login' => (new HomeController())->login(),
  'handle-login' => (new HomeController())->handleLogin(),
  'adminDashboard' => (new DashboardController())->index(),
  'clientHome' => (new HomeController())->clientHome(),
    'product-list' => (new ProductController())->list(),
default => require './views/errors/404.php', 
};
require_once './views/layouts/layout_bottom.php';
// nam
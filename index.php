<?php 
session_start();

// Require file Common
require_once './commons/env.php';       // Khai báo biến môi trường
require_once './commons/function.php';  // Hàm hỗ trợ

// Require Controllers
require_once './controllers/HomeController.php';
require_once './admin/controllers/DashboardController.php';



// Require Models
require_once './models/User.php';

// Route
$act = $_GET['act'] ?? '/';

// Điều hướng request
match ($act) {
    '/'         => (new HomeController())->index(),
    'home' => (new HomeController())->index(),
    'login'     => (new HomeController())->login(),    
    'handle-login' => (new HomeController())->handleLogin(), 
  'adminDashboard' => (new DashboardController())->index(),
     'clientHome'     => (new HomeController())->clientHome(),     
};
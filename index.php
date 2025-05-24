<?php
session_start();


// Require file Common
require_once './commons/env.php';      
require_once './commons/function.php';  
// Require Controllers
require_once './controllers/HomeController.php';
require_once './admin/controllers/DashboardController.php';

// Require Models
require_once './models/User.php';
require_once './models/CategoryModel.php';
require_once './models/ProductModel.php';


// Lấy tham số 'act' từ URL
$act = $_GET['act'] ?? '/';

// Xử lý điều hướng trước khi include layout để tránh lỗi header()
match ($act) {
    '/'                 => (new HomeController())->index(),
    'home'              => (new HomeController())->index(),
    'page'              => (new HomeController())->getAll(),
    'profile'           => (new HomeController())->getProfile(),
    'login'             => (new HomeController())->login(),
    'handle-login'      => (new HomeController())->handleLogin(),
    'register'          => (new HomeController())->register(),
    'handle-register'   => (new HomeController())->handleRegister(),
    'adminDashboard'    => (new DashboardController())->index(),
    'clientHome'        => (new HomeController())->clientHome(),
    default             => header("Location: ./?act=home") && exit,
};

// Sau khi thực thi action, include layout
require_once './views/layouts/layout_top.php';
require_once './views/layouts/layout_bottom.php';

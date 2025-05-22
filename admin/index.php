<?php 
ob_start();
session_start(); 

define('BASE_PATH', dirname(__DIR__));
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/UserController.php'; // ✅ Thêm controller người dùng

// Require toàn bộ file Models
require_once 'models/ProductModel.php';

// Route
$act = $_GET['act'] ?? '/';
$id = $_GET['id'] ?? null;
require_once 'views/layouts/layouts_top.php';
match ($act) {
    '/'               => (new DashboardController())->index(),
    'adminDashboard'  => (new DashboardController())->index(),
    default           => function() {
        echo "404 - Page not found";
    },
};
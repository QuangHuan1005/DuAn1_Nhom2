<?php 

session_start(); 

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/ProductController.php';

// Require toàn bộ file Models
require_once 'models/ProductModel.php';

// Route
$act = $_GET['act'] ?? '/';

// Sử dụng match để xử lý route
match ($act) {
    '/'               => (new DashboardController())->index(),
    'adminDashboard'  => (new DashboardController())->index(),
    default           => function() {
        echo "404 - Page not found";
    },
};
<?php 
ob_start();
session_start(); 

define('BASE_PATH', dirname(__DIR__));
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/ProductController.php';
// Load models trước
require_once 'models/CategoryModel.php';

// Load controller sau
require_once 'controllers/CategoryController.php';

// Require toàn bộ file Models
require_once 'models/ProductModel.php';

    require_once './views/layouts/header.php';
        require_once "./views/layouts/siderbar.php";


// Route
$act = $_GET['act'] ?? '/';

// Sử dụng match để xử lý route
match ($act) {
    '/'               => (new DashboardController())->index(),
    'adminDashboard'  => (new DashboardController())->index(),
    

    'category-list' => (new CategoryController())->getAllCategories(),
    'add_category' => (new CategoryController())->addCategory(),
    'edit_category' => (new CategoryController())->editCategory(),
    'delete_category' => (new CategoryController())->softDelete(),
    'view_category' => (new CategoryController())->viewCategory(),
    default           => function() {
        echo "404 - Page not found";
    },
};
    require_once "./views/layouts/libs_css.php";
    // require_once "./views/layouts/libs_js.php";

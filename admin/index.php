<?php 
ob_start();
session_start(); 

define('BASE_PATH', dirname(__DIR__)); 

// Require file Common
require_once '../commons/env.php';    
require_once '../commons/function.php'; 

// Require Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/UserController.php';  
require_once 'controllers/ProductController.php'; 

// Require Models
require_once 'models/UserModel.php';    
require_once 'models/ProductModel.php'; 

require_once './views/layouts/header.php';
require_once "./views/layouts/siderbar.php";



$act = $_GET['act'] ?? '/'; 
$id = $_GET['id'] ?? null;  

require_once 'views/layouts/layouts_top.php'; 

match ($act) {
    '/', 
    'adminDashboard' => (new DashboardController())->index(),

    // User Routes (Từ nhánh có liên quan đến User)
    'userIndex'      => (new UserController())->index(),
    'userCreate'     => (new UserController())->create(),
    'userStore'      => (new UserController())->store(),
    'userEdit'       => (new UserController())->edit($id),
    'userUpdate'     => (new UserController())->update($id),
    'userDelete'     => (new UserController())->delete($id),

    // Product Routes (Từ nhánh có liên quan đến Product)
    'product-list'        => (new ProductController())->getAllProduct(),
    'view_product'        => (new ProductController())->viewProduct(),
    'add_product'         => (new ProductController())->addProduct(),
    // 'edit_product'        => (new ProductController())->editProduct(), // Giữ nguyên comment nếu bạn muốn nó không hoạt động
    'product-soft-delete' => (new ProductController())->softDelete(),

    default          => function() {
        echo "404 - Page not found";
    },
};


require_once "./views/layouts/libs_css.php"; 
// require_once "./views/layouts/libs_js.php"; 

?>
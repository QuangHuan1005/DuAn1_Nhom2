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
require_once 'controllers/CategoryController.php';

// Require Models
require_once 'models/UserModel.php';    
require_once 'models/ProductModel.php'; 
require_once 'models/CategoryModel.php';

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
     'userView'       => (new UserController())->show($id), 

    // Product Routes
    'product-list'        => (new ProductController())->getAllProduct(),
    'view_product'        => (new ProductController())->viewProduct(),
    'add_product'         => (new ProductController())->addProduct(),
    'edit_product'        => (new ProductController())->editProduct(),
    'product-soft-delete' => (new ProductController())->softDelete(),
    // Category Routes
    'category-list'       => (new CategoryController())->index(),
    'category-add'     => (new CategoryController())->create(),
    'category-store'      => (new CategoryController())->store(),
    'category-edit'       => (new CategoryController())->edit($id),
    'category-view'       => (new CategoryController())->view($id),
    'category-update'     => (new CategoryController())->update($id),
    'category-soft-delete' => (new CategoryController())->softDelete($id),
    default          => function() {
        echo "404 - Page not found";
    },
};


require_once "./views/layouts/libs_css.php"; 
// require_once "./views/layouts/libs_js.php"; 

?>
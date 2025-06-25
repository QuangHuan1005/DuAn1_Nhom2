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
require_once 'controllers/OrderController.php';
require_once 'controllers/CategoryController.php';

// Require Models
require_once 'models/UserModel.php';    
require_once 'models/ProductModel.php'; 
require_once 'models/OrderModel.php'; 
require_once 'models/CategoryModel.php';

// Layout phần đầu trang
require_once './views/layouts/header.php';
require_once './views/layouts/siderbar.php';

$act = $_GET['act'] ?? 'adminDashboard'; 
$id = $_GET['id'] ?? null;  
$order_code = $_GET['order_code'] ?? null;

require_once 'views/layouts/layouts_top.php'; 

match ($act) {
    'adminDashboard' => (new DashboardController())->index(),

    // User Routes
    'userIndex'      => (new UserController())->index(),
    'userEdit'       => (new UserController())->edit($id),
    'userUpdate'     => (new UserController())->update($id),
    'userDelete'     => (new UserController())->delete($id),

    // Product Routes
    'product-list'        => (new ProductController())->getAllProduct(),
    'view_product'        => (new ProductController())->viewProduct(),
    'add_product'         => (new ProductController())->addProduct(),
    'edit_product'        => (new ProductController())->editProduct(), 
    'product-soft-delete' => (new ProductController())->softDelete($id),

    // Order Routes
    'orderIndex'          => (new OrderController())->index(),
    'orderView'           => (new OrderController())->view($order_code),
    'orderUpdateStatus'   => (new OrderController())->updateStatus($id),
    'orderEditStatus'     => (new OrderController())->updateStatusForm($id),

    // Category Routes
    'category-list'       => (new CategoryController())->index(),
    'category-add'        => (new CategoryController())->create(),
    'category-store'      => (new CategoryController())->store(),
    'category-edit'       => (new CategoryController())->edit($id),
    'category-view'       => (new CategoryController())->view($id),
    'category-update'     => (new CategoryController())->update($id),
    'category-soft-delete'=> (new CategoryController())->softDelete($id),

    default => function() {
        echo "404 - Page not found";
    },
};

require_once "./views/layouts/libs_css.php"; 
// nếu bạn có footer hoặc js thì include ở đây
// require_once "./views/layouts/libs_js.php"; 

?>

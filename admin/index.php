<?php
ob_start();
session_start();

define('BASE_PATH', dirname(__DIR__));
require_once '../commons/env.php';
require_once '../commons/function.php';

// Models
require_once 'models/CategoryModel.php';
require_once 'models/ProductModel.php';

// Controllers
require_once 'controllers/CategoryController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/DashboardController.php';
$act = $_GET['act'] ?? '/';
match ($act) {
    'category-list' => (new CategoryController())->getAllCategories(),
    'add_category' => (new CategoryController())->addCategory(),
    'edit_category' => (new CategoryController())->editCategory(), 
    'delete_category' => (new CategoryController())->softDelete(),
   
    default => function() {
        echo "404 - Page not found";
    },
};

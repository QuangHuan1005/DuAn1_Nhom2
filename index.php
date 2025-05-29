<?php
session_start();

// Require file Common
require_once './commons/env.php';      
require_once './commons/function.php';  
// Require Controllers
require_once './controllers/HomeController.php';
require_once './controllers/ProductController.php';
require_once './admin/controllers/DashboardController.php';
require_once './controllers/CartController.php';

// Require Models
require_once './models/User.php';
require_once './models/CategoryModel.php';
require_once './models/ProductModel.php';
require_once './models/CartModel.php';

// Lấy tham số 'act' từ URL
$act = $_GET['act'] ?? '/';

// Điều hướng request
match ($act) {
    '/' => (new HomeController())->index(),
    'home' => (new HomeController())->index(),
    'page' => (new ProductController())->store(),
    'product-detail' => (new ProductController())->detail($_GET['id']),
    'profile' => (new HomeController())->getProfile(),
    'login' => (new HomeController())->login(),
    'handle-login' => (new HomeController())->handleLogin(),
    'register' => (new HomeController())->register(),
    'handle-register' => (new HomeController())->handleregister(),
    'adminDashboard' => (new DashboardController())->index(),
    'clientHome' => (new HomeController())->clientHome(),
    'search' => (new ProductController())->search(),

    // Cart routes
    'cart' => (new CartController())->index(),
    'cart/add' => (new CartController())->addToCart(),
    'cart/update' => (new CartController())->updateCart(),
    'cart/remove' => (new CartController())->removeFromCart(),
    'cart/clear' => (new CartController())->clearCart(),






    'payment' => (new CartController())->payment(),

    default => header("Location: ./?act=home")
};
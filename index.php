<?php
session_start();
// Require file Common
require_once './commons/env.php';
require_once './commons/function.php';
// Require Controllers
require_once './controllers/HomeController.php';
require_once './controllers/ProductController.php';
require_once './controllers/OrderController.php';
require_once './controllers/UserController.php';
require_once './admin/controllers/DashboardController.php';

// Require Models
require_once './models/User.php';
require_once './models/CategoryModel.php';
require_once './models/ProductModel.php';
require_once './models/OrderModel.php';
require_once './models/UserModel.php';




// Lấy tham số 'act' từ URL
$act = $_GET['act'] ?? '/';
// Điều hướng request
match ($act) {
  '/' => (new HomeController())->index(),
  'home' => (new HomeController())->index(),
  'products' => (new ProductController())->store(),
  'search' => (new ProductController())->search($_GET['keyword']),
  'category' => (new ProductController())->category($_GET['id']),
  'product-detail' => (new ProductController())->detail($_GET['id']),
  'profile' => (new UserController())->profile(),
  'my_orders' => (new OrderController())->myOrders(),
  'order_detail' => (new OrderController())->orderDetail(),
  'login' => (new HomeController())->login(),
  'handle-login' => (new HomeController())->handleLogin(),
  'adminDashboard' => (new DashboardController())->index(),
  'clientHome' => (new HomeController())->clientHome(),
  'logout' => (new HomeController())->logout(),
  default => header("Location: ./?act=home") && exit ,

};
require_once './views/layouts/layout_bottom.php';

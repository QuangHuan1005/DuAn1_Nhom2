<?php

session_start();
require_once './commons/env.php';
require_once './commons/function.php';
// Require Controllers
require_once './controllers/HomeController.php';
require_once './controllers/ProductController.php';
require_once './controllers/OrderController.php';
require_once './controllers/CommentController.php';
require_once './controllers/UserController.php';
require_once './admin/controllers/DashboardController.php';
require_once './controllers/CartController.php';

// Require Models
require_once './models/User.php';
require_once './models/CategoryModel.php';
require_once './models/ProductModel.php';
require_once './models/OrderModel.php';
require_once './models/UserModel.php';
require_once './models/CommentModel.php';
require_once './models/CartModel.php';




// Lấy tham số 'act' từ URL
$act = $_GET['act'] ?? '/';
// Điều hướng request
match ($act) {
  '/' => (new HomeController())->index(),
  'home' => (new HomeController())->index(),
  'page' => (new ProductController())->store(),
  'products' => (new ProductController())->store(),
  'search' => (new ProductController())->search($_GET['keyword']),
  'category' => (new ProductController())->category($_GET['id']),
  'product-detail' => (new ProductController())->detail($_GET['id']),
  'add_comment' => (new CommentController())->add(),
  'profile' => (new UserController())->profile(),
  'my_orders' => (new OrderController())->myOrders(),
  'order_detail' => (new OrderController())->orderDetail($_GET['id']),
  'my_orders_complete' => (new OrderController())->completeOrder($_GET['id']),
  'login' => (new HomeController())->login(),
  'handle-login' => (new HomeController())->handleLogin(),
  'register' => (new HomeController())->register(),
  'handle-register' => (new HomeController())->handleregister(),
  'clientHome' => (new HomeController())->clientHome(),
  'logout' => (new HomeController())->logout(),


  'cart' => (new CartController())->index(),
  'cart/add' => (new CartController())->addToCart(),
  'cart/update' => (new CartController())->updateCart(),
  'cart/remove' => (new CartController())->removeFromCart(),
  'cart/clear' => (new CartController())->clearCart(),






  'payment' => (new CartController())->payment(),

  'cancelOrder' => (function () {
      $order_id = $_GET['order_id'] ?? 0;
      (new OrderController())->cancelOrder($order_id);
    })(),

  'order-success' => require_once './views/order_success.php',

  default => header("Location: ./?act=home")
};

<?php

require_once "models/User.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";
require_once "models/OrderModel.php";

class OrderController
{
    private $productModel;
    private $orderModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->orderModel = new OrderModel();
    }

    public function myOrders()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $user_id = $_SESSION['user']['id'];
        $orders = $this->orderModel->getOrdersUser($user_id);
        if (!$orders) {
            $orders = [];
        }

        $success = $_SESSION['success'] ?? null;
        $error = $_SESSION['error'] ?? null;

        unset($_SESSION['success'], $_SESSION['error']);

        require 'views/order/my_orders.php';
    }

    // public function orderDetail()
    // {
    //     if (!isset($_SESSION['user'])) {
    //         header("Location: ?act=login");
    //         exit;
    //     }
    //     $user_id = $_SESSION['user']['id'];
    //     $order_id = $_GET['order_id'] ?? 0;
    //     $orders = $this->orderModel->getOrdersUser($user_id);
    //     $orderModel = new OrderModel();
    //     $orderDetails = $orderModel->getOrderItems($user_id, $order_id);
    //     require 'views/order/order_detail.php';
    // }
    public function orderDetail($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=login');
            exit;
        }

        $order = $this->orderModel->getOrderById($id);
        $productDetails = $this->productModel->getProductDetail($id);
        // Chỉ cho phép xem đơn của chính mình
        if ($order['user_id'] != $_SESSION['user']['id']) {
            die('Bạn không có quyền xem đơn hàng này.');
        } else {
            $orderDetails = $this->orderModel->getOrderItems($id);
            require './views/order/order_detail.php';
        }

    }
    public function completeOrder($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->orderModel->complete($id);
        }

        require 'views/order/my_orders.php';

    }



}
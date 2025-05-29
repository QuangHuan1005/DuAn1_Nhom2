<?php

require_once "models/User.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";
require_once "models/OrderModel.php";


class OrderController
{
    private $orderModel;

    public function __construct()
    {
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
        ;
        require 'views/order/my_orders.php';
    }
    public function orderDetail()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ?act=login");
            exit;
        }
        $orderModel = new OrderModel();
        // $items = $this->orderModel->getOrderItems($order_id);

        require 'views/order/order_detail.php';
    }



}
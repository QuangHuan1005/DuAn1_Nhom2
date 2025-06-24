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
            header("Location: index.php?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;
        $orders = $this->orderModel->getOrdersByPage($user_id, $limit, $offset);

        $totalOrders = $this->orderModel->countOrdersByUser($user_id);
        $totalPages = ceil($totalOrders / $limit);

        // Thông báo
        $success = $_SESSION['success'] ?? null;
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['success'], $_SESSION['error']);

        require 'views/order/my_orders.php';
    }
  
    public function orderDetail($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=login');
            exit;
        }

        $order = $this->orderModel->getOrderById($id);

        if (!$order || $order['user_id'] != $_SESSION['user']['id']) {
            die('Không có quyền xem đơn hàng này hoặc đơn hàng không tồn tại.');
        }

        $orderDetails = $this->orderModel->getOrderItems($id);
        require 'views/order/order_detail.php';
    }

    public function completeOrder($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=login');
            exit;
        }

        $order = $this->orderModel->getOrderById($id);
        $user_id = $_SESSION['user']['id'];

        if (!$order || $order['user_id'] != $user_id) {
            $_SESSION['error'] = "Không thể hoàn tất đơn hàng này.";
        } else {
            $this->orderModel->complete($id);
            $_SESSION['success'] = "Đơn hàng đã được đánh dấu hoàn tất.";
        }

        header("Location: index.php?act=myOrders");
        exit;
    }

    public function cancelOrder($order_id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=login');
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $order = $this->orderModel->getOrderById($order_id);

        if (!$order) {
            $_SESSION['error'] = "Đơn hàng không tồn tại.";
        } elseif ($order['user_id'] != $user_id) {
            $_SESSION['error'] = "Bạn không có quyền hủy đơn hàng này.";
        } elseif ($order['status_id'] != 1) {
            $_SESSION['error'] = "Đơn hàng không thể hủy ở trạng thái hiện tại.";
        } else {
            $result = $this->orderModel->updateOrderStatus($order_id, 5); // 5 = Đã hủy
            $_SESSION['success'] = $result ? "Hủy đơn hàng thành công." : "Hủy đơn hàng thất bại.";
        }

        header("Location: index.php?act=myOrders");
        exit;
    }
}

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

    // Hiển thị danh sách đơn hàng của user đang đăng nhập
    public function myOrders()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $orders = $this->orderModel->getOrdersUser($user_id) ?? [];

        $success = $_SESSION['success'] ?? null;
        $error = $_SESSION['error'] ?? null;

        unset($_SESSION['success'], $_SESSION['error']);

        require 'views/order/my_orders.php';
    }

    // Xem chi tiết đơn hàng
    public function orderDetail($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=login');
            exit;
        }

        $order = $this->orderModel->getOrderById($id);

        if (!$order) {
            die('Đơn hàng không tồn tại.');
        }

        if ($order['user_id'] != $_SESSION['user']['id']) {
            die('Bạn không có quyền xem đơn hàng này.');
        }

        $orderDetails = $this->orderModel->getOrderItems($id);

        require './views/order/order_detail.php';
    }

    // Đánh dấu đơn hàng đã hoàn tất
    public function completeOrder($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->orderModel->complete($id);
        }

        header("Location: index.php?act=myOrders");
        exit;
    }

    // Hủy đơn hàng
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
            header("Location: index.php?act=myOrders");
            exit;
        }

        if ($order['user_id'] != $user_id) {
            $_SESSION['error'] = "Bạn không có quyền hủy đơn hàng này.";
            header("Location: index.php?act=myOrders");
            exit;
        }

        // Điều chỉnh lại tên trường 'status_id' thay vì 'status' nếu bạn dùng ID
        if ($order['status_id'] != 1) { // 1 = Chờ xác nhận
            $_SESSION['error'] = "Đơn hàng không thể hủy ở trạng thái hiện tại.";
            header("Location: index.php?act=myOrders");
            exit;
        }

        $result = $this->orderModel->updateOrderStatus($order_id, 5); // 5 = Đã hủy

        if ($result) {
            $_SESSION['success'] = "Hủy đơn hàng thành công.";
        } else {
            $_SESSION['error'] = "Hủy đơn hàng thất bại.";
        }

        header("Location: index.php?act=myOrders");
        exit;
    }
}

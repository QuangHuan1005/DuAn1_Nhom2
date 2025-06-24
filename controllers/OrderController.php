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
            header("Location: index.php?action=login");
            exit;   
        }
        $user_id = $_SESSION['user']['id'];
        $limit = 5;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;

        $offset = ($page - 1) * $limit;
        $orders = $this->orderModel->getOrdersByPage($limit, $offset);
        $totailOrders = $this->orderModel->getOrdersUser($user_id);
        $totalPages = ceil($totailOrders / $limit);

        if (!$orders) {
            $orders = [];
        }
        require 'views/order/my_orders.php';
    }

    // Xem chi tiết đơn hàng, chỉ user chính chủ mới xem được
    public function orderDetail($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=login');
            exit;
        }

        $order = $this->orderModel->getOrderById($id);
        $orderDetails = $this->orderModel->getOrderItems($id);
        require './views/order/order_detail.php';

        if (!$order) {
            die('Đơn hàng không tồn tại.');
        }

        if ($order['user_id'] != $_SESSION['user']['id']) {
            die('Bạn không có quyền xem đơn hàng này.');
        }
    }
    public function completeOrder($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=login');
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        $this->orderModel->complete($id);
        $orders = $this->orderModel->getOrderById($id);

        // Truyền dữ liệu ra view
        require './views/order/my_orders.php';
    }






    // Hủy đơn hàng, chỉ cho phép user chính chủ hủy đơn trạng thái 'pending'
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

        // Kiểm tra trạng thái đơn hàng, ví dụ chỉ cho hủy khi đang pending
        if ($order['status'] != 'pending') {
            $_SESSION['error'] = "Đơn hàng không thể hủy ở trạng thái hiện tại.";
            header("Location: index.php?act=myOrders");
            exit;
        }

        // Cập nhật trạng thái hủy đơn hàng
        $result = $this->orderModel->updateOrderStatus($order_id, 'cancelled');

        if ($result) {
            $_SESSION['success'] = "Hủy đơn hàng thành công.";
        } else {
            $_SESSION['error'] = "Hủy đơn hàng thất bại.";
        }

        header("Location: index.php?act=myOrders");
        exit;
    }
}

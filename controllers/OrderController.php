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
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        // Gọi đúng hàm từ model (đảm bảo bạn có hàm này trong OrderModel)
        $orders = $this->orderModel->getOrdersByPage($user_id, $limit, $offset);
        $totalOrders = $this->orderModel->countOrdersByUser($user_id);
        $totalPages = ceil($totalOrders / $limit);

        if (!$orders || !is_array($orders)) {
            $orders = [];
        }

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
            header("Location: index.php?act=my_orders");
            exit;
        }

        if ($order['user_id'] != $user_id) {
            $_SESSION['error'] = "Bạn không có quyền hủy đơn hàng này.";
            header("Location: index.php?act=my_orders");
            exit;
        }

        // Cho phép hủy nếu status_id là 1 (Đang xử lý) hoặc 2 (Đang giao)
        if (!in_array($order['status_id'], [1, 2])) {
            $_SESSION['error'] = "Đơn hàng không thể hủy ở trạng thái hiện tại.";
            header("Location: index.php?act=my_orders");
            exit;
        }

        $result = $this->orderModel->updateOrderStatus($order_id, 7); // 7 = Hủy đơn

        if ($result) {
            $_SESSION['success'] = "Hủy đơn hàng thành công.";
        } else {
            $_SESSION['error'] = "Hủy đơn hàng thất bại.";
        }

        header("Location: index.php?act=my_orders");
        exit;
    }

    // Hoàn tất đơn hàng (nút "Hoàn tất" khi đã nhận)
    public function completeOrder($order_id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?act=login');
            exit;
        }

        $order = $this->orderModel->getOrderById($order_id);

        if (!$order) {
            $_SESSION['error'] = "Đơn hàng không tồn tại.";
            header("Location: index.php?act=my_orders");
            exit;
        }

        if ($order['user_id'] != $_SESSION['user']['id']) {
            $_SESSION['error'] = "Bạn không có quyền hoàn tất đơn hàng này.";
            header("Location: index.php?act=my_orders");
            exit;
        }

        // Gọi hàm xử lý cập nhật trạng thái
        $success = $this->orderModel->complete($order_id);

        if ($success) {
            $_SESSION['success'] = "Đã cập nhật trạng thái đơn hàng.";
        } else {
            $_SESSION['error'] = "Không thể hoàn tất đơn hàng.";
        }

        header("Location: index.php?act=my_orders");
        exit;
    }
}

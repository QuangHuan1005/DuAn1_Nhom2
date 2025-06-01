<?php

class OrderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }

    public function index() {
        $keyword = $_GET['keyword'] ?? '';
        $status_id = $_GET['status_id'] ?? '';
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $orders = $this->orderModel->searchOrders($keyword, $limit, $offset,$status_id);
        $totalOrders = $this->orderModel->countTotalOrders($keyword);
        $totalPages = ceil($totalOrders / $limit);

    $statuses = $this->orderModel->getAllStatuses();
        require_once __DIR__ . '/../views/orders/index.php';
    }
    public function view() {
        $id = $_GET['id'] ?? 0;
        $order = $this->orderModel->getOrderById($id);

        if (!$order) {
            echo "Đơn hàng không tồn tại.";
            return;
        }
        $orderItems = $this->orderModel->getOrderItemsByOrderId($id);

        require_once __DIR__ . '/../views/orders/show.php';
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'] ?? 0;
            $status_id = $_POST['status_id'] ?? null;

            if ($id && $status_id) {
                $success = $this->orderModel->updateOrderStatus($id, $status_id);

                if ($success) {
                    header("Location: index.php?act=orderIndex");
                    exit;
                } else {
                    echo "Cập nhật trạng thái thất bại.";
                }
            } else {
                echo "Thiếu ID hoặc trạng thái.";
            }
        }
    }

    public function updateStatusForm() {
        $id = $_GET['id'] ?? 0;
        $order = $this->orderModel->getOrderById($id);
        $statuses = $this->orderModel->getAllStatuses(); 

        if (!$order) {
            echo "Đơn hàng không tồn tại.";
            return;
        }

        require_once __DIR__ . '/../views/orders/update_status.php';
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        $this->orderModel->deleteOrder($id);
        header("Location: index.php?act=orderIndex");
        exit;
    }
}

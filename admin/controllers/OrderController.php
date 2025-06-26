<?php

class OrderController {
    private $orderModel;
    private $userRole;

    public function __construct() {
        $this->orderModel = new OrderModel();
        $this->userRole = $_SESSION['user']['role'] ?? 'customer';
    }

    public function index() {
        $keyword = $_GET['keyword'] ?? '';
        $status_id = $_GET['status_id'] ?? '';
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $orders = $this->orderModel->searchOrders($keyword, $limit, $offset, $status_id);
        $totalOrders = $this->orderModel->countTotalOrders($keyword, $status_id);
        $totalPages = ceil($totalOrders / $limit);

        $statuses = $this->orderModel->getAllStatuses();

        require_once __DIR__ . '/../views/orders/index.php';
    }

    public function view() {
        $orderCode = $_GET['order_code'] ?? null;

        if (!$orderCode) {
            echo "Thiếu mã đơn hàng.";
            return;
        }

        $order = $this->orderModel->getOrderByCode($orderCode);

        if (!$order) {
            echo "Đơn hàng không tồn tại.";
            return;
        }

        $orderItems = $this->orderModel->getOrderItemsByOrderId($order['id']);

        require_once __DIR__ . '/../views/orders/show.php';
    }

   public function updateStatusForm() {
    $id = (int)($_GET['id'] ?? 0);

    if (!$id) {
        echo "Thiếu ID đơn hàng.";
        return;
    }

    $order = $this->orderModel->getOrderById($id);
    $statuses = $this->orderModel->getAllStatuses();

    if (!$order) {
        echo "Đơn hàng không tồn tại.";
        return;
    }

    require_once __DIR__ . '/../views/orders/update_status.php';
}


    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Phương thức không hợp lệ.";
            return;
        }

        $id = (int)($_GET['id'] ?? 0);
        $newStatusId = isset($_POST['status_id']) ? (int)$_POST['status_id'] : 0;

        if (!$id || !$newStatusId) {
            echo "Thiếu ID hoặc trạng thái mới.";
            return;
        }

        $order = $this->orderModel->getOrderById($id);
        if (!$order) {
            echo "Đơn hàng không tồn tại.";
            return;
        }

        $currentStatusId = $order['status_id'];
        $statuses = $this->orderModel->getAllStatuses();

        $statusNameToId = [];
        foreach ($statuses as $status) {
            $statusNameToId[$status['name']] = $status['id'];
        }

        $requiredStatuses = [
            "Chờ xác nhận",
            "Chờ lấy hàng",
            "Đang giao hàng",
            "Đã giao hàng",
            "Đã hủy",
             "Hoàn thành"
        ];

        foreach ($requiredStatuses as $statusName) {
            if (!isset($statusNameToId[$statusName])) {
                echo "Trạng thái '{$statusName}' chưa được khai báo trong hệ thống.";
                return;
            }
        }

        if (!$this->canChangeStatus($currentStatusId, $newStatusId, $this->userRole, $statusNameToId)) {
            echo "Không thể chuyển trạng thái từ '{$this->getStatusName($currentStatusId, $statuses)}' sang '{$this->getStatusName($newStatusId, $statuses)}' với quyền '{$this->userRole}'.";
            return;
        }

        if ($this->orderModel->updateOrderStatus($id, $newStatusId)) {
            header("Location: index.php?act=orderIndex");
            exit;
        } else {
            echo "Cập nhật trạng thái thất bại.";
        }
    }

    private function canChangeStatus($currentStatusId, $newStatusId, $userRole, $statusNameToId) {
        $waitingId = $statusNameToId["Chờ xác nhận"];
        $confirmedId = $statusNameToId["Chờ lấy hàng"];
        $shippingId = $statusNameToId["Đang giao hàng"];
        $deliveredId = $statusNameToId["Đã giao hàng"];
        $completedId = $statusNameToId["Đã hủy"];
        $cancelledId = $statusNameToId[ "Hoàn thành"];  

        if ($userRole === 'admin') {
            switch ($currentStatusId) {
                case $waitingId:
                    return in_array($newStatusId, [$confirmedId, $cancelledId]);
                case $confirmedId:
                    return in_array($newStatusId, [$shippingId, $cancelledId]);
                case $shippingId:
                    return $newStatusId === $deliveredId;
                case $deliveredId:
                    return $newStatusId === $completedId;
                    case $cancelledId:
                    return false;
                case $completedId:
                // case $cancelledId:
                //     return false;
                default:
                    return false;
            }
        }

        if ($userRole === 'customer') {
            return ($currentStatusId === $deliveredId && $newStatusId === $completedId);
        }

        return false;
    }

    private function getStatusName($statusId, $statuses) {
        foreach ($statuses as $status) {
            if ($status['id'] == $statusId) {
                return $status['name'];
            }
        }
        return "Không xác định";
    }
}

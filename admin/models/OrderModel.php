<?php

class OrderModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function searchOrders($keyword, $limit, $offset, $status_id = null) {
        $sql = "SELECT o.*, os.name as status_name 
                FROM orders o
                LEFT JOIN order_statuses os ON o.status_id = os.id
                WHERE (o.receiver_name LIKE :keyword 
                       OR o.receiver_email LIKE :keyword 
                       OR o.receiver_phone LIKE :keyword)";

        $params = [':keyword' => "%$keyword%"];

        if ($status_id !== null && $status_id !== '' && $status_id !== 'all') {
            $sql .= " AND o.status_id = :status_id";
            $params[':status_id'] = $status_id;
        }

        $sql .= " ORDER BY o.created_at DESC 
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);

        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val, PDO::PARAM_STR);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countTotalOrders($keyword, $status_id = null) {
        $sql = "SELECT COUNT(*) FROM orders 
                WHERE (receiver_name LIKE :keyword 
                       OR receiver_email LIKE :keyword 
                       OR receiver_phone LIKE :keyword)";

        $params = [':keyword' => "%$keyword%"];

        if ($status_id !== null && $status_id !== '' && $status_id !== 'all') {
            $sql .= " AND status_id = :status_id";
            $params[':status_id'] = $status_id;
        }

        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val, PDO::PARAM_STR);
        }
        $stmt->execute();
        return (int)$stmt->fetchColumn();
    }

      public function getOrderById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);}

   public function getOrderByCode($orderCode) {
    $sql = "SELECT o.*, os.name as status_name, pm.name as payment_method_name
            FROM orders o
            LEFT JOIN order_statuses os ON o.status_id = os.id
            LEFT JOIN payment_methods pm ON o.payment_method_id = pm.id
            WHERE o.order_code = :order_code LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':order_code', $orderCode, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    // Lấy đơn hàng kèm theo danh sách sản phẩm luôn
    public function getOrderByIdWithItems($id) {
        $order = $this->getOrderById($id);
        if (!$order) return false;

        $order['items'] = $this->getOrderItemsByOrderId($id);
        return $order;
    }

    public function getOrderItemsByOrderId($orderId) {
        $sql = "SELECT oi.*, p.name as product_name, p.image_url
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':order_id', (int)$orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOrder($id, $data) {
        $sql = "UPDATE orders SET 
                    status_id = :status_id,
                    total_amount = :total_amount,
                    shipping_address = :shipping_address,
                    receiver_name = :receiver_name,
                    receiver_phone = :receiver_phone,
                    receiver_email = :receiver_email,
                    payment_method_id = :payment_method_id,
                    payment_status = :payment_status,
                    updated_at = NOW()
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':status_id' => $data['status_id'],
            ':total_amount' => $data['total_amount'],
            ':shipping_address' => $data['shipping_address'],
            ':receiver_name' => $data['receiver_name'],
            ':receiver_phone' => $data['receiver_phone'],
            ':receiver_email' => $data['receiver_email'],
            ':payment_method_id' => $data['payment_method_id'],
            ':payment_status' => $data['payment_status'],
            ':id' => (int)$id
        ]);
    }

    public function updateOrderStatusByCode($orderCode, $status_id) {
    $sql = "UPDATE orders SET status_id = :status_id, updated_at = NOW() WHERE order_code = :order_code";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':status_id' => $status_id,
        ':order_code' => $orderCode
    ]);
}


    public function updateTotalAmount($orderId) {
        $total = $this->calculateTotalAmount($orderId);
        $sql = "UPDATE orders SET total_amount = :total_amount WHERE id = :order_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':total_amount' => $total,
            ':order_id' => $orderId,
        ]);
    }

    public function calculateTotalAmount($orderId) {
        $sql = "SELECT SUM(quantity * unit_price) as total FROM order_items WHERE order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':order_id', (int)$orderId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function updateOrderStatus($id, $status_id) {
        // Có thể thêm kiểm tra trạng thái chuyển đổi nếu muốn
        $sql = "UPDATE orders SET status_id = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status_id, $id]);
    }

    public function getOrderStatus($id) {
        $sql = "SELECT status_id FROM orders WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getAllStatuses() {
        $sql = "SELECT * FROM order_statuses ORDER BY id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  
// Tổng doanh thu từ các đơn "Hoàn thành"
    public function getTotalRevenue($startDate = null, $endDate = null)
    {
        $sql = "SELECT SUM(total_amount) as revenue FROM orders WHERE status_id = 4"; // Giả sử 4 = Hoàn thành

        $params = [];
        if ($startDate && $endDate) {
            $sql .= " AND created_at BETWEEN :start_date AND :end_date";
            $params = [
                ':start_date' => $startDate . ' 00:00:00',
                ':end_date' => $endDate . ' 23:59:59'
            ];
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC)['revenue'] ?? 0;
    }



    // Top 5 khách hàng mua nhiều nhất theo tổng tiền hoặc số đơn
    public function getTopCustomers($startDate = null, $endDate = null)
    {
        $sql = "
            SELECT u.id, u.fullname, u.email, COUNT(o.id) as total_orders, SUM(o.total_amount) as total_spent
            FROM users u
            JOIN orders o ON u.id = o.user_id
            WHERE o.status_id = 4
        ";

        $params = [];
        if ($startDate && $endDate) {
            $sql .= " AND o.created_at BETWEEN :start_date AND :end_date";
            $params = [
                ':start_date' => $startDate . ' 00:00:00',
                ':end_date' => $endDate . ' 23:59:59'
            ];
        }

        $sql .= "
            GROUP BY u.id
            ORDER BY total_spent DESC
            LIMIT 5
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy các đơn hàng "Chờ xác nhận"
    public function getPendingOrders()
    {
        $sql = "
            SELECT o.*, u.fullname 
            FROM orders o 
            JOIN users u ON o.user_id = u.id
            WHERE o.status_id = 1  -- Giả sử 1 = Chờ xác nhận
            ORDER BY o.created_at DESC
            LIMIT 10
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

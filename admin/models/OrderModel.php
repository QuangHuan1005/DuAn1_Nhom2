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
        $sql = "SELECT o.*, os.name as status_name, pm.name as payment_method_name
                FROM orders o
                LEFT JOIN order_statuses os ON o.status_id = os.id
                LEFT JOIN payment_methods pm ON o.payment_method_id = pm.id
                WHERE o.id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderItemsByOrderId($orderId) {
        $sql = "SELECT oi.*, p.name as product_name
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

    public function deleteOrder($id) {
        $this->conn->beginTransaction();
        try {
            $sqlDeleteItems = "DELETE FROM order_items WHERE order_id = :id";
            $stmtItems = $this->conn->prepare($sqlDeleteItems);
            $stmtItems->execute([':id' => (int)$id]);

            $sqlDeletePayments = "DELETE FROM order_payments WHERE order_id = :id";
            $stmtPayments = $this->conn->prepare($sqlDeletePayments);
            $stmtPayments->execute([':id' => (int)$id]);

            $sqlDeleteOrder = "DELETE FROM orders WHERE id = :id";
            $stmtOrder = $this->conn->prepare($sqlDeleteOrder);
            $result = $stmtOrder->execute([':id' => (int)$id]);

            $this->conn->commit();
            return $result;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Lỗi khi xóa đơn hàng: " . $e->getMessage());
            return false;
        }
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
        $sql = "UPDATE orders SET status_id = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status_id, $id]);
    }

    public function getAllStatuses() {
        $sql = "SELECT * FROM order_statuses ORDER BY id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

<?php
class OrderModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Đếm tổng số đơn hàng của 1 user
    public function countOrdersByUser($user_id)
    {
        $sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        $result = $stmt->fetch();
        return $result['total_orders'] ?? 0;
    }

    // Lấy danh sách đơn hàng theo trang
    public function getOrdersByPage($user_id, $limit, $offset)
    {
        $sql = "SELECT orders.*, order_statuses.name AS status_name
                FROM orders
                JOIN order_statuses ON orders.status_id = order_statuses.id
                WHERE orders.user_id = :user_id
                ORDER BY orders.created_at DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy đơn hàng theo ID
    public function getOrderById($id)
    {
        $sql = "SELECT o.*, u.username AS user_name, u.email AS user_email, u.phone AS user_phone
                FROM orders o
                JOIN users u ON o.user_id = u.id
                WHERE o.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách sản phẩm trong đơn hàng
    public function getOrderItems($order_id)
    {
        $sql = "SELECT oi.*, p.name AS product_name, p.image_url
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hoàn tất đơn hàng
    public function complete($order_id)
    {
        $stmt = $this->conn->prepare("SELECT status_id FROM orders WHERE id = ?");
        $stmt->execute([$order_id]);
        $order = $stmt->fetch();

        if (!$order) return false;

        // Nếu đang giao thì chuyển sang đã giao và cập nhật trạng thái thanh toán
        if ($order['status_id'] == 4) {
            $sql = "UPDATE orders SET status_id = 6, payment_status = 'Đã thanh toán', updated_at = NOW() WHERE id = ?";
        }
        // Nếu đang xử lý hoặc đang chờ thì chuyển sang đã hủy
        elseif (in_array($order['status_id'], [1, 2])) {
            $sql = "UPDATE orders SET status_id = 5, payment_status = 'Chưa thanh toán', updated_at = NOW() WHERE id = ?";
        } else {
            return false;
        }

        $update = $this->conn->prepare($sql);
        return $update->execute([$order_id]);
    }

    // Tạo đơn hàng mới
    public function createOrder($user_id, $receiver_name, $receiver_phone, $receiver_email, $total_amount, $shipping_address = 'Chưa cung cấp')
    {
        $sql = "INSERT INTO orders (
                    order_code, user_id, status_id, payment_method_id,
                    total_amount, shipping_address,
                    receiver_name, receiver_phone, receiver_email,
                    payment_status, is_received,
                    created_at, updated_at
                ) VALUES (
                    :order_code, :user_id, :status_id, :payment_method_id,
                    :total_amount, :shipping_address,
                    :receiver_name, :receiver_phone, :receiver_email,
                    :payment_status, :is_received,
                    NOW(), NOW()
                )";

        $stmt = $this->conn->prepare($sql);
        $order_code = 'DH' . date('YmdHis') . rand(100, 999);

        $stmt->execute([
            ':order_code' => $order_code,
            ':user_id' => $user_id,
            ':status_id' => 1, // đang xử lý
            ':payment_method_id' => 1, // COD
            ':total_amount' => $total_amount,
            ':shipping_address' => $shipping_address,
            ':receiver_name' => $receiver_name,
            ':receiver_phone' => $receiver_phone,
            ':receiver_email' => $receiver_email,
            ':payment_status' => 'Chưa thanh toán',
            ':is_received' => 0
        ]);

        return $this->conn->lastInsertId();
    }

    // Thêm sản phẩm vào đơn hàng
    public function addOrderItem($order_id, $product_id, $quantity, $unit_price)
    {
        $sql = "INSERT INTO order_items (
                    order_id, product_id, quantity, unit_price,
                    created_at, updated_at
                ) VALUES (
                    :order_id, :product_id, :quantity, :unit_price,
                    NOW(), NOW()
                )";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':order_id' => $order_id,
            ':product_id' => $product_id,
            ':quantity' => $quantity,
            ':unit_price' => $unit_price
        ]);
    }

    // Giảm số lượng tồn kho
    public function decreaseStockQuantity($product_id, $quantity)
    {
        $sql = "UPDATE products 
                SET stock_quantity = stock_quantity - :qty 
                WHERE id = :pid AND stock_quantity >= :qty";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':qty' => $quantity, ':pid' => $product_id]);
    }

    // Tăng lại số lượng tồn kho
    public function increaseStockQuantity($product_id, $quantity)
    {
        $sql = "UPDATE products SET stock_quantity = stock_quantity + :qty WHERE id = :pid";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':qty' => $quantity, ':pid' => $product_id]);
    }

    // Cập nhật trạng thái đơn hàng (cho hủy)
    public function updateOrderStatus($order_id, $new_status_id)
    {
        $sql = "UPDATE orders SET status_id = :status_id, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':status_id' => $new_status_id, ':id' => $order_id]);
    }
}

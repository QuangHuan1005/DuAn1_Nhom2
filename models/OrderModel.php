<?php
class OrderModel
{
    private $conn;

  public function __construct()
    {
        $this->conn = connectDB();
    }
    
    public function getOrdersUser($user_id)
    {
        $sql = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetchAll();
    }

    public function getOrderItems($order_id)
    {
        $sql = "SELECT 
                    oi.*, 
                    p.name AS product_name, 
                    p.image_url 
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':order_id' => $order_id]);
        return $stmt->fetchAll();
    }

    public function createOrder($user_id, $receiver_name, $receiver_phone, $receiver_email, $total_amount, $shipping_address = 'Chưa cung cấp')
    {
        $sql = "INSERT INTO orders (
                    order_code,
                    user_id,
                    status_id,
                    payment_method_id,
                    total_amount,
                    shipping_address,
                    receiver_name,
                    receiver_phone,
                    receiver_email,
                    payment_status,
                    is_received,
                    created_at,
                    updated_at
                ) VALUES (
                    :order_code,
                    :user_id,
                    :status_id,
                    :payment_method_id,
                    :total_amount,
                    :shipping_address,
                    :receiver_name,
                    :receiver_phone,
                    :receiver_email,
                    :payment_status,
                    :is_received,
                    NOW(),
                    NOW()
                )";

        $stmt = $this->conn->prepare($sql);

        $order_code = 'DH' . date('YmdHis') . rand(100, 999);

        $stmt->execute([
            ':order_code' => $order_code,
            ':user_id' => $user_id,
            ':status_id' => 1,
            ':payment_method_id' => 1, 
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
    public function addOrderItem($order_id, $product_id, $quantity, $unit_price)
    {
        $sql = "INSERT INTO order_items (
                    order_id,
                    product_id,
                    quantity,
                    unit_price,
                    created_at,
                    updated_at
                ) VALUES (
                    :order_id,
                    :product_id,
                    :quantity,
                    :unit_price,
                    NOW(),
                    NOW()
                )";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':order_id' => $order_id,
            ':product_id' => $product_id,
            ':quantity' => $quantity,
            ':unit_price' => $unit_price
        ]);
    }

    public function decreaseStockQuantity($product_id, $quantity)
    {
        $sql = "UPDATE products SET stock_quantity = stock_quantity - :qty WHERE id = :pid AND stock_quantity >= :qty";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':qty' => $quantity, ':pid' => $product_id]);
    }

    public function increaseStockQuantity($product_id, $quantity)
    {
        $sql = "UPDATE products SET stock_quantity = stock_quantity + :qty WHERE id = :pid";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':qty' => $quantity, ':pid' => $product_id]);
    }

}

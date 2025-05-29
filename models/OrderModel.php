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
        $data = $this->conn->prepare($sql);
        $data->bindParam(':user_id', $user_id);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
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

        $data = $this->conn->prepare($sql);
        $data->bindParam(':order_id', $order_id, PDO::PARAM_INT);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

}

<?php
class CommentModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getCmtsByProduct($product_id)
    {
        $sql = "
            SELECT c.*, u.username AS user_name
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.product_id = :product_id AND c.status = 1
            ORDER BY c.created_at DESC
        ";
        $data = $this->conn->prepare($sql);
        $data->bindParam(':product_id', $product_id);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm bình luận
    public function addComment($user_id, $product_id, $content)
    {
        $sql = "
            INSERT INTO comments (user_id, product_id, content, created_at)
            VALUES (:user_id, :product_id, :content, NOW())";
        $data = $this->conn->prepare($sql);
        $data->bindParam(':user_id', $user_id);
        $data->bindParam(':product_id', $product_id);
        $data->bindParam(':content', $content);
        return $data->execute();
    }

}
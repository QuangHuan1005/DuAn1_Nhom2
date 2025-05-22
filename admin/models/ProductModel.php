<?php
class ProductModel {
    private $conn;
    
    public function __construct() {
        $this->conn = connectDB();
        if (!$this->conn) {
            die("Kết nối database thất bại");
        }
    }
    
    public function get_list() {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.deleted_at IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.id = ? AND p.deleted_at IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
public function create($data) {
    $sql = "INSERT INTO products (category_id, name, description, image_url, price, stock_quantity, status) 
            VALUES (:category_id, :name, :description, :image_url, :price, :stock_quantity, :status)";
    
    $stmt = $this->conn->prepare($sql);

    // Ràng buộc giá trị cụ thể nếu cần
    return $stmt->execute([
        ':category_id' => $data['category_id'],
        ':name' => $data['name'],
        ':description' => $data['description'],
        ':image_url' => $data['image_url'] ?? null,
        ':price' => $data['price'],
        ':stock_quantity' => $data['stock_quantity'],
        ':status' => $data['status']
    ]);
}

public function update($id, $data)
{
    $sql = "UPDATE products SET
                category_id = :category_id,
                name = :name,
                description = :description,
                price = :price,
                stock_quantity = :stock_quantity,
                status = :status,
                image_url = :image_url,
                updated_at = NOW()
            WHERE id = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':category_id', $data['category_id']);
    $stmt->bindValue(':name', $data['name']);
    $stmt->bindValue(':description', $data['description']);
    $stmt->bindValue(':price', $data['price']);
    $stmt->bindValue(':stock_quantity', $data['stock_quantity']);
    $stmt->bindValue(':status', $data['status']);
    $stmt->bindValue(':image_url', $data['image_url']);
    $stmt->bindValue(':id', $id);

    return $stmt->execute();
}



    public function softDelete($id) {
        $sql = "UPDATE products SET deleted_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    public function getAllCategories() {
        $sql = "SELECT * FROM categories ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

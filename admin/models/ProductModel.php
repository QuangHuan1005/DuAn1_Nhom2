<?php
class ProductModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
        if (!$this->conn) {
            die("Kết nối database thất bại");
        }
    }

    // public function get_list()
    // {
    //     $sql = "SELECT p.*, c.name as category_name 
    //             FROM products p 
    //             LEFT JOIN categories c ON p.category_id = c.id 
    //             WHERE p.deleted_at IS NULL";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    public function get_list()
    {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.status = 1  AND c.is_active = 1 ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    public function getById($id)
    {
        $sql = "SELECT p.*, c.name AS category_name, c.is_active 
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Tìm kiếm sản phẩm, phân trang
    public function get_list_by_keyword($keyword = null, $limit = 5, $offset = 0)
    {
        $sql = "SELECT p.*, c.name as category_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE c.is_active = 1";

        $params = [];

        if ($keyword) {
            $sql .= " AND p.name LIKE ?";
            $params[] = $keyword . '%';
        }

        $sql .= " ORDER BY p.name ASC LIMIT $limit OFFSET $offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }

    public function count_all_by_keyword($keyword = null)
    {
        $sql = "SELECT COUNT(*) 
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE c.is_active = 1";
        $params = [];

        if ($keyword) {
            $sql .= " AND p.name LIKE ?";
            $params[] = $keyword . '%';
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn();
    }


    public function create($data)
    {
        $sql = "INSERT INTO products (category_id, name, description, image_url, price, discount_price, stock_quantity, status) 
            VALUES (:category_id, :name, :description, :image_url, :price, :discount_price, :stock_quantity, :status)";

        $stmt = $this->conn->prepare($sql);


        return $stmt->execute([
            ':category_id' => $data['category_id'],
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':image_url' => $data['image_url'] ?? null,
            ':price' => $data['price'],
            ':discount_price' => $data['discount_price'],
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




    public function updateStatus($id, $status)
    {
        $stmt = $this->conn->prepare("UPDATE products SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Top 5 sản phẩm bán chạy

    public function getTopSellingProducts()
    {
        $sql = "
            SELECT p.*, SUM(oi.quantity) AS total_sold
            FROM products p
            JOIN categories c ON p.category_id = c.id
            JOIN order_items oi ON p.id = oi.product_id
            JOIN orders o ON oi.order_id = o.id
            WHERE c.is_active = 1
            GROUP BY p.id
            ORDER BY total_sold DESC
            LIMIT 5
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    // Top 5 sản phẩm tồn kho cao nhất 
    public function getTopStockProducts()
    {
        $sql = "
            SELECT p.*
            FROM products p
            JOIN categories c ON p.category_id = c.id
            WHERE p.status = 1 AND c.is_active = 1
            ORDER BY p.stock_quantity DESC
            LIMIT 5
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

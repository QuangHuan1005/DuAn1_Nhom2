<?php
class ProductModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function searchProducts($keyword)
    {
        $sql = "SELECT * FROM products 
                WHERE deleted_at IS NULL 
                AND  status = 1
                AND  name LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['keyword' =>  $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBestseller()
    {
        $sql = "SELECT * FROM products WHERE status = 1 ORDER BY price DESC LIMIT 8";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFeatured()
    {
        $sql = "SELECT * FROM products WHERE status = 1  ORDER BY RAND() LIMIT 5";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCategory($category_id)
    {
        $sql = "SELECT * FROM products WHERE status = 1 AND category_id = :category_id";
        $data = $this->conn->prepare($sql);
        $data->execute(['category_id' => $category_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $sql = "SELECT COUNT(*) FROM products WHERE status = 1 ";
        $data = $this->conn->query($sql);
        return $data->fetchColumn();
    }

    public function getProductsByPage($limit, $offset)
    {
        $sql = "SELECT * FROM products WHERE status = 1 LIMIT :limit OFFSET :offset";
        $data = $this->conn->prepare($sql);
        $data->bindParam(':limit', $limit, PDO::PARAM_INT);
        $data->bindParam(':offset', $offset, PDO::PARAM_INT);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductDetail($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id AND status = 1 ";
        $data = $this->conn->prepare($sql);
        $data->execute(['id' => $id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function searchByKeyword($keyword)
    {
        $sql = "SELECT * FROM products WHERE status = 1 AND name LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $keyword = "%$keyword%"; 
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

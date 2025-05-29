<?php
class ProductModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getBestseller()
    {
        $sql = "SELECT * FROM products ORDER BY price DESC LIMIT 8";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getFeatured()
    {
        $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 5";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getByCategory($category_id)
    {
        $sql = "SELECT * FROM products WHERE category_id = $category_id";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {

        $sql = "SELECT COUNT(*) FROM products";
        // $data = $this->conn->prepare($sql);
        // // $data->execute();
        // return $data->fetchColumn(PDO::FETCH_ASSOC);
        $data = $this->conn->query($sql);
        return $data->fetchColumn();


    }
    public function getProductsByPage($limit, $offset)
    {
        $sql = "SELECT * FROM products LIMIT :limit OFFSET :offset";
        $data = $this->conn->prepare($sql);
        $data->bindParam(':limit', $limit, PDO::PARAM_INT);
        $data->bindParam(':offset', $offset, PDO::PARAM_INT);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProductDetail($id)
    {
        $sql = "SELECT * FROM products WHERE id = $id";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    public function searchByKeyword($keyword)
    {
        $sql = "SELECT * FROM products WHERE name LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $keyword = "%$keyword%"; // nối % ở PHP, không trong SQL
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }





}
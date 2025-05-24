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
    public function getProducts()
    {
        $sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 9";
        $data = $this->conn->prepare($sql);
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


}
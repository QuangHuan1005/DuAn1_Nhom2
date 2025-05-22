<?php
require_once 'env.php';

class ProductModel
{
    private $conn;

    public function __construct()
    {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname= " . DB_NAME . ";charset=utf8";
            $this->conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    public function getAllAvailable()
    {
        $sql = "SELECT * FROM products WHERE deleted_at IS NULL AND status = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

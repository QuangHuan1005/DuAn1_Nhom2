<?php
class CategoryModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAll()
    {
        $sql = "SELECT * FROM categories WHERE is_active = 1 ";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = $id";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetch(PDO::FETCH_ASSOC);
    }

}
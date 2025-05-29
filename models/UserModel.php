<?php
class UserModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getUserById($id) {
    $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    // public function updateUser($id, $name, $email, $phone, $address)
    // {
    //     $stmt = $this->conn->prepare("
    //     UPDATE users SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :id
    // ");
    //     $stmt->execute([
    //         ':id' => $id,
    //         ':name' => $name,
    //         ':email' => $email,
    //         ':phone' => $phone,
    //         ':address' => $address,
    //     ]);
    // }


}
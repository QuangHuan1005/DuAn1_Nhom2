<?php
class User
{
    public static function findByUsername($username)
    {
        $conn = connectDB();
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch() ?: false;
    }

    public static function register($data)
    {
        $conn = connectDB();

        $sql = "INSERT INTO users (username, email, fullname, phone, address, avatar, password, role, created_at)
                VALUES (:username, :email, :fullname, :phone, :address, :avatar, :password, 'client', NOW())";

        $stmt = $conn->prepare($sql);

        return $stmt->execute([
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':fullname' => $data['fullname'],
            ':phone' => $data['phone'],
            ':address' => $data['address'],
            ':avatar' => $data['avatar'],
           ':password' => $data['password']
        ]);
         //  return $stmt->execute($params);
    }

}

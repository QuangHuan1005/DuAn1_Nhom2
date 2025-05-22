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

}
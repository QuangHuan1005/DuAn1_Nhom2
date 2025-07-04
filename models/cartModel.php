<?php
class CartModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getCartIdByUserId($user_id)
    {
        $sql = "SELECT id FROM carts WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        $cart = $stmt->fetch(PDO::FETCH_ASSOC);

        return $cart ? $cart['id'] : $this->createCartForUser($user_id);
    }

    public function createCartForUser($user_id)
    {
        $sql = "INSERT INTO carts (user_id, created_at, updated_at) VALUES (?, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $this->conn->lastInsertId();
    }

    public function getCartItems($user_id)
    {
        $cart_id = $this->getCartIdByUserId($user_id);
        $sql = "SELECT ci.id, ci.product_id, ci.quantity, p.name, 
                   IFNULL(p.discount_price, p.price) AS price,
                   p.image_url
            FROM cart_items ci
            JOIN products p ON ci.product_id = p.id
            WHERE ci.cart_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$cart_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getCartItem($cart_id, $product_id)
    {
        $sql = "SELECT * FROM cart_items WHERE cart_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$cart_id, $product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addToCart($user_id, $product_id, $quantity)
    {
        $quantity = max(1, $quantity);
        $cart_id = $this->getCartIdByUserId($user_id);
        $item = $this->getCartItem($cart_id, $product_id);

        if ($item) {
            $newQuantity = $item['quantity'] + $quantity;
            $sql = "UPDATE cart_items SET quantity = ? WHERE cart_id = ? AND product_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$newQuantity, $cart_id, $product_id]);
        } else {
            $sql = "INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$cart_id, $product_id, $quantity]);
        }
    }

    public function updateQuantity($user_id, $item_id, $quantity)
    {
        if ($quantity < 1)
            return false;

        $cart_id = $this->getCartIdByUserId($user_id);
        $sql = "UPDATE cart_items SET quantity = ? WHERE id = ? AND cart_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$quantity, $item_id, $cart_id]);
    }

    public function removeFromCart($user_id, $cart_item_id)
    {
        $cart_id = $this->getCartIdByUserId($user_id);
        $sql = "DELETE FROM cart_items WHERE id = ? AND cart_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$cart_item_id, $cart_id]);
    }

    public function clearCart($user_id)
    {
        $cart_id = $this->getCartIdByUserId($user_id);
        $sql = "DELETE FROM cart_items WHERE cart_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$cart_id]);
    }

    public function getTotalQuantity($user_id)
    {
        $cart_id = $this->getCartIdByUserId($user_id);
        $sql = "SELECT SUM(quantity) as total FROM cart_items WHERE cart_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$cart_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? intval($row['total']) : 0;
    }

    public function getItemCount($user_id)
    {
        $cart_id = $this->getCartIdByUserId($user_id);
        $sql = "SELECT COUNT(*) as count FROM cart_items WHERE cart_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$cart_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? intval($row['count']) : 0;
    }

    public function getCartItemCount($user_id)
    {
        return $this->getItemCount($user_id);
    }
}

<?php
class CartController {
    private $cartModel;

    public function __construct() {
        $this->cartModel = new CartModel();
    }

    public function index() {
        if (!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $items = $this->cartModel->getCartItems($user_id);
        $this->updateCartTotal($user_id);

        include './views/cart.php';
    }

    public function addToCart() {
        if (!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $product_id = $_POST['product_id'] ?? null;
        $quantity = isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0 
                    ? (int)$_POST['quantity'] 
                    : 1;

        if ($product_id) {
            $cart_id = $this->cartModel->getCartIdByUserId($user_id);
            $existingItem = $this->cartModel->getCartItem($cart_id, $product_id);

            if ($existingItem) {
                $newQty = $existingItem['quantity'] + $quantity;
                $this->cartModel->updateQuantity($user_id, $existingItem['id'], $newQty); // Gọi đúng method updateQuantity
            } else {
                $this->cartModel->addToCart($user_id, $product_id, $quantity);
            }

            $this->updateCartTotal($user_id);
        }

        header("Location: ./?act=cart");
        exit;
    }

    public function updateCart() {
        if (!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
            foreach ($_POST['quantities'] as $item_id => $quantity) {
                $item_id = intval($item_id);
                $quantity = intval($quantity);
                if ($item_id > 0 && $quantity >= 1) {
                    $this->cartModel->updateQuantity($user_id, $item_id, $quantity);
                }
            }
        }

        $this->updateCartTotal($user_id);
        header("Location: ./?act=cart");
        exit;
    }

    public function removeFromCart() {
        if (!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $product_id = $_GET['id'] ?? null;

        if ($product_id) {
            $this->cartModel->removeFromCart($user_id, $product_id);
            $this->updateCartTotal($user_id);
        }

        header("Location: ./?act=cart");
        exit;
    }

    public function clearCart() {
        if (!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $this->cartModel->clearCart($user_id);
        $this->updateCartTotal($user_id);

        header("Location: ./?act=cart");
        exit;
    }

    public function payment() {
        if (!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $items = $this->cartModel->getCartItems($user_id);
        $this->updateCartTotal($user_id);

        include './views/payment.php';
    }

    private function updateCartTotal($user_id) {
        $total = $this->cartModel->getTotalQuantity($user_id);
        $_SESSION['cart_total'] = $total;
    }
}

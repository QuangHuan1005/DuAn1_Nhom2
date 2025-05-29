<?php
class CartController {
    private $cartModel;

    public function __construct() {
        global $conn;
        $this->cartModel = new CartModel($conn);
    }

    public function index() {
        if (!isset($_SESSION['user']) || !isset($_SESSION['cart_id'])) {
            header("Location: ./?act=login");
            exit;
        }
        $cart_id = $_SESSION['cart_id'];
        $items = $this->cartModel->getCartItems($cart_id);
        $this->updateCartTotal($cart_id);
        include './views/cart.php';
    }

    public function addToCart() {
        if (!isset($_SESSION['user']) || !isset($_SESSION['cart_id'])) {
            header("Location: ./?act=login");
            exit;
        }

        $cart_id = $_SESSION['cart_id'];
        $product_id = $_POST['product_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;

        if ($product_id) {
            $this->cartModel->addToCart($cart_id, $product_id, $quantity);
            $this->updateCartTotal($cart_id);
        }

        header("Location: ./?act=cart");
        exit;
    }

    public function updateCart() {
        if (!isset($_SESSION['user']) || !isset($_SESSION['cart_id'])) {
            header("Location: ./?act=login");
            exit;
        }

        if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
            $cart_id = $_SESSION['cart_id'];

            foreach ($_POST['quantities'] as $item_id => $quantity) {
                $item_id = intval($item_id);
                $quantity = intval($quantity);

                if ($item_id > 0 && $quantity >= 1) {
                    $this->cartModel->updateQuantity($cart_id, $item_id, $quantity);
                }
            }

            $this->updateCartTotal($cart_id);
        }

        header("Location: ./?act=cart");
        exit;
    }

    public function removeFromCart() {
        if (!isset($_SESSION['user']) || !isset($_SESSION['cart_id'])) {
            header("Location: ./?act=login");
            exit;
        }

        $cart_id = $_SESSION['cart_id'];
        $product_id = $_GET['id'] ?? null;

        if ($product_id) {
            $this->cartModel->removeFromCart($cart_id, $product_id);
            $this->updateCartTotal($cart_id);
        }

        header("Location: ./?act=cart");
        exit;
    }

    public function clearCart() {
        if (!isset($_SESSION['user']) || !isset($_SESSION['cart_id'])) {
            header("Location: ./?act=login");
            exit;
        }

        $cart_id = $_SESSION['cart_id'];
        $this->cartModel->clearCart($cart_id);
        $this->updateCartTotal($cart_id);

        header("Location: ./?act=cart");
        exit;
    }

    public function payment() {
        if (!isset($_SESSION['user']) || !isset($_SESSION['cart_id'])) {
            header("Location: ./?act=login");
            exit;
        }

        $cart_id = $_SESSION['cart_id'];
        $items = $this->cartModel->getCartItems($cart_id);
        $this->updateCartTotal($cart_id);

        include './views/payment.php';
    }

    private function updateCartTotal($cart_id) {
        $total = $this->cartModel->getTotalQuantity($cart_id);
        $_SESSION['cart_total'] = $total;
    }
}

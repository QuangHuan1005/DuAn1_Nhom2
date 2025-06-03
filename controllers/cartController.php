<?php
class CartController {
    private $cartModel;
    private $orderModel;

    public function __construct() {
        $this->cartModel = new CartModel();
        $this->orderModel = new OrderModel();
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
        $quantity = (isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0)
                    ? (int)$_POST['quantity'] : 1;

        if ($product_id) {
            $cart_id = $this->cartModel->getCartIdByUserId($user_id);
            $existingItem = $this->cartModel->getCartItem($cart_id, $product_id);

            if ($existingItem) {
                $newQty = $existingItem['quantity'] + $quantity;
                $this->cartModel->updateQuantity($user_id, $existingItem['id'], $newQty);
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
            foreach ($_POST['quantities'] as $cart_item_id => $quantity) {
                $cart_item_id = intval($cart_item_id);
                $quantity = intval($quantity);
                if ($cart_item_id > 0 && $quantity >= 1) {
                    $this->cartModel->updateQuantity($user_id, $cart_item_id, $quantity);
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
        $cart_item_id = $_GET['id'] ?? null;

        if ($cart_item_id) {
            $this->cartModel->removeFromCart($user_id, $cart_item_id);
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
        if(session_status() == PHP_SESSION_NONE) session_start();

        if(!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user = $_SESSION['user'];
        $user_id = $user['id'];

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            $items = $this->cartModel->getCartItems($user_id);
            $total = 0;
            foreach($items as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order_id = $this->orderModel->createOrder($user_id, $fullname, $phone, $email, $total);

            foreach($items as $item) {
                $this->orderModel->addOrderDetail($order_id, $item['product_id'], $item['quantity'], $item['price']);
            }

            $this->cartModel->clearCart($user_id);
            $this->updateCartTotal($user_id);

            header("Location: ./?act=order_success");
            exit;
        }

        $oldInput = [
            'fullname' => $user['fullname'] ?? '',
            'phone' => $user['phone'] ?? '',
            'email' => $user['email'] ?? '',
        ];
        $items = $this->cartModel->getCartItems($user_id);
        include './views/payment.php';
    }

    private function updateCartTotal($user_id) {
        $total = $this->cartModel->getTotalQuantity($user_id);
        $_SESSION['cart_total'] = $total;
    }
}

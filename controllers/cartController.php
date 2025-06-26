<?php
class CartController
{
    private $cartModel;
    private $orderModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $items = $this->cartModel->getCartItems($user_id);
        $this->updateCartTotal($user_id);
        $this->updateCartItemCount($user_id);

        include './views/cart.php';
    }

    public function addToCart()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $product_id = $_POST['product_id'] ?? null;
        $quantity = (isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0)
            ? (int) $_POST['quantity'] : 1;

        if ($product_id) {
            require_once "models/ProductModel.php";
            $productModel = new ProductModel();
            $product = $productModel->getProductDetail($product_id);

            if (!$product) {
                $_SESSION['cart_error'] = "Sản phẩm không tồn tại.";
                header("Location: ./?act=product-detail&id=" . $product_id);
                exit;
            }

            $stock = (int) $product['stock_quantity'];
            $cart_id = $this->cartModel->getCartIdByUserId($user_id);
            $existingItem = $this->cartModel->getCartItem($cart_id, $product_id);
            $currentQty = $existingItem ? (int) $existingItem['quantity'] : 0;
            $newQty = $currentQty + $quantity;

            if ($newQty > $stock) {
                $_SESSION['cart_error'] = "Số lượng đặt vượt quá tồn kho. Tồn kho hiện có: $stock sản phẩm.";
                header("Location: ./?act=product-detail&id=" . $product_id);
                exit;
            }

            if ($existingItem) {
                $this->cartModel->updateQuantity($user_id, $existingItem['id'], $newQty);
            } else {
                $this->cartModel->addToCart($user_id, $product_id, $quantity);
            }

            $this->updateCartTotal($user_id);
            $this->updateCartItemCount($user_id);
        }

        header("Location: ./?act=cart");
        exit;
    }

    public function updateCart()
    {
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
        $this->updateCartItemCount($user_id);
        header("Location: ./?act=cart");
        exit;
    }

    public function removeFromCart()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $cart_item_id = $_GET['id'] ?? null;

        if ($cart_item_id) {
            $this->cartModel->removeFromCart($user_id, $cart_item_id);
            $this->updateCartTotal($user_id);
            $this->updateCartItemCount($user_id);
        }

        header("Location: ./?act=cart");
        exit;
    }

    public function clearCart()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $this->cartModel->clearCart($user_id);
        $this->updateCartTotal($user_id);
        $this->updateCartItemCount($user_id);

        header("Location: ./?act=cart");
        exit;
    }

    public function payment()
    {
        if (session_status() == PHP_SESSION_NONE)
            session_start();

        if (!isset($_SESSION['user'])) {
            header("Location: ./?act=login");
            exit;
        }

        $user = $_SESSION['user'];
        $user_id = $user['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $receiver_name = $_POST['fullname'];
            $receiver_phone = $_POST['phone'];
            $receiver_email = $_POST['email'];
            $shipping_address = $_POST['address'] ?? 'Chưa cung cấp';

            $items = $this->cartModel->getCartItems($user_id);
            $total = 0;
            foreach ($items as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order_id = $this->orderModel->createOrder(
                $user_id,
                $receiver_name,
                $receiver_phone,
                $receiver_email,
                $total,
                $shipping_address
            );

            foreach ($items as $item) {
                $this->orderModel->addOrderItem(
                    $order_id,
                    $item['product_id'],
                    $item['quantity'],
                    $item['price']
                );

                $this->orderModel->decreaseStockQuantity($item['product_id'], $item['quantity']);
            }

            $this->cartModel->clearCart($user_id);
            $this->updateCartTotal($user_id);
            $this->updateCartItemCount($user_id);

            header('Location: index.php?act=order-success');
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

    private function updateCartTotal($user_id)
    {
        $total = $this->cartModel->getTotalQuantity($user_id);
        $_SESSION['cart_total'] = $total;
    }

    private function updateCartItemCount($user_id)
    {
        $count = $this->cartModel->getCartItemCount($user_id);
        $_SESSION['cart_item_count'] = $count;
    }
}

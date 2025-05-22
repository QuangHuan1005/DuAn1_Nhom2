-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2025 at 11:59 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csdl_duan1`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(2, 2, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(3, 3, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(4, 4, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(5, 5, '2025-05-17 11:34:35', '2025-05-17 11:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(2, 2, 1, 1, '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(3, 3, 5, 2, '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(4, 4, 3, 1, '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(5, 5, 4, 1, '2025-05-17 11:35:56', '2025-05-17 11:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại di động', 'Các loại điện thoại di động từ các thương hiệu nổi tiếng', '2025-05-17 11:29:14', '2025-05-17 11:29:14'),
(2, 'Laptop', 'Máy tính xách tay cho công việc và giải trí', '2025-05-17 11:29:14', '2025-05-17 11:29:14'),
(3, 'Âm thanh', 'Loa, tai nghe và thiết bị âm thanh', '2025-05-17 11:29:14', '2025-05-17 11:29:14'),
(4, 'Đồng hồ thông minh', 'Đồng hồ thông minh và vòng đeo tay', '2025-05-17 11:29:14', '2025-05-17 11:29:14'),
(5, 'Phụ kiện', 'Chuột, bàn phím, cáp và phụ kiện máy tính khác', '2025-05-17 11:29:14', '2025-05-17 11:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `content` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `status_id` int NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `receiver_name` varchar(100) NOT NULL,
  `receiver_phone` varchar(20) NOT NULL,
  `receiver_email` varchar(100) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status_id`, `total_amount`, `shipping_address`, `created_at`, `updated_at`, `receiver_name`, `receiver_phone`, `receiver_email`, `payment_method`, `payment_status`) VALUES
(1, 2, 1, '65800000.00', '456 Đường Nguyễn Huệ, TP. Hồ Chí Minh', '2025-05-17 11:34:04', '2025-05-17 11:34:04', '', '', '', '', ''),
(2, 2, 2, '8000000.00', '456 Đường Nguyễn Huệ, TP. Hồ Chí Minh', '2025-05-17 11:34:04', '2025-05-17 11:34:04', '', '', '', '', ''),
(3, 3, 3, '30000000.00', '789 Đường Lê Lợi, Đà Nẵng', '2025-05-17 11:34:04', '2025-05-17 11:34:04', '', '', '', '', ''),
(4, 4, 4, '36000000.00', '321 Đường Trần Phú, Hải Phòng', '2025-05-17 11:34:04', '2025-05-17 11:34:04', '', '', '', '', ''),
(5, 5, 5, '5200000.00', '654 Đường Phạm Văn Đồng, Cần Thơ', '2025-05-17 11:34:04', '2025-05-17 11:34:04', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '32900000.00', '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(2, 2, 3, 1, '8000000.00', '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(3, 3, 2, 1, '15000000.00', '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(4, 4, 4, 3, '12000000.00', '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(5, 5, 5, 2, '2600000.00', '2025-05-17 11:34:35', '2025-05-17 11:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

CREATE TABLE `order_payments` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `payment_method_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL,
  `status` varchar(50) NOT NULL COMMENT 'Completed, Pending',
  `transaction_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_payments`
--

INSERT INTO `order_payments` (`id`, `order_id`, `payment_method_id`, `amount`, `payment_date`, `status`, `transaction_id`) VALUES
(1, 4, 3, '192992.00', '2025-05-17 11:43:39', 'aiuameoamaiwha', 'aiiddjdnands');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Đang xử lý', 'Đơn hàng đang được xử lý', '2025-05-17 11:32:01', '2025-05-17 11:32:01'),
(2, 'Đang giao hàng', 'Đơn hàng đang vận chuyển đến khách hàng', '2025-05-17 11:32:01', '2025-05-17 11:32:01'),
(3, 'Đã giao hàng', 'Đơn hàng đã được giao thành công', '2025-05-17 11:32:01', '2025-05-17 11:32:01'),
(4, 'Đã hủy', 'Đơn hàng đã bị hủy', '2025-05-17 11:32:01', '2025-05-17 11:32:01'),
(5, 'Hoàn tất', 'Đơn hàng đã hoàn tất', '2025-05-17 11:32:01', '2025-05-17 11:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'Credit Card, PayPal, COD'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`) VALUES
(1, 'Thanh toán khi nhận hàng (COD)'),
(2, 'Thẻ tín dụng/ghi nợ'),
(3, 'Chuyển khoản ngân hàng'),
(4, 'Ví điện tử MoMo'),
(5, 'Ví điện tử ZaloPay');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) NOT NULL,
  `stock_quantity` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `image_url`, `description`, `price`, `discount_price`, `stock_quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'iPhone 13 Pro Max 256GB', 'iphone13.jpg', 'Điện thoại iPhone 13 Pro Max, dung lượng 256GB, màu bạc', '32900000.00', '0.00', 15, 0, '2025-05-17 11:30:29', '2025-05-17 11:30:29'),
(2, 2, 'Laptop Asus Vivobook X415', 'asusx415.jpg', 'Laptop Asus Vivobook X415 với RAM 8GB, ổ SSD 512GB', '15000000.00', '0.00', 20, 0, '2025-05-17 11:30:29', '2025-05-17 11:30:29'),
(3, 3, 'Tai nghe Sony WH-1000XM4', 'sonyxm4.jpg', 'Tai nghe chống ồn chủ động với âm thanh sống động', '8000000.00', '0.00', 30, 0, '2025-05-17 11:30:29', '2025-05-17 11:30:29'),
(4, 4, 'Apple Watch Series 7 (45mm)', 'watch7.jpg', 'Đồng hồ thông minh Apple Watch Series 7 kích thước 45mm', '12000000.00', '0.00', 25, 0, '2025-05-17 11:30:29', '2025-05-17 11:30:29'),
(5, 5, 'Chuột Logitech MX Master 3', 'logitechmx3.jpg', 'Chuột không dây cao cấp Logitech MX Master 3', '2600000.00', '0.00', 40, 0, '2025-05-17 11:30:29', '2025-05-17 11:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `rating` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 5, 'Sản phẩm rất tốt!', '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(2, 3, 2, 4, 'Máy chạy ổn, pin trâu.', '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(3, 5, 1, 3, 'Hơi đắt nhưng đáng tiền.', '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(4, 4, 4, 4, 'Đồng hồ đẹp, dễ sử dụng.', '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(5, 2, 3, 5, 'Âm thanh rất hay, chống ồn tốt.', '2025-05-17 11:35:56', '2025-05-17 11:35:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'nguyenvana', 'nguyenvana@example.com', '0912345678', 'hash1', 1, '2025-05-17 11:29:06', '2025-05-17 11:29:06'),
(2, 'tranthib', 'tranthib@gmail.com', '0987654321', 'hash2', 0, '2025-05-17 11:29:06', '2025-05-17 11:29:06'),
(3, 'levanc', 'levanc@viettel.com.vn', '0376543210', 'hash3', 1, '2025-05-17 11:29:06', '2025-05-17 11:29:06'),
(4, 'phamthid', 'phamthid@yahoo.com', '0354321098', 'hash4', 1, '2025-05-17 11:29:06', '2025-05-17 11:29:06'),
(5, 'hoangvane', 'hoangvane@abc.vn', '0933333333', 'hash5', 0, '2025-05-17 11:29:06', '2025-05-17 11:29:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `payment_method_id` (`payment_method_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_payments`
--
ALTER TABLE `order_payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD CONSTRAINT `order_payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_payments_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

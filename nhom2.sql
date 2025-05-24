-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th5 22, 2025 lúc 12:55 PM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nhom2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(2, 2, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(3, 3, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(4, 4, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(5, 5, '2025-05-17 11:34:35', '2025-05-17 11:34:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(2, 2, 1, 1, '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(3, 3, 5, 2, '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(4, 4, 3, 1, '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(5, 5, 4, 1, '2025-05-17 11:35:56', '2025-05-17 11:35:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại di động', 'Các loại điện thoại di động từ các thương hiệu nổi tiếng', '2025-05-17 11:29:14', '2025-05-17 11:29:14'),
(2, 'Laptop', 'Máy tính xách tay cho công việc và giải trí', '2025-05-17 11:29:14', '2025-05-17 11:29:14'),
(3, 'Âm thanh', 'Loa, tai nghe và thiết bị âm thanh', '2025-05-17 11:29:14', '2025-05-17 11:29:14'),
(4, 'Đồng hồ thông minh', 'Đồng hồ thông minh và vòng đeo tay', '2025-05-17 11:29:14', '2025-05-17 11:29:14'),
(5, 'Phụ kiện', 'Chuột, bàn phím, cáp và phụ kiện máy tính khác', '2025-05-17 11:29:14', '2025-05-17 11:29:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `content` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `status_id` int NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `receiver_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status_id`, `total_amount`, `shipping_address`, `created_at`, `updated_at`, `receiver_name`, `receiver_phone`, `receiver_email`, `payment_method`, `payment_status`) VALUES
(1, 2, 1, 65800000.00, '456 Đường Nguyễn Huệ, TP. Hồ Chí Minh', '2025-05-17 11:34:04', '2025-05-17 11:34:04', '', '', '', '', ''),
(2, 2, 2, 8000000.00, '456 Đường Nguyễn Huệ, TP. Hồ Chí Minh', '2025-05-17 11:34:04', '2025-05-17 11:34:04', '', '', '', '', ''),
(3, 3, 3, 30000000.00, '789 Đường Lê Lợi, Đà Nẵng', '2025-05-17 11:34:04', '2025-05-17 11:34:04', '', '', '', '', ''),
(4, 4, 4, 36000000.00, '321 Đường Trần Phú, Hải Phòng', '2025-05-17 11:34:04', '2025-05-17 11:34:04', '', '', '', '', ''),
(5, 5, 5, 5200000.00, '654 Đường Phạm Văn Đồng, Cần Thơ', '2025-05-17 11:34:04', '2025-05-17 11:34:04', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 32900000.00, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(2, 2, 3, 1, 8000000.00, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(3, 3, 2, 1, 15000000.00, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(4, 4, 4, 3, 12000000.00, '2025-05-17 11:34:35', '2025-05-17 11:34:35'),
(5, 5, 5, 2, 2600000.00, '2025-05-17 11:34:35', '2025-05-17 11:34:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_payments`
--

CREATE TABLE `order_payments` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `payment_method_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Completed, Pending',
  `transaction_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_payments`
--

INSERT INTO `order_payments` (`id`, `order_id`, `payment_method_id`, `amount`, `payment_date`, `status`, `transaction_id`) VALUES
(1, 4, 3, 192992.00, '2025-05-17 11:43:39', 'aiuameoamaiwha', 'aiiddjdnands');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Đang xử lý', 'Đơn hàng đang được xử lý', '2025-05-17 11:32:01', '2025-05-17 11:32:01'),
(2, 'Đang giao hàng', 'Đơn hàng đang vận chuyển đến khách hàng', '2025-05-17 11:32:01', '2025-05-17 11:32:01'),
(3, 'Đã giao hàng', 'Đơn hàng đã được giao thành công', '2025-05-17 11:32:01', '2025-05-17 11:32:01'),
(4, 'Đã hủy', 'Đơn hàng đã bị hủy', '2025-05-17 11:32:01', '2025-05-17 11:32:01'),
(5, 'Hoàn tất', 'Đơn hàng đã hoàn tất', '2025-05-17 11:32:01', '2025-05-17 11:32:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Credit Card, PayPal, COD'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`) VALUES
(1, 'Thanh toán khi nhận hàng (COD)'),
(2, 'Thẻ tín dụng/ghi nợ'),
(3, 'Chuyển khoản ngân hàng'),
(4, 'Ví điện tử MoMo'),
(5, 'Ví điện tử ZaloPay');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) NOT NULL,
  `stock_quantity` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `image_url`, `description`, `price`, `discount_price`, `stock_quantity`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'iPhone 13 Pro Max 256GB', 'iphone13.jpg', 'Điện thoại iPhone 13 Pro Max, dung lượng 256GB, màu bạc', 32900000.00, 0.00, 15, 0, '2025-05-22 11:58:06', '2025-05-17 11:30:29', '2025-05-17 11:30:29'),
(2, 2, 'Laptop Asus Vivobook X415', 'asusx415.jpg', 'Laptop Asus Vivobook X415 với RAM 8GB, ổ SSD 512GB', 15000000.00, 0.00, 20, 0, '2025-05-22 12:09:13', '2025-05-17 11:30:29', '2025-05-17 11:30:29'),
(3, 3, 'Tai nghe Sony WH-1000XM4', 'sonyxm4.jpg', 'Tai nghe chống ồn chủ động với âm thanh sống động', 8000000.00, 0.00, 30, 0, '2025-05-22 12:10:26', '2025-05-17 11:30:29', '2025-05-17 11:30:29'),
(4, 4, 'Apple Watch Series 7 (45mm)', 'watch7.jpg', 'Đồng hồ thông minh Apple Watch Series 7 kích thước 45mm', 12000000.00, 0.00, 25, 0, '2025-05-22 12:10:42', '2025-05-17 11:30:29', '2025-05-17 11:30:29'),
(5, 5, 'Chuột Logitech MX Master 3', 'logitechmx3.jpg', 'Chuột không dây cao cấp Logitech MX Master 3', 2600000.00, 0.00, 40, 0, '2025-05-22 13:26:20', '2025-05-17 11:30:29', '2025-05-17 11:30:29'),
(6, 1, 'hghffw', 'uploads/products/1747894244_giay5.png', 'gfgdfdsa', 1230000.00, 0.00, 123, 1, '2025-05-22 13:26:25', '2025-05-22 06:10:44', '2025-05-22 06:10:44'),
(7, 1, 'hghffw', 'uploads/products/1747894244_giay5.png', 'gfgdfdsa', 1230000.00, 0.00, 123, 1, '2025-05-22 14:09:48', '2025-05-22 06:10:44', '2025-05-22 06:10:44'),
(8, 1, 'hghffw', 'uploads/products/1747894929_giay5.png', 'gfgdfdsa', 1230000.00, 0.00, 123, 1, '2025-05-22 14:09:51', '2025-05-22 06:22:09', '2025-05-22 06:22:09'),
(9, 1, 'hghffw', 'uploads/products/1747894929_giay5.png', 'gfgdfdsa', 1230000.00, 0.00, 123, 1, '2025-05-22 17:39:54', '2025-05-22 06:22:09', '2025-05-22 06:22:09'),
(10, 1, 'hghffw', 'uploads/products/1747894972_giay5.png', 'gfgdfdsa', 1230000.00, 0.00, 123, 1, NULL, '2025-05-22 06:22:52', '2025-05-22 06:22:52'),
(11, 1, 'hghffw', 'uploads/products/1747894972_giay5.png', 'gfgdfdsa', 1230000.00, 0.00, 123, 1, NULL, '2025-05-22 06:22:52', '2025-05-22 06:22:52'),
(12, 1, 'hghffw', 'uploads/products/1747895171_giay5.png', 'gfgdfdsa', 1230000.00, 0.00, 123, 1, NULL, '2025-05-22 06:26:11', '2025-05-22 06:26:11'),
(13, 1, 'ytr', 'uploads/products/1747898018_giay5.png', 'rtew', 12000.00, 0.00, 12, 1, NULL, '2025-05-22 07:13:38', '2025-05-22 07:13:38'),
(14, 1, 'hghffw', 'uploads/products/1747898281_giay2.png', 'trewer', 12000.00, 0.00, 123, 1, NULL, '2025-05-22 07:18:01', '2025-05-22 07:18:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 5, 'Sản phẩm rất tốt!', '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(2, 3, 2, 4, 'Máy chạy ổn, pin trâu.', '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(3, 5, 1, 3, 'Hơi đắt nhưng đáng tiền.', '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(4, 4, 4, 4, 'Đồng hồ đẹp, dễ sử dụng.', '2025-05-17 11:35:56', '2025-05-17 11:35:56'),
(5, 2, 3, 5, 'Âm thanh rất hay, chống ồn tốt.', '2025-05-17 11:35:56', '2025-05-17 11:35:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','client') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `fullname`, `phone`, `address`, `avatar`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'nguyenvana', 'nguyenvana@example.com', '', '0912345678', NULL, NULL, 'hash1', 'admin', '2025-05-17 11:29:06', '2025-05-17 11:29:06'),
(2, 'tranthib', 'tranthib@gmail.com', '', '0987654321', NULL, 'Ảnh chụp màn hình (1).png', 'hash2', 'client', '2025-05-17 11:29:06', '2025-05-17 11:29:06'),
(3, 'levanc', 'levanc@viettel.com.vn', '', '0376543210', NULL, NULL, 'hash3', 'admin', '2025-05-17 11:29:06', '2025-05-17 11:29:06'),
(4, 'phamthid', 'phamthid@yahoo.com', '', '0354321098', NULL, NULL, 'hash4', 'admin', '2025-05-17 11:29:06', '2025-05-17 11:29:06'),
(5, 'hoangvane', 'hoangvane@abc.vn', '', '0933333333', NULL, '', 'hash5', 'client', '2025-05-17 11:29:06', '2025-05-17 11:29:06'),
(6, 'aaaaaaaaaaaaaa', 'admin@example.com', NULL, '03456789', NULL, 'Ảnh chụp màn hình (10).png', '$2y$10$VtZ1dc7Iv5lN.yX/aINDNe2lTlc/.VXQpsaWxkPAGwOYDAzg43RFu', 'admin', '2025-05-22 10:54:50', '2025-05-22 10:54:50'),
(9, 'aaaaaaaaaa', 'user@example.com', NULL, '03456789', NULL, 'Ảnh chụp màn hình (4).png', '$2y$10$OC87IzNOne7JlDMlvTq2QO7XthWbE9VDv6uGY9rbetkcIf07FtilS', 'client', '2025-05-22 11:34:05', '2025-05-22 11:34:05');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `payment_method_id` (`payment_method_id`);

--
-- Chỉ mục cho bảng `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `order_payments`
--
ALTER TABLE `order_payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`);

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `order_payments`
--
ALTER TABLE `order_payments`
  ADD CONSTRAINT `order_payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_payments_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

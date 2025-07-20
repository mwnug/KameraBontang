CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `email` varchar(255) UNIQUE,
  `password` varchar(255),
  `role` enum,
  `created_at` timestamp
);

CREATE TABLE `categories` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `category_name` varchar(255)
);

CREATE TABLE `products` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `category_id` int,
  `product_name` varchar(255),
  `price_per_day` decimal,
  `stock` int,
  `description` text,
  `image` varchar(255)
);

CREATE TABLE `customers` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `phone` varchar(255),
  `address` text
);

CREATE TABLE `transactions` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `customer_id` int,
  `total_price` decimal,
  `rental_start` date,
  `rental_end` date,
  `status` enum
);

CREATE TABLE `transaction_details` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `transaction_id` int,
  `product_id` int,
  `quantity` int,
  `price` decimal
);

CREATE TABLE `payments` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `transaction_id` int,
  `payment_date` date,
  `amount_paid` decimal,
  `payment_method` varchar(255)
);

CREATE TABLE `reports` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `report_type` varchar(255),
  `description` text,
  `created_at` timestamp
);

CREATE TABLE `settings` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `setting_key` varchar(255),
  `setting_value` varchar(255)
);

CREATE TABLE `logs` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `action` varchar(255),
  `description` text,
  `created_at` timestamp
);

ALTER TABLE `products` ADD FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

ALTER TABLE `transactions` ADD FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

ALTER TABLE `transaction_details` ADD FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

ALTER TABLE `transaction_details` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

ALTER TABLE `payments` ADD FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

ALTER TABLE `logs` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

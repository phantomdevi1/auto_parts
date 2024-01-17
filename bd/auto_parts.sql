-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Янв 17 2024 г., 17:24
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `auto_parts`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `ID` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `image_back` varchar(255) DEFAULT NULL,
  `image_icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`ID`, `category_name`, `image_back`, `image_icon`) VALUES
(1, 'Шины', 'img/back_category/tires_cart_back.svg', 'img/icon_category/tires_icon.svg'),
(2, 'Диски', 'img/back_category/disk_cart_back.svg', 'img/icon_category/disk_icon.svg'),
(3, 'Масла и фильтры', 'img/back_category/oil_cart_back.svg', 'img/icon_category/oil_icon.svg'),
(4, 'Тормозная система', 'img/back_category/brake_back.svg', 'img/icon_category/brake_icon.svg'),
(5, 'Аккумуляторы', 'img/back_category/battery_back.svg', 'img/icon_category/battery_icon.svg'),
(6, 'Воздушные фильтры', 'img/back_category/filter_back.svg', 'img/icon_category/filter_icon.svg');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) DEFAULT NULL,
  `full_price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `status`, `full_price`) VALUES
(33, 1, '2023-12-12 20:31:52', 'В сборке', 1242),
(34, 1, '2024-01-12 10:41:44', 'В обработке', 51167),
(36, 1, '2024-01-12 13:54:06', 'Готов к выдаче', 79045),
(38, 7, '2024-01-15 13:27:22', 'Выдан', 8500);

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `quantity`) VALUES
(38, 33, 41, 1),
(39, 33, 9, 1),
(40, 34, 44, 4),
(43, 36, 2, 1),
(44, 36, 1, 1),
(45, 36, 3, 1),
(46, 36, 4, 1),
(47, 36, 5, 1),
(48, 36, 44, 1),
(49, 36, 5, 1),
(50, 36, 29, 1),
(51, 36, 28, 1),
(53, 38, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `ID` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`ID`, `name`, `description`, `price`, `image`, `category`) VALUES
(1, 'FR Replica FR 630', 'Диски Replica FR 630 R14x5.5 5x105 ET39 изготовлены из алюминия, имеют черный матовый цвет. Размеры: R14x5.5, разболтовка 5x105, вылет ET39.', '7990.00', 'img/product/disk_FR_630.jpg', 2),
(2, 'Another Disk Model', 'Дополнительное описание другой модели дисков: материал, размеры, стиль и т.д.', '8500.00', 'img/product/another_disk_model.jpg', 2),
(3, 'Third Disk Model', 'Описание третьей модели дисков: материал, размеры, стиль и т.д.', '7500.00', 'img/product/third_disk_model.jpg', 2),
(4, 'Superior Wheels', 'Диски Superior Wheels с уникальным дизайном и высоким качеством изготовления.', '9200.00', 'img/product/superior_wheels.jpg', 2),
(5, 'Performance Rims', 'Производительные диски Performance Rims для повышения эстетики и характеристик вашего автомобиля.', '8800.00', 'img/product/performance_rims.jpg', 2),
(6, 'Castrol EDGE 5W-30', 'Синтетическое моторное масло Castrol EDGE 5W-30 обеспечивает надежную защиту двигателя и повышенную производительность.', '990.00', 'img/product/castrol_edge_5w30.jpg', 3),
(8, 'Shell Helix Ultra 5W-40', 'Синтетическое моторное масло Shell Helix Ultra 5W-40 обеспечивает отличную защиту и чистоту двигателя.', '750.00', 'img/product/shell_helix_5w40.jpg', 3),
(9, 'Bosch Oil Filter P 9251', 'Масляный фильтр Bosch P 9251 обеспечивает надежную фильтрацию масла и защиту двигателя от загрязнений.', '280.00', 'img/product/bosch_p9251.jpg', 3),
(10, 'MANN-FILTER WK 820/2', 'Топливный фильтр MANN-FILTER WK 820/2 обеспечивает чистоту топлива, защищает инжектор и систему питания.', '180.00', 'img/product/mann_filter_wk8202.jpg', 3),
(11, 'Michelin Pilot Sport 4', 'Высокопроизводительные шины Michelin Pilot Sport 4 с отличным сцеплением на сухих и мокрых дорогах.', '10990.00', 'img/product/michelin_pilot_sport4.jpg', 1),
(12, 'Continental ContiPremiumContact 5', 'Летние шины Continental ContiPremiumContact 5 обеспечивают комфортную и безопасную езду.', '8800.00', 'img/product/continental_contipremiumcontact5.jpg', 1),
(13, 'Nokian Hakkapeliitta 10', 'Зимние шины Nokian Hakkapeliitta 10 обеспечивают отличное сцепление на скользких дорогах.', '9800.00', 'img/product/nokian_hakkapeliitta10.jpg', 1),
(14, 'Pirelli P Zero', 'Шины Pirelli P Zero предназначены для высоких скоростей и улучшенного сцепления.', '8500.00', 'img/product/pirelli_pzero.jpg', 1),
(15, 'Bridgestone Turanza T005', 'Летние шины Bridgestone Turanza T005 обеспечивают хорошую управляемость и сцепление.', '9200.00', 'img/product/bridgestone_turanza_t005.jpg', 1),
(22, 'Brembo Тормозные колодки', 'Высококачественные тормозные колодки от Brembo для надежного и эффективного торможения.', '5999.99', 'img/product/brembo_brake_pads.jpg', 4),
(23, 'TRW Тормозные диски', 'Прочные тормозные диски от TRW, обеспечивающие стабильную тормозную эффективность.', '8999.99', 'img/product/trw_brake_discs.jpg', 4),
(24, 'ATE Тормозной масляный бак', 'Оригинальный тормозной масляный бак от ATE для надежной работы тормозной системы.', '2499.99', 'img/product/ate_brake_reservoir.jpg', 4),
(25, 'Ferodo Тормозные колодки', 'Продвинутые тормозные колодки Ferodo обеспечивают отличную тормозную эффективность.', '4999.99', 'img/product/ferodo_brake_pads.jpg', 4),
(26, 'Bosch Тормозные диски', 'Тормозные диски от Bosch совмещают надежность и высокую степень тормозной эффективности.', '7999.99', 'img/product/bosch_brake_discs.jpg', 4),
(27, 'ATE Тормозные шланги', 'Гибкие и надежные тормозные шланги ATE для обеспечения безопасности в тормозной системе.', '2999.99', 'img/product/ate_brake_hoses.jpg', 4),
(28, 'Bosch Аккумулятор S4', 'Надежный аккумулятор от Bosch, серии S4, обеспечивает стабильный запуск двигателя.', '4999.99', 'img/product/bosch_battery_s4.jpg', 5),
(29, 'Varta Silver Dynamic Аккумулятор', 'Продвинутый аккумулятор Varta Silver Dynamic для автомобилей с высокими энергозатратами.', '6999.99', 'img/product/varta_battery_silver_dynamic.jpg', 5),
(30, 'Exide Premium Аккумулятор', 'Используйте Exide Premium для надежной работы электроники и старта двигателя.', '5699.99', 'img/product/exide_battery_premium.jpg', 5),
(31, 'Bosch Аккумулятор S5', 'Профессиональный аккумулятор Bosch S5 с высокой емкостью для большого запаса энергии.', '7999.99', 'img/product/bosch_battery_s5.jpg', 5),
(32, 'Varta Blue Dynamic Аккумулятор', 'Экономичный и надежный аккумулятор Varta Blue Dynamic для разнообразных автомобилей.', '4499.99', 'img/product/varta_battery_blue_dynamic.jpg', 5),
(33, 'Exide Excell Аккумулятор', 'Универсальный аккумулятор Exide Excell для надежного и долговечного использования.', '5199.99', 'img/product/exide_battery_excell.jpg', 5),
(34, 'Mann-Filter Воздушный фильтр', 'Оригинальный воздушный фильтр Mann-Filter для эффективной фильтрации воздуха.', '799.99', 'img/product/mann_filter_air_filter.jpg', 6),
(35, 'Bosch Воздушный фильтр', 'Bosch представляет высококачественный воздушный фильтр для оптимальной чистоты воздуха.', '899.99', 'img/product/bosch_air_filter.jpg', 6),
(36, 'K&N Повторно используемый воздушный фильтр', 'K&N предлагает повторно используемый воздушный фильтр для улучшенной производительности.', '1299.99', 'img/product/kn_reusable_air_filter.jpg', 6),
(37, 'Mahle Воздушный фильтр', 'Mahle предоставляет воздушный фильтр высокого качества для эффективной фильтрации воздуха.', '749.99', 'img/product/mahle_air_filter.jpg', 6),
(38, 'Fram Экстра Гвард Воздушный фильтр', 'Fram предлагает воздушный фильтр Extra Guard для защиты двигателя от загрязнений.', '599.99', 'img/product/fram_extra_guard_air_filter.jpg', 6),
(39, 'Hengst Воздушный фильтр', 'Hengst представляет надежный воздушный фильтр для обеспечения чистого воздуха в двигателе.', '679.99', 'img/product/hengst_air_filter.jpg', 6),
(41, 'Valvoline Моторное масло', 'Valvoline - высококачественное моторное масло для долговечной работы двигателя.', '999.99', 'img/product/valvoline_motor_oil.jpg', 3),
(42, 'WIX Масляный фильтр', 'WIX предлагает прочный масляный фильтр для оптимальной защиты двигателя.', '299.99', 'img/product/wix_oil_filter.jpg', 3),
(43, 'Continental ContiPremiumContact 6', 'Continental ContiPremiumContact 6 - летние шины с отличным сцеплением и комфортной ездой.', '10000.99', 'img/product/continental_contipremiumcontact_6.jpg', 1),
(44, 'Enkei Raijin', 'Enkei Raijin - стильные и легкие автомобильные диски с уникальным дизайном.', '12999.99', 'img/product/enkei_raijin_wheel.jpg', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `review_text` text,
  `submission_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`review_id`, `username`, `rating`, `review_text`, `submission_date`) VALUES
(1, 'admin', 5, 'Отличный магазин!', '2023-11-12 16:56:31'),
(4, 'Илья', 5, 'потрясающий магазин, заказываю запчасти только тут!', '2023-11-12 17:05:50');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `access_status` int NOT NULL,
  `discount_card` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `user_email`, `user_phone`, `user_name`, `user_password`, `access_status`, `discount_card`) VALUES
(1, 'admin@mail.ru', '88888888888', 'admin', 'admin', 1, 1),
(7, 'qwerty@mail.ru', '89963214528', 'qwerty@mail.ru', '1234', 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `category` (`category`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`ID`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`ID`);

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

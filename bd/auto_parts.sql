-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 12 2023 г., 20:08
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

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
  `quantity` int DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `ID` int NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`ID`, `category_name`) VALUES
(1, 'Шины'),
(2, 'Диски'),
(3, 'Масла и фильтры'),
(4, 'Тормозная система'),
(5, 'Аккумуляторы'),
(6, 'Воздушные фильтры');

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
(7, 'MANN-FILTER C 25 114/1', 'Фильтр MANN-FILTER C 25 114/1 обеспечивает качественную фильтрацию воздуха, защищает двигатель от загрязнений.', '350.00', 'img/product/mann_filter_c25114.jpg', 3),
(8, 'Shell Helix Ultra 5W-40', 'Синтетическое моторное масло Shell Helix Ultra 5W-40 обеспечивает отличную защиту и чистоту двигателя.', '750.00', 'img/product/shell_helix_5w40.jpg', 3),
(9, 'Bosch Oil Filter P 9251', 'Масляный фильтр Bosch P 9251 обеспечивает надежную фильтрацию масла и защиту двигателя от загрязнений.', '280.00', 'img/product/bosch_p9251.jpg', 3),
(10, 'MANN-FILTER WK 820/2', 'Топливный фильтр MANN-FILTER WK 820/2 обеспечивает чистоту топлива, защищает инжектор и систему питания.', '180.00', 'img/product/mann_filter_wk8202.jpg', 3),
(11, 'Michelin Pilot Sport 4', 'Высокопроизводительные шины Michelin Pilot Sport 4 с отличным сцеплением на сухих и мокрых дорогах.', '10990.00', 'img/product/michelin_pilot_sport4.jpg', 1),
(12, 'Continental ContiPremiumContact 5', 'Летние шины Continental ContiPremiumContact 5 обеспечивают комфортную и безопасную езду.', '8800.00', 'img/product/continental_contipremiumcontact5.jpg', 1),
(13, 'Nokian Hakkapeliitta 10', 'Зимние шины Nokian Hakkapeliitta 10 обеспечивают отличное сцепление на скользких дорогах.', '9800.00', 'img/product/nokian_hakkapeliitta10.jpg', 1),
(14, 'Pirelli P Zero', 'Шины Pirelli P Zero предназначены для высоких скоростей и улучшенного сцепления.', '8500.00', 'img/product/pirelli_pzero.jpg', 1),
(15, 'Bridgestone Turanza T005', 'Летние шины Bridgestone Turanza T005 обеспечивают хорошую управляемость и сцепление.', '9200.00', 'img/product/bridgestone_turanza_t005.jpg', 1);

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
(2, 'admin', 5, 'Отличный магазин!', '2023-11-12 16:57:06'),
(3, 'admin', 5, 'Отличн7ый магащзин', '2023-11-12 16:57:15'),
(4, 'Илья', 5, 'потрясающий магазин, заказываю запчасти только тут!', '2023-11-12 17:05:50'),
(5, 'Илья', 5, 'Потрясающий магазин, заказываю запчасти только здесь!', '2023-11-12 17:06:08'),
(6, 'Илья', 5, 'Потрясающий магазин, заказываю запчасти только здесь!', '2023-11-12 17:06:21');

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
  `access_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID`, `user_email`, `user_phone`, `user_name`, `user_password`, `access_status`) VALUES
(1, 'admin@mail.ru', '88888888888', 'admin', 'admin', 1),
(4, 'gruzdev_ilya16@mail.ru', '89607092738', 'Илья', '1234', 0),
(5, 'qwerty@mail.ru', '89053451234', 'qwerty', '1234', 0);

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
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

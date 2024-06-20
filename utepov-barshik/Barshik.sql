-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 20 2024 г., 15:33
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Barshik`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Basket`
--

CREATE TABLE `Basket` (
  `Id_basket` int NOT NULL,
  `User_id` int NOT NULL,
  `Content` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Category`
--

CREATE TABLE `Category` (
  `Category_id` int NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Category`
--

INSERT INTO `Category` (`Category_id`, `Name`) VALUES
(1, 'Соки'),
(2, 'Молочные продукты'),
(3, 'Холодные напитки');

-- --------------------------------------------------------

--
-- Структура таблицы `Orders`
--

CREATE TABLE `Orders` (
  `Id_order` int NOT NULL,
  `User_id` int NOT NULL,
  `Date_of_order` datetime NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Total_price` decimal(25,0) NOT NULL,
  `Used_bonuses` decimal(10,0) DEFAULT NULL,
  `Accrued_bonuses` decimal(10,0) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Orders`
--

INSERT INTO `Orders` (`Id_order`, `User_id`, `Date_of_order`, `Status`, `Total_price`, `Used_bonuses`, `Accrued_bonuses`, `comment`) VALUES
(4, 2, '2024-06-06 06:55:26', 'Доставка', '458', '45', '24', '');

-- --------------------------------------------------------

--
-- Структура таблицы `Order_Product`
--

CREATE TABLE `Order_Product` (
  `id` int NOT NULL,
  `Id_product` int NOT NULL,
  `Id_order` int NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Product`
--

CREATE TABLE `Product` (
  `Id_product` int NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Category_id` int NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Product`
--

INSERT INTO `Product` (`Id_product`, `Name`, `Description`, `Category_id`, `Price`, `Image`) VALUES
(1, 'Сок яблочный', 'Сок из натуральных яблок', 1, '120', 'https://clck.ru/3BPHAU'),
(2, 'CocaCola', 'CocaCola classic', 3, '70', 'https://clck.ru/3BPHGo'),
(3, 'Сырок', 'Сырок с вареной сгущенкой', 2, '30', 'https://clck.ru/3BPHJQ');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `User_id` int NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password_hash` varchar(50) NOT NULL,
  `Bonus_points` decimal(10,0) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`User_id`, `Email`, `Password_hash`, `Bonus_points`, `role`) VALUES
(1, 'admin@mail.ru', '123', '1', 'admin'),
(2, 'user@mail.ru', '123', '1', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Basket`
--
ALTER TABLE `Basket`
  ADD PRIMARY KEY (`Id_basket`),
  ADD KEY `User_id` (`User_id`);

--
-- Индексы таблицы `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`Category_id`);

--
-- Индексы таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`Id_order`),
  ADD KEY `User_id` (`User_id`);

--
-- Индексы таблицы `Order_Product`
--
ALTER TABLE `Order_Product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_order` (`Id_order`),
  ADD KEY `Id_product` (`Id_product`);

--
-- Индексы таблицы `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`Id_product`),
  ADD KEY `Price` (`Price`),
  ADD KEY `Category_id` (`Category_id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`User_id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Basket`
--
ALTER TABLE `Basket`
  MODIFY `Id_basket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `Category`
--
ALTER TABLE `Category`
  MODIFY `Category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `Orders`
--
ALTER TABLE `Orders`
  MODIFY `Id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `Order_Product`
--
ALTER TABLE `Order_Product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `Product`
--
ALTER TABLE `Product`
  MODIFY `Id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `User_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Basket`
--
ALTER TABLE `Basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `Users` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `Users` (`User_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Order_Product`
--
ALTER TABLE `Order_Product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`Id_order`) REFERENCES `Orders` (`Id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`Id_product`) REFERENCES `Product` (`Id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Category_id`) REFERENCES `Category` (`Category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

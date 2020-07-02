-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 08 2020 г., 09:11
-- Версия сервера: 5.7.25
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `qms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `patronymic` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`id`, `login`, `password`, `fname`, `surname`, `patronymic`) VALUES
(1, 'BekBruce', '$2y$10$BwnaY5sgc/7KESr3FDMcGu5VJLCljzZi/jQGWJKOT/.R4NapxjLx2', 'Брюс', 'Бэк', 'Тэерович'),
(2, 'Zhupeev', '$2y$10$.LBIygQ6Ezg76mdYII4AC.keVbJc7lPLikBxAmctKsivE9gcwjsN6', 'Дмитрий', 'Жупеев', 'Сергеевич');

-- --------------------------------------------------------

--
-- Структура таблицы `employeesandservices`
--

CREATE TABLE `employeesandservices` (
  `id` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employeesandservices`
--

INSERT INTO `employeesandservices` (`id`, `employee`, `service`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `letter` char(1) NOT NULL,
  `queue` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name`, `letter`, `queue`) VALUES
(1, 'Получение почты', 'А', 2),
(2, 'Отправка почты', 'А', 2),
(3, 'Банковские услуги', 'Б', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `window` int(11) DEFAULT NULL,
  `service` int(11) NOT NULL,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`id`, `name`, `time`, `window`, `service`, `start`, `end`) VALUES
(1, 'А001', '2019-06-24 06:14:06', 2, 1, '2019-06-24 06:15:32', '2019-06-24 06:15:34'),
(2, 'А002', '2019-06-24 06:14:10', 2, 2, '2019-06-24 06:15:40', '2019-06-24 06:15:40'),
(3, 'Б001', '2019-06-24 06:14:13', 3, 3, '2019-06-24 06:16:28', '2019-06-24 06:16:29'),
(4, 'Б002', '2019-06-24 06:14:17', NULL, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `windows`
--

CREATE TABLE `windows` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `employee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `windows`
--

INSERT INTO `windows` (`id`, `name`, `employee`) VALUES
(1, 'Окно 1', NULL),
(2, 'Окно 2', NULL),
(3, 'Окно 3', 2),
(4, 'Окно 4', NULL),
(5, 'Окно 5', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `employeesandservices`
--
ALTER TABLE `employeesandservices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employeesandservices_ibfk_1` (`employee`),
  ADD KEY `employeesandservices_ibfk_2` (`service`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_ibfk_1` (`window`),
  ADD KEY `ticket_ibfk_2` (`service`);

--
-- Индексы таблицы `windows`
--
ALTER TABLE `windows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `employee` (`employee`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `employeesandservices`
--
ALTER TABLE `employeesandservices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `windows`
--
ALTER TABLE `windows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `employeesandservices`
--
ALTER TABLE `employeesandservices`
  ADD CONSTRAINT `employeesandservices_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employeesandservices_ibfk_2` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`window`) REFERENCES `windows` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`service`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `windows`
--
ALTER TABLE `windows`
  ADD CONSTRAINT `windows_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

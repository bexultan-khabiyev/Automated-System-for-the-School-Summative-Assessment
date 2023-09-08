-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 25 2021 г., 19:39
-- Версия сервера: 10.4.18-MariaDB
-- Версия PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project`
--
CREATE DATABASE IF NOT EXISTS `project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project`;

-- --------------------------------------------------------

--
-- Структура таблицы `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE `results` (
  `resultsID` int(5) NOT NULL,
  `userID` int(5) NOT NULL,
  `workID` int(5) NOT NULL,
  `results_grade` int(3) NOT NULL,
  `results_maxgrade` int(3) NOT NULL,
  `results_comment` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `results`
--

INSERT INTO `results` (`resultsID`, `userID`, `workID`, `results_grade`, `results_maxgrade`, `results_comment`) VALUES
(1, 5, 6, 23, 24, 'Your essay about how each hemisphere of brain functions separately was quite curious. I find reading it immensely interesting. However, your handwriting is an absolute mess, I barely read all of your introduction.'),
(4, 6, 12, 8, 10, 'Overall, the research you have conducted on the reproduction of germs was excellent. However, you have neglected several significant details.');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userID` int(5) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_surname` varchar(30) NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `user_class` varchar(3) NOT NULL,
  `user_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`userID`, `user_name`, `user_surname`, `user_login`, `user_password`, `user_class`, `user_status`) VALUES
(1, 'Aidana', 'Khabiyeva', 'Aidana0705', 'Aidana0705', '', 'teacher'),
(2, 'Bexultan', 'Khabiyev', 'Bekakrut', 'Bekakrut', '12D', 'student'),
(3, 'Daniyal', 'Mambetov', 'Donymagrony', 'Donymagrony', '12D', 'student'),
(4, 'Azamat', 'Duisembayev', 'Azik1234', 'Azik1234', '12D', 'student'),
(5, 'Assanali', 'Uteuliyev', 'Asanrulit', 'Asanrulit', '12D', 'student'),
(6, 'Chuck', 'Shuldiner', 'ilovemetal123', 'ilovemetal', '12D', 'student'),
(7, 'Chuck', 'Shuldiner', 'aaaaaaaa', 'ilovemetal', '12D', 'student');

-- --------------------------------------------------------

--
-- Структура таблицы `work`
--

DROP TABLE IF EXISTS `work`;
CREATE TABLE `work` (
  `workID` int(5) NOT NULL,
  `userID` int(5) NOT NULL,
  `work_name` varchar(30) NOT NULL,
  `work_check` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `work`
--

INSERT INTO `work` (`workID`, `userID`, `work_name`, `work_check`) VALUES
(2, 1, 'Mobile.png', 0),
(3, 2, 'IELTS Writing Task 1.docx', 1),
(5, 4, 'IELTS Writing Task 2.docx', 0),
(6, 5, 'Rubbish 2.0.docx', 1),
(11, 2, 'Homework.docx', 1),
(12, 6, 'Chuck Shuldiner hometask.docx', 1),
(13, 2, 'IELTS Writing Task 2.docx', 0),
(14, 2, 'IELTS Writing Task 1.docx', 0),
(15, 2, '', 0),
(16, 2, 'Day 10 LISTENING.docx', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`resultsID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `workID` (`workID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Индексы таблицы `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`workID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `results`
--
ALTER TABLE `results`
  MODIFY `resultsID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `work`
--
ALTER TABLE `work`
  MODIFY `workID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`workID`) REFERENCES `work` (`workID`);

--
-- Ограничения внешнего ключа таблицы `work`
--
ALTER TABLE `work`
  ADD CONSTRAINT `work_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

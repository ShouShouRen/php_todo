-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2023 年 01 月 21 日 06:48
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `todo`
--

-- --------------------------------------------------------

--
-- 資料表結構 `status`
--

CREATE TABLE `status` (
  `code` int(1) NOT NULL,
  `code_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `status`
--

INSERT INTO `status` (`code`, `code_name`) VALUES
(0, '進行中'),
(1, '已完成'),
(2, '未完成');

-- --------------------------------------------------------

--
-- 資料表結構 `todo_list`
--

CREATE TABLE `todo_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `start` varchar(10) NOT NULL,
  `end` varchar(10) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int(50) NOT NULL,
  `usetodo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `todo_list`
--

INSERT INTO `todo_list` (`id`, `title`, `start`, `end`, `content`, `created_at`, `status`, `usetodo`) VALUES
(1, '工作一', '10', '12', '吃飯睡覺', '2023-01-12 19:50:23', 0, 0),
(2, '工作二', '02', '04', '睡覺', '2023-01-14 10:55:58', 1, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` varchar(100) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `pw` varchar(100) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `user`, `user_name`, `pw`, `role`) VALUES
(1, 'admin', '超級管理者', '1234', 0),
(2, 'todo', 'todo_user', '1234', 1),
(3, 'peter', '陳暐仁', '1022', 0),
(4, 'user01', 'user01', '1234', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `usetodo`
--

CREATE TABLE `usetodo` (
  `codes` int(5) NOT NULL,
  `codes_name` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `usetodo`
--

INSERT INTO `usetodo` (`codes`, `codes_name`) VALUES
(0, '普通件'),
(1, '速件'),
(2, '最速件');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `todo_list`
--
ALTER TABLE `todo_list`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `todo_list`
--
ALTER TABLE `todo_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

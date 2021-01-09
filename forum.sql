-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 09, 2021 lúc 07:05 AM
-- Phiên bản máy phục vụ: 10.1.40-MariaDB
-- Phiên bản PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `forum`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `body` text,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sub_cate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_publish` tinyint(4) NOT NULL DEFAULT '0',
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `view_count` int(11) NOT NULL DEFAULT '1',
  `id_duyet` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `articles`
--

INSERT INTO `articles` (`article_id`, `title`, `description`, `body`, `create_at`, `sub_cate_id`, `user_id`, `is_publish`, `publish_date`, `view_count`, `id_duyet`) VALUES
(28, 'How to creat instance in google cloud sql?', '', '', '2021-01-09 06:04:04', 11, 21, 0, '2021-01-09 06:04:04', 2, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categoris`
--

CREATE TABLE `categoris` (
  `cate_id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `categoris`
--

INSERT INTO `categoris` (`cate_id`, `title`) VALUES
(8, 'Cloud SDK'),
(11, 'Cloud SQL'),
(7, 'Cloud Storage'),
(4, 'Compute Engine');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `content` text,
  `detail` text,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`comment_id`, `content`, `detail`, `user_id`, `article_id`, `create_at`) VALUES
(14, 'just read google docs: https://cloud.google.com/sql/docs/mysql/create-instance', NULL, 21, 28, '2021-01-09 06:04:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `like_action`
--

CREATE TABLE `like_action` (
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `like_action`
--

INSERT INTO `like_action` (`user_id`, `article_id`) VALUES
(21, 28);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quick_quest`
--

CREATE TABLE `quick_quest` (
  `quick_quest_id` int(11) NOT NULL,
  `title` varchar(555) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `quick_quest`
--

INSERT INTO `quick_quest` (`quick_quest_id`, `title`, `create_at`) VALUES
(1, '1', '2020-10-01 15:53:53'),
(2, '12', '2020-10-01 15:54:34'),
(3, 'Tai sao nguoi cao tuoi bi cao', '2020-10-01 15:55:17'),
(4, 'Hello world', '2020-10-01 15:57:07'),
(5, 'tai sao cho lai can nguoi!', '2020-10-01 16:07:59'),
(6, '213', '2020-10-01 16:10:32'),
(7, 'Hello world', '2020-10-01 16:10:59'),
(8, '1', '2020-10-01 16:11:53'),
(9, 'Tai sao nguoi cao tuoi bi cao', '2020-10-01 16:12:22'),
(10, '1', '2020-10-01 16:13:04'),
(11, '12', '2020-10-01 16:14:27'),
(12, '12', '2020-10-01 16:15:56'),
(13, '1', '2020-10-01 16:16:11'),
(14, 'Hello world', '2020-10-01 16:17:15'),
(15, '2132', '2020-10-01 16:18:45'),
(16, 'Tai sao lai bi thuong ha', '2020-10-01 16:19:14'),
(17, 'tuyen sinh truc tuyen co dung k', '2020-10-01 16:19:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quick_reply`
--

CREATE TABLE `quick_reply` (
  `content` text NOT NULL,
  `quick_quest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sub_categoris`
--

CREATE TABLE `sub_categoris` (
  `sub_cate_id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `cate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sub_categoris`
--

INSERT INTO `sub_categoris` (`sub_cate_id`, `title`, `cate_id`) VALUES
(9, 'Guides', 4),
(10, 'Concepts', 4),
(11, 'Guides', 11),
(12, 'Concepts', 11),
(13, 'Tutorials', 11),
(14, 'Supports', 11),
(16, 'On tap chuan bi thi', 7),
(17, 'Lap trinh', 7),
(18, 'Kien thuc co so', 7),
(19, 'Tin hoc co ban', 7),
(23, 'Guides', 8),
(24, 'Concepts', 8),
(25, 'Tutorials', 8),
(27, 'Supports', 8),
(29, 'Tutorials', 4),
(30, 'Supports', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(55) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `role`, `create_at`) VALUES
(21, 'admin', '$2y$10$t7j3/bXCgMTJAiZCgdTok.QrU1vtocUq7azSwC8ua73asqtAfwTjC', 'admin@gmail.com', 1, '2020-10-06 10:36:25'),
(22, 'hoang', '$2y$10$1NCTGNvuvC9TNf8tVHYSpuIIEvCjcqZkaZRU9QM8XzqH8WEPva7ly', 'nhuhoang@gmail.com', 1, '2020-10-06 12:42:15'),
(23, 'dat', '$2y$10$bBXHbdZSxE9AxzgFVWi.we4M0JYsKv99bwNcK3bOqfhkD2D/YHcVe', 'dsadas@dsadas', 0, '2020-10-07 00:33:26'),
(24, 'Khai', '$2y$10$PMikbQ6Vf56Di6zDY9KtQO40Hg3zTz8iiF5yX/zqLy6lLcpFEx8sa', 'khai123@gmail', 0, '2020-10-07 02:07:48'),
(25, 'beo', '$2y$10$SofrbTmYwvmwVITpsUrPRObkdwfLQAvhGvgaII0HoFCHrVvjKobFa', '1@1', 0, '2020-10-07 07:11:20'),
(26, 'user', '$2y$10$UW4H3RjGgugnwZU2dpzryOE9W.artvFxlIFg9xwKSJFSbMSFEC8UK', '1@11', 0, '2020-10-07 07:13:12'),
(27, 'hung', '$2y$10$e.2w6VJoybA3oizMWbSRtumMs8/dUoC3KzZBYe92DoK9L6nBPAoIq', 'hung@gmail.com', 0, '2020-10-08 05:48:17'),
(28, 'hieu', '$2y$10$jyuzbIXNIZcddGzjMgauM.9Bgivqcp/wXCgYJw5cy4QSao1WYKYCW', 'hung@gmail.com1', 0, '2020-10-08 05:48:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) DEFAULT NULL,
  `real_name` varchar(55) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `last_online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `img` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user_info`
--

INSERT INTO `user_info` (`user_id`, `real_name`, `birth`, `gender`, `last_online`, `img`) VALUES
(21, 'nhu hoang', '2020-10-07', 1, '2021-01-09 06:05:02', './userImages/admin.jpg'),
(22, 'NhuHoang1', '2020-10-08', 1, '2020-11-13 16:30:09', './userImages/hoang.jpg'),
(23, NULL, NULL, NULL, '2020-10-11 00:54:14', './userImages/user-default-img.png'),
(24, 'Tran Nhu Khai', '1993-01-07', 1, '2020-11-12 02:12:29', './userImages/Khai.jpg'),
(25, 'nhu hoang', '2020-10-01', 1, '2020-11-12 02:23:27', './userImages/beo.jpg'),
(26, 'user name', '2010-05-11', 1, '2020-10-07 07:13:46', './userImages/user.jpg'),
(27, NULL, NULL, NULL, '2020-10-08 05:48:18', './userImages/user-default-img.png'),
(28, NULL, NULL, NULL, '2020-10-08 05:48:48', './userImages/user-default-img.png');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `FK_articles` (`sub_cate_id`),
  ADD KEY `FK_articles2` (`user_id`);

--
-- Chỉ mục cho bảng `categoris`
--
ALTER TABLE `categoris`
  ADD PRIMARY KEY (`cate_id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `FK_comment1` (`user_id`),
  ADD KEY `FK_comment2` (`article_id`);

--
-- Chỉ mục cho bảng `like_action`
--
ALTER TABLE `like_action`
  ADD PRIMARY KEY (`user_id`,`article_id`),
  ADD KEY `FK_like_action2` (`article_id`);

--
-- Chỉ mục cho bảng `quick_quest`
--
ALTER TABLE `quick_quest`
  ADD PRIMARY KEY (`quick_quest_id`);

--
-- Chỉ mục cho bảng `quick_reply`
--
ALTER TABLE `quick_reply`
  ADD KEY `FK_quick_reply` (`quick_quest_id`);

--
-- Chỉ mục cho bảng `sub_categoris`
--
ALTER TABLE `sub_categoris`
  ADD PRIMARY KEY (`sub_cate_id`),
  ADD KEY `FK_sub_categoris` (`cate_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `user_info`
--
ALTER TABLE `user_info`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `categoris`
--
ALTER TABLE `categoris`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `quick_quest`
--
ALTER TABLE `quick_quest`
  MODIFY `quick_quest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `sub_categoris`
--
ALTER TABLE `sub_categoris`
  MODIFY `sub_cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_articles` FOREIGN KEY (`sub_cate_id`) REFERENCES `sub_categoris` (`sub_cate_id`),
  ADD CONSTRAINT `FK_articles2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_comment1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK_comment2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`);

--
-- Các ràng buộc cho bảng `like_action`
--
ALTER TABLE `like_action`
  ADD CONSTRAINT `FK_like_action1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `FK_like_action2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`);

--
-- Các ràng buộc cho bảng `quick_reply`
--
ALTER TABLE `quick_reply`
  ADD CONSTRAINT `FK_quick_reply` FOREIGN KEY (`quick_quest_id`) REFERENCES `quick_quest` (`quick_quest_id`);

--
-- Các ràng buộc cho bảng `sub_categoris`
--
ALTER TABLE `sub_categoris`
  ADD CONSTRAINT `FK_sub_categoris` FOREIGN KEY (`cate_id`) REFERENCES `categoris` (`cate_id`);

--
-- Các ràng buộc cho bảng `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

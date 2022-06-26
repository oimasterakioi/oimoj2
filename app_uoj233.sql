-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-06-26 11:11:24
-- 服务器版本： 5.7.27-0ubuntu0.18.04.1
-- PHP 版本： 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `app_uoj233`
--

-- --------------------------------------------------------

--
-- 表的结构 `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_time` datetime NOT NULL,
  `poster` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_md` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `zan` int(11) NOT NULL,
  `is_hidden` tinyint(1) NOT NULL,
  `remote_addr` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `blogs_comments`
--

CREATE TABLE `blogs_comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_time` datetime NOT NULL,
  `poster` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zan` int(11) NOT NULL,
  `remote_addr` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `blogs_tags`
--

CREATE TABLE `blogs_tags` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `tag` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `click_zans`
--

CREATE TABLE `click_zans` (
  `type` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` int(11) NOT NULL,
  `val` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `contests`
--

CREATE TABLE `contests` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `start_time` datetime NOT NULL,
  `last_min` int(11) NOT NULL,
  `player_num` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `zan` int(11) NOT NULL,
  `comp` varchar(10) NOT NULL,
  `content` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `contests_asks`
--

CREATE TABLE `contests_asks` (
  `id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `post_time` datetime NOT NULL,
  `reply_time` datetime NOT NULL,
  `is_hidden` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `contests_notice`
--

CREATE TABLE `contests_notice` (
  `contest_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` varchar(500) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `contests_permissions`
--

CREATE TABLE `contests_permissions` (
  `username` varchar(20) NOT NULL,
  `contest_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `contests_problems`
--

CREATE TABLE `contests_problems` (
  `problem_id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `contests_registrants`
--

CREATE TABLE `contests_registrants` (
  `username` varchar(20) NOT NULL,
  `user_rating` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `has_participated` tinyint(1) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `important_blogs`
--

CREATE TABLE `important_blogs` (
  `blog_id` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `judger_info`
--

CREATE TABLE `judger_info` (
  `judger_name` varchar(50) NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `ip` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `judger_info`
--

INSERT INTO `judger_info` (`judger_name`, `password`, `ip`) VALUES
('main_judger', 'pPoGL0IR7upaLwci0BbuUQS0RMpF2NhU', '');

-- --------------------------------------------------------

--
-- 表的结构 `lucky_all`
--

CREATE TABLE `lucky_all` (
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `good` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bad` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `used` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `lucky_all`
--

INSERT INTO `lucky_all` (`name`, `good`, `bad`, `used`) VALUES
('打模拟赛', '吊打全场', '会爆零', 0),
('写作业', '写的全对', '老师讲了这些吗', 0);

-- --------------------------------------------------------

--
-- 表的结构 `problems`
--

CREATE TABLE `problems` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT '1',
  `submission_requirement` text,
  `extra_config` varchar(500) NOT NULL DEFAULT '{"view_content_type":"ALL","view_details_type":"ALL"}',
  `zan` int(11) NOT NULL,
  `ac_num` int(11) NOT NULL DEFAULT '0',
  `submit_num` int(11) NOT NULL DEFAULT '0',
  `hard` int(5) NOT NULL DEFAULT '5'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `problems`
--

INSERT INTO `problems` (`id`, `title`, `is_hidden`, `submission_requirement`, `extra_config`, `zan`, `ac_num`, `submit_num`, `hard`) VALUES
(1, 'A+B 难度的 Problem', 0, '[{\"name\":\"answer\",\"type\":\"source code\",\"file_name\":\"answer.code\"}]', '{\"view_content_type\":\"ALL\",\"view_details_type\":\"ALL\"}', 0, 0, 0, 5);

-- --------------------------------------------------------

--
-- 表的结构 `problems_contents`
--

CREATE TABLE `problems_contents` (
  `id` int(11) NOT NULL,
  `statement_md` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `problems_contents`
--

INSERT INTO `problems_contents` (`id`, `statement_md`) VALUES
(1, '## 题目描述\n \n现有一个正整数 $k$，你需要求出最小的正整数 $n$，使得 $k|n!$。\n\n## 输入格式\n\n第一行一个整数 $m$，表示 $m$ 次询问。\n\n接下来 $m$ 行，每行一个整数，表示一次询问的 $k$。\n\n## 输出格式\n\n$m$ 行，每行一个正整数表示答案。\n\n## 输入样例\n```\n4\n1\n40\n136080\n```\n## 输出样例\n```\n1\n5\n12\n```\n## 数据规模与约定\n\n- 对于 $30\\%$ 的数据，$m\\leq10,k\\leq1000$；\n- 对于 $50\\%$ 的数据，$m\\leq100,k\\leq10^5$；\n- 对于 $100\\%$ 的数据，$m\\leq100,k\\leq10^7$。\n\n');

-- --------------------------------------------------------

--
-- 表的结构 `problems_permissions`
--

CREATE TABLE `problems_permissions` (
  `username` varchar(20) NOT NULL,
  `problem_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `problems_permissions`
--

INSERT INTO `problems_permissions` (`username`, `problem_id`) VALUES
('oimaster', 1);

-- --------------------------------------------------------

--
-- 表的结构 `problems_tags`
--

CREATE TABLE `problems_tags` (
  `problem_id` int(11) NOT NULL,
  `tag` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `submissions`
--

CREATE TABLE `submissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `problem_id` int(10) UNSIGNED NOT NULL,
  `contest_id` int(10) UNSIGNED DEFAULT NULL,
  `submit_time` datetime NOT NULL,
  `submitter` varchar(20) NOT NULL,
  `content` text NOT NULL,
  `language` varchar(15) NOT NULL,
  `tot_size` int(11) NOT NULL,
  `judge_time` datetime DEFAULT NULL,
  `result` blob NOT NULL,
  `status` varchar(20) NOT NULL,
  `result_error` varchar(20) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `used_time` int(11) NOT NULL DEFAULT '0',
  `used_memory` int(11) NOT NULL DEFAULT '0',
  `is_hidden` tinyint(1) NOT NULL,
  `status_details` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `submissions`
--

INSERT INTO `submissions` (`id`, `problem_id`, `contest_id`, `submit_time`, `submitter`, `content`, `language`, `tot_size`, `judge_time`, `result`, `status`, `result_error`, `score`, `used_time`, `used_memory`, `is_hidden`, `status_details`) VALUES
(1, 1, 0, '2022-06-25 15:25:07', 'oimaster', '{\"file_name\":\"\\/opt\\/uoj\\/web\\/app\\/storage\\/submission\\/aTuqMFtUJTZOJqwkzJFWPhqcbbuoSHlAFCqUqTREXaFscnOTvY.zip\",\"config\":[[\"answer_language\",\"C++11\"],[\"problem_id\",\"1\"]]}', 'C++11', 1461, NULL, '', '', NULL, NULL, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `user_info`
--

CREATE TABLE `user_info` (
  `usergroup` char(1) NOT NULL DEFAULT 'U',
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '1500',
  `qq` bigint(20) NOT NULL,
  `ac_num` int(11) NOT NULL DEFAULT '0',
  `register_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remote_addr` varchar(50) NOT NULL,
  `http_x_forwarded_for` varchar(50) NOT NULL,
  `motto` varchar(200) NOT NULL,
  `last_online` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contribution` int(11) NOT NULL DEFAULT '0',
  `overall` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `user_info`
--

INSERT INTO `user_info` (`usergroup`, `username`, `email`, `password`, `rating`, `qq`, `ac_num`, `register_time`, `remote_addr`, `http_x_forwarded_for`, `motto`, `last_online`, `contribution`, `overall`) VALUES
('S', 'oimaster', '202367038@qq.com', 'いいえ', 1500, 0, 0, '2022-06-24 11:00:02', '172.70.210.218', '222.95.81.6', '', '2022-06-24 11:00:02', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_lucky`
--

CREATE TABLE `user_lucky` (
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `user_msg`
--

CREATE TABLE `user_msg` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender` varchar(20) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `send_time` datetime NOT NULL,
  `read_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 转储表的索引
--

--
-- 表的索引 `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `blogs_comments`
--
ALTER TABLE `blogs_comments`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `blogs_tags`
--
ALTER TABLE `blogs_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `tag` (`tag`);

--
-- 表的索引 `click_zans`
--
ALTER TABLE `click_zans`
  ADD PRIMARY KEY (`type`,`target_id`,`username`);

--
-- 表的索引 `contests`
--
ALTER TABLE `contests`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `contests_asks`
--
ALTER TABLE `contests_asks`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `contests_notice`
--
ALTER TABLE `contests_notice`
  ADD KEY `contest_id` (`contest_id`);

--
-- 表的索引 `contests_permissions`
--
ALTER TABLE `contests_permissions`
  ADD PRIMARY KEY (`username`,`contest_id`);

--
-- 表的索引 `contests_problems`
--
ALTER TABLE `contests_problems`
  ADD PRIMARY KEY (`problem_id`,`contest_id`);

--
-- 表的索引 `contests_registrants`
--
ALTER TABLE `contests_registrants`
  ADD PRIMARY KEY (`contest_id`,`username`);

--
-- 表的索引 `important_blogs`
--
ALTER TABLE `important_blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- 表的索引 `judger_info`
--
ALTER TABLE `judger_info`
  ADD PRIMARY KEY (`judger_name`);

--
-- 表的索引 `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `problems_contents`
--
ALTER TABLE `problems_contents`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `problems_permissions`
--
ALTER TABLE `problems_permissions`
  ADD PRIMARY KEY (`username`,`problem_id`);

--
-- 表的索引 `problems_tags`
--
ALTER TABLE `problems_tags`
  ADD KEY `problem_id` (`problem_id`),
  ADD KEY `tag` (`tag`);

--
-- 表的索引 `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_hidden` (`is_hidden`,`problem_id`);

--
-- 表的索引 `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`username`),
  ADD KEY `rating` (`rating`,`username`),
  ADD KEY `ac_num` (`ac_num`,`username`);

--
-- 表的索引 `user_msg`
--
ALTER TABLE `user_msg`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `blogs_comments`
--
ALTER TABLE `blogs_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `blogs_tags`
--
ALTER TABLE `blogs_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `contests`
--
ALTER TABLE `contests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `contests_asks`
--
ALTER TABLE `contests_asks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `user_msg`
--
ALTER TABLE `user_msg`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

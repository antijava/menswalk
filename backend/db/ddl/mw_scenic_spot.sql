--
-- 資料表結構 `mw_scenic_spot`
--

CREATE TABLE `mw_scenic_spot` (
  `id` varchar(20) NOT NULL,
  `name` varchar(98) NOT NULL,
  `address` varchar(154) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `region` varchar(9) DEFAULT NULL,
  `town` varchar(12) DEFAULT NULL,
  `px` decimal(10,6) NOT NULL,
  `py` decimal(11,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- 資料表結構 `mw_mencount_detail`
--

CREATE TABLE `mw_mencount_detail` (
  `id` varchar(20) NOT NULL,
  `cdate` varchar(8) NOT NULL,
  `mencount` int(11) NOT NULL,
  `apikey` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


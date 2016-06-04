-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jun 04, 2016 at 06:50 AM
-- Server version: 5.5.38-log
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `alve`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
`id` int(11) NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

-- INSERT INTO `admins` (`id`, `username`, `password`) VALUES
-- (2, 'admin', '$2y$10$5GSMXS8uAygH46UCF7/i1epYBT3sJHxriscXtph7imgglR9hzLbv2');

-- --------------------------------------------------------

--
-- Table structure for table `allocations`
--

CREATE TABLE `allocations` (
  `id` int(11) NOT NULL,
  `allocation_name` varchar(256) DEFAULT NULL,
  `allocation_type` int(11) DEFAULT '0',
  `allocation_unit` varchar(256) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `allocations`
--

INSERT INTO `allocations` (`id`, `allocation_name`, `allocation_type`, `allocation_unit`, `created`, `modified`, `deleted`) VALUES
(1, '向上率 5%', 1, '%', NULL, NULL, 0),
(2, '向上率10%', 1, '%', NULL, NULL, 0),
(3, '削減率 5%', 2, '%', NULL, NULL, 0),
(4, '削減率10%', 2, '%', NULL, NULL, 0),
(5, 'リサイクルの管理レベル', 0, '特定値', NULL, NULL, 0),
(6, '管理レベル', 0, '特定値', NULL, NULL, 0),
(7, '節湯区分', 0, '特定値', NULL, NULL, 0),
(8, '達成率', 0, '特定値', NULL, NULL, 0),
(9, '有無', 0, '特定値', NULL, NULL, 0),
(10, 'しくみ管理レベル', 0, '特定値', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `allocation_items`
--

CREATE TABLE `allocation_items` (
  `id` int(11) NOT NULL,
  `point` int(11) DEFAULT NULL,
  `text` mediumtext,
  `range_max` int(11) DEFAULT NULL,
  `range_min` int(11) DEFAULT NULL,
  `allocation_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `allocation_items`
--

INSERT INTO `allocation_items` (`id`, `point`, `text`, `range_max`, `range_min`, `allocation_id`, `created`, `modified`, `deleted`) VALUES
(1, 3, NULL, NULL, 5, 1, NULL, NULL, 0),
(2, 2, NULL, 5, 3, 1, NULL, NULL, 0),
(3, 1, NULL, 3, 0, 1, NULL, NULL, 0),
(4, 3, NULL, NULL, 10, 2, NULL, NULL, 0),
(5, 2, NULL, 10, 5, 2, NULL, NULL, 0),
(6, 1, NULL, 5, 0, 2, NULL, NULL, 0),
(7, 3, NULL, NULL, 5, 3, NULL, NULL, 0),
(8, 2, NULL, 5, 3, 3, NULL, NULL, 0),
(9, 1, NULL, 3, 0, 3, NULL, NULL, 0),
(10, 3, NULL, NULL, 10, 4, NULL, NULL, 0),
(11, 2, NULL, 10, 5, 4, NULL, NULL, 0),
(12, 1, NULL, 5, 0, 4, NULL, NULL, 0),
(13, 3, '重さが製品全重量の5%未満の部品について、解体分離に関する表示ができている（製品本体、ドキュメント類等で）。', NULL, NULL, 5, NULL, NULL, 0),
(14, 2, '重さが製品全重量の5%以上～10%未満の部品について、解体分離に関する表示ができている（同）。', NULL, NULL, 5, NULL, NULL, 0),
(15, 1, '重さが製品全重量の10%以上の部品について、解体分離に関する表示ができている（同）。', NULL, NULL, 5, NULL, NULL, 0),
(16, 0, '表示をしていない。', NULL, NULL, 5, NULL, NULL, 0),
(17, 3, 'a. プロセスが標準化及び文書化され、その遵守状況の把握・測定が可能。プロセスが有効に機能していない場合は修正が行われ、継続的に改善されている。', NULL, NULL, 6, NULL, NULL, 0),
(18, 2, 'b. プロセスが標準化及び文書化され、訓練により伝達されている。しかし、このようなプロセスは個人に依存しており、逸脱が存在する可能性がある。', NULL, NULL, 6, NULL, NULL, 0),
(19, 1, 'c. 手続きは確立しているが、標準化は不十分で、訓練や伝達も存在しない。個人の知識に依存している程度が高く、過ちが発生しがちである。', NULL, NULL, 6, NULL, NULL, 0),
(20, 0, 'd. 実施すべき手続きが欠落している。組織として対応すべき問題を認識できても、個人ごと、あるいはケースバイケースの思いつきにより対応している。運用していない', NULL, NULL, 6, NULL, NULL, 0),
(21, 3, '工業会標準に準拠', NULL, NULL, 7, NULL, NULL, 0),
(22, 2, '自社標準に準拠節湯B', NULL, NULL, 7, NULL, NULL, 0),
(23, 1, '部分的にある', NULL, NULL, 7, NULL, NULL, 0),
(24, 0, '無', NULL, NULL, 7, NULL, NULL, 0),
(25, 3, '100%以上', NULL, NULL, 8, NULL, NULL, 0),
(26, 2, '80％以上', NULL, NULL, 8, NULL, NULL, 0),
(27, 1, '60％以上', NULL, NULL, 8, NULL, NULL, 0),
(28, 0, '60％未満', NULL, NULL, 8, NULL, NULL, 0),
(29, -1, 'マイナス', NULL, NULL, 8, NULL, NULL, 0),
(30, 3, '有', NULL, NULL, 9, NULL, NULL, 0),
(31, 0, '無', NULL, NULL, 9, NULL, NULL, 0),
(32, 3, 'a. プロセスが標準化及び文書化され、その遵守状況の把握・測定が可能。プロセスが有効に機能していない場合は修正が行われ、継続的に改善されている。', NULL, NULL, 10, NULL, NULL, 0),
(33, 2, 'b. プロセスが標準化及び文書化され、訓練により伝達されている。しかし、このようなプロセスは個人に依存しており、逸脱が存在する可能性がある。', NULL, NULL, 10, NULL, NULL, 0),
(34, 1, 'c. 手続きは確立しているが、標準化は不十分で、訓練や伝達も存在しない。個人の知識に依存している程度が高く、過ちが発生しがちである。', NULL, NULL, 10, NULL, NULL, 0),
(35, 0, 'd. 実施すべき手続きが欠落している。組織として対応すべき問題を認識できても、個人ごと、あるいはケースバイケースの思いつきにより対応している。', NULL, NULL, 10, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
`id` int(11) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `is_admin` int(11) DEFAULT '0',
  `company_name` varchar(256) DEFAULT NULL,
  `url` mediumtext,
  `tel` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `name_kana` varchar(256) DEFAULT NULL,
  `user_id` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

-- INSERT INTO `companies` (`id`, `password`, `deleted`, `created`, `modified`, `is_admin`, `company_name`, `url`, `tel`, `email`, `name_kana`, `user_id`) VALUES
-- (4, '$2y$10$mEeEZ4kaFj11p..nHhkq8eY93D8yV0IMwwUOzFwhmml/ji1Zq1CaS', NULL, '2016-04-14 12:12:00', '2016-05-22 08:00:28', 0, 'テスト株式会社', 'http://test.com', '08088888888', 'test@test', NULL, 'ALV00004'),
-- (5, '$2y$10$xdY0yr.W9p8UfTjI7wOOO.Ls7NijmSQpSO5a78UFIOye9d7eKVAqK', NULL, '2016-04-21 13:23:00', '2016-05-22 06:19:14', 0, '株式会社テスト1', 'https://google.com', '01200880112', 'test@1.com', 'テスト', 'ALV00005'),
-- (8, '$2y$10$TfZCAoFOzO5iHfzD.jpc/.RSSyGHN4sTlZZpDR0c1Z2EolYQ6zEM6', NULL, '2016-04-24 10:04:44', '2016-05-08 11:24:50', 0, 'test4312', 'http://google.com', '<b>teethe</b>', 'test@3.com', NULL, 'ALV00008'),
-- (9, '$2y$10$QTkuZPaaxt02Jk1kN8jkHuqhReSIEqht/K.hVY2asRA8NI8zdZL2e', '2016-05-11 10:22:36', '2016-05-11 10:22:25', '2016-05-11 10:22:25', 0, 'やはぎ', NULL, NULL, 'yahagi1989@gmail.com', 'やはぎ', 'ALV00009'),
-- (10, '$2y$10$scoKhmLH7iUylNSCpF9nnuzJIzwhKSrjpv5U9tXKAKEr./syVHfcu', NULL, '2016-05-22 07:22:08', '2016-05-28 08:59:58', 0, '東京電力株式会社', NULL, NULL, '', 'トウキョウデンリョク', 'ALV00010'),
-- (11, '$2y$10$VJS.A3Sr/kbNV/7aE1pPD.i9sZn2Of23OXIA89vyMmN8IAPpLqxQu', NULL, '2016-05-22 08:01:02', '2016-05-22 08:01:02', 0, '東京電力', NULL, NULL, 'yahagi1989@gmail.com', 'トウキョウデンリョク', 'ALV00011'),
-- (13, '$2y$10$g4c7valE1BioLdAQurEW1eeTp1ozUt8qOYW/YHTMK3ZUbOi8I4Jbi', NULL, '2016-05-28 08:46:15', '2016-05-28 08:46:15', 0, '轟', NULL, NULL, 'test@2.com', 'トドロキ', 'ALV00013');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
`id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `compared_product_name` varchar(256) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `update_comment` mediumtext,
  `completed` int(11) DEFAULT '0',
  `compared_model_number` varchar(256) DEFAULT NULL,
  `compared_url` varchar(256) DEFAULT NULL,
  `compared_sales_date` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluations`
--

-- INSERT INTO `evaluations` (`id`, `product_id`, `compared_product_name`, `created`, `modified`, `deleted`, `update_comment`, `completed`, `compared_model_number`, `compared_url`, `compared_sales_date`) VALUES
-- (2, 7, '', '2016-05-04 04:31:53', '2016-05-07 05:46:07', 0, NULL, 0, '', NULL, NULL),
-- (3, 8, '', '2016-05-04 07:10:00', '2016-05-22 09:42:56', 0, NULL, 1, 'sad', '', '0000-00-00 00:00:00'),
-- (6, 11, '', '2016-05-04 07:49:54', '2016-05-22 09:43:13', 0, NULL, 1, '', '', '0000-00-00 00:00:00'),
-- (8, 13, 'dfvafsv', '2016-05-06 09:37:38', '2016-05-22 06:33:20', 0, NULL, 1, 'sfvasvfaf ', NULL, NULL),
-- (9, 14, '', '2016-05-06 10:32:46', '2016-05-07 04:09:27', 0, NULL, 0, '', NULL, NULL),
-- (10, 15, 'てすっお', '2016-05-07 05:34:46', '2016-05-07 05:35:36', 0, NULL, 0, 'あdさsfv-sdcあ', NULL, NULL),
-- (11, 16, 'fgjhvgjk', '2016-05-08 17:11:21', '2016-05-22 08:24:07', 0, NULL, 0, 'chgvjkl', 'asdcasfvs', '2016-05-20 00:00:00'),
-- (12, 17, '', '2016-05-11 10:37:07', '2016-05-11 11:35:34', 0, NULL, 0, '', NULL, NULL),
-- (13, 18, '', '2016-05-22 09:21:10', '2016-05-22 09:39:32', 0, NULL, 0, '', '', '0000-00-00 00:00:00'),
-- (14, 19, '', '2016-05-28 08:30:09', '2016-05-28 08:30:09', 0, NULL, 0, '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_heads`
--

CREATE TABLE `evaluation_heads` (
  `id` int(11) NOT NULL,
  `large_type` varchar(256) DEFAULT NULL,
  `medium_type` varchar(256) DEFAULT NULL,
  `small_type` varchar(256) DEFAULT NULL,
  `item_description` mediumtext,
  `item_criteria` mediumtext,
  `allocation_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `required` int(11) DEFAULT '0',
  `options` mediumtext,
  `unit_category` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_heads`
--

INSERT INTO `evaluation_heads` (`id`, `large_type`, `medium_type`, `small_type`, `item_description`, `item_criteria`, `allocation_id`, `created`, `modified`, `deleted`, `required`, `options`, `unit_category`) VALUES
(1, '省エネルギー', '燃料・電気・熱', '製品消費エネルギーの低減', '動作時の消費電力量の削減', '製品の消費電力（定格電力）の削減率', 4, NULL, NULL, 0, 1, '削減率10%', '電力量'),
(2, '省エネルギー', '燃料・電気・熱', '製品消費エネルギーの低減', '待機時の消費電力の削減', '製品待機時の消費電力の削減率', 4, NULL, NULL, 0, 0, '削減率10%', '電力量'),
(3, '省エネルギー', '燃料・電気・熱', '流体エネルギー消費の低減', '節湯機能の有無', '工業会の節湯区分', 7, NULL, NULL, 0, 0, '節湯区分', NULL),
(4, '省エネルギー', '燃料・電気・熱', '製造・組立時のエネルギー消費削減', '生産設備、工程改善、不良率低減による製品製造時のエネルギー消費量の削減', '年間消費電力量（生産ラインもしくは該当工程別）の削減率', 3, NULL, NULL, 0, 0, '・製品評価時に、エネルギー消費削減量を計るときは、母数に、生産台数、売上額などを適宜設定する。\r\n\r\n・評価対象製品の全製造工程のエネルギー消費量を厳密に測定するのが難しい場合は、事業者で一定の決めを設け、測定対象範囲を限定して評価してもよい（鋳物製造工程に限定する、加工に時間がかかり使用電力が大きい弁体や弁箱等の大きな部品の製造工程に限定する、等）。', '電力量'),
(5, '省エネルギー', '燃料・電気・熱', '製造・組立時のエネルギー消費削減', '製品設計改善による製品製造時のエネルギー消費量の削減', '年間消費電力量（生産ラインもしくは該当工程別）の削減率', 4, NULL, NULL, 0, 0, '・製品評価時に、エネルギー消費削減量を計るときは、母数に、生産台数、売上額などを適宜設定する。\r\n・評価対象製品の全製造工程のエネルギー消費量を厳密に測定するのが難しい場合は、事業者で一定の決めを設け、測定対象範囲を限定して評価してもよい（鋳物製造工程に限定する、加工に時間がかかり使用電力が大きい弁体や弁箱等の大きな部品の製造工程に限定する、等）。', '電力量'),
(6, 'リデュース', '省資源化（減量化、減容化）', '製品の小型化及び／又は軽量化', '製品の軽量化\r\n(製品全体の重量削減)', '製品全体の重量の削減率', 4, NULL, NULL, 0, 0, '・これら項目の評価では、全構成部品の個別素材重量、完成品重量、寸法、体積が把握管理されていることが必要。\r\n・体積については、厳密に求めた数値を用いるか、外形寸法を用いるかは事業者で一定の決めを設定する。', '重量'),
(7, 'リデュース', '省資源化（減量化、減容化）', '製品の小型化及び／又は軽量化', '製品の小型化\r\n(製品全体の寸法、容積（体積）)', '製品全体の寸法又は体積の削減率', 4, NULL, NULL, 0, 0, '・これら項目の評価では、全構成部品の個別素材重量、完成品重量、寸法、体積が把握管理されていることが必要。\r\n・体積については、厳密に求めた数値を用いるか、外形寸法を用いるかは事業者で一定の決めを設定する。', '容積'),
(8, 'リデュース', '省資源化（減量化、減容化）', '製品の小型化及び／又は軽量化', '生産時の歩留まり改善による素材使用量の削減', '素材使用量の削減率', 4, NULL, NULL, 0, 0, '製品全体の重量が変わらない場合も、設計改善（歩留まり、不良率改善等）による材料の削減量を評価する。歩留まり、不良率評価は、設計試作、量産試作段階で実施する。', '重量'),
(9, 'リデュース', '省資源化（減量化、減容化）', '部品点数削減・部品共通化', '部品点数削減', '部品点数の削減率', 4, NULL, NULL, 0, 0, '\r\n\r\n【標準部品とは】\r\n\r\n本ガイドラインでは、一般規格部品、複数の製品で使用可能な部品、同一製品内でも複数使用する部品などを標準部品とするが、詳細な定義は事業者が決めてもよい。\r\n\r\n【部品の共通化とは】\r\n\r\n設計段階で標準部品が設定された結果、その部品を共通利用することで、調達、在庫管理、生産、保守など大幅なコスト削減が望める', '数量'),
(10, 'リデュース', '省資源化（減量化、減容化）', '部品点数削減・部品共通化', '標準部品使用の拡大', '部品標準化率（＝使用標準部品点数÷総部品点数）の向上率', 2, NULL, NULL, 0, 0, '\r\n【標準部品とは】\r\n本ガイドラインでは、一般規格部品、複数の製品で使用可能な部品、同一製品内でも複数使用する部品などを標準部品とするが、詳細な定義は事業者が決めてもよい。\r\n【部品の共通化とは】\r\n設計段階で標準部品が設定された結果、その部品を共通利用することで、調達、在庫管理、生産、保守など大幅なコスト削減が望める', '割合'),
(11, 'リデュース', '省資源化（減量化、減容化）', '包装の減量化･減容化', '梱包材、包装材の重量及び／又は体積の削減', '使い捨て包装材、梱包材の重量及び／又は体積の削減率', 4, NULL, NULL, 0, 0, '製造時の部品梱包材及び製品の使い捨て包装材や梱包材を対象とし、重量及び／又は体積を指標とする。\r\n【使い捨て材とは】\r\n事業者が回収せず、購入者側が処分する材料のことをいう。\r\n【チェックシートへの記入】\r\n・梱包材や包装材を使用していない場合は、項目の「必須／選択」欄で「非該当」を選ぶ。\r\n・通い箱を活用している場合は削減率100%とするか、又は回収率で評価して、その旨を備考欄に記入する。', '重量'),
(12, 'リデュース', '省資源化（減量化、減容化）', '流体の無駄な消費の低減（節水、漏れ削減）', '使用時の節水', '節水機能の有無', 9, NULL, NULL, 0, 0, '【チェックシートへの記入】\r\n節水機能に関係しない製品は、項目の「必須／選択」欄で「非該当」を選ぶ。', NULL),
(13, 'リデュース', '省資源化（減量化、減容化）', '流体の無駄な消費の低減（節水、漏れ削減）', 'バルブ閉時の弁座漏れ量の低減', '弁座漏れ量の削減率', 4, NULL, NULL, 0, 0, '・この項目は、エネルギー消費ではなく資源消費の観点で評価する。\r\n・漏れの測定方法を明確に規定する（工業用弁の場合、API、ANSI等の規定に基づく評価試験、客先仕様等）。\r\n【チェックシートへの記入】\r\n漏れ量が0と評価される場合は、便宜上「New Data」に0を、「Old Data」に1を入力する。\r\n', '弁座漏れ量'),
(14, 'リデュース', '省資源化（減量化、減容化）', '流体の無駄な消費の低減（節水、漏れ削減）', 'バルブ使用時の流体の漏れ削減（出口以外）', '気密性を確保する機能（設計）の有無\r\n（接合部から外部への漏れ対策が考慮されているか）', 4, NULL, NULL, 0, 0, '【チェックシートへの記入】\r\n漏れ量の具体的数値を入力する。または、接合部（駆動部、シャフト、フランジ、パッキンなど）に使われる部品を耐久性のあるものに変更した場合は、「有／無」を単位として、「有」を選択する。\r\n【漏れ量測定に使える指標】\r\n工業用弁では、ISO15848にパッキンからの許容漏れ量の規定がある。', NULL),
(15, 'リデュース', '長寿命化', '製品・部品・材料等の長寿命化', '製品、部品・材料（ボトルネックになるもの）の耐用年数（時間）の延長化', '耐用年数（時間）及び／又は耐用動作回数の向上率', 2, NULL, NULL, 0, 0, '以下の点を考慮に入れて寿命又は耐久性を計る評価方法を明確に定め、評価を行う。\r\n①耐用寿命時間\r\n②耐用動作回数\r\n③高耐久性の部品や材料への変更\r\n【寿命の定義・基準作成の参考となる規格】\r\n・SIL認証: IEC61508シリーズ（邦訳版標題「電気/電子/プログラム可能電子安全関連システムの機能安全」）。\r\n・JIS S 3200シリーズ（水道用器具の性能試験）。', '時間'),
(16, 'リデュース', '廃棄物削減', 'ライフサイクルを通して発生する廃棄物削減', '製造過程で発生する廃棄物（リサイクル、リユースの出来ないもの）の削減', '廃棄物発生量の削減率', 3, NULL, NULL, 0, 0, '・上記例を参考に、削減対象廃棄物とその削減目標値は事業者で決める。\r\n・評価範囲は、評価対象製品の製造工程単位、生産ライン単位等、事業者が一定の決めで定める。\r\n・必要であれば体積削減率を指標としてもよいが、重量換算した数値を指標とするのが適当であろう。', '重量'),
(17, 'リデュース', '廃棄物削減', '消耗品の消費削減', '一定条件下で使用した場合の消耗品の消費量削減', '年間の消耗品消費量の削減率又は消耗品の耐久時間の向上率', 4, NULL, NULL, 0, 0, '・消費量は消耗品の耐用寿命、交換周期で置き換えて目標値設定してもよい。\r\n・製品評価では、長寿命のパッキン、ガスケット等に仕様を変更した場合、消耗品の消費量を削減したと評価できる（耐用寿命や交換周期の改善率が向上したとみなす）。\r\n【消耗品の例】\r\nパッキン、ガスケット、潤滑油、バッテリ等。\r\n【チェックシートへの記入】\r\n製品使用時に発生する消耗品がない場合は、項目の「必須／選択」欄で「非該当」を選ぶ。\r\n', '重量'),
(18, 'リユース', 'メンテナンスの容易性', '交換可能部品の使用範囲拡大', '交換可能部品の使用範囲拡大', '交換可能部品の使用率及び／又は交換可能部品数の向上率', 2, NULL, NULL, 0, 0, '【交換可能部品とは】\r\nユーザー、メンテナンス担当者が、全体を交換せずにその部品のみ（市場で入手可能なもの）を交換することで復帰できる部品をいう。', '数量'),
(19, 'リユース', 'メンテナンスの容易性', '分解、再組み付け容易性', '交換部品の標準化', '交換部品の標準化率（＝標準化された交換部品数÷交換部品総数）の向上率', 2, NULL, NULL, 0, 0, '・製品設計、生産段階での部品標準化の一部としてとらえられるが、保守交換部品に絞った評価を行う。\r\n・2.1.2.2（標準部品使用の拡大）と重複しているが、ここでは交換部品に特定して評価する。\r\n【交換部品の標準化とは】\r\nユーザー又はメンテ担当者に部品交換の容易性を提供するため、部品の仕様が明示され、単独で管理（生産、販売）され、他機種との互換性を持つように設計されていることをいう\r\n【チェックシートへの記入】\r\n・全て規格品で構成されている場合は、「New Data」に1を、「Old Data」に0を入力し、規格品である旨を備考に記述する。\r\n・使い捨て製品で、交換部品がない製品は、項目の「必須／選択」欄で「非該当」を選ぶ。', '割合'),
(20, 'リユース', 'メンテナンスの容易性', '分解、再組み付け容易性', '部品の交換容易性', '交換時間の短縮率及び／又は交換容易性指標（時間、交換容易性が指標化されている場合）', 4, NULL, NULL, 0, 0, '・部品、モジュールなどの交換が容易に出来るよう、工具レス、少ない工具、特殊工具使用の削減など考慮されているかを加味し、実際の交換時間を測定評価する\r\n【チェックシートへの記入】\r\n使い捨て製品で、交換部品がない製品は、項目の「必須／選択」欄で「非該当」を選ぶ。', '時間'),
(21, 'リサイクル', 'リサイクル性向上', 'リサイクルが可能な資源・材料の使用範囲拡大', 'リサイクル可能な材料を使用した部品の使用範囲拡大', 'リサイクル可能な材料の使用率（＝リサイクル可能な材料で作られた部品の体積又は重量÷製品全体の体積又は重量）の向上率', 2, NULL, NULL, 0, 0, '・管理対象とするリサイクル可能な材料及び／又はリサイクルされた材料は、事業者にて設定する。\r\n・リサイクル可能な材料、リサイクルされた材料ともに、製品全体の体積又は重量に対する使用率を指標として評価する。', '割合'),
(22, 'リサイクル', 'リサイクル性向上', 'リサイクルが可能な資源・材料の使用範囲拡大', 'リサイクルされた材料を使用した部品、梱包材の使用範囲拡大', 'リサイクルされた材料使用率（＝リサイクルされた材料で作られた部品の体積又は重量÷製品全体の体積又は重量）の向上率', 2, NULL, NULL, 0, 0, '・管理対象とするリサイクル可能な材料及び／又はリサイクルされた材料は、事業者にて設定する。\r\n・リサイクル可能な材料、リサイクルされた材料ともに、製品全体の体積又は重量に対する使用率を指標として評価する。', '割合'),
(23, 'リサイクル', '解体・分離・分別容易性', '破砕・選別処理の容易性 ', '解体時、分別がしやすいように、リサイクル可能な材料を使用した部品の識別表示を行うための管理のレベル', '次に示すどのレベルにあるかを評価する。採点は管理レベルの得点区分にならう。\r\n\r\na）重さが製品全重量の5%未満の部品について、解体分離に関する表示ができている（製品本体、ドキュメント類等で）。\r\n\r\nb）重さが製品全重量の5%以上～10%未満の部品について、解体分離に関する表示ができている（同）。\r\n\r\nc）重さが製品全重量の10%以上の部品について、解体分離に関する表示ができている（同）。\r\n\r\nd）表示をしていない。', 5, NULL, NULL, 0, 0, '・取扱説明書、HP、図面、注意書き等への表示の有無と見やすさを評価する。\r\n\r\n・重さで部品を分類し、どれくらい細かい部品にまで識別表示ができているかを評価する。\r\n\r\n', NULL),
(24, 'リサイクル', '解体・分離・分別容易性', '破砕・選別処理の容易性 ', '解体・分別する対象物は取り外し容易性', '解体・分別する対象物の取り外し容易性', 4, NULL, NULL, 0, 0, '分解に要する時間を測定し、評価する。', '時間'),
(25, 'リサイクル', '解体・分離・分別容易性', '破砕・選別処理の容易性 ', 'リサイクル可能材種類数の低減', 'リサイクル可能な材料の種類数の低減', 4, NULL, NULL, 0, 0, '【リサイクル可能な材料の種類数低減の例】\r\n従来品はSUS304と316を使用⇒最新モデルでは316に統一。\r\n', '数量'),
(26, '環境・安全', '安全に関わる適用法令の遵守性', '製品に適用される関連法規制への遵守性', '該当製品に対する関連法規制とその遵守を確認した書類の有無', '技術資料の有無', 6, NULL, NULL, 0, 0, '関連国内法だけではなく、近年はCEマーキングを要求されることが多く、次のような関連指令を考慮、管理する必要がある。\r\n①EC EMC(電磁両立性）指令\r\n②EC 機械指令指令\r\n③EC 低電圧指令（LTV)\r\n④EC 圧力機器指令\r\n\r\n', NULL),
(27, '環境・安全', 'CO2（環境負荷物質）削減', '各段階での CO2 の排出量削減、代替化、発生回避の推進', '製品材料の生産過程で発生したCO2排出量の削減', '材料別CO2排出量の削減率', 3, NULL, NULL, 0, 0, '【個々の製品製造時におけるCO2排出量削減方法の例】\r\n①CO2排出量の少ない材料の選定\r\n②材料削減による排出量削減\r\n③工程改善による排出量削減', '重量'),
(28, '環境・安全', '有害化学物質管理', '関連法規制に適応し、製品、包装の各材料に含まれる有害化学物質の使用回避・管理', '浸出基準への適応性管理のレベル', '従来製品からの改善の有無', 6, NULL, NULL, 0, 0, '評価指針!D33', NULL),
(29, '環境・安全', '有害化学物質管理', '関連法規制に適応し、製品、包装の各材料に含まれる有害化学物質の使用回避・管理', '該当製品に対する有害化学物質管理のレベル', '従来製品からの改善の有無', 6, NULL, NULL, 0, 1, '【有害物質関連規制の例】\r\n欧州関連指令（REACH、RoHSなど）、化審法、化管法、浸出基準など。RoHS自体の適応対象は電気電子製品ではあるが、機械部品でも装置に組み込まれることが多い場合は、RoHS対応は必要となっている。\r\n【チェックシートへの記入】\r\n該当する指令・法規制が対象になくても、含有成分を把握し、「ない」と言うことを管理すべきであるので、「非該当」は選択できない。', NULL),
(30, '情報提供', '適切な情報提供', '製品のライフサイクル関係者への必要な情報提供とその方法の適切性', '製品のライフサイクル（選定、購入、使用）関係者が、選定・購入前に知っておくべき製品情報の提供', 'ライフサイクル関係者に有益な情報の提供量の増加率', 6, NULL, NULL, 0, 0, '7.1.1.1の「知っておくべき製品情報」とは、製品の仕様、特性、性能、機能などを指す。', NULL),
(31, '情報提供', '適切な情報提供', '製品のライフサイクル関係者への必要な情報提供とその方法の適切性', '製品のライフサイクル（選定、購入、使用）関係者が知っておくべき必要情報の提供（特定化学物質を使った指定製品の場合）', '環境規制及び労働安全衛生法で規制対象となっている化学物質に関する情報提供の有無', 6, NULL, NULL, 0, 0, '7.1.1.2は、法令により定められた特定の化学物質を使用している指定製品の場合の評価項目。自社製品に関係する法令の内容を把握・理解（＝しくみ評価）した上で、製品の個々のレベルでも、定められた表示をできているかを評価する。', NULL),
(32, '情報提供', '適切な情報提供', '製品のライフサイクル関係者への必要な情報提供とその方法の適切性', '製品のライフサイクル（流通、据付、使用、メンテナンス、廃棄）関係者が、購入後、開梱時、据え付け時、使用時、保守時、廃棄時等に知っておくべき製品の取り扱い、及び、環境安全性についての必要情報の提供', 'ライフサイクル関係者に有益な情報の提供量の増加率', 6, NULL, NULL, 0, 0, '7.1.1.3では、製品説明書、取り扱い説明書などで適切に情報提供できているか、特に法令により定められた表示が必要な場合、それを行っているかを評価する。\r\n', NULL),
(33, '情報提供', '適切な情報提供', '製品のライフサイクル関係者への必要な情報提供とその方法の適切性', '機器本体に表示すべき情報の表示の見やすさ', '見やすさの改善の有無', 6, NULL, NULL, 0, 0, '【評価時の視点】\r\n・表示内容が理解しやすいか。\r\n・見やすい位置にあるか。\r\n・読みやすい表示になっているか（表示の大きさなど）。', NULL),
(34, '情報提供', '適切な情報提供', '製品のライフサイクル関係者への必要な情報提供とその方法の適切性', '提供情報へのアクセスのしやすさ', '情報のデジタル化（Web等）率', 6, NULL, NULL, 0, 0, '利用者が必要情報（カタログ、仕様書、図面、取扱説明書、含有物質リスト、RoHS証明書、その他環境関連の証明書等）にいつでもペーパーレスでアクセスできる環境を提供できているか、デジタル化率として評価する。', NULL),
(35, '管理', 'DFE(環境配慮設計）の取り組み', 'DFE（環境配慮設計）の取り組み', '重点評価項目（事前に3項目以上を設定しておく）における設計目標値の達成率', '達成率の平均が次に示すどのレベルにあるかを評価する。\r\n\r\na） 100％以上\r\n\r\nb）　80％～100％未満\r\n\r\nc）　60％～80％未満\r\n\r\nd）　59％未満', 8, NULL, NULL, 0, 1, '製品開発時点で、関連部署を包括した環境配慮設計実施のためのプロジェクトが構成され、環境配慮設計の目標値管理、評価、レビューなどを行うしくみが準備されていることが必要となる。\r\n\r\n', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_items`
--

CREATE TABLE `evaluation_items` (
`id` int(11) NOT NULL,
  `evaluation_id` int(11) DEFAULT NULL,
  `head_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  `value` varchar(256) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `compared_value` varchar(256) DEFAULT NULL,
  `other_unit` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=537 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_items`
--

-- INSERT INTO `evaluation_items` (`id`, `evaluation_id`, `head_id`, `created`, `modified`, `deleted`, `value`, `unit_id`, `compared_value`, `other_unit`) VALUES
-- (381, 9, 1, '2016-05-07 04:09:27', '2016-05-07 04:09:27', NULL, '', 25, '', NULL),
-- (382, 9, 29, '2016-05-07 04:09:27', '2016-05-07 04:09:27', NULL, NULL, NULL, '0', NULL),
-- (383, 9, 35, '2016-05-07 04:09:27', '2016-05-07 04:09:27', NULL, NULL, NULL, '0', NULL),
-- (418, 10, 1, '2016-05-07 05:35:36', '2016-05-07 05:35:36', NULL, '100', 25, '1000', NULL),
-- (419, 10, 2, '2016-05-07 05:35:36', '2016-05-07 05:35:36', NULL, '19', 28, '121', NULL),
-- (420, 10, 3, '2016-05-07 05:35:36', '2016-05-07 05:35:36', NULL, '22', NULL, '0', NULL),
-- (421, 10, 17, '2016-05-07 05:35:36', '2016-05-07 05:35:36', NULL, '100', 5, '10', NULL),
-- (422, 10, 20, '2016-05-07 05:35:36', '2016-05-07 05:35:36', NULL, '12', 37, '12', NULL),
-- (423, 10, 23, '2016-05-07 05:35:36', '2016-05-07 05:35:36', NULL, '13', NULL, '0', NULL),
-- (424, 10, 26, '2016-05-07 05:35:36', '2016-05-07 05:35:36', NULL, '18', NULL, '0', NULL),
-- (425, 10, 29, '2016-05-07 05:35:36', '2016-05-07 05:35:36', NULL, '17', NULL, '0', NULL),
-- (426, 10, 34, '2016-05-07 05:35:36', '2016-05-07 05:35:36', NULL, '17', NULL, '0', NULL),
-- (427, 10, 35, '2016-05-07 05:35:36', '2016-05-07 05:35:36', NULL, '28', NULL, '0', NULL),
-- (434, 2, 1, '2016-05-07 05:46:07', '2016-05-07 05:46:07', NULL, '10', 25, '100', NULL),
-- (435, 2, 29, '2016-05-07 05:46:07', '2016-05-07 05:46:07', NULL, '17', NULL, '0', NULL),
-- (436, 2, 35, '2016-05-07 05:46:07', '2016-05-07 05:46:07', NULL, '27', NULL, '0', NULL),
-- (476, 12, 1, '2016-05-11 11:35:34', '2016-05-11 11:35:34', NULL, '100', 25, '11', NULL),
-- (477, 12, 29, '2016-05-11 11:35:34', '2016-05-11 11:35:34', NULL, NULL, NULL, '0', NULL),
-- (478, 12, 35, '2016-05-11 11:35:34', '2016-05-11 11:35:34', NULL, NULL, NULL, '0', NULL),
-- (497, 8, 1, '2016-05-22 06:33:20', '2016-05-22 06:33:20', NULL, '10', 25, '12', NULL),
-- (498, 8, 28, '2016-05-22 06:33:20', '2016-05-22 06:33:20', NULL, '17', NULL, '0', NULL),
-- (499, 8, 29, '2016-05-22 06:33:20', '2016-05-22 06:33:20', NULL, '17', NULL, '0', NULL),
-- (500, 8, 35, '2016-05-22 06:33:20', '2016-05-22 06:33:20', NULL, '28', NULL, '0', NULL),
-- (513, 11, 1, '2016-05-22 08:24:07', '2016-05-22 08:24:07', NULL, '', 25, '100', NULL),
-- (514, 11, 29, '2016-05-22 08:24:07', '2016-05-22 08:24:07', NULL, '17', NULL, '0', NULL),
-- (515, 11, 35, '2016-05-22 08:24:07', '2016-05-22 08:24:07', NULL, '27', NULL, '0', NULL),
-- (522, 13, 1, '2016-05-22 09:39:32', '2016-05-22 09:39:32', NULL, '', 0, '', 'kegs'),
-- (523, 13, 29, '2016-05-22 09:39:32', '2016-05-22 09:39:32', NULL, NULL, NULL, '0', ''),
-- (524, 13, 35, '2016-05-22 09:39:32', '2016-05-22 09:39:32', NULL, NULL, NULL, '0', ''),
-- (525, 3, 1, '2016-05-22 09:42:56', '2016-05-22 09:42:56', NULL, '100', 25, '1000', ''),
-- (526, 3, 29, '2016-05-22 09:42:56', '2016-05-22 09:42:56', NULL, '17', NULL, '0', ''),
-- (527, 3, 35, '2016-05-22 09:42:56', '2016-05-22 09:42:56', NULL, '27', NULL, '0', ''),
-- (528, 6, 1, '2016-05-22 09:43:13', '2016-05-22 09:43:13', NULL, '10', 25, '100', ''),
-- (529, 6, 2, '2016-05-22 09:43:13', '2016-05-22 09:43:13', NULL, '100', 25, '100', ''),
-- (530, 6, 3, '2016-05-22 09:43:13', '2016-05-22 09:43:13', NULL, '21', NULL, '0', ''),
-- (531, 6, 18, '2016-05-22 09:43:13', '2016-05-22 09:43:13', NULL, '100', 30, '1000', ''),
-- (532, 6, 29, '2016-05-22 09:43:13', '2016-05-22 09:43:13', NULL, '17', NULL, '0', ''),
-- (533, 6, 35, '2016-05-22 09:43:13', '2016-05-22 09:43:13', NULL, '27', NULL, '0', ''),
-- (534, 14, 1, '2016-05-28 08:30:09', '2016-05-28 08:30:09', NULL, '', 25, '', ''),
-- (535, 14, 29, '2016-05-28 08:30:09', '2016-05-28 08:30:09', NULL, NULL, NULL, '0', ''),
-- (536, 14, 35, '2016-05-28 08:30:09', '2016-05-28 08:30:09', NULL, NULL, NULL, '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `fomulas`
--

CREATE TABLE `fomulas` (
`id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `fomula_start` datetime DEFAULT NULL,
  `fomula_end` datetime DEFAULT NULL,
  `completed` int(11) DEFAULT '0',
  `operator_name` varchar(256) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fomulas`
--

-- INSERT INTO `fomulas` (`id`, `company_id`, `created`, `modified`, `deleted`, `fomula_start`, `fomula_end`, `completed`, `operator_name`) VALUES
-- (7, 5, '2016-05-07 05:38:08', '2016-05-07 05:38:50', NULL, '2016-05-22 00:00:00', '2016-05-11 00:00:00', 1, 'やはぎ'),
-- (10, 5, '2016-05-09 15:01:29', '2016-05-09 15:01:29', '2016-05-09 15:04:25', '2016-05-03 00:00:00', '2016-05-05 00:00:00', 0, 'sacsdcasas'),
-- (11, 5, '2016-05-09 15:14:39', '2016-05-09 15:14:43', NULL, '2016-05-29 00:00:00', '2016-05-28 00:00:00', 0, ''),
-- (12, 5, '2016-05-11 11:24:33', '2016-05-11 11:26:52', NULL, '2016-05-24 00:00:00', '2016-05-19 00:00:00', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `fomula_heads`
--

CREATE TABLE `fomula_heads` (
  `id` int(11) NOT NULL,
  `large_type` varchar(256) DEFAULT NULL,
  `medium_type` varchar(256) DEFAULT NULL,
  `small_type` varchar(256) DEFAULT NULL,
  `item_description` mediumtext,
  `item_criteria` mediumtext,
  `allocation_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `required` int(11) DEFAULT '0',
  `unit_category` varchar(256) DEFAULT NULL,
  `options` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fomula_heads`
--

INSERT INTO `fomula_heads` (`id`, `large_type`, `medium_type`, `small_type`, `item_description`, `item_criteria`, `allocation_id`, `created`, `modified`, `deleted`, `required`, `unit_category`, `options`) VALUES
(1, '省エネルギー', '燃料・電気・熱', '製品消費エネルギーの低減', '製品動作時、待機時など消費エネルギー削減を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 0, NULL, NULL),
(2, '省エネルギー', '燃料・電気・熱', '製造・組立時のエネルギー消費削減', '製品製造時のエネルギー削減を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(3, '省エネルギー', '燃料・電気・熱', '製造・組立時のエネルギー消費削減', '事業所単位のエネルギー消費量の削減', NULL, 2, NULL, NULL, 0, 0, '期間', NULL),
(4, 'リデュース', '省資源化（減量化、減容化）', '製品の小型化及び／又は軽量化', '製品の小型化及び／又は軽量化を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(5, 'リデュース', '省資源化（減量化、減容化）', '部品点数削減・部品共通化', '部品点数削減及び使用部品の標準化・共通化を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(6, 'リデュース', '省資源化（減量化、減容化）', '包装の減量化･減容化', '梱包材、包装材の重量、体積の削減を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 0, NULL, NULL),
(7, 'リデュース', '省資源化（減量化、減容化）', '希少資源使用量の削減', '希少材料の使用量の削減を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 0, NULL, NULL),
(8, 'リデュース', '長寿命化', '製品・部品・材料等の長寿命化', '長寿命化を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(9, 'リデュース', '廃棄物削減', '製品製造時に発生する廃棄物削減', 'リサイクル、リユースできない廃棄物発生量（事業所単位）の削減を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(10, 'リデュース', '廃棄物削減', '消耗品の消費削減', '製品使用時の消耗品の発生低減化を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 0, NULL, NULL),
(11, 'リデュース', '廃棄物削減', '製品製造時の水資源消費削減', '製品製造時の洗浄、冷却などで消費される水資源の削減を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(12, 'リユース', 'メンテナンスの容易性', 'メンテナンスのしやすい構造', '製品のメンテナンス時の安全性、信頼性、容易性の向上を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(13, 'リサイクル', 'リサイクル性向上', 'リサイクルが可能な資源・材料の使用範囲拡大', 'リサイクルされた材料、リサイクル可能な材料を使用した部品の使用範囲拡大を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(14, 'リサイクル', '解体・分離・分別容易性', '破砕・選別処理の容易性', '製品の廃棄、リサイクルのために解体・分離、分別の容易性を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(15, '環境・安全', '安全に関わる適用法令の遵守性', '製品に適用される関連法規制への遵守性', '製品に適用される関連法規制の最新情報を把握し、遵守するための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(16, '環境・安全', '安全に関わる適用法令の遵守性', '製造段階に適用される関連法規制への遵守性', '製造段階に適用される関連法規制の最新情報を把握し、遵守するための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(17, '環境・安全', 'CO2（環境負荷物質）削減', '各段階での環境影響物質の使用量削減、代替化、発生回避の推進', '製品製造段階（材料固有、製造）におけるCO2等環境負荷物質排出量の削減を図るための管理のしくみ', NULL, 10, NULL, NULL, 0, 1, NULL, NULL),
(18, '環境・安全', 'CO2（環境負荷物質）削減', '各段階での環境影響物質の使用量削減、代替化、発生回避の推進', '製造段階における、事業所単位でのCO2など環境負荷物質排出量削減', NULL, 2, NULL, NULL, 0, 0, '期間', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fomula_items`
--

CREATE TABLE `fomula_items` (
`id` int(11) NOT NULL,
  `fomula_id` int(11) DEFAULT NULL,
  `head_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `value` varchar(256) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=964 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fomula_items`
--

-- INSERT INTO `fomula_items` (`id`, `fomula_id`, `head_id`, `created`, `modified`, `deleted`, `value`, `unit_id`) VALUES
-- (816, 7, 1, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '33', NULL),
-- (817, 7, 2, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '32', NULL),
-- (818, 7, 4, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '32', NULL),
-- (819, 7, 5, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '32', NULL),
-- (820, 7, 8, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '32', NULL),
-- (821, 7, 9, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '32', NULL),
-- (822, 7, 11, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '32', NULL),
-- (823, 7, 12, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '32', NULL),
-- (824, 7, 13, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '34', NULL),
-- (825, 7, 14, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '32', NULL),
-- (826, 7, 15, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '32', NULL),
-- (827, 7, 16, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '32', NULL),
-- (828, 7, 17, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '33', NULL),
-- (829, 7, 18, '2016-05-07 05:38:50', '2016-05-07 05:38:50', 0, '100', NULL),
-- (890, 10, 2, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (891, 10, 4, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (892, 10, 5, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (893, 10, 8, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (894, 10, 9, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (895, 10, 11, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (896, 10, 12, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (897, 10, 13, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (898, 10, 14, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (899, 10, 15, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (900, 10, 16, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (901, 10, 17, '2016-05-09 15:01:29', '2016-05-09 15:01:29', 0, NULL, NULL),
-- (914, 11, 2, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (915, 11, 4, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (916, 11, 5, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (917, 11, 8, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (918, 11, 9, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (919, 11, 11, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (920, 11, 12, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (921, 11, 13, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (922, 11, 14, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (923, 11, 15, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (924, 11, 16, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (925, 11, 17, '2016-05-09 15:14:43', '2016-05-09 15:14:43', 0, NULL, NULL),
-- (951, 12, 1, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '32', NULL),
-- (952, 12, 2, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '32', NULL),
-- (953, 12, 4, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '32', NULL),
-- (954, 12, 5, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '34', NULL),
-- (955, 12, 8, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '34', NULL),
-- (956, 12, 9, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '33', NULL),
-- (957, 12, 11, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '32', NULL),
-- (958, 12, 12, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '34', NULL),
-- (959, 12, 13, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '34', NULL),
-- (960, 12, 14, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '32', NULL),
-- (961, 12, 15, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '32', NULL),
-- (962, 12, 16, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '33', NULL),
-- (963, 12, 17, '2016-05-11 11:26:52', '2016-05-11 11:26:52', 0, '32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
`id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `product_name` varchar(256) DEFAULT NULL,
  `model_number` varchar(256) DEFAULT NULL,
  `operator_name` varchar(256) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  `product_comment` mediumtext,
  `product_info_url` mediumtext,
  `sales_date` datetime DEFAULT NULL,
  `operator_department` varchar(256) DEFAULT NULL,
  `operator_tel` varchar(256) DEFAULT NULL,
  `latest_fomula` datetime DEFAULT NULL,
  `published` int(11) DEFAULT '0',
  `operator_email` varchar(256) DEFAULT NULL,
  `published_date` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

-- INSERT INTO `products` (`id`, `company_id`, `type_id`, `product_name`, `model_number`, `operator_name`, `created`, `modified`, `deleted`, `product_comment`, `product_info_url`, `sales_date`, `operator_department`, `operator_tel`, `latest_fomula`, `published`, `operator_email`, `published_date`) VALUES
-- (7, 5, 7, '製品2', 'asdcas', 'yahagi', '2016-05-04 04:31:53', '2016-05-11 10:52:26', '2016-05-22 06:28:38', '&lt;/textarea&gt;&lt;script type=&quot;text/javascript&quot;&gt;alert();&lt;/script&gt;&lt;textarea&gt;', '', '2016-05-26 00:00:00', 'sales', 'tel', '2016-05-01 00:00:00', 1, 'tel', NULL),
-- (8, 5, 11, '製品11243', 'savf-asrfava', '矢作', '2016-05-04 07:10:00', '2016-05-22 09:42:59', NULL, '', 'http://test.com', '2016-05-01 00:00:00', '営業', '', '2016-05-02 00:00:00', 1, '', '2016-05-22 15:41:23'),
-- (11, 5, 2, '製品追加', 'ASD-ASD', '矢作 裕之', '2016-05-04 07:49:54', '2016-05-22 09:43:15', NULL, 'fvasdv adfvadf', '', '2016-05-06 00:00:00', '営業', '0890121', '2016-05-06 00:00:00', 1, 'dcasvafs@sadcas.com', '2016-05-22 18:43:15'),
-- (13, 5, 2, 'seihinn', 'asvasd', 'やはぎ', '2016-05-06 18:37:38', '2016-05-22 06:33:23', NULL, '', '', '2016-05-03 00:00:00', '営業', '080-1121', '2016-05-17 00:00:00', 1, 'fast.com', NULL),
-- (14, 5, NULL, 'test', '', 'afevasfdva', '2016-05-06 10:32:46', '2016-05-07 04:09:27', '2016-05-09 15:14:22', '', '', '2016-05-04 00:00:00', '', '', '0000-00-00 00:00:00', 0, '', NULL),
-- (15, 5, 2, '製品1', 'dsav-afvaf', '矢作', '2016-05-07 05:34:46', '2016-05-07 05:35:54', NULL, 'さゔぁfゔぁf', 'https://google.com', '2016-05-09 00:00:00', '営業', '080-121-121', '2016-05-09 00:00:00', 1, 'yahagi1989@gmail.com', NULL),
-- (16, 5, 1, 'dash', 'cdsac', '', '2016-05-08 17:11:21', '2016-05-22 08:24:07', NULL, 'sゔぁあfsvさ', '', '2016-05-04 00:00:00', '', '', '2016-05-03 00:00:00', 0, '', NULL),
-- (17, 5, NULL, '', '', '', '2016-05-11 10:37:07', '2016-05-11 11:35:34', NULL, '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '', NULL),
-- (18, 5, NULL, '', '', '', '2016-05-22 09:21:10', '2016-05-22 09:39:32', NULL, '', '', '0000-00-00 00:00:00', '', '', '0000-00-00 00:00:00', 0, '', NULL),
-- (19, 5, NULL, '', '', '', '2016-05-28 08:30:09', '2016-05-28 08:30:09', NULL, '', '', NULL, '', '', NULL, 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(256) DEFAULT NULL,
  `fomula` varchar(256) DEFAULT NULL,
  `purpose` varchar(256) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `type_name`, `fomula`, `purpose`, `created`, `modified`, `deleted`) VALUES
(1, '手動弁', NULL, NULL, NULL, NULL, 0),
(2, '調節弁', '空気式', NULL, NULL, NULL, 0),
(3, '調節弁', '電気式', NULL, NULL, NULL, 0),
(4, '調節弁', '油圧式', NULL, NULL, NULL, 0),
(5, '自力式調節弁', NULL, NULL, NULL, NULL, 0),
(6, '電磁弁', NULL, NULL, NULL, NULL, 0),
(7, '安全弁', NULL, NULL, NULL, NULL, 0),
(8, 'スチームトラップ類', NULL, NULL, NULL, NULL, 0),
(9, 'プリーザバルブ', NULL, NULL, NULL, NULL, 0),
(10, '給水栓', '手動式', 'キッチン用', NULL, NULL, 0),
(11, '給水栓', '電気式', 'キッチン用', NULL, NULL, 0),
(12, '給水栓', '手動式', '洗面用', NULL, NULL, 0),
(13, '給水栓', '電気式', '洗面用', NULL, NULL, 0),
(14, '給水栓', '手動式', 'バス用', NULL, NULL, 0),
(15, '給水栓', '電気式', 'バス用', NULL, NULL, 0),
(16, '給水栓', '手動式', 'その他', NULL, NULL, 0),
(17, '止水栓', NULL, NULL, NULL, NULL, 0),
(18, '分水栓', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `category` varchar(256) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `category`, `name`, `created`, `modified`, `deleted`) VALUES
(0, NULL, 'その他', NULL, NULL, 0),
(1, '定性値', '－', NULL, NULL, 0),
(2, '重量', 't', NULL, NULL, 0),
(3, '重量', 'CO2t', NULL, NULL, 0),
(4, '重量', 'kg', NULL, NULL, 0),
(5, '重量', 'g', NULL, NULL, 0),
(6, '重量', 'mmg', NULL, NULL, 0),
(7, '容積', '立方m', NULL, NULL, 0),
(8, '容積', '立方cm', NULL, NULL, 0),
(9, '容積', '立方mm', NULL, NULL, 0),
(10, '容積', 'リットル', NULL, NULL, 0),
(11, '容積', 'mmリットル', NULL, NULL, 0),
(12, '容積', 'cc', NULL, NULL, 0),
(13, '空気消費量', 'Nm3', NULL, NULL, 0),
(14, '弁座漏れ量', '定格CV値', NULL, NULL, 0),
(15, '弁座漏れ量', 'リットル/h', NULL, NULL, 0),
(16, '弁座漏れ量', 'mmリットル/min', NULL, NULL, 0),
(17, '面積', '平方km', NULL, NULL, 0),
(18, '面積', '平方m', NULL, NULL, 0),
(19, '面積', '平方cm', NULL, NULL, 0),
(20, '面積', '平方mm', NULL, NULL, 0),
(21, '長さ', 'km', NULL, NULL, 0),
(22, '長さ', 'm', NULL, NULL, 0),
(23, '長さ', 'cm', NULL, NULL, 0),
(24, '長さ', 'mm', NULL, NULL, 0),
(25, '電力量', 'kWh', NULL, NULL, 0),
(26, '電力量', 'Wh', NULL, NULL, 0),
(27, '電力量', 'kW', NULL, NULL, 0),
(28, '電力量', 'W', NULL, NULL, 0),
(29, '電力量', 'mW', NULL, NULL, 0),
(30, '数量', '個', NULL, NULL, 0),
(31, '数量', '点', NULL, NULL, 0),
(32, '数量', '回', NULL, NULL, 0),
(33, '数量', '種類', NULL, NULL, 0),
(34, '割合', '%', NULL, NULL, 0),
(35, '時間', '年', NULL, NULL, 0),
(36, '時間', '月', NULL, NULL, 0),
(37, '時間', '日', NULL, NULL, 0),
(38, '時間', '時間', NULL, NULL, 0),
(39, '時間', '分', NULL, NULL, 0),
(40, '時間', '秒', NULL, NULL, 0),
(41, '力', 'N(kg.m/s2）', NULL, NULL, 0),
(42, '圧力', 'kPa', NULL, NULL, 0),
(43, '圧力', 'Pa', NULL, NULL, 0),
(44, '圧力', 'bar', NULL, NULL, 0),
(45, '圧力', 'mbar', NULL, NULL, 0),
(46, '圧力', 'kg/cm2', NULL, NULL, 0),
(47, '圧力', 'mmH2O', NULL, NULL, 0),
(48, '圧力', 'psi', NULL, NULL, 0),
(49, '圧力', 'mmHg', NULL, NULL, 0),
(50, '期間', '1年', NULL, NULL, 0),
(51, '期間', '6ヶ月', NULL, NULL, 0),
(52, '期間', '3ヶ月', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allocations`
--
ALTER TABLE `allocations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allocation_items`
--
ALTER TABLE `allocation_items`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_allocation_items_allocation_id_idx` (`allocation_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_evaluations_product_id_idx` (`product_id`);

--
-- Indexes for table `evaluation_heads`
--
ALTER TABLE `evaluation_heads`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_ evaluation_heads_allocation_id_idx` (`allocation_id`), ADD KEY `fk_evaluation_head_category_idx` (`unit_category`(255));

--
-- Indexes for table `evaluation_items`
--
ALTER TABLE `evaluation_items`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_ evaluation_items_evaluation_id_idx` (`evaluation_id`), ADD KEY `fk_ evaluation_items_head_id_idx` (`head_id`), ADD KEY `fk_ evaluation_items_unit_id_idx` (`unit_id`);

--
-- Indexes for table `fomulas`
--
ALTER TABLE `fomulas`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_fomulas_company_id_idx` (`company_id`);

--
-- Indexes for table `fomula_heads`
--
ALTER TABLE `fomula_heads`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_fomua_heads_allocation_id_idx` (`allocation_id`), ADD KEY `fk_fomua_heads_category_idx` (`unit_category`(255));

--
-- Indexes for table `fomula_items`
--
ALTER TABLE `fomula_items`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_fomula_items_fomula_id_idx` (`fomula_id`), ADD KEY `fk_fomula_items_head_id_idx` (`head_id`), ADD KEY `fk_fomula_items_unit_id_idx` (`unit_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_products_company_id_idx` (`company_id`), ADD KEY `fk_products_type_id_idx` (`type_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_units_category_idx` (`category`(255));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `evaluation_items`
--
ALTER TABLE `evaluation_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=537;
--
-- AUTO_INCREMENT for table `fomulas`
--
ALTER TABLE `fomulas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `fomula_items`
--
ALTER TABLE `fomula_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=964;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocation_items`
--
ALTER TABLE `allocation_items`
ADD CONSTRAINT `fk_allocation_items_allocation_id` FOREIGN KEY (`allocation_id`) REFERENCES `allocations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
ADD CONSTRAINT `fk_evaluations_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation_heads`
--
ALTER TABLE `evaluation_heads`
ADD CONSTRAINT `fk_ evaluation_heads_allocation_id` FOREIGN KEY (`allocation_id`) REFERENCES `allocations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation_items`
--
ALTER TABLE `evaluation_items`
ADD CONSTRAINT `fk_ evaluation_items_evaluation_id` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_ evaluation_items_head_id` FOREIGN KEY (`head_id`) REFERENCES `evaluation_heads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_ evaluation_items_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fomulas`
--
ALTER TABLE `fomulas`
ADD CONSTRAINT `fk_fomulas_company_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fomula_heads`
--
ALTER TABLE `fomula_heads`
ADD CONSTRAINT `fk_fomua_heads_allocation_id` FOREIGN KEY (`allocation_id`) REFERENCES `allocations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fomula_items`
--
ALTER TABLE `fomula_items`
ADD CONSTRAINT `fk_fomula_items_fomula_id` FOREIGN KEY (`fomula_id`) REFERENCES `fomulas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_fomula_items_head_id` FOREIGN KEY (`head_id`) REFERENCES `fomula_heads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_fomula_items_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `fk_products_company_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_products_type_id` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 18, 2016 at 09:17 AM
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
  `deleted` int(11) DEFAULT '0',
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `allocations`
--

INSERT INTO `allocations` (`id`, `allocation_name`, `allocation_type`, `allocation_unit`, `created`, `modified`, `deleted`, `description`) VALUES
(1, '向上率 5%', 1, '%', NULL, NULL, 0, '向上率 5%以上=3 点<br/>2.5%以上5%未満=2 点<br/>0%より大きく 2.5%未満=1 点<br/>0%=0 点<br/> 0%未満=マイナス 1 点 '),
(2, '向上率10%', 1, '%', NULL, NULL, 0, '向上率 10%以上=3 点<br/>5%以上10%未満=2 点<br/>0%より大きく 5%未満=1 点<br/>0%=0 点<br/> 0%未満=マイナス 1 点 '),
(3, '削減率 5%', 2, '%', NULL, NULL, 0, '削減率 5%以上=3 点<br/>2.5%以上5%未満=2 点<br/>0%より大きく 2.5%未満=1 点<br/>0%=0 点<br/> 0%未満=マイナス 1 点 '),
(4, '削減率10%', 2, '%', NULL, NULL, 0, '削減率 10%以上=3 点<br/>5%以上10%未満=2 点<br/>0%より大きく 5%未満=1 点<br/>0%=0 点<br/> 0%未満=マイナス 1 点 '),
(5, 'リサイクルの管理レベル', 0, '特定値', NULL, NULL, 0, 'a=3 点、b=2 点、c=1 点、d=0 点'),
(6, '管理レベル', 0, '特定値', NULL, NULL, 0, 'a=3 点、b=2 点、c=1 点、d=0 点'),
(7, '節湯区分', 0, '特定値', NULL, NULL, 0, 'a=3 点、b=2 点、c=1 点、d=0 点'),
(8, '達成率', 0, '特定値', NULL, NULL, 0, 'a=3 点、b=2 点、c=1 点、d=0 点'),
(9, '有無', 0, '特定値', NULL, NULL, 0, '有=3 点、無=0 点'),
(10, 'しくみ管理レベル', 0, '特定値', NULL, NULL, 0, 'a=3 点、b=2 点、c=1 点、d=0 点');

-- --------------------------------------------------------

--
-- Table structure for table `allocation_items`
--

CREATE TABLE `allocation_items` (
  `id` int(11) NOT NULL,
  `point` int(11) DEFAULT NULL,
  `text` mediumtext,
  `range_max` double DEFAULT NULL,
  `range_min` double DEFAULT NULL,
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
(2, 2, NULL, 5, 2.5, 1, NULL, NULL, 0),
(3, 1, NULL, 2.5, 0, 1, NULL, NULL, 0),
(4, 3, NULL, NULL, 10, 2, NULL, NULL, 0),
(5, 2, NULL, 10, 5, 2, NULL, NULL, 0),
(6, 1, NULL, 5, 0, 2, NULL, NULL, 0),
(7, 3, NULL, NULL, 5, 3, NULL, NULL, 0),
(8, 2, NULL, 5, 2.5, 3, NULL, NULL, 0),
(9, 1, NULL, 2.5, 0, 3, NULL, NULL, 0),
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;


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
(0, '省エネルギー', '燃料・電気・熱', '製品消費エネルギーの低減', '動作時の空気消費量の削減', '製品動作時の空気消費量（定格空気消費量）の削減率', 4, NULL, NULL, 0, 1, '削減率10%', '容積'),
(1, '省エネルギー', '燃料・電気・熱', '製品消費エネルギーの低減', '動作時の消費電力量の削減', '製品の消費電力（定格電力）の削減率', 4, NULL, NULL, 0, 1, '削減率10%', '電力量'),
(2, '省エネルギー', '燃料・電気・熱', '製品消費エネルギーの低減', '待機時の消費電力の削減', '製品待機時の消費電力の削減率', 4, NULL, NULL, 0, 0, '削減率10%', '電力量'),
(3, '省エネルギー', '燃料・電気・熱', '流体エネルギー消費の低減', '節湯機能の有無', '工業会の節湯区分', 7, NULL, NULL, 0, 0, '節湯区分', NULL),
(4, '省エネルギー', '燃料・電気・熱', '製造・組立時のエネルギー消費削減', '生産設備、工程改善、不良率低減による製品製造時のエネルギー消費量の削減', '年間消費電力量（生産ラインもしくは該当工程別）の削減率', 3, NULL, NULL, 0, 0, '・製品評価時に、エネルギー消費削減量を計るときは、母数に、生産台数、売上額などを適宜設定する。・評価対象製品の全製造工程のエネルギー消費量を厳密に測定するのが難しい場合は、事業者で一定の決めを設け、測定対象範囲を限定して評価してもよい（鋳物製造工程に限定する、加工に時間がかかり使用電力が大きい弁体や弁箱等の大きな部品の製造工程に限定する、等）。', '電力量'),
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
) ENGINE=InnoDB AUTO_INCREMENT=621 DEFAULT CHARSET=utf8;


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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=988 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `login_histories`
--

CREATE TABLE `login_histories` (
`id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

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
(2, '調節弁', '電気式', NULL, NULL, NULL, 0),
(3, '調節弁', '空気式', NULL, NULL, NULL, 0),
(4, '調節弁', '油圧式', NULL, NULL, NULL, 0),
(5, '自力式調節弁', NULL, NULL, NULL, NULL, 0),
(6, '電磁弁', NULL, NULL, NULL, NULL, 0),
(7, '安全弁', NULL, NULL, NULL, NULL, 0),
(8, 'スチームトラップ類', NULL, NULL, NULL, NULL, 0),
(9, 'プリーザバルブ', NULL, NULL, NULL, NULL, 0),
(10, '給水栓', '手動式', 'キッチン用', NULL, NULL, 0),
(11, '給水栓', '電気式', 'キッチン用', NULL, NULL, 0),
(12, '給水栓', '手動式', 'バス用', NULL, NULL, 0),
(13, '給水栓', '電気式', 'バス用', NULL, NULL, 0),
(14, '給水栓', '手動式', '洗面用', NULL, NULL, 0),
(15, '給水栓', '電気式', '洗面用', NULL, NULL, 0),
(16, '給水栓', '手動式', 'その他', NULL, NULL, 0),
(17, '止水栓', NULL, NULL, NULL, NULL, 0),
(18, '分水栓', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type_head_relations`
--

CREATE TABLE `type_head_relations` (
`id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `evaluation_head_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=584 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_head_relations`
--

INSERT INTO `type_head_relations` (`id`, `type_id`, `evaluation_head_id`) VALUES
(1, 2, 1),
(2, 6, 1),
(3, 11, 1),
(4, 13, 1),
(5, 15, 1),
(6, 2, 2),
(7, 6, 2),
(8, 11, 2),
(9, 13, 2),
(10, 15, 2),
(11, 10, 3),
(12, 11, 3),
(13, 12, 3),
(14, 13, 3),
(15, 14, 3),
(16, 15, 3),
(17, 16, 3),
(18, 1, 4),
(19, 2, 4),
(20, 3, 4),
(21, 4, 4),
(22, 5, 4),
(23, 6, 4),
(24, 7, 4),
(25, 8, 4),
(26, 9, 4),
(27, 10, 4),
(28, 11, 4),
(29, 12, 4),
(30, 13, 4),
(31, 14, 4),
(32, 15, 4),
(33, 16, 4),
(34, 17, 4),
(35, 18, 4),
(36, 1, 5),
(37, 2, 5),
(38, 3, 5),
(39, 4, 5),
(40, 5, 5),
(41, 6, 5),
(42, 7, 5),
(43, 8, 5),
(44, 9, 5),
(45, 10, 5),
(46, 11, 5),
(47, 12, 5),
(48, 13, 5),
(49, 14, 5),
(50, 15, 5),
(51, 16, 5),
(52, 17, 5),
(53, 18, 5),
(54, 1, 6),
(55, 2, 6),
(56, 3, 6),
(57, 4, 6),
(58, 5, 6),
(59, 6, 6),
(60, 7, 6),
(61, 8, 6),
(62, 9, 6),
(63, 10, 6),
(64, 11, 6),
(65, 12, 6),
(66, 13, 6),
(67, 14, 6),
(68, 15, 6),
(69, 16, 6),
(70, 17, 6),
(71, 18, 6),
(72, 1, 7),
(73, 2, 7),
(74, 3, 7),
(75, 4, 7),
(76, 5, 7),
(77, 6, 7),
(78, 7, 7),
(79, 8, 7),
(80, 9, 7),
(81, 10, 7),
(82, 11, 7),
(83, 12, 7),
(84, 13, 7),
(85, 14, 7),
(86, 15, 7),
(87, 16, 7),
(88, 17, 7),
(89, 18, 7),
(90, 1, 8),
(91, 2, 8),
(92, 3, 8),
(93, 4, 8),
(94, 5, 8),
(95, 6, 8),
(96, 7, 8),
(97, 8, 8),
(98, 9, 8),
(99, 10, 8),
(100, 11, 8),
(101, 12, 8),
(102, 13, 8),
(103, 14, 8),
(104, 15, 8),
(105, 16, 8),
(106, 17, 8),
(107, 18, 8),
(108, 1, 9),
(109, 2, 9),
(110, 3, 9),
(111, 4, 9),
(112, 5, 9),
(113, 6, 9),
(114, 7, 9),
(115, 8, 9),
(116, 9, 9),
(117, 10, 9),
(118, 11, 9),
(119, 12, 9),
(120, 13, 9),
(121, 14, 9),
(122, 15, 9),
(123, 16, 9),
(124, 17, 9),
(125, 18, 9),
(126, 1, 10),
(127, 2, 10),
(128, 3, 10),
(129, 4, 10),
(130, 5, 10),
(131, 6, 10),
(132, 7, 10),
(133, 8, 10),
(134, 9, 10),
(135, 10, 10),
(136, 11, 10),
(137, 12, 10),
(138, 13, 10),
(139, 14, 10),
(140, 15, 10),
(141, 16, 10),
(142, 17, 10),
(143, 18, 10),
(144, 1, 11),
(145, 2, 11),
(146, 3, 11),
(147, 4, 11),
(148, 5, 11),
(149, 6, 11),
(150, 7, 11),
(151, 8, 11),
(152, 9, 11),
(153, 10, 11),
(154, 11, 11),
(155, 12, 11),
(156, 13, 11),
(157, 14, 11),
(158, 15, 11),
(159, 16, 11),
(160, 17, 11),
(161, 18, 11),
(162, 10, 12),
(163, 11, 12),
(164, 12, 12),
(165, 13, 12),
(166, 14, 12),
(167, 15, 12),
(168, 16, 12),
(169, 1, 13),
(170, 2, 13),
(171, 3, 13),
(172, 4, 13),
(173, 5, 13),
(174, 6, 13),
(175, 7, 13),
(176, 8, 13),
(177, 9, 13),
(178, 10, 13),
(179, 11, 13),
(180, 12, 13),
(181, 13, 13),
(182, 14, 13),
(183, 15, 13),
(184, 16, 13),
(185, 17, 13),
(186, 18, 13),
(187, 1, 14),
(188, 2, 14),
(189, 3, 14),
(190, 4, 14),
(191, 5, 14),
(192, 6, 14),
(193, 7, 14),
(194, 8, 14),
(195, 9, 14),
(196, 10, 14),
(197, 11, 14),
(198, 12, 14),
(199, 13, 14),
(200, 14, 14),
(201, 15, 14),
(202, 16, 14),
(203, 17, 14),
(204, 18, 14),
(205, 1, 15),
(206, 2, 15),
(207, 3, 15),
(208, 4, 15),
(209, 5, 15),
(210, 6, 15),
(211, 7, 15),
(212, 8, 15),
(213, 9, 15),
(214, 10, 15),
(215, 11, 15),
(216, 12, 15),
(217, 13, 15),
(218, 14, 15),
(219, 15, 15),
(220, 16, 15),
(221, 17, 15),
(222, 18, 15),
(223, 1, 16),
(224, 2, 16),
(225, 3, 16),
(226, 4, 16),
(227, 5, 16),
(228, 6, 16),
(229, 7, 16),
(230, 8, 16),
(231, 9, 16),
(232, 10, 16),
(233, 11, 16),
(234, 12, 16),
(235, 13, 16),
(236, 14, 16),
(237, 15, 16),
(238, 16, 16),
(239, 17, 16),
(240, 18, 16),
(241, 1, 17),
(242, 2, 17),
(243, 3, 17),
(244, 4, 17),
(245, 5, 17),
(246, 6, 17),
(247, 7, 17),
(248, 8, 17),
(249, 9, 17),
(250, 10, 17),
(251, 11, 17),
(252, 12, 17),
(253, 13, 17),
(254, 14, 17),
(255, 15, 17),
(256, 16, 17),
(257, 17, 17),
(258, 18, 17),
(259, 1, 18),
(260, 2, 18),
(261, 3, 18),
(262, 4, 18),
(263, 5, 18),
(264, 6, 18),
(265, 7, 18),
(266, 8, 18),
(267, 9, 18),
(268, 10, 18),
(269, 11, 18),
(270, 12, 18),
(271, 13, 18),
(272, 14, 18),
(273, 15, 18),
(274, 16, 18),
(275, 17, 18),
(276, 18, 18),
(277, 1, 19),
(278, 2, 19),
(279, 3, 19),
(280, 4, 19),
(281, 5, 19),
(282, 6, 19),
(283, 7, 19),
(284, 8, 19),
(285, 9, 19),
(286, 10, 19),
(287, 11, 19),
(288, 12, 19),
(289, 13, 19),
(290, 14, 19),
(291, 15, 19),
(292, 16, 19),
(293, 17, 19),
(294, 18, 19),
(295, 1, 20),
(296, 2, 20),
(297, 3, 20),
(298, 4, 20),
(299, 5, 20),
(300, 6, 20),
(301, 7, 20),
(302, 8, 20),
(303, 9, 20),
(304, 10, 20),
(305, 11, 20),
(306, 12, 20),
(307, 13, 20),
(308, 14, 20),
(309, 15, 20),
(310, 16, 20),
(311, 17, 20),
(312, 18, 20),
(313, 1, 21),
(314, 2, 21),
(315, 3, 21),
(316, 4, 21),
(317, 5, 21),
(318, 6, 21),
(319, 7, 21),
(320, 8, 21),
(321, 9, 21),
(322, 10, 21),
(323, 11, 21),
(324, 12, 21),
(325, 13, 21),
(326, 14, 21),
(327, 15, 21),
(328, 16, 21),
(329, 17, 21),
(330, 18, 21),
(331, 1, 22),
(332, 2, 22),
(333, 3, 22),
(334, 4, 22),
(335, 5, 22),
(336, 6, 22),
(337, 7, 22),
(338, 8, 22),
(339, 9, 22),
(340, 10, 22),
(341, 11, 22),
(342, 12, 22),
(343, 13, 22),
(344, 14, 22),
(345, 15, 22),
(346, 16, 22),
(347, 17, 22),
(348, 18, 22),
(349, 1, 23),
(350, 2, 23),
(351, 3, 23),
(352, 4, 23),
(353, 5, 23),
(354, 6, 23),
(355, 7, 23),
(356, 8, 23),
(357, 9, 23),
(358, 10, 23),
(359, 11, 23),
(360, 12, 23),
(361, 13, 23),
(362, 14, 23),
(363, 15, 23),
(364, 16, 23),
(365, 17, 23),
(366, 18, 23),
(367, 1, 24),
(368, 2, 24),
(369, 3, 24),
(370, 4, 24),
(371, 5, 24),
(372, 6, 24),
(373, 7, 24),
(374, 8, 24),
(375, 9, 24),
(376, 10, 24),
(377, 11, 24),
(378, 12, 24),
(379, 13, 24),
(380, 14, 24),
(381, 15, 24),
(382, 16, 24),
(383, 17, 24),
(384, 18, 24),
(385, 1, 25),
(386, 2, 25),
(387, 3, 25),
(388, 4, 25),
(389, 5, 25),
(390, 6, 25),
(391, 7, 25),
(392, 8, 25),
(393, 9, 25),
(394, 10, 25),
(395, 11, 25),
(396, 12, 25),
(397, 13, 25),
(398, 14, 25),
(399, 15, 25),
(400, 16, 25),
(401, 17, 25),
(402, 18, 25),
(403, 1, 26),
(404, 2, 26),
(405, 3, 26),
(406, 4, 26),
(407, 5, 26),
(408, 6, 26),
(409, 7, 26),
(410, 8, 26),
(411, 9, 26),
(412, 10, 26),
(413, 11, 26),
(414, 12, 26),
(415, 13, 26),
(416, 14, 26),
(417, 15, 26),
(418, 16, 26),
(419, 17, 26),
(420, 18, 26),
(421, 1, 27),
(422, 2, 27),
(423, 3, 27),
(424, 4, 27),
(425, 5, 27),
(426, 6, 27),
(427, 7, 27),
(428, 8, 27),
(429, 9, 27),
(430, 10, 27),
(431, 11, 27),
(432, 12, 27),
(433, 13, 27),
(434, 14, 27),
(435, 15, 27),
(436, 16, 27),
(437, 17, 27),
(438, 18, 27),
(439, 1, 28),
(440, 2, 28),
(441, 3, 28),
(442, 4, 28),
(443, 5, 28),
(444, 6, 28),
(445, 7, 28),
(446, 8, 28),
(447, 9, 28),
(448, 10, 28),
(449, 11, 28),
(450, 12, 28),
(451, 13, 28),
(452, 14, 28),
(453, 15, 28),
(454, 16, 28),
(455, 17, 28),
(456, 18, 28),
(457, 1, 29),
(458, 2, 29),
(459, 3, 29),
(460, 4, 29),
(461, 5, 29),
(462, 6, 29),
(463, 7, 29),
(464, 8, 29),
(465, 9, 29),
(466, 10, 29),
(467, 11, 29),
(468, 12, 29),
(469, 13, 29),
(470, 14, 29),
(471, 15, 29),
(472, 16, 29),
(473, 17, 29),
(474, 18, 29),
(475, 1, 30),
(476, 2, 30),
(477, 3, 30),
(478, 4, 30),
(479, 5, 30),
(480, 6, 30),
(481, 7, 30),
(482, 8, 30),
(483, 9, 30),
(484, 10, 30),
(485, 11, 30),
(486, 12, 30),
(487, 13, 30),
(488, 14, 30),
(489, 15, 30),
(490, 16, 30),
(491, 17, 30),
(492, 18, 30),
(493, 1, 31),
(494, 2, 31),
(495, 3, 31),
(496, 4, 31),
(497, 5, 31),
(498, 6, 31),
(499, 7, 31),
(500, 8, 31),
(501, 9, 31),
(502, 10, 31),
(503, 11, 31),
(504, 12, 31),
(505, 13, 31),
(506, 14, 31),
(507, 15, 31),
(508, 16, 31),
(509, 17, 31),
(510, 18, 31),
(511, 1, 32),
(512, 2, 32),
(513, 3, 32),
(514, 4, 32),
(515, 5, 32),
(516, 6, 32),
(517, 7, 32),
(518, 8, 32),
(519, 9, 32),
(520, 10, 32),
(521, 11, 32),
(522, 12, 32),
(523, 13, 32),
(524, 14, 32),
(525, 15, 32),
(526, 16, 32),
(527, 17, 32),
(528, 18, 32),
(529, 1, 33),
(530, 2, 33),
(531, 3, 33),
(532, 4, 33),
(533, 5, 33),
(534, 6, 33),
(535, 7, 33),
(536, 8, 33),
(537, 9, 33),
(538, 10, 33),
(539, 11, 33),
(540, 12, 33),
(541, 13, 33),
(542, 14, 33),
(543, 15, 33),
(544, 16, 33),
(545, 17, 33),
(546, 18, 33),
(547, 1, 34),
(548, 2, 34),
(549, 3, 34),
(550, 4, 34),
(551, 5, 34),
(552, 6, 34),
(553, 7, 34),
(554, 8, 34),
(555, 9, 34),
(556, 10, 34),
(557, 11, 34),
(558, 12, 34),
(559, 13, 34),
(560, 14, 34),
(561, 15, 34),
(562, 16, 34),
(563, 17, 34),
(564, 18, 34),
(565, 1, 35),
(566, 2, 35),
(567, 3, 35),
(568, 4, 35),
(569, 5, 35),
(570, 6, 35),
(571, 7, 35),
(572, 8, 35),
(573, 9, 35),
(574, 10, 35),
(575, 11, 35),
(576, 12, 35),
(577, 13, 35),
(578, 14, 35),
(579, 15, 35),
(580, 16, 35),
(581, 17, 35),
(582, 18, 35),
(583, 3, 0);

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
-- Indexes for table `login_histories`
--
ALTER TABLE `login_histories`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_login_histories_company_id_idx` (`company_id`);

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
-- Indexes for table `type_head_relations`
--
ALTER TABLE `type_head_relations`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_type_head_relations_type_id_idx` (`type_id`), ADD KEY `fk_type_head_relations_evaluation_head_id_idx` (`evaluation_head_id`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `evaluation_items`
--
ALTER TABLE `evaluation_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT for table `fomulas`
--
ALTER TABLE `fomulas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `fomula_items`
--
ALTER TABLE `fomula_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT for table `login_histories`
--
ALTER TABLE `login_histories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `type_head_relations`
--
ALTER TABLE `type_head_relations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=584;
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
-- Constraints for table `login_histories`
--
ALTER TABLE `login_histories`
ADD CONSTRAINT `fk_login_histories_company_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
ADD CONSTRAINT `fk_products_company_id` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_products_type_id` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `type_head_relations`
--
ALTER TABLE `type_head_relations`
ADD CONSTRAINT `fk_type_head_relations_evaluation_head_id` FOREIGN KEY (`evaluation_head_id`) REFERENCES `evaluation_heads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_type_head_relations_type_id` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

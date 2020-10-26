-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2018 at 03:01 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proje2`
--

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(10) UNSIGNED NOT NULL,
  `genre_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `genre_name`) VALUES
(1, 'Aile'),
(2, 'Aksiyon'),
(3, 'Animasyon'),
(4, 'Belgesel'),
(5, 'Bilim Kurgu'),
(6, 'Biyografi'),
(7, 'Çizgi Film'),
(8, 'Dans'),
(9, 'Dram'),
(10, 'Fantastik'),
(11, 'Gençlik'),
(12, 'Gerilim'),
(13, 'Gizem'),
(14, 'Hint'),
(15, 'Komedi'),
(16, 'Korku'),
(17, 'Macera'),
(18, 'Müzikal'),
(19, 'Polisiye'),
(20, 'Romantik'),
(21, 'Savaş'),
(22, 'Spor'),
(23, 'Suç'),
(24, 'Tarih');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `location_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`) VALUES
(1, 'Adana'),
(2, 'Adıyaman'),
(3, 'Afyonkarahisar'),
(4, 'Ağrı'),
(5, 'Amasya'),
(6, 'Ankara'),
(7, 'Antalya'),
(8, 'Artvin'),
(9, 'Aydın'),
(10, 'Balıkesir'),
(11, 'Bilecik'),
(12, 'Bingöl'),
(13, 'Bitlis'),
(14, 'Bolu'),
(15, 'Burdur'),
(16, 'Bursa'),
(17, 'Çanakkale'),
(18, 'Çankırı'),
(19, 'Çorum'),
(20, 'Denizli'),
(21, 'Diyarbakır'),
(22, 'Edirne'),
(23, 'Elâzığ'),
(24, 'Erzincan'),
(25, 'Erzurum'),
(26, 'Eskişehir'),
(27, 'Gaziantep'),
(28, 'Giresun'),
(29, 'Gümüşhane'),
(30, 'Hakkâri'),
(31, 'Hatay'),
(32, 'Isparta'),
(33, 'Mersin'),
(34, 'İstanbul'),
(35, 'İzmir'),
(36, 'Kars'),
(37, 'Kastamonu'),
(38, 'Kayseri'),
(39, 'Kırklareli'),
(40, 'Kırşehir'),
(41, 'Kocaeli'),
(42, 'Konya'),
(43, 'Kütahya'),
(44, 'Malatya'),
(45, 'Manisa'),
(46, 'Kahramanmaraş'),
(47, 'Mardin'),
(48, 'Muğla'),
(49, 'Muş'),
(50, 'Nevşehir'),
(51, 'Niğde'),
(52, 'Ordu'),
(53, 'Rize'),
(54, 'Sakarya'),
(55, 'Samsun'),
(56, 'Siirt'),
(57, 'Sinop'),
(58, 'Sivas'),
(59, 'Tekirdağ'),
(60, 'Tokat'),
(61, 'Trabzon'),
(62, 'Tunceli'),
(63, 'Şanlıurfa'),
(64, 'Uşak'),
(65, 'Van'),
(66, 'Yozgat'),
(67, 'Zonguldak'),
(68, 'Aksaray'),
(69, 'Bayburt'),
(70, 'Karaman'),
(71, 'Kırıkkale'),
(72, 'Batman'),
(73, 'Şırnak'),
(74, 'Bartın'),
(75, 'Ardahan'),
(76, 'Iğdır'),
(77, 'Yalova'),
(78, 'Karabük'),
(79, 'Kilis'),
(80, 'Osmaniye'),
(81, 'Düzce'),
(82, 'Adana - ParkAVM');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2018_03_09_123338_create_movies_table', 1),
(9, '2018_03_09_124246_create_showtimes_table', 1),
(10, '2018_03_09_131112_create_reservations_table', 1),
(11, '2018_04_10_170849_create_sales_table', 2),
(12, '2018_04_17_103648_create_prices_table', 3),
(13, '2018_04_17_103811_create_genres_table', 3),
(14, '2018_04_17_103909_create_locations_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(10) UNSIGNED NOT NULL,
  `movie_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `movie_detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `movie_poster` text COLLATE utf8mb4_unicode_ci,
  `movie_genre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `movie_name`, `movie_detail`, `movie_poster`, `movie_genre`, `created_at`, `updated_at`) VALUES
(1, 'The Shawshank Redemption', 'Genç ve başarılı bir bankacı olan Andy Dufresne, karısını ve onun sevgilisini öldürmek suçundan ömür boyu hapse mahkum edilir ve Shawshank hapishanesine gönderilir. Burada başta Red olmak üzere yeni arkadaşlar edinir. Hapishane yaşamını uyum sağlamaya çalışırken diğer yandan da bilgisi ve kültürüyle etrafındaki insanları etkilemeyi başaracaktır.', '4daacf311f844fc3de9dd137e342a802.jpg', '1,2', NULL, '2018-05-25 17:18:51'),
(2, 'The Lord of the Rings: The Return of the King', 'Aragorn, kendi ırkının çağrısına cevap vererek, Orta Dünya’nın bütün kaderi onun elindeyken doğumuyla birlikte ona verilen gücünü kullanabilecek midir? Karanlığın bütün güçleri son savaş için bir araya gelirken Gandalf, Gondor’un yaralı ordusunu toparlamak için hazırlıklara başlar. Gandalf’a gereken destek Rohan Kralı Theoden’den gelir. Thoden, tarihin bu en büyük savaşı için tüm savaşçılarını seferber eder. İçlerinde saklanan Eowyn ve Merry ile birlikte insanlar, tüm cesaretlerine ve ırklarına olan sonsuz bağlılıklarına rağmen Gondor’u kuşatan düşmanların karşısında güçsüzdür. Çok büyük kayıplar vereceklerini bilseler de insanlar Sauron’un dikkatini başka yöne çekerek Yüzük Taşıyıcısı’nın yolculuğunu tamamlamasını sağlamak için hayatlarının en zor savaşında birbirlerine kenetlenirler.', 'eff21b15220e34969f4e00e477bc547e.jpg', '3', NULL, '2018-05-25 17:19:51'),
(3, 'The Dark Knight', 'The Dark Knight\'da, Batman suça karşı savaşını daha da ileriye götürüyor: Teğmen Jim Gordon ve Bölge Savcısı Harvey Dent’in yardımlarıyla, Batman, şehir sokaklarını sarmış olan suç örgütlerinden geriye kalanları temizlemeye girişir. Bu ortaklığın etkili olduğu açıktır, ama ekip kısa süre sonra kendilerini, Joker olarak bilinen ve Gotham şehri sakinlerini daha önce de dehşete boğmuş olan suç dehasının yarattığı karmaşanın ortasında bulurlar.', 'f9fae2cea730f945cc719ebcd87acc58.jpg', '4,5', NULL, '2018-05-25 17:20:09'),
(4, 'The GodFather', 'Sicilya\'dan göç eden Corleone ailesi, Amerika\'da yerleşme çabalarını sürdürürken kendilerine kaba kuvvet kullanmaya kalkan ve yapmaya kalktıkları her işten haraç isteyen bir takım kimliği belirsiz kişilere karşı onlar da kaba kuvvet kullanmaya ve bunda da başarılı olmaya başlayınca kendilerini tahmin bile edemeyecekleri bir yaşantının içinde bulurlar. Bir taraftan son derece katı örf ve aile yaşantısı diğer tarafta ise acımasızca önlerine çıkanları yok etmeye başlayan Corleone ailesi bir müddet sonra Amerika\'nın en korkulan mafya topluluğu haline gelmiştir. Kendileri her ne kadar mafya değil bir aile olduklarını söyleseler de.', '321172339ce83a55cf7e5a3f45d5fde0.jpg', '11,12', NULL, '2018-05-25 17:20:19'),
(5, 'Inception', 'Dom Cobb (Leonardo DiCaprio) çok yetenekli bir hırsızdır. Uzmanlık alanı, zihnin en savunmasız olduğu rüya görme anında, bilinçaltının derinliklerindeki değerli sırları çekip çıkarmak ve onları çalmaktır. Cobb’un bu ender mahareti, onu kurumsal casusluğun tehlikeli yeni dünyasında aranan bir oyuncu yapmıştır. Ancak, aynı zamanda bu durum onu uluslararası bir kaçak yapmış ve sevdiği herşeye malolmuştur. Cobb’a içinde bulunduğu durumdan kurtulmasını sağlayacak bir fırsat sunulur. Ona hayatını geri verebilecek son bir iş; tabi eğer imkansız başlangıçı tamamlayabilirse... Mükemmel soygun yerine, Cobb ve takımındaki profesyoneller bu sefer tam tersini yapmak zorundadır; görevleri bir fikri çalmak değil onu yerleştirmektir. Eğer başarırlarsa, mükemmel suç bu olacaktır. Ama ne dikkatle yapılan planlamalar, ne de uzmanlıkları, onları, her hareketlerini önceden tahmin ettiği anlaşılan tehlikeli düşmanlarına karşı hazırlıklı kılabilir. Bu, gelişini sadece Cobb’un görebildiği bir düşmandır.', 'c00bc31f6d7aa10a28dc11b4c2a1cd7c.jpg', '13,14,15', NULL, '2018-05-25 17:20:32'),
(6, 'Forrest Gump', 'Forrest Gump, zeka seviyesi 75 olan bir erkeğin hayatını ele alıyor. Zeka seviyesi nedeni ile devlet okullarına girmekte bile zorlanan Forrest Gump  zamanla akla mantığa uymayan başarılara imza atıyor. Her ne kadar zeka seviyesi düşük olsa da fiziksel olarak son derece sağlam olan Forrest Gump, zamanla gelişen olaylar zincirinde bizi hayal edemeyeceğimiz bir dünyaya götürüyor.', '2f42a089a4e747b9d4d59e8a2cb441f3.png', '4', NULL, '2018-05-25 17:24:24'),
(7, '12 Angry Men', 'Genç bir adam babasını öldürme suçuyla yargılanmaktadır.12 tane jüri tartışmak için bir odada toplanırlar.Bu jürilerden 11 tanesi çocuğun suçlu olduğunu söyler ama 8. jüri(HENRY FONDA) suçsuz olduğunu söyler.Diğer jüriler ona kararını değiştirmesinde ısrar etmektedir ama tartışmadan kararını değiştirmeyecektir çünkü boş yere masum bir çocuğu ölüme göndermek istememektedir.Sadece bir odada geçen ve sadece konuşma üzerine yapılmış ve klasikler arasına girmiş Sidney Lumet in başyapıtı, sinema tarihinin en önemli filmleri arasında gösterilmektedir.', 'c3c4a283210cd64054d50b0786903eeb.jpg', '5', NULL, '2018-05-25 17:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `price_value` int(11) NOT NULL,
  `price_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `price_value`, `price_name`) VALUES
(5, 10, 'İndirimli'),
(6, 20, 'Öğrenci'),
(7, 30, 'Tam Bilet'),
(8, 5, 'Çocuk'),
(10, 15, 'Promosyon');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `showtime_id` int(10) NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idnumber` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_detail` text COLLATE utf8mb4_unicode_ci,
  `sale` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `showtime_id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idnumber` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `id` int(10) UNSIGNED NOT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `location` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `movie_time` datetime DEFAULT NULL,
  `booking` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user1', 'user1@email.com', '$2y$10$rV8htrI7rqMRXWb//TbOPuFk4AgmYNNmhFn39OrPuySZOrBOYLFGW', NULL, NULL, NULL),
(2, 'admin', 'user2@email.com', '$2y$10$NTZTdDSE/NoodDiQQ5E/4uXlBfpGQWQYS.xpTIcqilLcL0EoROd2C', 'dhDPO6TZR9fOVZw4zE7vBexz6ozuUifVmHdxxK5dK73jKHY2G7TXqhKWxNBQ', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

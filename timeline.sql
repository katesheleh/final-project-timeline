-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2021 at 08:51 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timeline`
--
CREATE DATABASE IF NOT EXISTS timeline;

use timeline;

-- --------------------------------------------------------

--
-- Table structure for table `bets`
--

CREATE TABLE `bets` (
  `id` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `price` decimal(10,0) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `winner` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bets`
--

INSERT INTO `bets` (`id`, `created_date`, `price`, `user_id`, `product_id`, `winner`) VALUES
(10, '2021-12-05 13:50:45', '76', 1, 34, 0),
(11, '2021-12-05 13:51:09', '402', 1, 32, 0),
(12, '2021-12-05 13:51:19', '780', 1, 50, 0),
(13, '2021-12-05 13:51:26', '505', 1, 33, 0),
(14, '2021-12-05 18:21:21', '460', 3, 49, 0),
(15, '2021-12-05 18:21:28', '790', 3, 50, 0),
(16, '2021-12-05 18:22:08', '508', 2, 33, 0),
(17, '2021-12-05 18:22:25', '512', 1, 33, 0),
(18, '2021-12-05 18:22:48', '515', 2, 33, 1),
(19, '2021-12-05 18:23:05', '47', 2, 52, 0),
(20, '2021-12-05 18:23:26', '71', 3, 52, 0),
(21, '2021-12-05 18:23:45', '100', 2, 52, 0),
(22, '2021-12-05 18:50:33', '35', 2, 41, 0),
(23, '2021-12-05 18:50:59', '41', 3, 41, 0),
(24, '2021-12-05 18:51:24', '50', 2, 41, 0),
(25, '2021-12-05 19:16:12', '812', 1, 50, 1),
(26, '2021-12-05 19:20:27', '67', 3, 41, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tech_value` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `tech_value`) VALUES
(1, 'Hogar & Tech', 'hogar'),
(2, 'Deporte', 'deporte'),
(3, 'Música', 'musica'),
(4, 'Arte & Artesanía', 'arte'),
(5, 'Ropa & Calzado', 'ropa'),
(6, 'Muebles', 'muebles');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `init_price` decimal(10,0) UNSIGNED NOT NULL DEFAULT 0,
  `last_price` decimal(10,0) UNSIGNED DEFAULT NULL,
  `expire_date` datetime NOT NULL,
  `rate_value` decimal(10,0) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `winner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_date`, `name`, `description`, `image`, `init_price`, `last_price`, `expire_date`, `rate_value`, `category_id`, `author_id`, `winner_id`) VALUES
(26, '2021-12-05 12:01:12', 'Fjallraven - Foldsack No. 1 Backpack, Fits 15 Laptops', 'Your perfect pack for everyday use and walks in the forest. Stash your laptop (up to 15 inches) in the padded sleeve, your everyday', '81fPKd-2AYL._AC_SL1500_.jpg', '110', NULL, '2022-02-07 00:00:00', '4', 5, 2, NULL),
(27, '2021-12-05 12:02:29', 'Mens Casual Premium Slim Fit T-Shirts', 'Slim-fitting style, contrast raglan long sleeve, three-button henley placket, light weight & soft fabric for breathable and comfortable wearing. And Solid stitched shirts with round neck made for durability and a great fit for casual fashion wear and diehard baseball fans. The Henley style round neckline includes a three-button placket.', '71-3HjGNDUL._AC_SY879._SX._UX._SY._UY_.jpg', '22', NULL, '2022-02-28 00:00:00', '3', 5, 2, NULL),
(28, '2021-12-05 12:03:59', 'Mens Cotton Jacket', 'great outerwear jackets for Spring/Autumn/Winter, suitable for many occasions, such as working, hiking, camping, mountain/rock climbing, cycling, traveling or other outdoors. Good gift choice for you or your family member. A warm hearted love to Father, husband or son in this thanksgiving or Christmas Day.', '71li-ujtlUL._AC_UX679_.jpg', '55', NULL, '2021-12-14 00:00:00', '1', 5, 2, NULL),
(29, '2021-12-05 12:05:06', 'Mens Casual Slim Fit', 'The color could be slightly different between on the screen and in practice. / Please note that body builds vary by person, therefore, detailed size information should be reviewed below on the product description.', '71YXzeOuslL._AC_UY879_.jpg', '16', NULL, '2022-01-13 00:00:00', '9', 5, 2, NULL),
(30, '2021-12-05 12:15:15', 'John Hardy Women\'s Legends Naga Gold & Silver Dragon Station Chain Bracelet', 'From our Legends Collection, the Naga was inspired by the mythical water dragon that protects the ocean\'s pearl. Wear facing inward to be bestowed with love and abundance, or outward for protection.', '71pWzhdJNwL._AC_UL640_QL65_ML3_.jpg', '695', NULL, '2021-12-26 00:00:00', '23', 4, 3, NULL),
(31, '2021-12-05 12:16:22', 'Solid Gold Petite Micropave', 'Satisfaction Guaranteed. Return or exchange any order within 30 days.Designed and sold by Hafeez Center in the United States. Satisfaction Guaranteed. Return or exchange any order within 30 days.', '61sbMiUnoGL._AC_UL640_QL65_ML3_.jpg', '168', NULL, '2022-01-26 00:00:00', '10', 4, 3, NULL),
(32, '2021-12-05 12:17:39', 'White Gold Plated Princess', 'Classic Created Wedding Engagement Solitaire Diamond Promise Ring for Her. \r\nGifts to spoil your love more for Engagement, Wedding, Anniversary, Valentine\'s Day...', '71YAIFU48IL._AC_UL640_QL65_ML3_.jpg', '235', '402', '2022-01-30 00:00:00', '45', 4, 3, NULL),
(33, '2021-12-05 12:19:20', 'Pierced Owl Rose Gold Plated Stainless Steel Double', 'Rose Gold Plated Double Flared Tunnel Plug Earrings. Made of 316L Stainless Steel', '51UDEzMJVpL._AC_UL640_QL65_ML3_.jpg', '500', '515', '2021-12-05 18:52:00', '3', 4, 3, 2),
(34, '2021-12-05 12:21:17', 'WD 2TB Elements Portable External Hard Drive - USB 3.0', 'USB 3.0 and USB 2.0 Compatibility Fast data transfers Improve PC Performance High Capacity;\r\nCompatibility Formatted NTFS for Windows 10, Windows 8.1, Windows 7; \r\nReformatting may be required for other operating systems; Compatibility may vary depending on user’s hardware configuration and operating system', '61IBBVJvSDL._AC_SY879_.jpg', '64', '76', '2022-01-15 00:00:00', '7', 1, 3, NULL),
(35, '2021-12-05 12:22:52', 'SanDisk SSD PLUS 1TB Internal SSD - SATA III 6 Gb/s', 'Easy upgrade for faster boot up, shutdown, application load and response (As compared to 5400 RPM SATA 2.5” hard drive; \r\nBased on published specifications and internal benchmarking tests using PCMark vantage scores) Boosts burst write performance, making it ideal for typical PC workloads The perfect balance of performance and reliability Read/write speeds of up to 535MB/s/450MB/s (Based on internal testing; Performance may vary depending upon drive capacity, host device, OS and application.)', '61U7T1koQqL._AC_SX679_.jpg', '109', NULL, '2022-01-09 00:00:00', '4', 1, 1, NULL),
(36, '2021-12-05 12:24:08', 'Silicon Power 256GB SSD 3D NAND A55 SLC Cache Performance Boost SATA III 2.5', '3D NAND flash are applied to deliver high transfer speeds Remarkable transfer speeds that enable faster bootup and improved overall system performance. \r\nThe advanced SLC Cache Technology allows performance boost and longer lifespan 7mm slim design suitable for Ultrabooks and Ultra-slim notebooks. \r\nSupports TRIM command, Garbage Collection technology, RAID, and ECC (Error Checking & Correction) to provide the optimized performance and enhanced reliability.', '71kWymZ+c+L._AC_SX679_.jpg', '100', NULL, '2021-12-23 00:00:00', '2', 1, 1, NULL),
(37, '2021-12-05 12:25:09', 'WD 4TB Gaming Drive Works with Playstation 4 Portable External Hard Drive', 'Expand your PS4 gaming experience, Play anywhere Fast and easy, setup Sleek design with high capacity, 3-year manufacturer\'s limited warranty', '61mtL65D4cL._AC_SX679_.jpg', '114', NULL, '2021-12-15 00:00:00', '9', 1, 1, NULL),
(38, '2021-12-05 12:26:22', 'Acer SB220Q bi 21.5 inches Full HD (1920 x 1080) IPS Ultra-Thin', '21. 5 inches Full HD (1920 x 1080) widescreen IPS display And Radeon free Sync technology. No compatibility for VESA Mount Refresh Rate: 75Hz - Using HDMI port Zero-frame design | ultra-thin | 4ms response time | IPS panel Aspect ratio - 16: 9. Color Supported - 16. 7 million colors. Brightness - 250 nit Tilt angle -5 degree to 15 degree. Horizontal viewing angle-178 degree. Vertical viewing angle-178 degree 75 hertz', '81QpkIctqPL._AC_SX679_.jpg', '599', NULL, '2022-02-25 00:00:00', '12', 1, 1, NULL),
(39, '2021-12-05 12:27:42', 'Samsung 49-Inch CHG90 144Hz Curved Gaming Monitor (LC49HG90DMNXZA) – Super Ultrawide Screen QLE', '49 INCH SUPER ULTRAWIDE 32:9 CURVED GAMING MONITOR with dual 27 inch screen side by side QUANTUM DOT (QLED) TECHNOLOGY, HDR support and factory calibration provides stunningly realistic and accurate color and contrast 144HZ HIGH REFRESH RATE and 1ms ultra fast response time work to eliminate motion blur, ghosting, and reduce input lag', '81Zt42ioCgL._AC_SX679_.jpg', '1200', NULL, '2021-12-25 00:00:00', '23', 1, 1, NULL),
(40, '2021-12-05 12:28:55', 'BIYLACLESEN Women\'s 3-in-1 Snowboard Jacket Winter Coats', 'Note:The Jackets is US standard size, Please choose size as your usual wear Material: 100% Polyester; Detachable Liner Fabric: Warm Fleece. Detachable Functional Liner: Skin Friendly, Lightweigt and Warm.Stand Collar Liner jacket, keep you warm in cold weather. Zippered Pockets: 2 Zippered Hand Pockets, 2 Zippered Pockets on Chest (enough to keep cards or keys)and 1 Hidden Pocket Inside.Zippered Hand Pockets and Hidden Pocket keep your things secure. Humanized Design: Adjustable and Detachable Hood and Adjustable cuff to prevent the wind and water,for a comfortable fit. 3 in 1 Detachable Design provide more convenience, you can separate the coat and inner as needed, or wear it together. It is suitable for different season and help you adapt to different climates', '51Y5NI-I5jL._AC_UX679_.jpg', '57', NULL, '2022-01-30 00:00:00', '1', 5, 1, NULL),
(41, '2021-12-05 12:29:54', 'Lock and Love Women\'s Removable Hooded Faux Leather Moto Biker Jacket', '100% POLYURETHANE(shell) 100% POLYESTER(lining) 75% POLYESTER 25% COTTON (SWEATER), Faux leather material for style and comfort / 2 pockets of front, 2-For-One Hooded denim style faux leather jacket, Button detail on waist / Detail stitching at sides, HAND WASH ONLY / DO NOT BLEACH / LINE DRY / DO NOT IRON', '81XH0e8fefL._AC_UY879_.jpg', '29', '67', '2021-12-05 19:21:00', '6', 5, 1, 3),
(42, '2021-12-05 12:31:26', 'Rain Jacket Women Windbreaker Striped Climbing Raincoats', 'Lightweight perfet for trip or casual wear---Long sleeve with hooded, adjustable drawstring waist design. Button and zipper front closure raincoat, fully stripes Lined and The Raincoat has 2 side pockets are a good size to hold all kinds of things, it covers the hips, and the hood is generous but doesn\'t overdo it.Attached Cotton Lined Hood with Adjustable Drawstrings give it a real styled look.', '71HblAHs5xL._AC_UY879_-2.jpg', '36', NULL, '2021-12-29 00:00:00', '1', 5, 2, NULL),
(43, '2021-12-05 12:33:13', 'MBJ Women\'s Solid Short Sleeve Boat Neck V', '95% RAYON 5% SPANDEX, Made in USA or Imported, Do Not Bleach, Lightweight fabric with great stretch for comfort, Ribbed on sleeves and neckline / Double stitching on bottom hem', '71z3kpMAYsL._AC_UY879_.jpg', '5', NULL, '2021-12-26 00:00:00', '1', 5, 3, NULL),
(44, '2021-12-05 12:34:01', 'Opna Women\'s Short Sleeve Moisture', '100% Polyester, Machine wash, 100% cationic polyester interlock, Machine Wash & Pre Shrunk for a Great Fit, Lightweight, roomy and highly breathable with moisture wicking fabric which helps to keep moisture away, Soft Lightweight Fabric with comfortable V-neck collar and a slimmer fit, delivers a sleek, more feminine silhouette and Added Comfort', '51eg55uWmdL._AC_UX679_.jpg', '8', NULL, '2022-02-15 00:00:00', '2', 5, 3, NULL),
(45, '2021-12-05 12:34:57', 'DANVOUY Womens T Shirt Casual Cotton Short', '95%Cotton,5%Spandex, Features: Casual, Short Sleeve, Letter Print,V-Neck,Fashion Tees, The fabric is soft and has some stretch., Occasion: Casual/Office/Beach/School/Home/Street. Season: Spring,Summer,Autumn,Winter.', '61pHAEJ4NML._AC_UX679_.jpg', '3', NULL, '2021-12-14 00:00:00', '1', 5, 3, NULL),
(46, '2021-12-05 13:01:22', 'Pesas rusas deportivas de 5 kg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'pexels-photo-221247.jpeg', '34', NULL, '2022-03-04 00:00:00', '2', 2, 3, NULL),
(47, '2021-12-05 13:05:23', 'Raqueta de tenis', 'Tristique facilisi natoque lacinia at porttitor pretium tincidunt pharetra dignissim magna, semper nostra lobortis hac curabitur est vitae et nec enim quisque, class eu mauris sem diam volutpat tempus dis sociosqu. \r\nProin fermentum enim commodo purus semper pharetra laoreet urna habitasse vel venenatis mattis praesent sociis, justo dis augue vehicula rutrum tristique sem pellentesque auctor platea ad quam mauris. \r\nNetus suscipit eu dignissim himenaeos volutpat a nibh cursus augue, proin sem tempor purus mollis ullamcorper urna luctus, cras sollicitudin eget senectus nisl mus lacinia diam.', 'pexels-photo-209977.jpeg', '58', NULL, '2022-01-09 00:00:00', '7', 2, 1, NULL),
(48, '2021-12-05 13:07:46', 'Pelota de fútbol', 'At velit taciti faucibus fringilla aptent vulputate nulla, parturient curae mattis sociosqu duis erat, mi netus sociis id dui est. Dis sagittis vivamus aenean gravida porta turpis cum rhoncus euismod, in parturient libero ridiculus magnis et conubia curabitur phasellus, neque laoreet tempor venenatis cursus pulvinar ornare est. Accumsan imperdiet habitasse laoreet ac sociis feugiat est potenti at, nunc quam dignissim eros class eu quis eleifend, tortor nisi ante nec viverra nullam ullamcorper egestas.\r\n\r\nHabitasse in libero aenean platea pellentesque enim luctus aptent est, ultricies fames augue magnis faucibus eget sociis curae condimentum, nisi eu montes cum vulputate suscipit tristique nibh. Donec tincidunt cubilia eu neque a condimentum molestie vitae, rhoncus ac quis nam at montes mattis, nullam pharetra nec convallis mollis interdum litora. Blandit augue dapibus aliquam primis nullam cursus massa morbi platea inceptos rutrum, pharetra vitae litora proin odio fringilla sem vivamus quis cubilia.\r\n\r\nEros eleifend ligula metus ullamcorper volutpat ac sociosqu lacinia class mi, erat nec leo egestas nisi luctus vel quis tempor, faucibus tellus sodales sem placerat elementum nibh diam quisque. Fermentum nisl purus litora semper cras sociosqu, vestibulum accumsan ut mus quisque luctus phasellus, congue nibh mattis cubilia mollis. Volutpat bibendum sollicitudin et ultricies metus porttitor tortor turpis cras accumsan habitant, aptent nunc id facilisis lacus iaculis magnis in sodales penatibus.', 'the-ball-stadion-football-the-pitch-47730.jpeg', '89', NULL, '2022-01-17 00:00:00', '2', 2, 2, NULL),
(49, '2021-12-05 13:42:55', 'Sofa', 'Habitasse in libero aenean platea pellentesque enim luctus aptent est, ultricies fames augue magnis faucibus eget sociis curae condimentum, nisi eu montes cum vulputate suscipit tristique nibh. Donec tincidunt cubilia eu neque a condimentum molestie vitae, rhoncus ac quis nam at montes mattis, nullam pharetra nec convallis mollis interdum litora. Blandit augue dapibus aliquam primis nullam cursus massa morbi platea inceptos rutrum, pharetra vitae litora proin odio fringilla sem vivamus quis cubilia.\r\n\r\nEros eleifend ligula metus ullamcorper volutpat ac sociosqu lacinia class mi, erat nec leo egestas nisi luctus vel quis tempor, faucibus tellus sodales sem placerat elementum nibh diam quisque. Fermentum nisl purus litora semper cras sociosqu, vestibulum accumsan ut mus quisque luctus phasellus, congue nibh mattis cubilia mollis. Volutpat bibendum sollicitudin et ultricies metus porttitor tortor turpis cras accumsan habitant, aptent nunc id facilisis lacus iaculis magnis in sodales penatibus.', 'pexels-photo-1866149.jpeg', '455', '460', '2022-01-29 00:00:00', '2', 6, 2, NULL),
(50, '2021-12-05 13:44:05', 'Cama 135 X 180', 'Lorem ipsum dolor sit amet consectetur adipiscing elit, dis ad auctor nulla molestie potenti ridiculus, sollicitudin suspendisse sed cras nibh cum. Pulvinar habitant facilisi habitasse id hendrerit netus primis ligula mauris, nulla magnis litora risus egestas aptent cras porta, dui per hac senectus tellus accumsan consequat nunc. Velit neque nec accumsan sapien magna cubilia nisi mattis hendrerit dictumst fames lectus interdum, ornare taciti dis duis facilisi feugiat eget odio blandit arcu montes mus.\r\n\r\nTristique facilisi natoque lacinia at porttitor pretium tincidunt pharetra dignissim magna, semper nostra lobortis hac curabitur est vitae et nec enim quisque, class eu mauris sem diam volutpat tempus dis sociosqu. Proin fermentum enim commodo purus semper pharetra laoreet urna habitasse vel venenatis mattis praesent sociis, justo dis augue vehicula rutrum tristique sem pellentesque auctor platea ad quam mauris. Netus suscipit eu dignissim himenaeos volutpat a nibh cursus augue, proin sem tempor purus mollis ullamcorper urna luctus, cras sollicitudin eget senectus nisl mus lacinia diam.\r\n\r\nAt velit taciti faucibus fringilla aptent vulputate nulla, parturient curae mattis sociosqu duis erat, mi netus sociis id dui est. Dis sagittis vivamus aenean gravida porta turpis cum rhoncus euismod, in parturient libero ridiculus magnis et conubia curabitur phasellus, neque laoreet tempor venenatis cursus pulvinar ornare est. Accumsan imperdiet habitasse laoreet ac sociis feugiat est potenti at, nunc quam dignissim eros class eu quis eleifend, tortor nisi ante nec viverra nullam ullamcorper egestas.', 'pexels-photo-2082087.jpeg', '670', '812', '2021-12-05 19:16:00', '10', 6, 2, 1),
(51, '2021-12-05 13:46:58', 'Mesa con 2 sillas', 'Dignissim quisque ultricies nunc orci sociis aliquam dis tristique, enim convallis cum aptent fames id facilisi venenatis, class cras laoreet hac purus mollis sagittis. Metus ridiculus mus mauris fusce vestibulum nec magnis dictumst, sem dictum ligula nam dapibus porttitor facilisis nisi, eu eleifend risus per maecenas curae pretium. Cras sodales diam ornare lacinia rhoncus nulla bibendum mauris maecenas, congue et dictumst laoreet facilisi gravida integer pretium, per auctor fames hendrerit volutpat eleifend molestie fermentum.\r\n\r\nInterdum nascetur ligula suscipit curabitur ante velit facilisi neque montes, cubilia eget taciti vulputate arcu risus maecenas. Egestas convallis fringilla gravida augue cursus cum mattis mus velit natoque facilisis, non imperdiet per cras nulla leo interdum nam penatibus torquent nostra, lacus lacinia justo nisi id nisl turpis pharetra diam dictumst. Cras tellus nunc massa inceptos viverra cubilia aptent varius commodo enim, erat ullamcorper montes nullam auctor penatibus dapibus ac quam rhoncus, dui duis accumsan id donec cursus a consequat mauris. Luctus est aliquam platea lacinia suscipit montes, dui fames mauris nam molestie ultrices eget, consequat faucibus mus rutrum mollis.\r\n\r\nLitora tincidunt malesuada interdum vivamus eget ridiculus conubia ultricies, etiam habitant vehicula duis nunc consequat. Ullamcorper fermentum pellentesque condimentum aenean suscipit phasellus cursus quisque, arcu vel bibendum ut tristique posuere nostra felis neque, in lobortis egestas platea primis rhoncus dignissim. Hendrerit proin massa pharetra habitant vel habitasse nascetur, urna sem est ullamcorper ante nibh ultricies, senectus potenti magna lacinia dui dapibus.', 'pexels-photo-5411784.jpeg', '376', NULL, '2022-01-29 00:00:00', '8', 6, 3, NULL),
(52, '2021-12-05 13:49:53', 'Micrófono', 'Gravida parturient felis commodo est dignissim potenti tortor fermentum quisque aenean senectus, metus suscipit semper mollis magnis vel non lectus sem viverra, integer mus praesent nascetur id rhoncus phasellus duis aliquam sodales. Semper nisl placerat cras ad felis dis rutrum sodales cubilia, eu dictum inceptos auctor ultricies massa hac aliquet urna tellus, himenaeos quisque lobortis nunc elementum curabitur volutpat sagittis. Venenatis gravida phasellus nibh facilisis leo scelerisque rutrum, egestas condimentum congue laoreet at dapibus eu nullam, placerat netus mus eros ut curae.\r\n\r\nDignissim quisque ultricies nunc orci sociis aliquam dis tristique, enim convallis cum aptent fames id facilisi venenatis, class cras laoreet hac purus mollis sagittis. Metus ridiculus mus mauris fusce vestibulum nec magnis dictumst, sem dictum ligula nam dapibus porttitor facilisis nisi, eu eleifend risus per maecenas curae pretium. Cras sodales diam ornare lacinia rhoncus nulla bibendum mauris maecenas, congue et dictumst laoreet facilisi gravida integer pretium, per auctor fames hendrerit volutpat eleifend molestie fermentum.', 'pexels-photo-144429.jpeg', '23', '100', '2022-03-04 00:00:00', '23', 3, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `registered_date` datetime DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contacts` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `registered_date`, `name`, `email`, `password`, `contacts`) VALUES
(1, '2021-11-21 12:33:52', 'Harry Potter', 'harry.potter@example.com', '$2y$10$Vk8wccVx.J9x/yOx.dccheM0SUOKwOPYvkfe5M8ZvOqOz.jQ/pnpe', 'soy Harry Potter de Callejón Diagon,\r\nMi mobil es 123 123 123.\r\nDisponible todos los días de 8 a 17.'),
(2, '2021-11-21 12:36:26', 'Don Quixote', 'don.quixote@example.com', '$2y$10$4/FZfWLYl/4Oc//fskR5p.9plbsiulR.qraZ139qoyd/mMxLFKJSu', 'soy Don Quixote de la Mancha\r\nmi email es don.quixote@example.com'),
(3, '2021-11-21 12:38:56', 'Bill Gates', 'bill.gates@example.com', '$2y$10$RTLhw4pPu5qd1MJm5d6OxO/VyE37kL4h82iYAwKcsDiG7jmmk.Djq', 'Mi nombre es Bill Gates,\r\nestoy en Washington,\r\nWhatsapp: 354 354 354');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bets`
--
ALTER TABLE `bets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `winner_id` (`author_id`),
  ADD KEY `winner_id_2` (`winner_id`);
ALTER TABLE `products` ADD FULLTEXT KEY `product_ft_search` (`name`,`description`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `contacts` (`contacts`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bets`
--
ALTER TABLE `bets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bets`
--
ALTER TABLE `bets`
  ADD CONSTRAINT `bets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bets_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`winner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2019 at 02:06 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_username` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL,
  `admin_password` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL,
  `admin_role` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_username`, `admin_password`, `admin_role`) VALUES
('fpt', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'Gucci'),
(2, 'Amazon'),
(3, 'Canopy'),
(4, 'Lonson'),
(5, 'Banuce'),
(6, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_username` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL,
  `customer_password` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL,
  `customer_name` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `customer_email` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `customer_mobile` varchar(20) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `customer_status` tinyint(4) DEFAULT NULL,
  `customer_gender` tinyint(4) NOT NULL,
  `customer_dob` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `created_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_username`, `customer_password`, `customer_name`, `customer_email`, `customer_mobile`, `customer_status`, `customer_gender`, `customer_dob`, `created_date`) VALUES
('cuvip', 'anhemtoi517544', 'mai anh vu', 'jasoncowboy2@gmail.com', '912312321', 1, 0, '24-july-1995', '2019-08-21 08:05:41'),
('dashi', 'anhemtoi', 'dashishoyu', 'dashishoyu@gmail.com', '982283949', 1, 1, '2019-08-15', '2019-08-23 01:30:28'),
('jasoncowboy', 'anhemtoi', 'cuvip', 'jasoncowboy2@gmail.com', '2147483647', 1, 0, '24-july-1995', '2019-08-21 08:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `order_id` int(11) NOT NULL,
  `customer_username` varchar(30) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `customer_email` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `customer_tel` int(11) DEFAULT NULL,
  `order_status` varchar(15) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `payment_method` varchar(5) COLLATE utf8_vietnamese_ci NOT NULL,
  `delivery_address` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `delivery_note` varchar(255) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `customer_username` varchar(30) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `telephone` int(11) DEFAULT NULL,
  `feedback_details` varchar(300) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `reply_status` varchar(55) COLLATE utf8_vietnamese_ci NOT NULL DEFAULT 'not yet',
  `admin_id_reply` varchar(30) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `reply_detail` varchar(1000) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `reply_date` varchar(30) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `customer_username`, `email`, `telephone`, `feedback_details`, `reply_status`, `admin_id_reply`, `reply_detail`, `reply_date`) VALUES
(1, NULL, 'jasoncowboy2@gmail.com', NULL, 'Feedback', 'not yet', 'fpt', 'Thank you so much!', '2019-09-15'),
(3, NULL, 'cuvip517544@gmail.com', NULL, 'Feedback from cuvip', 'not yet', 'fpt', 'fdsafsafdsafa', '2019-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_id`, `prod_id`, `quantity`) VALUES
(2, 4, 1),
(3, 4, 1),
(4, 1, 3),
(4, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `prod_price` float NOT NULL,
  `prod_description` varchar(1000) COLLATE utf8_vietnamese_ci NOT NULL,
  `image` varchar(20) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `image_2` varchar(20) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `image_3` varchar(20) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `image_4` varchar(20) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_gender` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `product_category` varchar(10) COLLATE utf8_vietnamese_ci NOT NULL,
  `brand_id` int(11) NOT NULL,
  `material` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `detail` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `detail_size` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `strap_material` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `strap_length` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `zip_type` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `slot_num` varchar(50) COLLATE utf8_vietnamese_ci DEFAULT NULL,
  `simple_size` int(11) NOT NULL,
  `style` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_price`, `prod_description`, `image`, `image_2`, `image_3`, `image_4`, `quantity`, `product_gender`, `product_category`, `brand_id`, `material`, `detail`, `detail_size`, `strap_material`, `strap_length`, `zip_type`, `slot_num`, `simple_size`, `style`) VALUES
(1, 'Gucci Oak Leather Backpack', 400, 'Oak Leathers Bags stands for a centuries-old tradition of knowledge, ingenuity and culture. The ‘city of dreaming spires’ is considered to be the prototypical university city. But how becomes a bag a similar icon for its category. The Oak Leather Bags combines the cultural ambitions of her spiritual hometown, with the traditional art of leather craft to create the perfect companion for every lifestyle. No matter if you are on a scientific mission, if you want to become the next contemporary poet or if your only wish is to have a well organised bag with a stylish look – with the Oak Leather Bags you’re well-equipped to be up for every adventure.\r\n', 'product 1 (1).jpg', 'product 1 (2).jpg', 'product 1 (3).jpg', 'product 1 (4).jpg', 12, 'men', 'handbag', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, 'AmazonBasics Canvas Duffel Bag', 100, 'Product Dimensions: 20.7 x 16.1 x 8.5 inches.\r\nShipping Weight: 4.05 pounds.\r\nThe duffel bag provides two loop handles for lifting or moving the bag, and its heavy-duty shoulder strap allows for comfortably carrying it over one shoulder. Even more, the duffel bag comes with interior and exterior pockets for keeping smaller items neatly organized and easily accessible.', 'product 2 (1).jpg', 'product 2 (2).jpg', 'product 2 (3).jpg', 'product 2 (4).jpg', 15, 'men', 'backpack', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(3, 'Victorian style Handbag', 350, 'This is a stylish messenger bag, perfect for both women and men.It is specially made to carry a 15.6 inch laptops,its vintage leather look, and the water resistant waxed canvas. You can adjust the length of the bag to convert it to a cross-body bag, shoulder bag or remove the straps completely to use it as a briefcase.\r\n', 'product 3 (1).jpg', 'product 3 (2).jpg', 'product 3 (3).jpg', 'product 3 (4).jpg', 25, 'men', 'handbag', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(4, 'Oak Leathers Bags', 120, 'Leather Crossbody Purses and Handbags for Women-Premium Crossover Bag Over The Shoulder Womens. Oak Leathers Bags stands for a centuries-old tradition of knowledge, ingenuity and culture. The ‘city of dreaming spires’ is considered to be the prototypical university city. But how becomes a bag a similar icon for its category. The Oak Leather Bags combines the cultural ambitions of her spiritual hometown, with the traditional art of leather craft to create the perfect companion for every lifestyle. No matter if you are on a scientific mission, if you want to become the next contemporary poet or if your only wish is to have a well organised bag with a stylish look – with the Oak Leather Bags you’re well-equipped to be up for every adventure.\r\n', 'product 4 (1).jpg', 'product 4 (2).jpg', 'product 4 (3).jpg', 'product 4 (4).jpg', 10, 'women', 'handbag', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(5, 'The Lovely Tote Co', 121, 'The Lovely Tote Co. Women\'s Straw Crossbody Bag Woven Cross Body Bag Shoulder Top Handle Satchel. Enjoy your seaside trip with this cute straw bag! Match it with your floral dresses and straw hat. Top handle. Metal keepers cover handle tabs. Tassel drops on flap. Magnetic closure. Adjustable crossbody strap. Inside zipper pocket. Inside open wall pocket. Branded snap. Please wipe clean only.', 'product 5 (1).jpg', 'product 5 (2).jpg', 'product 5 (3).jpg', 'product 5 (4).jpg', 15, 'women', 'handbag', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(6, 'Solo Backpack', 115, 'Solo Midnight 15.6\" Laptop Backpack, Black. Great design isn\'t just for your clothing - you want to reflect your great sense of style in your accessories, too. Solo bags offer great functionality with cutting edge style. The versatility of the Midnight 15.6” Backpack creates portability while giving the needed storage while you are on the go. Created for those Millennials looking for practicality with modern style.\r\n', 'product 6 (1).jpg', 'product 6 (2).jpg', 'product 6 (3).jpg', 'product  6 (4).jpg', 30, 'unisex', 'backpack', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(7, 'Tzowla Business Laptop Backpack', 130, 'Tzowla Business Laptop Backpack Water Resistant Anti-Theft College Backpack with USB Charging Port and Lock 15.6 Inch Computer Backpacks for Women Men, Casual Hiking Travel Daypack (A-Black). Multiple divider pockets, easy for holding 15.6 Inches laptop, water bottle, readers and a bunch of other items, iPad, journal, pens and pencils, iPhone.\r\nLIFE-TIME WARRANTY: Life-time warranty from Tzowla and friendly 24 hours customer service.\r\nCONVENIENT USB&HEADSET PORT DESIGN：USB interface with built-in cable design, great convenience for charging your electronic devices via connecting your own power bank.\r\nANTI-THEFT DESIGN: With Fixed Password Lock and Durable Metal Zippers, it is safe guaranteed for protecting your valuable items inside. No need to worry theft easily opening your backpack when you are travelling or lining up.', 'product 7 (1).jpg', 'product 7 (2).jpg', 'product 7 (3).jpg', 'product 7 (4).jpg', 20, 'unisex', 'backpack', 6, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0),
(8, 'Amazon Basics Backpack', 140, 'AmazonBasics Backpack for Laptops up to 17-inches. Large multi-compartment backpack with a padded sleeve for laptops. Holds up to 17\" notebook computer. Mesh water bottle pockets at side. Organizational compartments for pens, keys, and cell phone. Internal Dimensions: 12\" x 4.5\" x 17.5\" (LxWxH); External dimensions: 15\" x 7\" x 19\" (LxWxH). Large multi-compartment backpack with a padded sleeve for laptops. Mesh water bottle pockets at side. Organizational compartments for pens, keys, and cell phone.\r\n', 'product 8 (1).jpg', 'product 8 (2).jpg', 'product 8 (3).jpg', 'product 8 (4).jpg', 20, 'unisex', 'backpack', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(9, 'Amazon Starter Backpack', 95, 'Starter Backpack a backpack for school, the office, travel, hiking, or the gym. Features comfortable straps, reflective tape, pockets for all of your essentials, and a water bottle sleeve to keep you hydrated. On the move since 1971, Starter is back and ready to play harder than ever. Our Amazon-exclusive collection offers T-shirts, sweatshirts, and sweatpants for Men, Women, and Kids. Just look for the star on our soft-as-ever hoodies, performance tops, leggings, and more. From the field to the stands, everyone dreams of being a Starter.\r\n', 'product 9 (1).jpg', 'product 9 (2).jpg', 'product 9 (3).jpg', 'product 9 (4).jpg', 16, 'unisex', 'backpack', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(10, 'Cabin Max️ Metz Backpack', 250, 'Cabin Max️ Metz Backpack for Men and Women Flight Approved Carry On Luggage Bag Massive 44 Litre Travel Hand Luggage 22x14x9 - Perfectly Sized for Southwest Airlines and Many More! (black slate). The Original and best Cabin Max flight backpack - The Metz 44 liter carry on luggage is a flight approved hand luggage designed to make the most of your maximum hand luggage allowance. High strength composite recyclable polyester backpack with padded ergonomic back padding design. Your Metz has 3 main zipped compartments to give you the maximum amount of freedom when packing for your trip, organizational compartment with numerous pockets and zipped compartments. ', 'product 10 (1).jpg', 'product 10 (2).jpg', 'product 10 (3).jpg', 'product 10 (4).jpg', 22, 'unisex', 'backpack', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(11, 'The North Face Borealis Backpack.', 150, 'The North Face Borealis Backpack. Product Dimensions: 19.8 x 13.5 x 8.5 inches. Shipping Weight: 2 pounds. Nylon fabric defends your goods against weather and abrasions, and reflective accents on every side of the bag give you nighttime visibility. Renovated 28-liter backpack with easy access to pockets and overhauled suspension system. Padded and raised laptop compartment inside main pocket protects your 15 or smaller laptop and is checkpoint friendly. FlexVent system offers maximum support and ventilation on padded mesh back panel and shoulder straps.\r\n', 'product 11 (1).jpg', 'product 11 (2).jpg', 'product 11 (3).jpg', 'product 11 (4).jpg', 30, 'unisex', 'backpack', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(12, 'CANOPY VERDE Womens backpack', 300, 'Designed in Brooklyn, Canopy Verde handbags combine minimalist design with thoughtful details. Available in olive green/espresso, navy/black, tweed/black. Check out the rest of our collection!\r\nOUR TOPSELLER - Two bags in one! Wear it as a tote or backpack. Easily fits laptop, magazines, change of clothing, diapers, and more.\r\n17”H x 14.5”W x 4.5”D (14\"H folded over) with 8.5” handle drop. Works best for laptops and computers 14\" or smaller.\r\nWELL DESIGNED INTERIOR - bright orange lining helps you quickly find whatever you need, plus lots of pockets for sunglasses, phone, valuables, etc.\r\nDELIGHTFUL DETAILS - backpack straps can be tucked away in back sleeve, back pocket with hidden magnet, wood zip pullers\r\nECO & VEGAN - organic cotton canvas and eco-friendly dyes as certified by the Global Organic Textile Standard (GOTS), supple vegan leather', 'product 12 (1).jpg', 'product 12 (2).jpg', 'product 12 (3).jpg', 'product 12 (4).jpg', 20, 'women', 'backpack', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_rating`
--

CREATE TABLE `product_rating` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_id` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `rating_content` varchar(1000) COLLATE utf8_vietnamese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `product_rating`
--

INSERT INTO `product_rating` (`id`, `product_id`, `customer_id`, `rating`, `rating_content`) VALUES
(3, 2, 'dashi', 4, 'This product is really good');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_username`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_username`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_username` (`customer_username`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `customer_username` (`customer_username`),
  ADD KEY `admin_id_reply` (`admin_id_reply`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_id`,`prod_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `product_rating`
--
ALTER TABLE `product_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_rating`
--
ALTER TABLE `product_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customer` (`customer_username`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`customer_username`) REFERENCES `customer` (`customer_username`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`admin_id_reply`) REFERENCES `admin` (`admin_username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

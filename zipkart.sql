-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 25, 2023 at 01:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zipkart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$3LB22XT7pkNc.jBKu6dVJO2OYmZV1T6Lo4tsf.r1MSk0maWmZYCKK'),
(2, 'admin1', 'admin1@gmail.com', '$2y$10$v1MPOn0/U0d5RYEZsHNwrejOmgcmi2DYxedB/aVkjV1ItpSXfenoS');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Nike'),
(2, 'Puma'),
(3, 'Apple'),
(4, 'Dell'),
(5, 'Samsung'),
(7, 'Generic'),
(8, 'Boat');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Grocery'),
(2, 'Fashion'),
(3, 'Clearance sale'),
(4, 'Heavy discounts'),
(5, 'Smartphones'),
(6, 'Smartwatches'),
(7, 'Personal hygiene'),
(8, 'Home decors'),
(9, 'Cooking appliance'),
(10, 'Headphones');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 1, 250121792, '[\"1\",\"10\"]', 3, 'pending'),
(2, 1, 1557148571, '[\"10\"]', 1, 'pending'),
(3, 1, 550511403, '[\"12\"]', 1, 'pending'),
(4, 1, 370674723, '[\"6\"]', 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `date`, `status`) VALUES
(1, 'Puma Unisex Leather Sneakers', 'Product story we celebrate timeless taste that needs no gilding with the bari z. This classic style features a stacked sole and the iconic Puma formstrip to deliver a simple yet powerful statement, perched at the peak of style. ', 'puma,sneakers,shoes', 2, 2, 'sneaker1.jpg', 'sneaker2.jpg', 'sneaker3.jpg', '2399', '2023-08-24 13:11:31', 'true'),
(6, 'New Kellogg’s HERSHEY’S Chocos ', ' A yummy heart-shaped chocolatey crunchy breakfast cereal that makes mornings fun for kids. ', 'chocos,kelloggs,snacks', 1, 7, 'grocery1.jpg', 'grocery2.jpg', 'grocery3.jpg', '210', '2023-08-18 07:53:12', 'true'),
(7, 'Samsung Galaxy M14 5G ', 'Silver color, 6GB, 128GB Storage | 50MP+2MP+2MP Triple camera setup | 13MP front camera\nSuperfast 5G with 13 5G Bands, Exynos 1330 Octa Core 2.4GH 5nm processor with Android 13, One UI Core 5.0, 6000mAH li-ion battery', 'samsung,galaxy,5g', 3, 5, 'clearance1.jpg', 'clearance2.jpg', 'clearance3.jpg', '15990', '2023-08-19 02:18:25', 'true'),
(8, 'Apple iPhone 13 (128GB) - Blue', 'iOS 14, 6.1-inch Super Retina XDR display\nCinematic mode adds shallow depth of field and shifts focus automatically in your videos\nAdvanced dual-camera system with 12MP Wide and Ultra Wide cameras; Smart HDR 4, Night mode, 4K Dolby Vision HDR recording', 'apple,iphone', 5, 3, 'iphone1.jpg', 'iphone2.jpg', 'iphone3.jpg', '59999', '2023-08-19 02:09:48', 'true'),
(10, 'Nike Mens Regular Fit T-Shirt', 'NIKE Sportswear is your lifestyle inspired, soft cotton fabric offer smooth on skin and great breathability that enhance super-comfort feel.\nProduct Dimensions ‏ : ‎ 20 x 20 x 5 cm; 150 Grams\nFit Type: Regular Fit\nColor name: MYSTIC GREEN/CORAL STARDUST', 'nike,tshirt,sports', 4, 1, 'tshirt1.jpg', 'tshirt2.jpg', 'tshirt3.jpg', '799', '2023-08-19 02:13:32', 'true'),
(11, 'Samsung Galaxy Watch4 Bluetooth', 'Bioelectrical Impedance Analysis Sensor for Body Composition Analysis, Optical Heart Rate Sensor.\nAdvanced Sleep Analysis. Enhanced Fitness tracking lets you track 90+ workouts; Enriched App availability and connectivity with Wear OS. ', 'smartwatch,samsung,galaxy', 6, 5, 'watch1.jpg', 'watch2.jpg', 'watch3.jpg', '11990', '2023-08-19 02:25:58', 'true'),
(12, 'Dettol Antiseptic Liquid 1000ml', 'Dettol Antiseptic Liquid protects you and your family from 100 illness causing germs. fresh pine fragrance. liquid can be used to protect against infection from cuts and scratches, disinfect toys, and sanitize baby wear leaving everything clean and fresh.', 'dettol,antiseptic', 7, 7, 'dettol1.jpg', 'dettol2.jpg', '12(3).jpg', '297', '2023-08-24 13:16:41', 'true'),
(13, 'Furniture Cafe Wooden Wall Shelves', 'Corner Hanging Shelf for Living Room Stylish | Zig Zag Home Decor Floating Display Rack Storage Organizer Unique Design with Finish 5 Tiers (Brown Finish)', 'shelves,decors', 8, 7, 'decor1.jpg', 'decor2.jpg', 'decor3.jpg', '699', '2023-08-18 09:02:04', 'true'),
(14, 'Samsung 28 L Convection Microwave Oven (MC28A5025VS/TL, Silver, slimfry)', 'Auto Cook, Defrost,Control Panel lock, Racks, Timer, interior Light, Turntable, Crusty Plate, Dough/Proof, Tact control, Silver Dual tone Finish, Multi-Spit, Ceramic Enamel Cavity with 10 year Warranty', 'microwave,over,samsung', 9, 5, 'cooking1.jpg', 'cooking2.jpg', 'cooking3.jpg', '14590', '2023-08-18 09:13:54', 'true'),
(15, 'Dell 14 Laptop, Intel Core i3-1115G4/8GB/512GB/14.0 inches display', 'Model Name: Vostro 3420, Screen Size:14 Inches, Colour: Carbon Black, FHD Display, TUV Rheinland Certified Comfortview Reduce Harmful Blue Light Emissions/Win 11+MSO 21/15 Month McAfee/Carbon Black/1.48kg ', 'dell,laptop,intel', 3, 4, 'laptop1.jpg', 'laptop2.jpg', 'laptop3.jpg', '37990', '2023-08-18 09:20:57', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 1, 3997, 250121792, 3, '2023-08-23 12:52:15', 'Complete'),
(2, 1, 799, 1557148571, 1, '2023-08-22 15:38:29', 'pending'),
(3, 1, 297, 550511403, 1, '2023-08-24 18:39:20', 'Complete');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(255) NOT NULL,
  `order_id` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `date`) VALUES
(1, 1, 250121792, 3997, 'UPI', '2023-08-23 12:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_mobile`) VALUES
(1, 'vishwa1', 'vishwa@gmail.com', '$2y$10$eV4paB2mXWLPStddFUC5SugjdLL1sdos7o/pctKYSydPr1UZRPshC', '94481.jpg', '::1', 'karnataka', '944813'),
(3, 'test3', 'test3@gmail.com', '$2y$10$YpGDHMncJ5iRj/Njbp.DZ.5KFP4aOO/Pbx4tymb/iL/InyKLYxbVO', '980980.jpg', '::1', 'india', '980980');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

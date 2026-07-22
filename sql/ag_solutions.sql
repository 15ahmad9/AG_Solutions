-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2026 at 10:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ag_solutions`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$DtS8A2lgd4U61AZ7q.c9/e90l3B3GIuBu6VUDdfrPnM8D73tsejlm', '2026-05-20 19:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(23, 'Ahmad', 'ahmad@gmail.com', 'sdfgbvfdxhbfxdhbxfdbxfdbgxd', '2026-05-20 20:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` longtext NOT NULL,
  `technologies` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `content`, `technologies`, `created_at`) VALUES
(4, 'Mutadarrib', 'منصة للتدريب المهني تربط المتدربين بجهات التدريب المعتمدة في مختلف التخصصات.', 'منصة “متدرب” هي منصة رقمية للتدريب المهني تهدف إلى ربط الخريجين بجهات تدريب معتمدة في مختلف التخصصات، ضمن مسار واضح يبدأ بإنشاء الحساب وإكمال الملف الشخصي، ثم التقديم على فرص التدريب والمتابعة حتى إتمام البرنامج.', 'php', '2026-05-21 20:05:19'),
(6, 'Fashion Store', 'وجهتك لأحدث الصيحات والأنماط، والتزامك بالأناقة والجودة ورضا العملاء.', 'نواكب أحدث الصيحات والتصاميم العصرية، مع حرصنا الدائم على تقديم أعلى معايير الأناقة والجودة لضمان رضا عملائنا وثقتهم.', '', '2026-05-21 20:14:37'),
(7, 'Health and Medicine Pharmacy', 'نقدّم لك أفضل خدمات وحلول الرعاية الصحية المتكاملة في مدينتك، بجودة موثوقة', 'متخصصون في توفير الأدوية والمستلزمات الطبية ومنتجات العناية الصحية بجودة عالية وأسعار مناسبة، مع الالتزام بتقديم خدمة موثوقة واستشارات تساعد على تعزيز صحة وراحة العملاء.', '', '2026-05-21 20:16:30'),
(8, 'Cinema World', 'تطبيق مجاني لمشاهدة الأفلام والبرامج التلفزيونية عبر الإنترنت بجودة عالية على أي جهاز', 'هل تبحث عن تطبيق لمشاهدة الأفلام مع الأصدقاء والعائلة؟ سينما وورلد هو أفضل تطبيق لمشاهدة الأفلام والمسلسلات التلفزيونية مجاناً. كل ذلك مجاناً وبشكل قانوني.', 'JavaScript (React)', '2026-05-21 20:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `project_images`
--

CREATE TABLE `project_images` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_images`
--

INSERT INTO `project_images` (`id`, `project_id`, `image`) VALUES
(10, 4, 'uploads/1779393919_Mutadarrib.png'),
(12, 6, 'uploads/1779394477_Fashion Store.png'),
(13, 7, 'uploads/1779394590_Health and Medicine Pharmacy.png'),
(14, 8, 'uploads/1779396421_Cinema World.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_images`
--
ALTER TABLE `project_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `project_images`
--
ALTER TABLE `project_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project_images`
--
ALTER TABLE `project_images`
  ADD CONSTRAINT `project_images_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



CREATE TABLE templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    demo_link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE templates
ADD file_path VARCHAR(255) NULL AFTER image;

ALTER TABLE projects ADD website_url VARCHAR(500) DEFAULT NULL;

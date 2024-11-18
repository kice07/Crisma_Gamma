-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 18, 2024 at 04:19 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crismawork`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_id` int NOT NULL,
  `freelancer_id` int NOT NULL,
  `freelancer_cv_id` varchar(255) COLLATE utf8mb4 NOT NULL,
  `date` varchar(10) COLLATE utf8mb4 NOT NULL,
  `state` varchar(60) COLLATE utf8mb4 NOT NULL DEFAULT 'ongoing',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `job_id`, `freelancer_id`, `freelancer_cv_id`, `date`, `state`) VALUES
(5, 7, 816858279, 'EhIv%507-12-2023', '30/05/2024', 'ongoing'),
(6, 12, 736782275, 'Ehouman_Korangui_Web developer', '30/05/2024', 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

DROP TABLE IF EXISTS `calls`;
CREATE TABLE IF NOT EXISTS `calls` (
  `id` varchar(20) COLLATE utf8mb4 NOT NULL,
  `caller_id` int NOT NULL,
  `called_id` int NOT NULL,
  `duration` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4 DEFAULT NULL,
  `date` varchar(12) COLLATE utf8mb4 NOT NULL,
  `hour` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4 NOT NULL,
  `direction` varchar(15) COLLATE utf8mb4 NOT NULL,
  `state` varchar(10) COLLATE utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `calls`
--

INSERT INTO `calls` (`id`, `caller_id`, `called_id`, `duration`, `date`, `hour`, `direction`, `state`) VALUES
('1112223334123456789', 1112223334, 123456789, '30:15', '09/11/2024', '11:05', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:01:05', '09/11/2024', '22:56', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:55', '10/11/2024', '01:07', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '10/11/2024', '20:23', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '10/11/2024', '20:48', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, NULL, '10/11/2024', '21:55', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, NULL, '11/11/2024', '13:22', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '11/11/2024', '15:36', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '11/11/2024', '16:19', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '11/11/2024', '17:25', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '11/11/2024', '17:36', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '11/11/2024', '18:53', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '12/11/2024', '00:35', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '12/11/2024', '01:16', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '12/11/2024', '01:19', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '01:22', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '05:01', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, NULL, '13/11/2024', '05:25', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '05:27', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '05:52', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '06:20', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '11:04', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '13:33', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '13:49', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '13:58', 'sortant', 'missed'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '14:02', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '14:12', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, NULL, '13/11/2024', '14:12', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '14:14', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '14:25', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '14:32', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:00:00', '13/11/2024', '14:53', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:08', '13/11/2024', '15:01', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:09', '13/11/2024', '15:05', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, NULL, '13/11/2024', '15:08', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, NULL, '13/11/2024', '15:09', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, NULL, '13/11/2024', '16:09', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, NULL, '13/11/2024', '16:10', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, '00:27', '13/11/2024', '16:17', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '11:03', '13/11/2024', '16:51', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '01:44', '13/11/2024', '17:05', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, NULL, '13/11/2024', '17:18', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, '00:10', '13/11/2024', '17:22', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, NULL, '13/11/2024', '17:23', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, '00:08', '13/11/2024', '17:42', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:10', '13/11/2024', '18:34', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:11', '13/11/2024', '19:16', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, NULL, '13/11/2024', '19:22', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, NULL, '13/11/2024', '19:25', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, NULL, '13/11/2024', '19:28', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, '00:16', '13/11/2024', '22:51', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:47', '14/11/2024', '00:03', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:28', '14/11/2024', '00:11', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:49', '14/11/2024', '00:48', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:17', '14/11/2024', '13:14', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:24', '14/11/2024', '13:17', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, '00:09', '14/11/2024', '13:44', 'sortant', 'call'),
('1112223334123456789', 1112223334, 123456789, NULL, '16/11/2024', '15:20', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, NULL, '16/11/2024', '15:32', 'sortant', ''),
('1112223334123456789', 1112223334, 123456789, '00:06', '16/11/2024', '16:09', 'sortant', 'call');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4 NOT NULL,
  `email` varchar(80) COLLATE utf8mb4 NOT NULL,
  `token` varchar(30) COLLATE utf8mb4 NOT NULL,
  `pass` text COLLATE utf8mb4 NOT NULL,
  `status` varchar(255) COLLATE utf8mb4 NOT NULL,
  `picture` text COLLATE utf8mb4,
  `language` varchar(10) COLLATE utf8mb4 NOT NULL DEFAULT 'fr',
  `location` varchar(50) COLLATE utf8mb4 DEFAULT NULL,
  `employe` varchar(255) COLLATE utf8mb4 NOT NULL,
  `detail` text COLLATE utf8mb4,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1404511237 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `token`, `pass`, `status`, `picture`, `language`, `location`, `employe`, `detail`) VALUES
(6, 'Pigier', 'mariekg1508@gmail.com', '', '$2y$12$.lBHaiKD7vnomy7a2kfh9eoY5hZXIM1iK2c9UDUl96M0nKfu1s9om', 'online', '170153238013453081-modele-de-logo-de-football-de-ville-vecteur-de-conception-de-logo-de-ville-de-football-vectoriel.jpg', 'en', 'Boston', '3000', NULL),
(600628041, 'Guy Serge', 'christ.ehouman07@gmail.com', '', '0baf02df25ef4038519a60a4a9dc6883', 'En ligne', '170153252312000361-symbole-du-logo-du-trophee-de-football-de-la-coupe-d-afrique-peut-cameroun-2021-illustrationle-de-conception-gratuit-vectoriel.jpg', '', NULL, '40000', NULL),
(1112223334, 'ULRCO', 'christivan.antiquesmall@gmail.com ', '1112223334', '$2y$10$I7KRnklOK03PO2oV8GKhWu7a7xvn5ZHe9mXf8iQQ7.Z8.fFaYtuca', 'online', 'coupe.jpg', 'fr', 'Sudbury', '15000', NULL),
(1276811152, 'Kice_Corp', 'kice.corp@gmail.com', '', '$2y$10$DC7aU9s6FOUw6FtBtVwWN.VdNe1z1ppiK7P1rFRiOno6/Xep9TFS2', 'online', 'girly.jpg', 'en', NULL, '50000', NULL),
(1404511236, 'OCP', 'ivanehouman5@gmail.com', '', '$2y$10$OD3NMgjXG.j3AKuDKZy0qu/p5ZMjJwrt/iFjG5JYeGeOhWaa/d02.', 'online', 'ivan.jpg', 'fr', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contrat`
--

DROP TABLE IF EXISTS `contrat`;
CREATE TABLE IF NOT EXISTS `contrat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `free_id` int NOT NULL,
  `comp_id` int NOT NULL,
  `resume_id` varchar(60) COLLATE utf8mb4 NOT NULL,
  `job_id` int NOT NULL,
  `date` varchar(16) COLLATE utf8mb4 NOT NULL,
  `ending` varchar(10) COLLATE utf8mb4 NOT NULL,
  `state` varchar(15) COLLATE utf8mb4 NOT NULL DEFAULT 'en cours',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `contrat`
--

INSERT INTO `contrat` (`id`, `free_id`, `comp_id`, `resume_id`, `job_id`, `date`, `ending`, `state`) VALUES
(1, 736782275, 1404511236, 'Ehouman_Korangui_UX/UI design', 12, '31/05/2024', '31/12/2024', 'en cours');

-- --------------------------------------------------------

--
-- Table structure for table `freelancer`
--

DROP TABLE IF EXISTS `freelancer`;
CREATE TABLE IF NOT EXISTS `freelancer` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4 NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4 NOT NULL,
  `age` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4 NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4 DEFAULT NULL,
  `password` text COLLATE utf8mb4 NOT NULL,
  `image` varchar(255) COLLATE utf8mb4 NOT NULL DEFAULT 'no_user.jpg',
  `status` varchar(255) COLLATE utf8mb4 NOT NULL,
  `langage` varchar(8) COLLATE utf8mb4 NOT NULL DEFAULT 'français',
  `rate` float DEFAULT NULL,
  `plan` varchar(10) COLLATE utf8mb4 DEFAULT NULL,
  `availability` varchar(60) COLLATE utf8mb4 NOT NULL,
  `token` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `freelancer`
--

INSERT INTO `freelancer` (`id`, `nom`, `prenom`, `age`, `email`, `pays`, `password`, `image`, `status`, `langage`, `rate`, `plan`, `availability`, `token`) VALUES
(736782275, 'Ehouman', 'Korangui', 20, 'ivanehouman5@gmail.com', 'Ghana', '$2y$10$DQGDcnEJwrvpj1xyqHWU4eXgbhh/4G7WD6Z1MqosfRrsQZqKRh4US', 'Settings-pana.png', 'En ligne', 'français', NULL, NULL, 'temps plein', 0),
(816858279, 'Ehouman', 'Ivan', 19, 'mariekg1508@gmail.com', 'Canada', '0baf02df25ef4038519a60a4a9dc6883', '170153252312000361-symbole-du-logo-du-trophee-de-football-de-la-coupe-d-afrique-peut-cameroun-2021-illustrationle-de-conception-gratuit-vectoriel.jpg', 'En ligne', 'en', NULL, NULL, 'temps partiel', 0),
(123456789, 'AAAA', 'BBBB', 21, 'kice.corp@gmail.com', 'France', '$2y$10$ADGPCE8nksmll5.7.GYcjuFII2QMQLiMRjpZ7Z.f0WdqpfCARk.I2', 'no_user.png', 'online', 'français', NULL, NULL, '', 123456789);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE utf8mb4 NOT NULL,
  `job_category` varchar(255) COLLATE utf8mb4 NOT NULL,
  `job_sub_category` varchar(60) COLLATE utf8mb4 NOT NULL,
  `content` text COLLATE utf8mb4 NOT NULL,
  `currency` varchar(60) COLLATE utf8mb4 NOT NULL,
  `salary` double UNSIGNED NOT NULL,
  `job_type` varchar(15) COLLATE utf8mb4 NOT NULL,
  `skills` text COLLATE utf8mb4 NOT NULL,
  `experience` varchar(20) COLLATE utf8mb4 NOT NULL,
  `post_date` varchar(20) COLLATE utf8mb4 NOT NULL,
  `expire_date` varchar(20) COLLATE utf8mb4 NOT NULL,
  `frequence` varchar(20) COLLATE utf8mb4 DEFAULT NULL,
  `applicants` int NOT NULL,
  `company_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `job_category`, `job_sub_category`, `content`, `currency`, `salary`, `job_type`, `skills`, `experience`, `post_date`, `expire_date`, `frequence`, `applicants`, `company_id`) VALUES
(7, 'Web development', 'Developpement Mobile', 'Programmation et Code', 'papapapapapapapapap', 'USD', 777.56, 'contrat', 'html css react', '2 ans', '31/05/2024', '31/07/2024', 'Par mois', 0, 600628041),
(8, 'Flutter', 'Developpement Mobile', 'Programmation et Code', 'En tant qu\'ingénieur en Intelligence Artificielle (IA), vous serez responsable de concevoir, développer et mettre en œuvre des solutions innovantes basées sur l\'IA pour résoudre des problèmes complexes dans divers domaines. Vous travaillerez en étroite collaboration avec une équipe multidisciplinaire pour comprendre les besoins des clients, analyser les données, développer des modèles d\'apprentissage automatique et déployer des solutions d\'IA à grande échelle.', 'USD', 1000, 'temps plein', 'Figma web_design', '3 ans', '31/05/2024', '31/04/2024', 'Par mois', 0, 600628041),
(9, 'React JS', 'Developpement Mobile', 'Programmation et Code', 'szxjytdkyufkuycgcvyu', 'USD', 123.65, 'temps plein', 'html css react', '2 ans', '30/05/2024', '31/04/2024', 'Par mois', 10, 600628041),
(10, 'un exemple', 'Developpement Mobile', 'Programmation et Code', 'papa c\'est un exemple', ' USD', 25, 'temps plein', 'be a fucking coder', '2 ans', '30/05/2024', '31/08/2024', 'Par mois', 0, 600628041),
(11, 'unexemple', 'Developpement Mobile', 'Programmation et Code', 'JE suis un super heros depuis longtemps', 'Euro', 25, 'temps plein', 'be a fucking coder', '2 ans', '31/05/2024', '31/04/2024', 'Par mois', 0, 600628041),
(12, 'software developer', 'Programmation et Technologie', 'Programmation et Code', '\n                            je suis un enfant <font color=\"#ff0000\">passionnee de dev </font>j\'essaie de nouvelle tech<br>                        ', 'USD', 16655, 'temps plein', 'HTML;CSS;JS;12', '10 ans ', '30/05/2024', '31/04/2024', 'Par mois', 15, 1404511236),
(14, 'Dev Something', 'Programmation et Technologie ', 'Programmation et Code ', '  je suis un enfant', 'USD', 15000, 'contrat', 'HTML;CSS;JS', '7 ans', '24/07/2024', '20/08/2024', 'Par mois', 10, 1404511236);

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

DROP TABLE IF EXISTS `job_category`;
CREATE TABLE IF NOT EXISTS `job_category` (
  `id` varchar(255) COLLATE utf8mb4 NOT NULL,
  `label` varchar(255) COLLATE utf8mb4 NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`id`, `label`, `picture`) VALUES
('ProgTech', 'Programmation et Technologie', 'technology-programming.jpg'),
('RedTrad', 'Redaction et Traduction', 'writing-translation.jpg'),
('MerkDig', 'Marketing digital', 'digital-marketing.jpg'),
('Des', 'Design', 'design.jpg'),
('VidPhoIm', 'Video Photo et Image', 'video-photography.jpg'),
('Bus', 'Business', 'business.jpg'),
('MusAud', 'Musique et Audio', 'music-audio.jpg'),
('VenMarMark', 'ventes de marque marketing\r\n\r\n', 'marketing-branding-sales'),
('SocMed', 'Reseaux sociaux', 'social-media.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `job_sub_category`
--

DROP TABLE IF EXISTS `job_sub_category`;
CREATE TABLE IF NOT EXISTS `job_sub_category` (
  `id` varchar(255) COLLATE utf8mb4 NOT NULL,
  `label` varchar(255) COLLATE utf8mb4 NOT NULL,
  `big_cat_id` varchar(255) COLLATE utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `job_sub_category`
--

INSERT INTO `job_sub_category` (`id`, `label`, `big_cat_id`) VALUES
('CodProg', 'Programmation et Code', 'ProgTech'),
('DaSciAna', 'Data science et analyse', 'ProgTech'),
('DataB', 'Base de données', 'ProgTech'),
('SoMedApp', 'Application réseau social', 'ProgTech'),
('SoftTest', 'Test logiciel', 'ProgTech'),
('MobAppDev', 'Developpement Mobile', 'ProgTech'),
('EmTempDev', 'Developpement de template email', 'ProgTech'),
('SoftTest', 'Test logiciel', 'ProgTech'),
(' CMSDev', 'Developement CMS', 'ProgTech'),
(' eComCMSDevt', 'Developement CMS ecommerce', 'ProgTech'),
(' ERP/CRMDev', 'ERP/CRM Developppement', 'ProgTech'),
('WebDev', 'Developpement Web', 'ProgTech'),
('GameDev', 'Developpement de jeux', 'ProgTech'),
('Trad', 'Traduction', 'RedTrad'),
('ResuCVCovLet', 'CV et cover letter', 'RedTrad'),
('Trans', 'Transcription', 'RedTrad'),
('EcriCreat', 'Ecriture créative', 'RedTrad'),
('ContWrit', 'Ecriture de contenu', 'RedTrad'),
('EcriFant', 'Ecriture fantôme', 'RedTrad'),
('TechWrit', 'Ecriture technique', 'RedTrad'),
('EcriBusi', 'Ecriture d\'entreprise', 'RedTrad'),
('Copy', 'Copywriting', 'RedTrad'),
('ProRead', 'Proofreading', 'RedTrad'),
('ResWrit', 'Ecriture de recherche', 'RedTrad'),
('SEMGooAdPPC', 'SEM, Google Ads & PPC', 'MerkDig'),
('SEO', 'SEO', 'MerkDig'),
('Ads', 'Adsense', 'MerkDig'),
('WebAnal', 'Web Analytics', 'MerkDig'),
('ConvOptim', 'Conversion Optimization', 'MerkDig'),
('GroHack', 'Growth Hacking', 'MerkDig'),
('GraphDes', 'Graphic Design', 'Des'),
('LogoDes', 'Logo Design', 'Des'),
(' Anim', ' Animation', 'Des'),
(' WebDes', ' Web Design', 'Des'),
('CompAidDes', 'Computer-Aided Design (CAD)', 'Des'),
('Cart&Com', 'Cartoon & Comics', 'Des'),
('ProfPhoto', 'Professional Photography', 'VidPholm'),
('Vid', 'Videography', 'VidPhoIm'),
(' Anim', ' Animation', 'VidPholm'),
('Film', ' Filmmaking', 'VidPholm');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int NOT NULL,
  `msg` text COLLATE utf8mb4 NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `type` varchar(255) COLLATE utf8mb4 NOT NULL,
  `path` varchar(255) COLLATE utf8mb4 DEFAULT NULL,
  `size` int DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4 NOT NULL,
  `time` varchar(255) COLLATE utf8mb4 NOT NULL,
  `date` varchar(255) COLLATE utf8mb4 NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `incoming_msg_id`, `msg`, `outgoing_msg_id`, `type`, `path`, `size`, `state`, `time`, `date`) VALUES
(17, 816858279, 'Corrigé devoir 2.pdf', 600628041, 'file', 'admin_dashboard_assets/pdf_sent/company-600628041/600628041_816858279_Corrigé devoir 2.pdf', 390, 'read', '16:42', '15/02/2024'),
(29, 600628041, 'oui bien reçu\r\n', 816858279, 'text', NULL, 0, 'read', '11:34', '17/2/2024'),
(30, 600628041, 'EXPLOITATION.pdf', 816858279, 'file', 'freelancer_dashboard_assets/pdf_sent/freelancer-816858279/816858279_600628041_EXPLOITATION.pdf', 180, 'read', '11:36', '17/2/2024'),
(31, 600628041, 'coucou', 816858279, 'text', NULL, 0, 'read', '11:43', '10/3/2024'),
(32, 600628041, 'EXPLOITATION.pdf', 816858279, 'file', 'freelancer_dashboard_assets/pdf_sent/freelancer-816858279/816858279_600628041_EXPLOITATION.pdf', 180, 'read', '11:43', '10/3/2024'),
(33, 123456789, 'je reçois , je suis un freelancer ', 1112223334, 'text', NULL, NULL, 'read', '23:44', '18/08/2024'),
(34, 816858279, 'je recois , je suis un freelancer', 1112223334, 'text', NULL, NULL, 'read', '23:45', '18/08/2024'),
(35, 736782275, 'une essaie', 1112223334, 'text', NULL, NULL, 'read', '23:56', '18/08/2024'),
(36, 736782275, 'papa', 1112223334, 'text', NULL, NULL, 'read', '17:33', '19/08/2024'),
(37, 736782275, 'papa2', 1112223334, 'text', NULL, NULL, 'read', '17:33', '19/08/2024'),
(38, 736782275, 'papa3', 1112223334, 'text', NULL, NULL, 'read', '18:05', '19/08/2024'),
(39, 816858279, 'j\'essaie', 1112223334, 'text', NULL, NULL, 'read', '22:32', '19/08/2024'),
(40, 123456789, 'j\'essaie2', 1112223334, 'text', NULL, NULL, 'read', '22:33', '19/08/2024'),
(41, 123456789, 'compagnie', 1112223334, 'text', NULL, NULL, 'read', '22:38', '19/08/2024'),
(42, 1112223334, 'reponse', 123456789, 'text', NULL, NULL, 'read', '23:49', '19/08/2024'),
(43, 123456789, 'ah bon', 1112223334, 'text', NULL, NULL, 'read', '23:50', '19/08/2024'),
(44, 1112223334, 'love', 123456789, 'text', NULL, NULL, 'read', '14:53', '20/08/2024'),
(45, 123456789, 'oui', 1112223334, 'text', NULL, NULL, 'read', '14:52', '20/08/2024'),
(46, 1112223334, 'le freelancer', 123456789, 'text', NULL, NULL, 'read', '15:06', '20/08/2024'),
(47, 123456789, 'l\'entreprise', 1112223334, 'text', NULL, NULL, 'read', '15:04', '20/08/2024'),
(48, 123456789, 'essaie', 1112223334, 'text', NULL, NULL, 'read', '15:07', '20/08/2024'),
(49, 123456789, 'essaie entreprise', 1112223334, 'text', NULL, NULL, 'read', '15:07', '20/08/2024'),
(50, 123456789, 'essaie entreorise n 2', 1112223334, 'text', NULL, NULL, 'read', '15:07', '20/08/2024'),
(51, 1112223334, 'envoi1', 123456789, 'text', NULL, NULL, 'read', '17:14', '20/08/2024'),
(52, 123456789, 'reception1', 1112223334, 'text', NULL, NULL, 'read', '17:40', '20/08/2024'),
(53, 1112223334, 'envoi2', 123456789, 'text', NULL, NULL, 'read', '20:25', '20/08/2024'),
(54, 123456789, 'reponse2', 1112223334, 'text', NULL, NULL, 'read', '21:15', '20/08/2024'),
(55, 1112223334, 'envoie3', 123456789, 'text', NULL, NULL, 'read', '21:16', '20/08/2024'),
(56, 123456789, 'reponse3', 1112223334, 'text', NULL, NULL, 'read', '21:34', '20/08/2024'),
(57, 1112223334, 'envoi4', 123456789, 'text', NULL, NULL, 'read', '21:44', '20/08/2024'),
(58, 123456789, 'response4', 1112223334, 'text', NULL, NULL, 'read', '21:44', '20/08/2024'),
(59, 1112223334, 'envoi5', 123456789, 'text', NULL, NULL, 'read', '11:46', '21/08/2024'),
(60, 123456789, 'reponse5', 1112223334, 'text', NULL, NULL, 'read', '11:58', '21/08/2024'),
(61, 1112223334, 'envoi6', 123456789, 'text', NULL, NULL, 'read', '12:02', '21/08/2024'),
(62, 123456789, 'reponse', 1112223334, 'text', NULL, NULL, 'read', '12:54', '21/08/2024'),
(63, 1112223334, 'envoi7', 123456789, 'text', NULL, NULL, 'read', '14:27', '21/08/2024'),
(64, 123456789, 'reponse7', 1112223334, 'text', NULL, NULL, 'read', '14:30', '21/08/2024'),
(65, 1112223334, 'envoi8', 123456789, 'text', NULL, NULL, 'read', '14:50', '21/08/2024'),
(66, 123456789, 'reponse8', 1112223334, 'text', NULL, NULL, 'read', '15:12', '21/08/2024'),
(67, 1112223334, 'envoi9', 123456789, 'text', NULL, NULL, 'read', '15:44', '21/08/2024'),
(68, 123456789, 'reponse9', 1112223334, 'text', NULL, NULL, 'read', '15:46', '21/08/2024'),
(69, 1112223334, 'envoi10', 123456789, 'text', NULL, NULL, 'read', '15:50', '21/08/2024'),
(70, 123456789, 'reponse10', 1112223334, 'text', NULL, NULL, 'read', '15:51', '21/08/2024'),
(71, 1112223334, 'envoi11', 123456789, 'text', NULL, NULL, 'read', '16:04', '21/08/2024'),
(72, 123456789, 'reponse11', 1112223334, 'text', NULL, NULL, 'read', '16:04', '21/08/2024'),
(73, 1112223334, 'envoi12', 123456789, 'text', NULL, NULL, 'read', '23:35', '21/08/2024'),
(74, 0, 'response12', 1112223334, 'text', NULL, NULL, 'unread', '15:08', '23/08/2024'),
(75, 0, 'reponse', 1112223334, 'text', NULL, NULL, 'unread', '15:17', '23/08/2024'),
(76, 0, 'reponse12', 1112223334, 'text', NULL, NULL, 'unread', '16:56', '23/08/2024'),
(77, 123456789, 'reponse12', 1112223334, 'text', NULL, NULL, 'read', '17:08', '23/08/2024'),
(78, 1112223334, 'envoi13', 123456789, 'text', NULL, NULL, 'read', '17:47', '23/08/2024'),
(79, 123456789, 'reponse13', 1112223334, 'text', NULL, NULL, 'read', '19:33', '23/08/2024'),
(80, 1112223334, 'envoi14', 123456789, 'text', NULL, NULL, 'read', '19:40', '23/08/2024'),
(81, 123456789, 'reponse14', 1112223334, 'text', NULL, NULL, 'read', '19:39', '23/08/2024'),
(82, 1112223334, 'envoi15', 123456789, 'text', NULL, NULL, 'read', '23:29', '23/08/2024'),
(83, 123456789, 'reponse15', 1112223334, 'text', NULL, NULL, 'read', '23:29', '23/08/2024'),
(84, 123456789, 'reponse15_2', 1112223334, 'text', NULL, NULL, 'read', '23:29', '23/08/2024'),
(85, 1112223334, 'got you', 123456789, 'text', NULL, NULL, 'read', '23:30', '23/08/2024'),
(86, 123456789, 'bonjour', 1112223334, 'text', NULL, NULL, 'read', '09:31', '24/08/2024'),
(87, 1112223334, 'bonjour mr', 123456789, 'text', NULL, NULL, 'read', '09:31', '24/08/2024'),
(88, 123456789, 'bonjour freelancer', 1112223334, 'text', NULL, NULL, 'read', '15:07', '17/11/2024'),
(89, 1112223334, 'bonojur entreprise', 123456789, 'text', NULL, NULL, 'read', '15:32', '17/11/2024'),
(90, 123456789, 'bonsoir freelancer', 1112223334, 'text', NULL, NULL, 'read', '19:39', '17/11/2024'),
(91, 1112223334, 'bonsoir entreprise', 123456789, 'text', NULL, NULL, 'read', '19:41', '17/11/2024'),
(92, 123456789, 'bonsoir freelancer je dormais ', 1112223334, 'text', NULL, NULL, 'read', '10:13', '18/11/2024'),
(93, 123456789, 'sinon je vais bien', 1112223334, 'text', NULL, NULL, 'read', '11:07', '18/11/2024'),
(94, 1112223334, 'i\'m happy to hear that', 123456789, 'text', NULL, NULL, 'read', '11:11', '18/11/2024'),
(95, 1112223334, 'very happy', 123456789, 'text', NULL, NULL, 'read', '11:17', '18/11/2024');

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

DROP TABLE IF EXISTS `resume`;
CREATE TABLE IF NOT EXISTS `resume` (
  `id` varchar(500) COLLATE utf8mb4 NOT NULL,
  `user_id` int NOT NULL,
  `position` varchar(255) COLLATE utf8mb4 NOT NULL,
  `category` varchar(255) COLLATE utf8mb4 NOT NULL,
  `sous_category` varchar(255) COLLATE utf8mb4 NOT NULL,
  `bio` varchar(255) COLLATE utf8mb4 NOT NULL,
  `date` varchar(15) COLLATE utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `resume`
--

INSERT INTO `resume` (`id`, `user_id`, `position`, `category`, `sous_category`, `bio`, `date`) VALUES
('Ehouman_Ivan_Web dev', 816858279, 'Web dev', 'Pogrammation etTechnologie', 'Developpement Mobile', 'Je suis un passionné de la technologie depuis mon plus jeune âge, et j\'ai toujours été fasciné par la manière dont elle peut améliorer nos vies de manière significative. Avec une formation approfondie en ingénierie logicielle et une expérience professionn', '31/05/2024'),
('Ehouman_Korangui_UX/UI design', 736782275, 'UX/UI design', 'Design', ' Web Design', 'une bion de designer ', '31/05/2024'),
('Ehouman_Korangui_Web developer', 736782275, 'Web developer', 'Programmation et Technologie', 'Programmation et Code', 'je suis une bio comme les autres', '31/05/2024');

-- --------------------------------------------------------

--
-- Table structure for table `resume_education`
--

DROP TABLE IF EXISTS `resume_education`;
CREATE TABLE IF NOT EXISTS `resume_education` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4 NOT NULL,
  `degree` varchar(255) COLLATE utf8mb4 NOT NULL,
  `starting_date` varchar(255) COLLATE utf8mb4 NOT NULL,
  `ending_date` varchar(255) COLLATE utf8mb4 NOT NULL,
  `city` varchar(255) COLLATE utf8mb4 NOT NULL,
  `description` text COLLATE utf8mb4 NOT NULL,
  `resume_id` varchar(255) COLLATE utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `resume_education`
--

INSERT INTO `resume_education` (`id`, `name`, `degree`, `starting_date`, `ending_date`, `city`, `description`, `resume_id`) VALUES
(11, 'Lmigb', 'Bachelor', 'Jan 2024', 'Mar 2024', 'Bassam', 'Je suis un passionné de la technologie depuis mon plus jeune âge, et j\'ai toujours été fasciné par la manière dont elle peut améliorer nos vies de manière significative. Avec une formation approfondie en ingénierie logicielle et une expérience professionn', 'Ehouman_Ivan_Web dev'),
(12, 'Umoncton', 'Master', 'Jan 2024', 'Mar 2024', 'Moncton', 'Je suis un passionné de la technologie depuis mon plus jeune âge, et j\'ai toujours été fasciné par la manière dont elle peut améliorer nos vies de manière significative. Avec une formation approfondie en ingénierie logicielle et une expérience professionn', 'Ehouman_Ivan_Web dev'),
(13, 'UCal', 'paapa\n                            ', 'Janv 2024', 'Fev 2024', 'MOncton', 'paapa\n                            ', 'Ehouman_Korangui_Web developer'),
(14, 'Umoncton', 'mon bachelor\n                            ', 'Janv 2024', 'Mar 2024', 'moncton', 'mon bachelor\n                            ', 'Ehouman_Korangui_UX/UI design');

-- --------------------------------------------------------

--
-- Table structure for table `resume_experience`
--

DROP TABLE IF EXISTS `resume_experience`;
CREATE TABLE IF NOT EXISTS `resume_experience` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(255) COLLATE utf8mb4 NOT NULL,
  `company` varchar(255) COLLATE utf8mb4 NOT NULL,
  `starting_date` varchar(255) COLLATE utf8mb4 NOT NULL,
  `ending_date` varchar(255) COLLATE utf8mb4 NOT NULL,
  `city` varchar(255) COLLATE utf8mb4 NOT NULL,
  `description` varchar(255) COLLATE utf8mb4 NOT NULL,
  `resume_id` varchar(255) COLLATE utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `resume_experience`
--

INSERT INTO `resume_experience` (`id`, `position`, `company`, `starting_date`, `ending_date`, `city`, `description`, `resume_id`) VALUES
(8, 'data analyst', 'Google', 'Jan 2024', 'Mar 2024', 'Moncton', 'Je suis un passionné de la technologie depuis mon plus jeune âge, et j\'ai toujours été fasciné par la manière dont elle peut améliorer nos vies de manière significative. Avec une formation approfondie en ingénierie logicielle et une expérience professionn', 'Ehouman_Ivan_Web dev'),
(9, 'exp2', 'MicroSoft', 'Jan 2024', 'Mar 2024', 'Nash', 'Je suis un passionné de la technologie depuis mon plus jeune âge, et j\'ai toujours été fasciné par la manière dont elle peut améliorer nos vies de manière significative. Avec une formation approfondie en ingénierie logicielle et une expérience professionn', 'Ehouman_Ivan_Web dev'),
(10, 'exp1', 'Google', 'Janv 2024', 'Mar 2024', 'USA', 'exp1D\n                            ', 'Ehouman_Korangui_Web developer'),
(11, 'exp2', 'AMAzon', 'Janv 2024', 'Mar 2024', 'Moncton', 'exp2D\n                            ', 'Ehouman_Korangui_Web developer'),
(12, 'web des', 'Facebook', 'Janv 2024', 'Jui 2024', 'montreal', 'une experience banale\n                            ', 'Ehouman_Korangui_UX/UI design');

-- --------------------------------------------------------

--
-- Table structure for table `resume_language`
--

DROP TABLE IF EXISTS `resume_language`;
CREATE TABLE IF NOT EXISTS `resume_language` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4 NOT NULL,
  `level` varchar(255) COLLATE utf8mb4 NOT NULL,
  `resume_id` varchar(255) COLLATE utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `resume_language`
--

INSERT INTO `resume_language` (`id`, `label`, `level`, `resume_id`) VALUES
(35, 'Francais', 'Fluent(Oral et écrit)', 'Ehouman_Ivan_Web dev'),
(36, 'Anglais', 'Avancé', 'Ehouman_Ivan_Web dev'),
(37, 'Francais', 'Avancé', 'Ehouman_Korangui_Web developer'),
(38, 'Anglais', 'Avancé', 'Ehouman_Korangui_Web developer'),
(39, 'Francais', 'Fluent(Oral et écrit)', 'Ehouman_Korangui_UX/UI design');

-- --------------------------------------------------------

--
-- Table structure for table `resume_skill`
--

DROP TABLE IF EXISTS `resume_skill`;
CREATE TABLE IF NOT EXISTS `resume_skill` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4 NOT NULL,
  `level` varchar(255) COLLATE utf8mb4 NOT NULL,
  `resume_id` varchar(255) COLLATE utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `resume_skill`
--

INSERT INTO `resume_skill` (`id`, `label`, `level`, `resume_id`) VALUES
(19, 'HTML', 'Expert', 'Ehouman_Ivan_Web dev'),
(20, 'Css', 'Competent', 'Ehouman_Ivan_Web dev'),
(21, 'Js\r\n', 'Competent', 'Ehouman_Ivan_Web dev'),
(23, 'HTML', 'Debutant', 'Ehouman_Korangui_Web developer'),
(24, 'CSS', 'Competent', 'Ehouman_Korangui_Web developer'),
(25, 'CSS', 'Experimenté', 'Ehouman_Korangui_UX/UI design');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` varchar(20) COLLATE utf8mb4 NOT NULL,
  `event` varchar(255) COLLATE utf8mb4 NOT NULL,
  `person_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `date`, `event`, `person_id`) VALUES
(55, '24 May 2024', 'une entreprise', 1404511236);

-- --------------------------------------------------------

--
-- Table structure for table `whishlist`
--

DROP TABLE IF EXISTS `whishlist`;
CREATE TABLE IF NOT EXISTS `whishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_id` int NOT NULL,
  `free_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

--
-- Dumping data for table `whishlist`
--

INSERT INTO `whishlist` (`id`, `job_id`, `free_id`) VALUES
(9, 7, 736782275);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

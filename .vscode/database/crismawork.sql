-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 11, 2024 at 02:51 PM
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
  `freelancer_cv_id` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `job_id`, `freelancer_id`, `freelancer_cv_id`) VALUES
(5, 7, 816858279, 'EhIv%507-12-2023');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4  NOT NULL,
  `token` varchar(30) CHARACTER SET utf8mb4  NOT NULL,
  `pass` text CHARACTER SET utf8mb4  NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `picture` text CHARACTER SET utf8mb4 ,
  `location` varchar(50) CHARACTER SET utf8mb4  DEFAULT NULL,
  `employe` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `detail` text CHARACTER SET utf8mb4 ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1329539919 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `email`, `token`, `pass`, `status`, `picture`, `location`, `employe`, `detail`) VALUES
(6, 'Pigier', 'mariekg1508@gmail.com', '78507822d8682b8c62d1', '$2y$12$.lBHaiKD7vnomy7a2kfh9eoY5hZXIM1iK2c9UDUl96M0nKfu1s9om', '', '170153238013453081-modele-de-logo-de-football-de-ville-vecteur-de-conception-de-logo-de-ville-de-football-vectoriel.jpg', NULL, '3000', NULL),
(600628041, 'Guy Serge', 'christ.ehouman07@gmail.com', '', '0baf02df25ef4038519a60a4a9dc6883', 'En ligne', '170153252312000361-symbole-du-logo-du-trophee-de-football-de-la-coupe-d-afrique-peut-cameroun-2021-illustrationle-de-conception-gratuit-vectoriel.jpg', NULL, '40000', NULL),
(1276811152, 'Kice_Corp', 'kice.corp@gmail.com', '', '0baf02df25ef4038519a60a4a9dc6883', 'En ligne', 'girly.jpg', NULL, '50000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer`
--

DROP TABLE IF EXISTS `freelancer`;
CREATE TABLE IF NOT EXISTS `freelancer` (
  `id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `sexe` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `age` int DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `pays` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `ville` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `password` text  NOT NULL,
  `image` text  NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `rate` float DEFAULT NULL,
  `token` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `freelancer`
--

INSERT INTO `freelancer` (`id`, `nom`, `prenom`, `sexe`, `age`, `email`, `pays`, `ville`, `password`, `image`, `status`, `rate`, `token`) VALUES
(736782275, 'Ehouman', 'Korangui', '', NULL, 'ivanehouman5@gmail.com', '', '', '0baf02df25ef4038519a60a4a9dc6883', '1701521508kice.jpg', 'En ligne', NULL, 0),
(816858279, 'Ehouman', 'Ivan', 'homme', 19, 'mariekg1508@gmail.com', 'Canada', 'Moncton', '0baf02df25ef4038519a60a4a9dc6883', '170153252312000361-symbole-du-logo-du-trophee-de-football-de-la-coupe-d-afrique-peut-cameroun-2021-illustrationle-de-conception-gratuit-vectoriel.jpg', 'En ligne', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(60) CHARACTER SET utf8mb4  NOT NULL,
  `job_category` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `content` text CHARACTER SET utf8mb4 NOT NULL,
  `salary_type` varchar(60) CHARACTER SET utf8mb4  NOT NULL,
  `salary_amount` double UNSIGNED NOT NULL,
  `job_type` varchar(15) CHARACTER SET utf8mb4 NOT NULL,
  `skills` text CHARACTER SET utf8mb4  NOT NULL,
  `experience` varchar(20)  NOT NULL,
  `post_date` varchar(20)  NOT NULL,
  `expire_date` varchar(20)  NOT NULL,
  `category` int UNSIGNED NOT NULL,
  `company` int UNSIGNED NOT NULL,
  `role` varchar(15) CHARACTER SET utf8mb4  NOT NULL,
  `frequence` varchar(20) CHARACTER SET utf8mb4  DEFAULT NULL,
  `benefit` varchar(200) CHARACTER SET utf8mb4  DEFAULT NULL,
  `company_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `job_category`, `content`, `salary_type`, `salary_amount`, `job_type`, `skills`, `experience`, `post_date`, `expire_date`, `category`, `company`, `role`, `frequence`, `benefit`, `company_id`) VALUES
(7, 'Web development', 'Developpement Mobile', 'papapapapapapapapap', 'A l\'heure', 777.56, 'Contrat', 'html css react', '2 années', '2023-10-30', '2023-11-10', 1, 1, 'web dev', NULL, 'Transport, Horaire', 600628041),
(8, 'Flutter', 'Developpement Mobile', 'En tant qu\'ingénieur en Intelligence Artificielle (IA), vous serez responsable de concevoir, développer et mettre en œuvre des solutions innovantes basées sur l\'IA pour résoudre des problèmes complexes dans divers domaines. Vous travaillerez en étroite collaboration avec une équipe multidisciplinaire pour comprendre les besoins des clients, analyser les données, développer des modèles d\'apprentissage automatique et déployer des solutions d\'IA à grande échelle.', 'Personnalisé', 1000, 'Temps plein', 'Figma web_design', ' > 3 années', '2023-10-31', '2023-11-11', 1, 1, 'Designer', NULL, 'Materiel', 600628041),
(9, 'React JS', 'Developpement Mobile', 'szxjytdkyufkuycgcvyu', 'A l\'heure', 123.65, 'Temps plein', 'html css react', '2 années', '2023-11-02', '2023-12-08', 1, 1, 'web front', NULL, 'Horaire, Formation', 600628041),
(10, 'un exemple', 'Developpement Mobile', 'papa c\'est un exemple', ' ', 25, 'Temps plein', 'be a fucking coder', '2 années', '2024-02-10', '2024-02-29', 1, 1, 'papapa_dev', NULL, 'Transport, Formation', 600628041),
(11, 'unexemple', 'Developpement Mobile', 'JE suis un super heros depuis longtemps', 'A l\'heure', 25, 'Temps plein', 'be a fucking coder', '2 années', '2024-02-10', '2024-02-23', 1, 1, 'papapa_dev', NULL, 'Voyage, Materiel, Formation', 600628041);

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

DROP TABLE IF EXISTS `job_category`;
CREATE TABLE IF NOT EXISTS `job_category` (
  `id` varchar(255)  NOT NULL,
  `label` varchar(255)  NOT NULL,
  `picture` varchar(255)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `job_category`
--

INSERT INTO `job_category` (`id`, `label`, `picture`) VALUES
('ProgTech', 'Pogrammation etTechnologie', 'technology-programming.jpg'),
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
  `id` varchar(255)  NOT NULL,
  `label` varchar(255)  NOT NULL,
  `big_cat_id` varchar(255)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

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
  `msg` text  NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `type` varchar(255)  NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4  DEFAULT NULL,
  `size` int DEFAULT NULL,
  `state` varchar(255)  NOT NULL,
  `time` varchar(255)  NOT NULL,
  `date` varchar(255)  NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `incoming_msg_id`, `msg`, `outgoing_msg_id`, `type`, `path`, `size`, `state`, `time`, `date`) VALUES
(1, 600628041, 'salut', 816858279, 'text', '', NULL, 'read', '17:02', '13/02/2024'),
(2, 816858279, 'coucou', 600628041, 'text', '', NULL, 'read', '17:03', '13/02/2024'),
(10, 816858279, 'papa', 600628041, 'text', '', 0, 'read', '20:51', '14/02/2024'),
(13, 816858279, 'testing today', 600628041, 'text', '', 0, 'read', '12:46', '15/02/2024'),
(14, 816858279, 'another dm', 600628041, 'text', '', 0, 'read', '12:49', '15/02/2024'),
(15, 816858279, 'FONDEMENT_SYST_EXPLOITATION.pdf', 600628041, 'file', 'admin_dashboard_assets/pdf_sent/company-600628041/600628041_816858279_FONDEMENT_SYST_EXPLOITATION.pdf', 180, 'read', '16:22', '15/02/2024'),
(17, 816858279, 'Corrigé devoir 2.pdf', 600628041, 'file', 'admin_dashboard_assets/pdf_sent/company-600628041/600628041_816858279_Corrigé devoir 2.pdf', 390, 'read', '16:42', '15/02/2024'),
(18, 816858279, 'kiki', 600628041, 'text', NULL, 0, 'read', '20:29', '16/02/2024'),
(19, 816858279, 'encore une fois', 600628041, 'text', NULL, 0, 'read', '20:33', '16/02/2024'),
(20, 816858279, 'again', 600628041, 'text', NULL, 0, 'read', '20:41', '16/02/2024'),
(21, 816858279, 'papa', 600628041, 'text', NULL, 0, 'read', '0:12', '17/2/2024'),
(23, 600628041, 'papa', 816858279, 'text', NULL, 0, 'read', '11:10', '17/2/2024'),
(24, 816858279, 'pourquoi repondre pareil', 600628041, 'text', NULL, 0, 'read', '11:14', '17/2/2024'),
(25, 600628041, 'je sais pas trop', 816858279, 'text', NULL, 0, 'read', '11:14', '17/2/2024'),
(26, 600628041, 'j\'aime bien', 816858279, 'text', NULL, 0, 'read', '11:16', '17/2/2024'),
(27, 600628041, 'et c\'est amusant', 816858279, 'text', NULL, 0, 'read', '11:30', '17/2/2024'),
(28, 816858279, 'Est ce que tu recois', 600628041, 'text', NULL, 0, 'read', '11:31', '17/2/2024'),
(29, 600628041, 'oui bien reçu\r\n', 816858279, 'text', NULL, 0, 'read', '11:34', '17/2/2024'),
(30, 600628041, 'EXPLOITATION.pdf', 816858279, 'file', 'freelancer_dashboard_assets/pdf_sent/freelancer-816858279/816858279_600628041_EXPLOITATION.pdf', 180, 'read', '11:36', '17/2/2024'),
(31, 600628041, 'coucou', 816858279, 'text', NULL, 0, 'read', '11:43', '10/3/2024'),
(32, 600628041, 'EXPLOITATION.pdf', 816858279, 'file', 'freelancer_dashboard_assets/pdf_sent/freelancer-816858279/816858279_600628041_EXPLOITATION.pdf', 180, 'read', '11:43', '10/3/2024');

-- --------------------------------------------------------

--
-- Table structure for table `resume`
--

DROP TABLE IF EXISTS `resume`;
CREATE TABLE IF NOT EXISTS `resume` (
  `id` varchar(500) CHARACTER SET utf8mb4  NOT NULL,
  `user_id` int NOT NULL,
  `position` varchar(255)  NOT NULL,
  `type` varchar(255)  NOT NULL,
  `category` varchar(255)  NOT NULL,
  `sous_category` varchar(255)  NOT NULL,
  `bio` varchar(255)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `resume`
--

INSERT INTO `resume` (`id`, `user_id`, `position`, `type`, `category`, `sous_category`, `bio`) VALUES
('EhIv%507-12-2023', 816858279, '', '', '', '', ''),
('Ehouman_Ivan_Web dev', 816858279, 'Web dev', 'Temps plein', 'Pogrammation etTechnologie', 'Developpement Mobile', 'Je suis un passionné de la technologie depuis mon plus jeune âge, et j\'ai toujours été fasciné par la manière dont elle peut améliorer nos vies de manière significative. Avec une formation approfondie en ingénierie logicielle et une expérience professionn');

-- --------------------------------------------------------

--
-- Table structure for table `resume_education`
--

DROP TABLE IF EXISTS `resume_education`;
CREATE TABLE IF NOT EXISTS `resume_education` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255)  NOT NULL,
  `degree` varchar(255)  NOT NULL,
  `starting_date` varchar(255)  NOT NULL,
  `ending_date` varchar(255)  NOT NULL,
  `city` varchar(255)  NOT NULL,
  `description` text  NOT NULL,
  `resume_id` varchar(255)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `resume_education`
--

INSERT INTO `resume_education` (`id`, `name`, `degree`, `starting_date`, `ending_date`, `city`, `description`, `resume_id`) VALUES
(11, 'Lmigb', 'Bachelor', 'Jan 2024', 'Mar 2024', 'Bassam', 'Je suis un passionné de la technologie depuis mon plus jeune âge, et j\'ai toujours été fasciné par la manière dont elle peut améliorer nos vies de manière significative. Avec une formation approfondie en ingénierie logicielle et une expérience professionn', 'Ehouman_Ivan_Web dev'),
(12, 'Umoncton', 'Master', 'Jan 2024', 'Mar 2024', 'Moncton', 'Je suis un passionné de la technologie depuis mon plus jeune âge, et j\'ai toujours été fasciné par la manière dont elle peut améliorer nos vies de manière significative. Avec une formation approfondie en ingénierie logicielle et une expérience professionn', 'Ehouman_Ivan_Web dev');

-- --------------------------------------------------------

--
-- Table structure for table `resume_experience`
--

DROP TABLE IF EXISTS `resume_experience`;
CREATE TABLE IF NOT EXISTS `resume_experience` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position` varchar(255)  NOT NULL,
  `company` varchar(255)  NOT NULL,
  `starting_date` varchar(255)  NOT NULL,
  `ending_date` varchar(255)  NOT NULL,
  `city` varchar(255)  NOT NULL,
  `description` varchar(255)  NOT NULL,
  `resume_id` varchar(255)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `resume_experience`
--

INSERT INTO `resume_experience` (`id`, `position`, `company`, `starting_date`, `ending_date`, `city`, `description`, `resume_id`) VALUES
(8, 'data analyst', 'Google', 'Jan 2024', 'Mar 2024', 'Moncton', 'Je suis un passionné de la technologie depuis mon plus jeune âge, et j\'ai toujours été fasciné par la manière dont elle peut améliorer nos vies de manière significative. Avec une formation approfondie en ingénierie logicielle et une expérience professionn', 'Ehouman_Ivan_Web dev'),
(9, 'exp2', 'MicroSoft', 'Jan 2024', 'Mar 2024', 'Nash', 'Je suis un passionné de la technologie depuis mon plus jeune âge, et j\'ai toujours été fasciné par la manière dont elle peut améliorer nos vies de manière significative. Avec une formation approfondie en ingénierie logicielle et une expérience professionn', 'Ehouman_Ivan_Web dev');

-- --------------------------------------------------------

--
-- Table structure for table `resume_language`
--

DROP TABLE IF EXISTS `resume_language`;
CREATE TABLE IF NOT EXISTS `resume_language` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(255)  NOT NULL,
  `level` varchar(255)  NOT NULL,
  `resume_id` varchar(255)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `resume_language`
--

INSERT INTO `resume_language` (`id`, `label`, `level`, `resume_id`) VALUES
(35, 'Francais', 'Fluent(Oral et écrit)', 'Ehouman_Ivan_Web dev'),
(36, 'Anglais', 'Avancé', 'Ehouman_Ivan_Web dev');

-- --------------------------------------------------------

--
-- Table structure for table `resume_skill`
--

DROP TABLE IF EXISTS `resume_skill`;
CREATE TABLE IF NOT EXISTS `resume_skill` (
  `id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(255)  NOT NULL,
  `level` varchar(255)  NOT NULL,
  `resume_id` varchar(255)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `resume_skill`
--

INSERT INTO `resume_skill` (`id`, `label`, `level`, `resume_id`) VALUES
(19, 'HTML', 'Expert', 'Ehouman_Ivan_Web dev'),
(20, 'Css', 'Competent', 'Ehouman_Ivan_Web dev'),
(21, 'Js\r\n', 'Competent', 'Ehouman_Ivan_Web dev');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int NOT NULL AUTO_INCREMENT,
  `task_id` int NOT NULL,
  `daynumber` int NOT NULL,
  `rest` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `event` varchar(255)  NOT NULL,
  `person_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `task_id`, `daynumber`, `rest`, `event`, `person_id`) VALUES
(8, 0, 29, 'Fevrier 2024', 'papolou', 600628041),
(14, 0, 17, 'Fevrier 2024', 'papa', 600628041),
(15, 1, 17, 'Fevrier 2024', 'mama', 600628041),
(16, 2, 18, 'Fevrier 2024', 'lord', 600628041),
(17, 1, 29, 'Fevrier 2024', 'lord', 600628041),
(18, 0, 27, 'Fevrier 2024', 'look', 600628041),
(19, 0, 11, 'Mars 2024', 'papaL', 600628041),
(20, 1, 11, 'Mars 2024', 'second', 600628041),
(21, 0, 12, 'Mars 2024', 'papaL', 816858279);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

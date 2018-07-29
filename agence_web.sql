-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  Dim 29 juil. 2018 à 22:39
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `agence_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `isSeen` tinyint(1) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `author`, `email`, `content`, `postId`, `isSeen`, `date`) VALUES
(5, 'Di iorio', 'christian_dirio@yahoo.fr', 'D\'où vient-il?\r\nContrairement à une opinion répandue, le Lorem Ipsum n\'est pas simplement du texte aléatoire. Il trouve ses racines dans une oeuvre de la littérature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s\'est intéressé à un des mots latins les plus obscurs, consectetur, extrait d\'un passage du Lorem Ipsum, et en étudiant tous les usages de ce mot dans la littérature classique, découvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du \"De Finibus Bonorum et Malorum\" (Des Suprêmes Biens et des Suprêmes Maux) de Cicéron. Cet ouvrage, très populaire pendant la Renaissance, est un traité sur la théorie de l\'éthique. Les premières lignes du Lorem Ipsum.', 1, 1, '2018-07-12 22:18:56'),
(6, 'Frazao', 'frazao@gmail.com', 'Où puis-je m\'en procurer?\r\nPlusieurs variations de Lorem Ipsum peuvent être trouvées ici ou là, mais la majeure partie d\'entre elles a été altérée par l\'addition d\'humour ou de mots aléatoires qui ne ressemblent pas une seconde à du texte standard. Si vous voulez utiliser un passage du Lorem Ipsum, vous devez être sûr qu\'il n\'y a rien d\'embarrassant caché dans le texte. Tous les générateurs de Lorem Ipsum sur Internet tendent à reproduire le même extrait sans fin, ce qui fait de lipsum.com le seul vrai générateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour générer un Lorem Ipsum irréprochable. Le Lorem Ipsum ainsi obtenu ne contient aucune répétition, ni ne contient des mots farfelus, ou des touches d\'humour.', 1, 1, '2018-07-12 22:20:27'),
(20, 'Di Iorio', 'christian@gmail.com', 'coucou c\'est nous', 1, 1, '2018-07-16 14:06:48'),
(21, 'Giovanny', 'giovanny@yahoo.fr', 'Ceci est un commentaire de Giovanny', 1, 1, '2018-07-18 09:59:17'),
(22, 'Abdeljalil Yassir-Montet', 'yassir.montet@yahoo.fr', 'test', 4, 1, '2018-07-29 12:33:26'),
(23, 'Abdeljalil Yassir-Montet', 'yassir.montet@yahoo.fr', 'test', 4, 1, '2018-07-29 12:33:43'),
(24, 'Abdel', 'yassir.montet@yahoo.fr', 'test', 4, 0, '2018-07-29 12:34:55'),
(25, 'Abdeljalil Yassir-Montet', 'yassir.montet@yahoo.fr', 'test', 7, 0, '2018-07-29 12:35:34');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `object` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `response_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `lastName`, `firstName`, `email`, `object`, `message`, `date`, `response_status`) VALUES
(1, 'gsfdhfgh', 'fghfhsfhfg', 'gfjfgjhgfh', 'fgjhdfjetyuj', 'gfjhgjfjytkj', '0000-00-00 00:00:00', 1),
(2, 'Gaubert', 'David', 'christian_diiorio@yahoo.fr', 'test mail', 'ceci est un test', '0000-00-00 00:00:00', 0),
(3, 'colibri', 'oiseau', 'coucou@gmail.com', 'oiseat', 'oiseau', '2018-07-19 00:00:00', 0),
(4, 'Di Iorio', 'Christian', 'christian_diiorio@yahoo.fr', 'test contact', 'Ceci est un test de contact', '2018-07-19 00:00:00', 0),
(5, 'Di Iorio', 'Christian', 'christian_diiorio@yahoo.fr', 'Test du formulaire de contact', 'Ceci est un test de formulaire', '2018-07-19 00:00:00', 0),
(6, 'Di Iorio', 'Christian', 'christian_diiorio@yahoo.fr', 'Test du formulaire de contact', 'Ceci est un test de formulaire', '2018-07-19 00:00:00', 0),
(7, 'Di Iorio', 'Christian', 'christian_diiorio@yahoo.fr', 'Test du formulaire de contact', 'Ceci est un test de formulaire', '2018-07-19 00:00:00', 0),
(8, 'Di Iorio', 'Christian', 'christian_diiorio@yahoo.fr', 'Test du formulaire de contact', 'Ceci est un test de formulaire', '2018-07-19 00:00:00', 0),
(9, 'Di Iorio', 'Christian', 'christian_diiorio@yahoo.fr', 'Test contact', 'Ceci est un test de contact', '2018-07-19 00:00:00', 0),
(10, 'Di Iorio', 'Christian', 'christian_diiorio@yahoo.fr', 'Test contact', 'Ceci est un test de contact', '2018-07-19 00:00:00', 0),
(11, 'Abdel', 'Yassir', 'yassir.montet70@gmail.com', 'coucou', 'coucou', '2018-07-19 00:00:00', 0),
(12, 'Abdel', 'Yassir-Montet', 'yassir.montet70@gmail.com', 'Test contact', 'Test contact', '2018-07-29 19:04:09', 0),
(13, 'Abdel', 'Yassir-Montet', 'yassir.montet@yahoo.fr', 'Test contact', 'Test contact', '2018-07-29 19:08:40', 1);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `title`, `subtitle`, `content`, `image_name`, `createdAt`, `updatedAt`, `slug`, `page_id`) VALUES
(2, 'Christian di lorio', 'Développeur', '<ul class=\"détail-comp hov1\">\r\n<li onmouseover=\"on(this)\" onmouseout=\"off(this)\"><p>PHP / Symfony</p></li>\r\n<li onmouseover=\"on1(this)\" onmouseout=\"off1(this)\"><p>Gestion de projet</p></li>\r\n<li onmouseover=\"on2(this)\" onmouseout=\"off2(this)\"><p>Bootstrap</p></li>\r\n<li onmouseover=\"on3(this)\" onmouseout=\"off3(this)\"><p>Worpdress</p></li>\r\n<li onmouseover=\"on4(this)\" onmouseout=\"off4(this)\"><p>Création de plugins</p></li>\r\n<li onmouseover=\"on5(this)\" onmouseout=\"off5(this)\"><p>Référencement</p></li>\r\n</ul>', 'chr-min.jpg', '2013-01-01 00:00:00', '2018-07-28 18:21:29', 'christian-di-lorio', 1),
(3, 'basique', 'Ce pack est totalement personnalisable selon vos besoins, il permet simplement de vous orienter et nous aide à déterminer le type de projet que vous pourriez entreprendre.', '<li><p>Achat de noms de domaines</p></li>\r\n<li><p>Hébergement</p></li>\r\n<li><p>Prise en charge configuration Wordpress</p></li>\r\n<li><p>Installation des plugins</p></li>\r\n<li><p>Personnalisation du thème</p></li>', '', '2013-01-01 00:00:00', '2018-07-27 22:54:22', 'basique', 2),
(5, 'premium', 'Ce pack est totalement personnalisable selon vos besoins, il permet simplement de vous orienter et nous aide à déterminer le type de projet que vous pourriez entreprendre', '<li><p>Pack basique</p></li>\r\n<li><p>Adaptation du thème à 100%</p></li>\r\n<li><p>Ajout de fonctionnalités spécifiques et personnalisés</p></li>\r\n<li><p>Création d\'une identité visuelle digitale</p></li>', '', '2013-01-01 00:00:00', '2018-07-27 23:32:20', 'premium', 2),
(6, 'premium +', 'Ce pack est totalement personnalisable selon vos besoins, il permet simplement de vous orienter et nous aide à déterminer le type de projet que vous pourriez entreprendre.', '<li><p>Pack premium</p></li>\r\n<li><p>Développement de A à Z avec symfony au lieu de Wordpress</p></li>\r\n<li><p>Développement de plugins</p></li>\r\n<li><p>Campagne Adwords</p></li>\r\n<li><p>Création d\'une identité visuelle multimédia</p></li>', '', '2013-01-01 00:00:00', '2018-07-27 23:34:11', 'premium-1', 2),
(7, 'mon dizième article', 'mon dizième article', 'mon dizième article', '115830632.jpg', '2013-01-01 00:00:00', '2018-07-23 02:12:00', 'mon-dizieme-article', 3),
(11, 'test upload 5', 'http://localhost:9090', 'http://localhost:9090', '115826009.jpg', '2013-01-01 00:00:00', '2018-07-23 03:24:00', 'test-upload-5-1', 3),
(12, 'Abdel Yassir', 'Développeur', '<ul class=\"détail-comp hov1\">\r\n<li onmouseover=\"on6(this)\" onmouseout=\"off6(this)\"><p>PHP / Symfony</p></li>\r\n<li onmouseover=\"on7(this)\" onmouseout=\"off7(this)\"><p>Gestion de projet</p></li>\r\n<li onmouseover=\"on8(this)\" onmouseout=\"off8(this)\"><p>Bootstrap</p></li>\r\n<li onmouseover=\"on9(this)\" onmouseout=\"off9(this)\"><p>Worpdress</p></li>\r\n<li onmouseover=\"on10(this)\" onmouseout=\"off10(this)\"><p>Création de plugins</p></li>\r\n<li onmouseover=\"on11(this)\" onmouseout=\"off11(this)\"><p>Référencement</p></li>\r\n</ul>', 'abd-min.jpg', '2013-01-01 00:00:00', '2018-07-27 21:30:55', 'abdel-yassir', 1),
(13, 'Lucas dieffenbacher', 'Marketeur', '<ul class=\"détail-comp hov2\">\r\n<li onmouseover=\"on12(this)\" onmouseout=\"off12(this)\"><p>Etude de marché</p></li>\r\n<li onmouseover=\"on13(this)\" onmouseout=\"off13(this)\"><p>Gestion de projet</p></li>\r\n<li onmouseover=\"on14(this)\" onmouseout=\"off14(this)\"><p>Campagne Adwords</p></li>\r\n<li onmouseover=\"on15(this)\" onmouseout=\"off15(this)\"><p>Stratégie marketing</p></li>\r\n<li onmouseover=\"on16(this)\" onmouseout=\"off16(this)\"><p>Réalisation vidéo</p></li>\r\n<li onmouseover=\"on17(this)\" onmouseout=\"off17(this)\"><p>Photographie</p></li>\r\n</ul>', 'luc-min.jpg', '2013-01-01 00:00:00', '2018-07-27 21:29:28', 'lucas-dieffenbacher', 1),
(14, 'Giovanny legros', 'Designer', '<ul class=\"détail-comp hov3\">\r\n<li><p>Web design</p></li>\r\n<li><p>Gestion de projet</p></li>\r\n<li><p>Développement Front-end</p></li>\r\n<li><p>Infographie / Print</p></li>\r\n<li><p>Création d\'identité visuelle</p></li>\r\n<li><p>Publictité digitale (visuels)</p></li>\r\n</ul>', 'gio-min.jpg', '2013-01-01 00:00:00', '2018-07-27 21:31:42', 'giovanny-legros', 1);

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pageNumber` smallint(6) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `page`
--

INSERT INTO `page` (`id`, `title`, `slug`, `pageNumber`, `content`) VALUES
(1, 'L\'agence', 'l-agence', 1, '<p>LEON, c&#39;est pour vous, 4 pros. Quatres passion&eacute;s du digitall<br />\r\nqui sont &agrave; l&#39;&eacute;coute. Quatres passion&eacute;s qui font tout pour<br />\r\nque votre projet soit un projet qui vous satisfait...</p>'),
(2, 'Les services', 'les-services', 2, ''),
(3, 'Les réferences', 'les-references', 3, 'Test contenu references');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `isPosted` tinyint(1) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `name`, `content`, `email`, `image`, `date`, `isPosted`, `category`) VALUES
(1, 'Post 1', 'Create post 1', '<h2>Qu&#39;est-ce que le Lorem Ipsum?</h2>\r\n\r\n<p>Le&nbsp;<strong>Lorem Ipsum</strong>&nbsp;est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l&#39;imprimerie depuis les ann&eacute;es 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte. Il n&#39;a pas fait que survivre cinq si&egrave;cles, mais s&#39;est aussi adapt&eacute; &agrave; la bureautique informatique, sans que son contenu n&#39;en soit modifi&eacute;. Il a &eacute;t&eacute; popularis&eacute; dans les ann&eacute;es 1960 gr&acirc;ce &agrave; la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus r&eacute;cemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker. ceci est une phrase avec des balists&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>pour un essai</p>\r\n\r\n<h2>Pourquoi l&#39;utiliser?</h2>\r\n\r\n<p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et emp&ecirc;che de se concentrer sur la mise en page elle-m&ecirc;me. L&#39;avantage du Lorem Ipsum sur un texte g&eacute;n&eacute;rique comme &#39;Du texte. Du texte. Du texte.&#39; est qu&#39;il poss&egrave;de une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du fran&ccedil;ais standard. De nombreuses suites logicielles de mise en page ou &eacute;diteurs de sites Web ont fait du Lorem Ipsum leur faux texte par d&eacute;faut, et une recherche pour &#39;Lorem Ipsum&#39; vous conduira vers de nombreux sites qui n&#39;en sont encore qu&#39;&agrave; leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d&#39;y rajouter de petits clins d&#39;oeil, voire des phrases embarassantes).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>D&#39;o&ugrave; vient-il?</h2>\r\n\r\n<p>Contrairement &agrave; une opinion r&eacute;pandue, le Lorem Ipsum n&#39;est pas simplement du texte al&eacute;atoire. Il trouve ses racines dans une oeuvre de la litt&eacute;rature latine classique datant de 45 av. J.-C., le rendant vieux de 2000 ans. Un professeur du Hampden-Sydney College, en Virginie, s&#39;est int&eacute;ress&eacute; &agrave; un des mots latins les plus obscurs, consectetur, extrait d&#39;un passage du Lorem Ipsum, et en &eacute;tudiant tous les usages de ce mot dans la litt&eacute;rature classique, d&eacute;couvrit la source incontestable du Lorem Ipsum. Il provient en fait des sections 1.10.32 et 1.10.33 du &quot;De Finibus Bonorum et Malorum&quot; (Des Supr&ecirc;mes Biens et des Supr&ecirc;mes Maux) de Cic&eacute;ron. Cet ouvrage, tr&egrave;s populaire pendant la Renaissance, est un trait&eacute; sur la th&eacute;orie de l&#39;&eacute;thique. Les premi&egrave;res lignes du Lorem Ipsum, &quot;Lorem ipsum dolor sit amet...&quot;, proviennent de la section 1.10.32.</p>', 'christian.yvan@gmail.com', 'Capture d’écran 2018-07-24 à 12.26.13.png', '2013-01-01 00:00:00', 1, 'Design'),
(2, 'Post 2', 'Création Post 2', '<p>Ceci est la cr&eacute;ation du post 2</p>', 'christian_diiorio@yahoo.fr', 'b34a319610813d21d127351605bb5461.jpeg', '2018-07-09 00:00:00', 1, 'informatique'),
(4, 'Nouveau Post', 'Françis', '<h2>O&ugrave; puis-je m&#39;en procurer?</h2>\r\n\r\n<p>Plusieurs variations de Lorem Ipsum peuvent &ecirc;tre trouv&eacute;es ici ou l&agrave;, mais la majeure partie d&#39;entre elles a &eacute;t&eacute; alt&eacute;r&eacute;e par l&#39;addition d&#39;humour ou de mots al&eacute;atoires qui ne ressemblent pas une seconde &agrave; du texte standard. Si vous voulez utiliser un passage du Lorem Ipsum, vous devez &ecirc;tre s&ucirc;r qu&#39;il n&#39;y a rien d&#39;embarrassant cach&eacute; dans le texte. Tous les g&eacute;n&eacute;rateurs de Lorem Ipsum sur Internet tendent &agrave; reproduire le m&ecirc;me extrait sans fin, ce qui fait de lipsum.com le seul vrai g&eacute;n&eacute;rateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour g&eacute;n&eacute;rer un Lorem Ipsum irr&eacute;prochable. Le Lorem Ipsum ainsi obtenu ne contient aucune r&eacute;p&eacute;tition, ni ne contient des mots farfelus, ou des touches d&#39;humour.</p>\r\n\r\n<p><img alt=\"\" src=\"C:\\Users\\Christian\\Pictures\\image_2\" style=\"border-style:solid; border-width:1px; height:150px; width:150px\" /></p>', 'christian@yahoo.fr', '74d3fbe4cb6ea89189ef5e0d348d8e89.jpeg', '2018-07-12 00:00:00', 1, 'image web'),
(5, 'Création d\'un post avec ckeditor', 'Fait par chrisian diiorio', '<h1 style=\"font-style:italic\">Bonjour ceci est un test de post avec ckeditor</h1>\r\n\r\n<p>Je vais faire un article avec une balise strong <strong>Important pour voir ci cela marche.</strong></p>\r\n\r\n<p>Un retour &agrave; la ligne puis un <u>sous lignage </u>et c&#39;est parti.</p>', 'christian_diiorio@yahoo.fr', 'C:\\wamp64\\tmp\\php8D90.tmp', '2018-07-13 00:00:00', 1, 'ckeditor catégory'),
(6, 'Création blog le 17/07/2018', 'Yvan', '<p><strong>Ceci est</strong> la cr&eacute;ation d<em>&#39;un post </em>en date du 1<u>7/07/2018 par yvan</u></p>', 'coucou@yahoo.fr', '9f4c09a7cc96da49ebc3242996269e10.jpeg', '2018-07-17 00:00:00', 1, 'essai de créatio de blog'),
(7, 'nouveau post', 'qdgqgqg', '<p>mlkqgjmlkgjmqlkgjmqlk</p>', 'lqkjgmlk@yahoo.fr', '1f6320b34aea07e02b85c814b24fef42.jpeg', '2018-07-17 00:00:00', 1, 'qmlkjgmqlg'),
(8, 'jdjdjdghj', 'ghdjgjgj', '<p>dgjdgjdgjjdjghfgj nouveau post</p>', 'christian.yvan@gmail.com', '727a36466dc99284d7d183967aa5a962.jpeg', '2018-07-18 00:00:00', 1, 'nouveau post');

-- --------------------------------------------------------

--
-- Structure de la table `response_contact`
--

CREATE TABLE `response_contact` (
  `id` int(11) NOT NULL,
  `content_response` longtext COLLATE utf8_unicode_ci,
  `date` datetime NOT NULL,
  `contactId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `response_contact`
--

INSERT INTO `response_contact` (`id`, `content_response`, `date`, `contactId`) VALUES
(1, '<p>coco</p>\r\n', '2018-07-29 22:20:24', 13);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'diiorio', 'diiorio', 'christian.yvan@gmail.com', 'christian.yvan@gmail.com', 1, NULL, '$2y$13$32BUwZLjJEgnPsas2qy2iu7oUUCUE81Frdl1qa2hLy13MTYOGyQ66', '2018-07-19 18:37:17', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(4, 'abdel', 'abdel', 'yassir.montet70@gmail.com', 'yassir.montet70@gmail.com', 1, NULL, '$2y$13$WWvN/mXOt5VcX7EWyBzpB.yFawdXIico1o0WRn4nE9eI3EboZauc.', '2018-07-29 20:35:48', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CE094D20D` (`postId`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1F1B251E989D9B62` (`slug`),
  ADD KEY `IDX_1F1B251EC4663E4` (`page_id`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_140AB620989D9B62` (`slug`),
  ADD UNIQUE KEY `UNIQ_140AB6207D850928` (`pageNumber`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `response_contact`
--
ALTER TABLE `response_contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `response_contact`
--
ALTER TABLE `response_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526CE094D20D` FOREIGN KEY (`postId`) REFERENCES `post` (`id`);

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_1F1B251EC4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

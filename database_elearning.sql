-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 28 juin 2022 à 22:45
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `database_elearning`
--

-- --------------------------------------------------------

--
-- Structure de la table `about_web`
--

CREATE TABLE `about_web` (
  `url1` varchar(250) NOT NULL,
  `url2` varchar(250) NOT NULL,
  `url3` varchar(250) NOT NULL,
  `url4` varchar(250) NOT NULL,
  `url5` varchar(250) NOT NULL,
  `about_us` text NOT NULL,
  `logo` varchar(250) NOT NULL,
  `cover` varchar(250) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `about_web`
--

INSERT INTO `about_web` (`url1`, `url2`, `url3`, `url4`, `url5`, `about_us`, `logo`, `cover`, `id`) VALUES
('https://github.com', 'https://www.youtube.com/', 'https://fr-fr.facebook.com/', 'https://twitter.com/?lang=fr', 'https://www.instagram.com/?hl=fr', 'Changer l apprentissage pour le mieux\r\nQue vous vouliez apprendre ou partager ce que vous savez, vous êtes au bon endroit. En tant que destination mondiale pour l apprentissage en ligne, nous connectons les gens grâce à la connaissance.\r\n', '62bb4e0d522fc3.06396125.jpg', '62bb4e0d526303.49690638.jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `cat`
--

CREATE TABLE `cat` (
  `cat_id` int(10) NOT NULL,
  `cat_name` text NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cat`
--

INSERT INTO `cat` (`cat_id`, `cat_name`, `image`) VALUES
(101, 'Espagnol', '62bb5314d697a3.29053371.svg'),
(102, 'Japonais', '62bb53222c8a19.62064518.svg'),
(103, 'Russian', '62bb53305c11c7.55613637.svg'),
(104, 'English', '62bb534090aeb7.31374080.svg'),
(105, 'Chinois', '62bb5351eb4d10.99047987.svg'),
(106, 'Français', '62bb563e13d443.29437816.svg');

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

CREATE TABLE `course` (
  `id_cours` int(11) NOT NULL,
  `title` varchar(600) NOT NULL,
  `short_description` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `price_r` int(11) NOT NULL,
  `cover` varchar(250) NOT NULL,
  `video_intro` varchar(250) NOT NULL,
  `date_cours` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `id_sub_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `course`
--

INSERT INTO `course` (`id_cours`, `title`, `short_description`, `description`, `price`, `price_r`, `cover`, `video_intro`, `date_cours`, `id_user`, `id_cat`, `id_sub_cat`) VALUES
(79, 'The English Master Course: English Grammar, English Speaking', 'The Complete English Language Course: English grammar, English speaking, and writing. British and American English.', ' Are you tired of learning the same simple topics and never really getting better at English speaking or English grammar? This course will fix all those problems. This has been one of the top Udemy English courses for many years, and that is because we care about our students.', 1200, 2000, '62bb571b715a48.24994766.jpg', '62bb571b70f400.29929030.mp4', '2022-06-28', 45, 104, 23),
(80, 'English for Beginners: Intensive Spoken English Course', 'English speaking course. 77 Hours of English language speaking, English listening practice. 1000 English language words', 'English speaking course. 77 Hours of English language speaking, English listening practice. 1000 English language words', 1000, 1500, '62bb6430cb04f0.34381333.jpg', '62bb6430ca8075.87866113.mp4', '2022-06-28', 46, 104, 23),
(81, 'English Speaking Complete: English Language Mastery', 'Supercharge your English speaking fluency and improve your vocabulary, grammar and English language skills.', 'Supercharge your English speaking fluency and improve your vocabulary, grammar and English language skills.', 900, 1200, '62bb64993b1d05.44064331.jpg', '62bb64993aa8e2.59720739.mp4', '2022-06-28', 46, 104, 23),
(82, 'Cours d’anglais pour les professionnels - intermédiaire', 'Améliorer votre expression oral et compréhension pour communiquer en anglais avec toute confiance au travail', 'Améliorer votre expression oral et compréhension pour communiquer en anglais avec toute confiance au travail', 1000, 1200, '62bb6677913bb6.90653429.jpg', '62bb6638da3e20.06989231.mp4', '2022-06-28', 46, 104, 23),
(83, 'Parler anglais comme un anglophone – Speak English Better', 'Éviter les erreurs courantes que commettent les natifs francophones – Apprendre l anglais pour le quotidien', 'Éviter les erreurs courantes que commettent les natifs francophones – Apprendre l’anglais pour le quotidien', 3000, 3500, '62bb679ebc8266.81897215.jpg', '62bb679ebbfa91.18748205.mp4', '2022-06-28', 46, 104, 23);

-- --------------------------------------------------------

--
-- Structure de la table `demande_enseignement`
--

CREATE TABLE `demande_enseignement` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `niveau_acad` varchar(250) NOT NULL,
  `niveau` int(11) NOT NULL,
  `lang` text NOT NULL,
  `file` varchar(250) NOT NULL,
  `resultat` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_enseignant` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `niveau_acad` text NOT NULL,
  `facebook` varchar(250) NOT NULL,
  `twitter` varchar(250) NOT NULL,
  `instgram` varchar(250) NOT NULL,
  `github` varchar(250) NOT NULL,
  `youtube` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `id_user`, `niveau_acad`, `facebook`, `twitter`, `instgram`, `github`, `youtube`) VALUES
(45, 5, 'licence en langue Anglais.', '', '', '', '', ''),
(46, 35, 'licence en langue Anglais.', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `followers`
--

CREATE TABLE `followers` (
  `id_follow` int(11) NOT NULL,
  `id_ens` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `followers`
--

INSERT INTO `followers` (`id_follow`, `id_ens`, `id_user`) VALUES
(19, 40, 10);

-- --------------------------------------------------------

--
-- Structure de la table `lecon`
--

CREATE TABLE `lecon` (
  `id` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `title` text NOT NULL,
  `type` int(11) NOT NULL,
  `file` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `duree` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `lecon`
--

INSERT INTO `lecon` (`id`, `id_course`, `id_section`, `title`, `type`, `file`, `date`, `duree`) VALUES
(67, 70, 47, 'Course Structure and Study Tips [MUST WATCH!]', 1, '62add455ab83a6.34413746.mp4', '2022-06-18', '00:00:00'),
(68, 70, 48, '9 Parts of Speech', 1, '62add49e350ca1.99581550.mp4', '2022-06-18', '00:00:00'),
(69, 70, 48, 'Awesome Adjectives + Amazing Adverbs', 1, '62add4be85e447.20868304.mp4', '2022-06-18', '00:00:00'),
(70, 70, 48, 'Verb Form List', 2, '62add52e579d55.36623667.pdf', '2022-06-18', '00:00:00'),
(71, 70, 49, 'Phrasal Verbs + Collocations', 1, '62add560bd6c58.29516094.mp4', '2022-06-18', '00:00:00'),
(72, 70, 50, 'Description Practice', 2, '62addeb57de7e4.23529627.pdf', '2022-06-18', '00:00:00'),
(73, 70, 51, 'Full Example Description', 3, '62addf78e98eb5.29840791.png', '2022-06-18', '00:00:00'),
(74, 79, 52, 'Course Review, Course Certificate', 1, '62bb577a7cae17.61703204.mp4', '2022-06-28', '00:00:00'),
(75, 79, 52, 'PDFs, Q/A, Contacting Me, Reporting Issues', 2, '62bb579b6d80e0.34952675.pdf', '2022-06-28', '00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `id_surce` int(11) NOT NULL,
  `id_dest` int(11) NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`msg_id`, `id_surce`, `id_dest`, `msg`) VALUES
(69, 10, 27, 'hello 😊'),
(70, 10, 27, 'how are you?'),
(71, 27, 10, 'fine :)');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `cardname` varchar(250) NOT NULL,
  `cardnumber` int(250) NOT NULL,
  `expyear` year(4) NOT NULL,
  `expmonth` varchar(200) NOT NULL,
  `id_cour` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `cardname`, `cardnumber`, `expyear`, `expmonth`, `id_cour`, `id_user`) VALUES
(12, 'safia', 12345, 2019, 'september', 79, 5);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_cour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL,
  `id_quize` int(11) NOT NULL,
  `question` varchar(250) NOT NULL,
  `reponse1` varchar(250) NOT NULL,
  `reponse2` varchar(250) NOT NULL,
  `reponse3` varchar(250) NOT NULL,
  `reponse4` varchar(250) NOT NULL,
  `bonne_reponse` varchar(250) NOT NULL,
  `accessoires` varchar(250) NOT NULL,
  `explication` text NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id_question`, `id_quize`, `question`, `reponse1`, `reponse2`, `reponse3`, `reponse4`, `bonne_reponse`, `accessoires`, `explication`, `type`) VALUES
(127, 27, 'What ______ less, now that you have a baby?', ' you do', 'do you', ' are you doing', 'you are doing', ' are you doing', '62bb59789ef7d4.88328578.', 'Correct answer  are you doing', '');

-- --------------------------------------------------------

--
-- Structure de la table `quize`
--

CREATE TABLE `quize` (
  `id_quize` int(11) NOT NULL,
  `id_section` int(11) NOT NULL,
  `titre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `quize`
--

INSERT INTO `quize` (`id_quize`, `id_section`, `titre`) VALUES
(27, 52, 'short English quiz 1');

-- --------------------------------------------------------

--
-- Structure de la table `quize_reponse`
--

CREATE TABLE `quize_reponse` (
  `id_reponse` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_quiz` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `reponse_user` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `quize_reponse`
--

INSERT INTO `quize_reponse` (`id_reponse`, `id_user`, `id_quiz`, `id_question`, `reponse_user`) VALUES
(70, 5, 27, 127, ' are you doing');

-- --------------------------------------------------------

--
-- Structure de la table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `id_cour` int(11) NOT NULL,
  `average_rating` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

CREATE TABLE `section` (
  `id_section` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `id_cour` int(11) NOT NULL,
  `calssm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`id_section`, `title`, `id_cour`, `calssm`) VALUES
(52, 'Chapter 1', 79, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sub_cat`
--

CREATE TABLE `sub_cat` (
  `sub_cat_id` int(10) NOT NULL,
  `sub_cat_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sub_cat`
--

INSERT INTO `sub_cat` (`sub_cat_id`, `sub_cat_name`) VALUES
(23, 'Niveau A1'),
(24, 'Niveau A2'),
(25, 'Niveau B1'),
(26, 'Niveau B2'),
(27, 'Niveau C1'),
(28, 'Niveau C2');

-- --------------------------------------------------------

--
-- Structure de la table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `id_user`) VALUES
(3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `tb_blog`
--

CREATE TABLE `tb_blog` (
  `id_blog` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `blog_title` varchar(250) NOT NULL,
  `blog_sub_title` varchar(250) NOT NULL,
  `blog_cont` text NOT NULL,
  `blog_image` varchar(250) NOT NULL,
  `blog_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nome`, `prenom`, `email`, `password`, `user_image`) VALUES
(5, 'NEXT', 'LEVEL', 'admin@example.com', 'admin2001', 'owl.jpg'),
(35, 'maya', 'it', 'maya@gmail.com', '123', 'defult.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `about_web`
--
ALTER TABLE `about_web`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id_cours`);

--
-- Index pour la table `demande_enseignement`
--
ALTER TABLE `demande_enseignement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_enseignant`);

--
-- Index pour la table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id_follow`);

--
-- Index pour la table `lecon`
--
ALTER TABLE `lecon`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id_question`);

--
-- Index pour la table `quize`
--
ALTER TABLE `quize`
  ADD PRIMARY KEY (`id_quize`);

--
-- Index pour la table `quize_reponse`
--
ALTER TABLE `quize_reponse`
  ADD PRIMARY KEY (`id_reponse`);

--
-- Index pour la table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Index pour la table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id_section`);

--
-- Index pour la table `sub_cat`
--
ALTER TABLE `sub_cat`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Index pour la table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tb_blog`
--
ALTER TABLE `tb_blog`
  ADD PRIMARY KEY (`id_blog`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `about_web`
--
ALTER TABLE `about_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cat`
--
ALTER TABLE `cat`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT pour la table `course`
--
ALTER TABLE `course`
  MODIFY `id_cours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT pour la table `demande_enseignement`
--
ALTER TABLE `demande_enseignement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_enseignant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `followers`
--
ALTER TABLE `followers`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `lecon`
--
ALTER TABLE `lecon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT pour la table `question`
--
ALTER TABLE `question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT pour la table `quize`
--
ALTER TABLE `quize`
  MODIFY `id_quize` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `quize_reponse`
--
ALTER TABLE `quize_reponse`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT pour la table `section`
--
ALTER TABLE `section`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `sub_cat`
--
ALTER TABLE `sub_cat`
  MODIFY `sub_cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tb_blog`
--
ALTER TABLE `tb_blog`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

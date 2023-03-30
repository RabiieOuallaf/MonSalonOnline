-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : jeu. 16 mars 2023 à 15:39
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `monsalononline`
--

-- --------------------------------------------------------

--
-- Structure de la table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(55) NOT NULL,
  `employee_pwd` varchar(155) NOT NULL,
  `employee_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `full_schedule`
--

CREATE TABLE `full_schedule` (
  `days` varchar(30) DEFAULT NULL,
  `day_id` int(11) NOT NULL DEFAULT 0,
  `hour_id` int(11) DEFAULT NULL,
  `hour_value` int(11) DEFAULT NULL,
  `hour_availability` varchar(50) DEFAULT 'free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `full_schedule`
--

INSERT INTO `full_schedule` (`days`, `day_id`, `hour_id`, `hour_value`, `hour_availability`) VALUES
('Monday', 1, 1, 9, 'hold'),
('Monday', 1, 1, 10, 'hold'),
('Monday', 1, 1, 11, 'free'),
('Monday', 1, 1, 12, 'free'),
('Monday', 1, 1, 14, 'free'),
('Monday', 1, 1, 50, 'free'),
('Monday', 1, 1, 16, 'free'),
('Monday', 1, 1, 17, 'free'),
('Monday', 1, 1, 18, 'hold'),
('Monday', 1, 1, 19, 'hold'),
('Monday', 1, 1, 20, 'hold'),
('Tuesday', 2, 2, 9, 'free'),
('Tuesday', 2, 2, 10, 'free'),
('Tuesday', 2, 2, 11, 'free'),
('Tuesday', 2, 2, 12, 'free'),
('Tuesday', 2, 2, 14, 'hold'),
('Tuesday', 2, 2, 15, 'free'),
('Tuesday', 2, 2, 16, 'free'),
('Tuesday', 2, 2, 17, 'hold'),
('Tuesday', 2, 2, 18, 'free'),
('Tuesday', 2, 2, 19, 'free'),
('Tuesday', 2, 2, 20, 'free'),
('Wednesday', 3, 3, 9, 'free'),
('Wednesday', 3, 3, 10, 'hold'),
('Wednesday', 3, 3, 11, 'free'),
('Wednesday', 3, 3, 12, 'free'),
('Wednesday', 3, 3, 14, 'free'),
('Wednesday', 3, 3, 15, 'hold'),
('Wednesday', 3, 3, 16, 'free'),
('Wednesday', 3, 3, 17, 'free'),
('Wednesday', 3, 3, 18, 'free'),
('Wednesday', 3, 3, 19, 'free'),
('Wednesday', 3, 3, 20, 'hold'),
('Thursday', 4, 4, 9, 'free'),
('Thursday', 4, 4, 10, 'free'),
('Thursday', 4, 4, 11, 'free'),
('Thursday', 4, 4, 12, 'free'),
('Thursday', 4, 4, 14, 'free'),
('Thursday', 4, 4, 15, 'free'),
('Thursday', 4, 4, 16, 'free'),
('Thursday', 4, 4, 17, 'free'),
('Thursday', 4, 4, 18, 'free'),
('Thursday', 4, 4, 19, 'free'),
('Thursday', 4, 4, 20, 'free'),
('Friday', 5, 5, 9, 'free'),
('Friday', 5, 5, 10, 'free'),
('Friday', 5, 5, 11, 'free'),
('Friday', 5, 5, 12, 'free'),
('Friday', 5, 5, 16, 'free'),
('Friday', 5, 5, 17, 'free'),
('Friday', 5, 5, 18, 'free'),
('Friday', 5, 5, 19, 'free'),
('Friday', 5, 5, 20, 'free'),
('Friday', 5, 5, 21, 'free'),
('Friday', 5, 5, 22, 'free'),
('Saturday', 6, 6, 9, 'free'),
('Saturday', 6, 6, 10, 'free'),
('Saturday', 6, 6, 11, 'free'),
('Saturday', 6, 6, 12, 'free'),
('Saturday', 6, 6, 14, 'free'),
('Saturday', 6, 6, 15, 'free'),
('Saturday', 6, 6, 16, 'free'),
('Saturday', 6, 6, 17, 'free'),
('Saturday', 6, 6, 18, 'free'),
('Saturday', 6, 6, 19, 'hold'),
('Saturday', 6, 6, 20, 'free'),
('Sunday', 7, 7, 9, 'free'),
('Sunday', 7, 7, 10, 'free'),
('Sunday', 7, 7, 11, 'free'),
('Sunday', 7, 7, 12, 'free');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `reservation_date` int(11) NOT NULL,
  `reservation_duration` time DEFAULT '01:00:00',
  `reservation_service` varchar(255) DEFAULT NULL,
  `reservation_customer_reference` varchar(50) DEFAULT NULL,
  `reservation_barber_id` int(11) DEFAULT NULL,
  `reservation_date_day` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `reservation_date`, `reservation_duration`, `reservation_service`, `reservation_customer_reference`, `reservation_barber_id`, `reservation_date_day`) VALUES
(1, 0, '01:00:00', 'Excepturi qui id dol', '\"AXYX8YUAAvRO\"', 2, NULL),
(2, 0, '01:00:00', 'Magnam tempora moles', '\"AXYX8YUAAvRO\"', 1, NULL),
(3, 0, '01:00:00', 'Ea voluptas quia cum', '\"AXYX8YUAAvRO\"', 2, NULL),
(4, 0, '01:00:00', 'Ea voluptas quia cum', '\"AXYX8YUAAvRO\"', 2, NULL),
(5, 16, '01:00:00', 'Quia praesentium ani', '\"AXYX8YUAAvRO\"', 2, NULL),
(6, 19, '01:00:00', 'Illum explicabo Su', '\"AXYX8YUAAvRO\"', 1, NULL),
(7, 0, '01:00:00', 'Incididunt atque qui', '\"AXYX8YUAAvRO\"', 1, NULL),
(8, 19, '01:00:00', 'Est ipsam est quia f', '\"ARswXYYUNYR\"', 2, 6),
(9, 19, '01:00:00', 'Velit repellendus M', '\"ARswXYYUNYR\"', 1, 6),
(10, 0, '01:00:00', 'Blanditiis eu archit', '\"ARswXYYUNYR\"', 3, 1),
(11, 0, '01:00:00', 'Blanditiis eu archit', '\"ARswXYYUNYR\"', 3, 1),
(12, 0, '01:00:00', 'Deserunt possimus o', '\"ARswXYYUNYR\"', 3, 1),
(13, 0, '01:00:00', 'Deserunt possimus o', '\"ARswXYYUNYR\"', 3, 1),
(14, 0, '01:00:00', 'Deserunt possimus o', '\"ARswXYYUNYR\"', 3, 1),
(15, 9, '01:00:00', 'here something', 'ffff', 3, 1),
(16, 19, '01:00:00', 'Dolorem veritatis al', '\"ARswXYYUNYR\"', 1, 1),
(17, 10, '01:00:00', 'Molestiae quia non e', '\"ARswXYYUNYR\"', 2, 3),
(18, 0, '01:00:00', 'Qui quod at et volup', '\"ARswXYYUNYR\"', 2, 2),
(19, 189, '01:00:00', 'Qui rem qui ex dolor', '\"ARswXYYUNYR\"', 2, 4),
(20, 189, '01:00:00', 'Qui rem qui ex dolor', '\"ARswXYYUNYR\"', 2, 4),
(21, 3, '01:00:00', 'Consequuntur sed et ', '\"ARswXYYUNYR\"', 1, 3),
(22, 15, '01:00:00', 'Aut voluptate est po', '\"ARswXYYUNYR\"', 3, 3),
(23, 15, '01:00:00', 'Aut voluptate est po', '\"ARswXYYUNYR\"', 3, 3),
(24, 15, '01:00:00', 'Aut voluptate est po', '\"ARswXYYUNYR\"', 3, 3),
(25, 1, '01:00:00', 'Alias suscipit aut l', '\"ARswXYYUNYR\"', 3, 1),
(26, 5, '01:00:00', '', '\"ARswXYYUNYR\"', 0, 4),
(27, 19, '01:00:00', 'Dolorum dolorem reru', '\"ARswXYYUNYR\"', 2, 0),
(28, 20, '01:00:00', 'Nesciunt non aperia', '\"ARswXYYUNYR\"', 1, 3),
(29, 15, '01:00:00', 'Nesciunt non aperia', '\"ARswXYYUNYR\"', 1, 3),
(30, 19, '01:00:00', 'Repudiandae deleniti', '\"ARswXYYUNYR\"', 3, 1),
(31, 18, '01:00:00', 'Rerum quae officiis ', '\"ARswXYYUNYR\"', 3, 1),
(32, 14, '01:00:00', 'Dolore reiciendis se', '\"ARswXYYUNYR\"', 2, 2),
(33, 17, '01:00:00', 'Quis distinctio Odi', '\"ARswXYYUNYR\"', 2, 2),
(34, 10, '01:00:00', 'Saepe consequatur ip', '\"ARswXYYUNYR\"', 2, 1),
(35, 20, '01:00:00', 'Et aliquam delectus', '\"ARswXYYUNYR\"', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `schedule_days`
--

CREATE TABLE `schedule_days` (
  `days` varchar(30) DEFAULT NULL,
  `day_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `schedule_days`
--

INSERT INTO `schedule_days` (`days`, `day_id`) VALUES
('Monday', 1),
('Tuesday', 2),
('Wednesday', 3),
('Thursday', 4),
('Friday', 5),
('Saturday', 6),
('Sunday', 7);

-- --------------------------------------------------------

--
-- Structure de la table `schedule_hours`
--

CREATE TABLE `schedule_hours` (
  `hour_id` int(11) DEFAULT NULL,
  `hour_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `schedule_hours`
--

INSERT INTO `schedule_hours` (`hour_id`, `hour_value`) VALUES
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 14),
(1, 50),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(6, 9),
(6, 10),
(6, 11),
(6, 12),
(6, 14),
(6, 15),
(6, 16),
(6, 17),
(6, 18),
(6, 19),
(6, 20),
(5, 9),
(5, 10),
(5, 11),
(5, 12),
(5, 16),
(5, 17),
(5, 18),
(5, 19),
(5, 20),
(5, 21),
(5, 22),
(7, 9),
(7, 10),
(7, 11),
(7, 12);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(55) NOT NULL,
  `user_pwd` varchar(155) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_refernce` varchar(255) DEFAULT NULL,
  `user_role` varchar(55) NOT NULL,
  `user_phone_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pwd`, `user_email`, `user_refernce`, `user_role`, `user_phone_number`) VALUES
(1, 'rabiei', '123', 'Rabie@gmail.com', NULL, '', NULL),
(5, 'rabiei', '123', 'Rabiiie@gmail.com', 'ARswXYYUNYR', '', NULL),
(6, 'alina', '12345', 'Alina@gmail.com', 'XRRmUvwsZQXR', '', NULL),
(8, 'alina', '12345', 'Alinaa@gmail.com', 'QvZQZwUAvmRO', '', NULL),
(9, 'alina', '12345', 'Alinaa@outlook.com', 'QQXRYsPOsYY', '', NULL),
(10, 'ysername', 'ffff', 'rrf@rf.cof', 'ff', '', NULL),
(11, 'Aliquip dolores vel ', '', 'Velit tempore nihil', '7XULRN7mOYwY', '', NULL),
(12, 'Ea tempora aut labor', '', 'Do aliqua Veniam m', 'YRwZAUsZQQvN', '', NULL),
(13, 'Perferendis quidem r', '', 'Voluptate dolor susc', 'RvUUOwAURZLX', '', NULL),
(14, 'Cum ea repudiandae a', '', 'Eos odit reiciendis', 's8wXYU7wvA', '', NULL),
(15, 'Molestiae nostrud es', '', 'Eaque voluptatibus e', 'sAYvPZvswv', '', NULL),
(16, 'Quidem qui sunt dolo', '', 'Quia nesciunt cupid', 'OPQXZQssvY', '', NULL),
(17, 'Labore cupiditate ir', '', 'Corrupti rem rerum ', 'UNZXOmNQYRv', '', NULL),
(18, 'Laborum elit asperi', '', 'Rerum veniam aliqua', 'QYXYvNsUZsAs', '', NULL),
(19, 'Fugit ut optio eve', '', 'Atque quis in molest', 'UQwYNRvZZvQU', '', NULL),
(22, 'Voluptatibus laborum', '', 'Suscipit sit duis vo', 'QXXvXPwwRXv', '', NULL),
(23, 'Accusamus repellendu', '', 'Officiis debitis ess', 'vZROZUwLUXURw', '', NULL),
(24, 'Maiores magnam omnis', '', 'Mollitia perspiciati', 'PYXOAvZZUvUA', '', NULL),
(25, 'Maxime aut soluta si', '', 'Veniam omnis commod', 'YvQYZRXmXw', '', NULL),
(26, 'Cillum ea ut quisqua', '', 'Sapiente in rerum la', 'YXmUPZwvUUX', '', NULL),
(27, 'Voluptatem Elit ac', '', 'In totam aliquam est', 'XRARwsssAYU', '', NULL),
(28, 'Recusandae Quasi de', '', 'Sint non lorem id p', 'XPvYXQUNvs', '', NULL),
(29, 'Ut eaque rerum venia', '', 'Iusto aliquam in neq', 'mvYZPPsssXQ', '', NULL),
(30, 'Rem mollitia id reru', '', 'Aspernatur deserunt ', 'swNXvPvw8LUNR', '', NULL),
(31, 'Vel quis aliquip est', '', 'Velit qui maiores i', 'UQvURLRZYX', '', NULL),
(32, 'Sequi fugiat omnis ', '', 'Laboris dolores accu', 'YvsNYsOLRPUP', '', 91),
(33, 'Ipsa aute veniam a', 'Pa$$w0rd!', 'Quae cupidatat aliqu', 'YsvUsZswmw', '', 26),
(34, 'Aut eu a et qui sed ', 'Pa$$w0rd!', 'Officia ut ea qui eu', 'UUmvwRwvwv', '', 4),
(36, 'Quam corporis reicie', 'vffffffffff', 'Quod et ab recusanda', 'UwZQPNvUUwAQ', '', 10),
(37, 'Quas veritatis quia ', 'Quas et dolore deser', 'Totam ut similique r', 'RAXYRZNZXR', '', 7),
(38, 'Adipisicing atque om', '4453', 'Adipisicing et aut s', 'wXYXsPXvwNv', '', 2),
(39, 'Omnis sint non inci', 'Pa$$w0rd!', 'Molestiae consequatu', 'PNvPOUPvmmwRR', '', 41),
(40, 'Vero voluptatem qui ', 'Pa$$w0rd!', 'Aliquip facilis enim', 'sXwQPZPYZvRNA', '', NULL),
(41, 'Modi sed aute ipsam ', 'Pa$$w0rd!', 'Asperiores occaecat ', 'sQR8YYvPQw', '', 72),
(42, 'Nemo labore eos cons', 'Pa$$w0rd!', 'Officia laborum haru', 'UYZZRvAYZY', '', 81),
(43, 'Architecto accusanti', 'Pa$$w0rd!', 'Sint voluptatum enim', 'OUsRRXvQswsR', '', 89),
(44, 'rrr', '43334', 'rrr@ff,c', 'XXOmsQQsAYvv', '', 6),
(45, 'Aliquid fugit quis ', 'rabi1234', 'Animi praesentium f', 'QXssQYUAZv', '', 53),
(46, 'Illum in sed enim a', 'fgpfpf44', 'Autem autem molestia', 'YZXUwXvsNPY', '', 11),
(47, 'rabie', 'rabie444', 'rabie@gmailc.om', 'AXYX8YUAAvRO', '', 4040404),
(48, 'Numquam vero sunt al', 'Pa$$w0rd!', 'Perspiciatis qui mo', 'ROUUPZQZUZ7P', '', 32),
(49, 'Porro fuga Adipisic', 'fff44', 'Magnam elit et veni', 'vZZwwYUROYXU', '', 21),
(50, 'rabie', 'paswrod', 'email', 'fff4f', '', 605540),
(51, 'Minima illum archit', 'Pa$$w0rd!', 'Nobis commodi quia o', 'sYR8sOsXPw', 'client', 61),
(52, 'Cum exercitationem e', 'Pa$$w0rd!', 'Sit ex ipsum est es', 'PAXZUYvU7QZ', 'client', 33),
(54, 'Reiciendis consequat', 'Pa$$w0rd!', 'Quo laudantium aut ', 'vsYUQZNvNws', 'client', 78);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_email` (`employee_email`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Index pour la table `schedule_days`
--
ALTER TABLE `schedule_days`
  ADD PRIMARY KEY (`day_id`);

--
-- Index pour la table `schedule_hours`
--
ALTER TABLE `schedule_hours`
  ADD KEY `hour_id` (`hour_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_refernce` (`user_refernce`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `schedule_days`
--
ALTER TABLE `schedule_days`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `schedule_hours`
--
ALTER TABLE `schedule_hours`
  ADD CONSTRAINT `schedule_hours_ibfk_1` FOREIGN KEY (`hour_id`) REFERENCES `schedule_days` (`day_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

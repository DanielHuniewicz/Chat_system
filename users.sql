-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Cze 2020, 12:22
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `day2`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `login` varchar(50) COLLATE utf16_polish_ci NOT NULL,
  `pass` varchar(100) COLLATE utf16_polish_ci NOT NULL,
  `email` varchar(50) COLLATE utf16_polish_ci NOT NULL,
  `wiek` int(11) NOT NULL,
  `telefon` int(11) NOT NULL,
  `Miejscowosc` varchar(50) COLLATE utf16_polish_ci NOT NULL,
  `avatar` varchar(100) COLLATE utf16_polish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`login`, `pass`, `email`, `wiek`, `telefon`, `Miejscowosc`, `avatar`, `admin`) VALUES
('Adam', '$2y$10$E3W9sqCysNpKKvuK01Ht9OZFsiZNVH2uw.arNTDE9HUpwaIilxnTi', 'adam@wp.pl', 22, 885234123, 'Szczecin', '', 0),
('artur', 'qwe123456', 'artur@gmail.com', 0, 0, '', '', 0),
('Daniel', 'qwe123', 'daniel@gmail.com', 26, 793123942, 'Goleniow', 'https://image.flaticon.com/icons/svg/147/147144.svg', 1),
('danieltest', 'qwe1234', '', 0, 0, '', 'https://image.flaticon.com/icons/svg/147/147144.svg', 0),
('danieltest1', 'qwe123', '', 0, 0, '', 'https://cdn.iconscout.com/icon/free/png-512/avatar-380-456332.png', 0),
('danieltest2', 'qwe123', '', 0, 0, '', 'https://cdn.iconscout.com/icon/free/png-512/avatar-367-456319.png', 0),
('empty', 'qwe123', 'artur@gmail.com', 0, 0, '', '', 0),
('test777', '83560a75c016ee68f0dd71bf1bb35b84', 'daniel@gmail.com', 26, 793123942, 'Goleniow', 'https://image.flaticon.com/icons/svg/147/147144.svg', 1),
('Wojtek', '$2y$10$5KW1SCt7OzjfABRQMka0Le6WV9Igz9uB6KKfRKcIDcLeKSGvqzsB.', 'wojtek@o2.pl', 31, 334632673, 'Szczecin', '', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

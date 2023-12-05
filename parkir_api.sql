-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jul 2023 pada 13.10
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir_api`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jeniskendaraan`
--

CREATE TABLE `jeniskendaraan` (
  `idJenisKendaraan` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Tarif` float NOT NULL,
  `CreateDate` datetime NOT NULL,
  `ModifyDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jeniskendaraan`
--

INSERT INTO `jeniskendaraan` (`idJenisKendaraan`, `Nama`, `Tarif`, `CreateDate`, `ModifyDate`) VALUES
(2, 'Motor', 5000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Mobil', 10000, '2023-07-22 19:56:23', '2023-07-22 19:56:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `parkir`
--

CREATE TABLE `parkir` (
  `idParkir` int(11) NOT NULL,
  `idTempatParkir` int(11) NOT NULL,
  `idJenisKendaraan` int(11) NOT NULL,
  `TotalBayar` float NOT NULL,
  `PlatNomor` varchar(10) NOT NULL,
  `JamMasuk` datetime NOT NULL,
  `JamKeluar` datetime NOT NULL,
  `StatusParkir` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `parkir`
--

INSERT INTO `parkir` (`idParkir`, `idTempatParkir`, `idJenisKendaraan`, `TotalBayar`, `PlatNomor`, `JamMasuk`, `JamKeluar`, `StatusParkir`) VALUES
(24, 5, 2, 56500, 'AK-1010-CB', '2023-07-23 00:29:08', '2023-07-23 11:46:20', 0),
(25, 5, 3, 0, 'AK-2121-FG', '2023-07-23 11:46:40', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tempatparkir`
--

CREATE TABLE `tempatparkir` (
  `idTempatParkir` int(11) NOT NULL,
  `idJenisKendaraan` int(11) NOT NULL,
  `Posisi` varchar(5) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `ModifyDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tempatparkir`
--

INSERT INTO `tempatparkir` (`idTempatParkir`, `idJenisKendaraan`, `Posisi`, `CreateDate`, `ModifyDate`) VALUES
(3, 2, 'A1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 'A2', '2023-07-22 16:07:48', '2023-07-22 16:07:48'),
(5, 2, 'A3', '2023-07-22 16:07:48', '2023-07-22 16:07:48'),
(6, 2, 'A4', '2023-07-22 16:07:48', '2023-07-22 16:07:48'),
(7, 2, 'A5', '2023-07-22 16:07:48', '2023-07-22 16:07:48'),
(8, 2, 'A6', '2023-07-22 16:07:48', '2023-07-22 16:07:48'),
(9, 2, 'A7', '2023-07-22 20:06:40', '2023-07-22 20:06:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Level` int(11) NOT NULL,
  `CreateDate` datetime NOT NULL,
  `ModifyDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`idUser`, `Nama`, `Email`, `Password`, `Level`, `CreateDate`, `ModifyDate`) VALUES
(2, 'Admin', 'admin@gmail.com', 'admin123', 1, '2023-07-22 14:09:15', '2023-07-22 14:09:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jeniskendaraan`
--
ALTER TABLE `jeniskendaraan`
  ADD PRIMARY KEY (`idJenisKendaraan`);

--
-- Indeks untuk tabel `parkir`
--
ALTER TABLE `parkir`
  ADD PRIMARY KEY (`idParkir`),
  ADD KEY `idTempatParkir` (`idTempatParkir`),
  ADD KEY `idJenisKendaraan` (`idJenisKendaraan`);

--
-- Indeks untuk tabel `tempatparkir`
--
ALTER TABLE `tempatparkir`
  ADD PRIMARY KEY (`idTempatParkir`),
  ADD KEY `idJenisKendaraan` (`idJenisKendaraan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jeniskendaraan`
--
ALTER TABLE `jeniskendaraan`
  MODIFY `idJenisKendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `parkir`
--
ALTER TABLE `parkir`
  MODIFY `idParkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tempatparkir`
--
ALTER TABLE `tempatparkir`
  MODIFY `idTempatParkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

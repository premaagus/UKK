-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2019 at 06:04 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pembayaran_listrik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `kodeLogin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `namaLengkap` varchar(50) NOT NULL,
  `level` smallint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`kodeLogin`, `username`, `password`, `namaLengkap`, `level`) VALUES
(1, 'admin', '$2y$12$5bNb7SnQ3dna3zJkQWB2L./fTvh4D/soUgFNHjIQaouYUXGlvCICa', 'I Wayan Prema Agus Prasetya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `kodePelanggan` int(11) NOT NULL,
  `noPelanggan` varchar(25) NOT NULL,
  `noMeter` int(15) NOT NULL,
  `pelangganKodeTarif` int(11) NOT NULL,
  `namaLengkap` varchar(50) NOT NULL,
  `telp` varchar(16) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`kodePelanggan`, `noPelanggan`, `noMeter`, `pelangganKodeTarif`, `namaLengkap`, `telp`, `alamat`) VALUES
(4, '12948', 0, 3, 'premaagus', '087761661668', 'denpasar'),
(5, '1204998710', 102870172, 2, 'asdas', '9102740', 'sanur');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `kodePembayaran` int(11) NOT NULL,
  `pembayaranKodeTagihan` int(11) NOT NULL,
  `tglBayar` datetime NOT NULL,
  `jumlahTagihan` double NOT NULL,
  `buktiPembayaran` varchar(100) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tagihan`
--

CREATE TABLE `tb_tagihan` (
  `kodeTagihan` int(11) NOT NULL,
  `noTagihan` int(15) NOT NULL,
  `tagihanKodePelanggan` int(11) NOT NULL,
  `tahunTagih` mediumint(5) NOT NULL,
  `bulanTagih` smallint(3) NOT NULL,
  `pemakaianAkhir` int(15) NOT NULL,
  `jumlahPemakaian` int(15) NOT NULL,
  `tglPencatatan` date NOT NULL,
  `totalBayar` int(25) NOT NULL,
  `tglMulaiBayar` date NOT NULL,
  `tglAkhirBayar` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tagihan`
--

INSERT INTO `tb_tagihan` (`kodeTagihan`, `noTagihan`, `tagihanKodePelanggan`, `tahunTagih`, `bulanTagih`, `pemakaianAkhir`, `jumlahPemakaian`, `tglPencatatan`, `totalBayar`, `tglMulaiBayar`, `tglAkhirBayar`, `status`, `keterangan`) VALUES
(1, 1294817249, 5, 2018, 1, 200, 4000, '2019-01-24', 50000, '2019-01-01', '2019-01-05', 'belum', 'harus bayar');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `kodeTarif` int(11) NOT NULL,
  `daya` int(10) NOT NULL,
  `tarifPerKwh` double NOT NULL,
  `beban` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tarif`
--

INSERT INTO `tb_tarif` (`kodeTarif`, `daya`, `tarifPerKwh`, `beban`) VALUES
(2, 2000, 300, 50),
(3, 2500, 3000, 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`kodeLogin`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`kodePelanggan`),
  ADD KEY `FK_pelangganKodeTarif` (`pelangganKodeTarif`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`kodePembayaran`),
  ADD KEY `FK_pembayaranKodeTagihan` (`pembayaranKodeTagihan`);

--
-- Indexes for table `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  ADD PRIMARY KEY (`kodeTagihan`),
  ADD KEY `FK_tagihanKodePelanggan` (`tagihanKodePelanggan`);

--
-- Indexes for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`kodeTarif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `kodeLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `kodePelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `kodePembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  MODIFY `kodeTagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `kodeTarif` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD CONSTRAINT `FK_pelangganKodeTarif` FOREIGN KEY (`pelangganKodeTarif`) REFERENCES `tb_tarif` (`KodeTarif`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `FK_pembayaranKodeTagihan` FOREIGN KEY (`pembayaranKodeTagihan`) REFERENCES `tb_tagihan` (`kodeTagihan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_tagihan`
--
ALTER TABLE `tb_tagihan`
  ADD CONSTRAINT `FK_tagihanKodePelanggan` FOREIGN KEY (`tagihanKodePelanggan`) REFERENCES `tb_pelanggan` (`kodePelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

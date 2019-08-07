-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Mar 2019 pada 08.05
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipbi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(6) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `register` int(11) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `ukuran` varchar(15) NOT NULL,
  `bahan` varchar(20) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `no_pabrik` varchar(10) NOT NULL,
  `sumber_perolehan` varchar(15) NOT NULL,
  `harga_perolehan` float NOT NULL,
  `supplier` varchar(15) NOT NULL,
  `ruang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `register`, `merk`, `ukuran`, `bahan`, `tanggal_beli`, `no_pabrik`, `sumber_perolehan`, `harga_perolehan`, `supplier`, `ruang`) VALUES
('KB001', 'Nama Barang', 2, 'Merk', 'sedang', 'kayu', '2019-03-24', '09090', 'APBN', 100000, 'SUP002', 'Kelas 1'),
('KB002', 'Barang2', 2, 'Merk2', 'Ukuran 2', 'Bahan 2', '2019-03-31', '0101011', 'APBD', 100000, 'SUP01', 'Ruang TU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keadaan_barang`
--

CREATE TABLE `keadaan_barang` (
  `kode_barang` varchar(6) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `rusak_ringan` int(11) NOT NULL DEFAULT '0',
  `rusak_berat` int(11) NOT NULL DEFAULT '0',
  `hilang` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keadaan_barang`
--

INSERT INTO `keadaan_barang` (`kode_barang`, `jumlah`, `rusak_ringan`, `rusak_berat`, `hilang`) VALUES
('BR002', 10, 5, 3, 2),
('KB002', 10, 5, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `no_faktur` varchar(6) NOT NULL,
  `kode_supplier` varchar(6) NOT NULL,
  `kode_barang` varchar(6) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `harga_satuan` float NOT NULL,
  `harga_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`no_faktur`, `kode_supplier`, `kode_barang`, `tanggal_pembelian`, `jumlah_barang`, `harga_satuan`, `harga_total`) VALUES
('F002', 'SUP002', 'Barang', '2019-12-31', 2, 0, 500000),
('F003', 'SUP002', 'Barang', '2019-12-31', 2, 100000, 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penanggung`
--

CREATE TABLE `penanggung` (
  `nama` varchar(15) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `kelas` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penanggung`
--

INSERT INTO `penanggung` (`nama`, `nip`, `kelas`) VALUES
('Penanggung Jawa', '00909090909', 'Ruang TU');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `kode_supplier` varchar(6) NOT NULL,
  `nama_supplier` varchar(25) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`kode_supplier`, `nama_supplier`, `alamat`, `no_telp`) VALUES
('SUP002', 'Nama Supplier 2', 'alamat', '0909099'),
('Sup003', 'nama sup 3', 'alamat sup 3', '0909090'),
('SUP01', 'Cv Supply', 'Alamat Supplier', '001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `level` varchar(12) NOT NULL,
  `nama_user` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `level`, `nama_user`) VALUES
('admin', 'admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `keadaan_barang`
--
ALTER TABLE `keadaan_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_faktur`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supplier`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

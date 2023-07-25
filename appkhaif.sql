-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Jul 2023 pada 13.48
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appkhaif`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barangmasuk`
--

CREATE TABLE `tbl_barangmasuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah_masuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_barangmasuk`
--

INSERT INTO `tbl_barangmasuk` (`id_masuk`, `id_barang`, `tanggal_masuk`, `jumlah_masuk`) VALUES
(1, 7, '2023-07-18', 2),
(2, 5, '2023-07-18', 1),
(3, 7, '2023-07-19', 492),
(4, 6, '2023-07-19', 100),
(5, 10, '2023-07-23', 2),
(6, 12, '2023-07-23', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_order`
--

CREATE TABLE `tbl_detail_order` (
  `id_do` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_order`
--

INSERT INTO `tbl_detail_order` (`id_do`, `qty`, `harga`, `id_order`, `id_produk`, `tanggal`) VALUES
(23, 2, 9000, 29, 10, '2023-07-23'),
(24, 1, 10000, 29, 11, '2023-07-23'),
(25, 10, 10000, 30, 11, '2023-07-23'),
(26, 10, 9000, 30, 10, '2023-07-23'),
(27, 184, 9000, 31, 10, '2023-07-23');

--
-- Trigger `tbl_detail_order`
--
DELIMITER $$
CREATE TRIGGER `tg_stok_barang` AFTER INSERT ON `tbl_detail_order` FOR EACH ROW UPDATE tbl_produk SET tbl_produk.qty=tbl_produk.qty-NEW.qty WHERE tbl_produk.id_produk=NEW.id_produk
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_order_jasa`
--

CREATE TABLE `tbl_detail_order_jasa` (
  `id_do` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_order_jasa`
--

INSERT INTO `tbl_detail_order_jasa` (`id_do`, `qty`, `harga`, `id_order`, `tanggal`, `id_produk`) VALUES
(1, 40, 1000, 1, '2023-07-23', 9),
(2, 1, 5000, 1, '2023-07-23', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(15, 1, 1),
(19, 1, 3),
(24, 1, 9),
(30, 1, 2),
(31, 1, 10),
(32, 1, 11),
(33, 1, 12),
(34, 1, 14),
(35, 2, 14),
(36, 1, 15),
(37, 1, 16),
(38, 2, 16),
(39, 1, 19),
(40, 1, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jasa`
--

CREATE TABLE `tbl_jasa` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jasa`
--

INSERT INTO `tbl_jasa` (`id_produk`, `nama_produk`, `harga`, `foto`) VALUES
(8, 'Print Warna', 1500, 'Print.jpg'),
(9, 'Print Hitam Putih', 1000, 'Print_copy.JPG'),
(10, 'Jilid', 5000, 'Jilid.png'),
(11, 'Laminating', 5000, 'Laminating.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 'n'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 'y'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 'n'),
(9, 'Contoh Form', 'welcome/form', 'fa fa-id-card', 0, 'n'),
(10, 'DATA SUPPLIER', 'tbl_supplier', 'fa fa-truck', 0, 'y'),
(11, 'DATA BARANG', '-', 'fa fa-tag', 0, 'y'),
(12, 'TRANSAKSI', 'list_produk', 'fa fa-cart-arrow-down', 14, 'y'),
(13, 'RIWAYAT TRANSAKSI', 'tbl_order', 'fa fa-laptop', 14, 'y'),
(14, 'TRANSAKSI BARANG', '-', 'fa fa-shopping-cart', 0, 'y'),
(15, 'DATA JASA', 'tbl_jasa', 'fa fa-tags', 0, 'y'),
(16, 'TRANSAKSI JASA', '-', 'fa fa-shopping-cart', 0, 'y'),
(17, 'TRANSAKSI', 'list_produk/jasa', 'fa fa-cart-arrow-down', 16, 'y'),
(18, 'RIWAYAT TRANSAKSI', 'tbl_order/jasa', 'fa fa-laptop', 16, 'y'),
(19, 'DATA PENGELUARAN', 'tbl_pengeluaran', 'fa fa-money', 0, 'y'),
(20, 'CETAK LAPORAN', '-', 'fa fa-print', 0, 'y'),
(21, 'LAPORAN BARANG MASUK', 'cetak_laporan', 'fa fa-file-pdf-o', 20, 'y'),
(22, 'LAPORAN STOK BARANG', 'cetak_laporan/stok_barang', 'fa fa-file-pdf-o', 20, 'y'),
(23, 'REKOMENDASI RESTOK', 'cetak_laporan/restok_barang', 'fa fa-file-pdf-o', 20, 'y'),
(24, 'LAPORAN DATA PENGELUARAN', 'cetak_laporan/pengeluaran', 'fa fa-file-pdf-o', 20, 'y'),
(25, 'KINERJA KARYAWAN (BARANG)', 'cetak_laporan/laporan_kinerja', 'fa fa-file-pdf-o', 20, 'y'),
(26, 'KINERJA KARYAWAN (JASA)', 'cetak_laporan/kinerja_jasa', 'fa fa-file-pdf-o', 20, 'y'),
(27, 'LAPORAN PENJUALAN', 'cetak_laporan/penjualan_barang', 'fa fa-file-pdf-o', 20, 'y'),
(28, 'REKAP LABA KOTOR', 'cetak_laporan/laba', 'fa fa-file-pdf-o', 20, 'y'),
(29, 'DATA STOK BARANG', 'tbl_produk', 'fa fa-archive', 11, 'y'),
(30, 'RIWAYAT PENAMBAHAN STOK', 'tbl_barangmasuk', 'fa fa-shopping-basket', 11, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id_order` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_users` int(11) NOT NULL,
  `status` enum('Sedang Diproses','Selesai') NOT NULL,
  `ongkir` varchar(100) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `jenis_pembayaran` varchar(50) NOT NULL,
  `status_pembayaran` varchar(50) DEFAULT NULL,
  `bukti_pembayaran` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_order`
--

INSERT INTO `tbl_order` (`id_order`, `tanggal`, `id_users`, `status`, `ongkir`, `id_karyawan`, `jenis_pembayaran`, `status_pembayaran`, `bukti_pembayaran`) VALUES
(29, '2023-07-23', 13, 'Selesai', '2', 1, 'Pembayaran Online', 'Sudah Dibayar', 'ok.png'),
(30, '2023-07-23', 15, 'Selesai', '2', 1, 'Pembayaran Online', 'Sudah Dibayar', 'ok1.png'),
(31, '2023-07-23', 13, 'Selesai', '1', 1, 'Bayar Ditempat', 'Sudah Dibayar', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_order_jasa`
--

CREATE TABLE `tbl_order_jasa` (
  `id_order` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_users` int(11) NOT NULL,
  `status` enum('Sedang Diproses','Selesai') NOT NULL,
  `ongkir` varchar(100) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `file` text NOT NULL,
  `jenis_pembayaran` varchar(50) NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL,
  `bukti_pembayaran` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_order_jasa`
--

INSERT INTO `tbl_order_jasa` (`id_order`, `tanggal`, `id_users`, `status`, `ongkir`, `id_karyawan`, `file`, `jenis_pembayaran`, `status_pembayaran`, `bukti_pembayaran`) VALUES
(1, '2023-07-23', 15, 'Selesai', '1', 1, '', 'Bayar Ditempat', 'Sudah Dibayar', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengeluaran`
--

CREATE TABLE `tbl_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `id_users` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pengeluaran`
--

INSERT INTO `tbl_pengeluaran` (`id_pengeluaran`, `tanggal`, `nominal`, `keterangan`, `id_users`, `kategori`) VALUES
(1, '2023-07-05', 20000, 'Bensin', 1, 'Bahan Bakar'),
(2, '2023-07-11', 21000, 'Tambal Ban', 1, 'Lainnya'),
(3, '2023-07-23', 15000000, 'Listrik', 1, 'Tagihan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jenis_produk` enum('Barang','Jasa') NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `id_supplier`, `nama_produk`, `qty`, `harga`, `jenis_produk`, `tanggal_masuk`, `foto`) VALUES
(9, 3, 'Pulpen', 500, 5000, 'Barang', '2023-07-22', 'pulpen.jpg'),
(10, 3, 'Tip X', 6, 9000, 'Barang', '2023-07-22', 'Tip_x.jpg'),
(11, 3, 'Stopmap', 289, 10000, 'Barang', '2023-07-22', 'stopmap.jpg'),
(13, 3, 'Tip ex Joyko', 200, 7000, 'Barang', '2023-07-23', ''),
(14, 3, 'Kertas F4 pack', 100, 50000, 'Barang', '2023-07-23', 'Kertas_A41.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `no_hp`, `email`) VALUES
(3, 'Toko', '-', '-', 'ryan@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `no_hp`, `jenis_kelamin`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(1, 'Ryan', '085249373788', 'Laki-laki', 'ryan@gmail.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 1, 'y'),
(13, 'Navid', '081565488155', 'Laki-laki', 'Navid@gmail.com', '$2y$04$6gQjj7ISvHX4a2PcMoeaju5hQnJck8OrVKSFhMBoSW0AbVpUAUBtK', '', 2, 'y'),
(14, 'Dimas', '087628321293', 'Laki-laki', 'Dimas@gmail.com', '$2y$04$zFpGnl6Tb00dFozlkXqJ7OhHjFjZdxtbxWSft7fDVWkj89B9rnyd.', '', 2, 'y'),
(15, 'Bayu', '098537438924', 'Laki-laki', 'bayu@gmail.com', '$2y$04$9ycpUIIEIEDTFMcAA4OA6uhf.zXkDCaD4sYEJp2Rx9uhmH5svmBMG', '', 2, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Admin'),
(2, 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barangmasuk`
--
ALTER TABLE `tbl_barangmasuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indeks untuk tabel `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD PRIMARY KEY (`id_do`);

--
-- Indeks untuk tabel `tbl_detail_order_jasa`
--
ALTER TABLE `tbl_detail_order_jasa`
  ADD PRIMARY KEY (`id_do`);

--
-- Indeks untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_jasa`
--
ALTER TABLE `tbl_jasa`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `tbl_order_jasa`
--
ALTER TABLE `tbl_order_jasa`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indeks untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeks untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barangmasuk`
--
ALTER TABLE `tbl_barangmasuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  MODIFY `id_do` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_order_jasa`
--
ALTER TABLE `tbl_detail_order_jasa`
  MODIFY `id_do` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tbl_jasa`
--
ALTER TABLE `tbl_jasa`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tbl_order_jasa`
--
ALTER TABLE `tbl_order_jasa`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

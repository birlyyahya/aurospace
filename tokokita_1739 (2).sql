-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2022 pada 03.36
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokokita_1739`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `idadmin` int(2) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`idadmin`, `username`, `password`) VALUES
(1, 'birly', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_biaya_kirim`
--

CREATE TABLE `tbl_biaya_kirim` (
  `idbiayakirim` int(5) NOT NULL,
  `idkurir` int(3) NOT NULL,
  `idkotaasal` int(4) NOT NULL,
  `idkotatujuan` int(4) NOT NULL,
  `biaya` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_biaya_kirim`
--

INSERT INTO `tbl_biaya_kirim` (`idbiayakirim`, `idkurir`, `idkotaasal`, `idkotatujuan`, `biaya`) VALUES
(4, 5, 3, 3, 7000),
(5, 6, 3, 6, 90000),
(6, 5, 5, 6, 80000),
(7, 5, 3, 5, 32000),
(8, 5, 5, 3, 32000),
(9, 5, 5, 6, 56000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_order`
--

CREATE TABLE `tbl_detail_order` (
  `iddetailorder` int(10) NOT NULL,
  `idorder` int(5) NOT NULL,
  `idproduk` int(5) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` int(10) NOT NULL,
  `ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_detail_order`
--

INSERT INTO `tbl_detail_order` (`iddetailorder`, `idorder`, `idproduk`, `jumlah`, `harga`, `ongkir`) VALUES
(56, 76, 12, 2, 500000, 7000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `idkategori` int(5) NOT NULL,
  `namakategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`idkategori`, `namakategori`) VALUES
(1, 'Baju'),
(2, 'hoodie'),
(3, 'headset'),
(4, 'headphone'),
(5, 'Pants'),
(6, 'Short Pants'),
(7, 'Socks');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kesehatantoko`
--

CREATE TABLE `tbl_kesehatantoko` (
  `idkesehatantoko` int(5) NOT NULL,
  `idtoko` int(5) NOT NULL,
  `nilai` float NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kesehatantoko`
--

INSERT INTO `tbl_kesehatantoko` (`idkesehatantoko`, `idtoko`, `nilai`, `catatan`) VALUES
(1, 3, 100, 'Sangat Baik\r\n'),
(2, 1, 100, 'Sangat Baik'),
(3, 2, 100, 'Sangat Baik\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_komentar`
--

CREATE TABLE `tbl_komentar` (
  `idkomentar` int(11) NOT NULL,
  `iddetailorder` int(5) NOT NULL,
  `nilai` int(1) NOT NULL,
  `komentar` text NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_komentar`
--

INSERT INTO `tbl_komentar` (`idkomentar`, `iddetailorder`, `nilai`, `komentar`, `gambar`) VALUES
(8, 56, 2, 'penipu', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_konfirmasi`
--

CREATE TABLE `tbl_konfirmasi` (
  `idkonfirmasi` int(5) NOT NULL,
  `idorder` int(5) NOT NULL,
  `buktitf` varchar(100) NOT NULL,
  `validasi` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_konfirmasi`
--

INSERT INTO `tbl_konfirmasi` (`idkonfirmasi`, `idorder`, `buktitf`, `validasi`) VALUES
(71, 76, 'product-19.jpg', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kota`
--

CREATE TABLE `tbl_kota` (
  `idkota` int(4) NOT NULL,
  `namakota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kota`
--

INSERT INTO `tbl_kota` (`idkota`, `namakota`) VALUES
(3, 'MATARAM'),
(5, 'JOGJA'),
(6, 'PALEMBANG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kurir`
--

CREATE TABLE `tbl_kurir` (
  `idkurir` int(2) NOT NULL,
  `namakurir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kurir`
--

INSERT INTO `tbl_kurir` (`idkurir`, `namakurir`) VALUES
(5, 'JNE'),
(6, 'POS INDONESIA'),
(7, 'SiCepat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_liked`
--

CREATE TABLE `tbl_liked` (
  `idlike` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `idkonsumen` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_liked`
--

INSERT INTO `tbl_liked` (`idlike`, `idproduk`, `idkonsumen`) VALUES
(48, 11, 1),
(49, 10, 1),
(51, 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_member`
--

CREATE TABLE `tbl_member` (
  `idkonsumen` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `namakonsumen` varchar(50) NOT NULL,
  `alamat` varchar(20) NOT NULL,
  `idkota` int(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` char(15) NOT NULL,
  `statusaktif` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_member`
--

INSERT INTO `tbl_member` (`idkonsumen`, `username`, `password`, `namakonsumen`, `alamat`, `idkota`, `email`, `telp`, `statusaktif`) VALUES
(1, 'birlyyahya', '123', 'birly', 'yogyakarta', 5, 'birlyyahya@students.amikom.ac.id', '085158551580', 'N'),
(2, 'yahya', '123', 'yahya', 'Mataram', 3, 'yahya@gmail.com', '08776537717', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_order`
--

CREATE TABLE `tbl_order` (
  `idorder` int(5) NOT NULL,
  `idkonsumen` int(5) NOT NULL,
  `idtoko` int(5) NOT NULL,
  `tglorder` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `statusorder` enum('Belum Bayar','Dikemas','Dikirim','Diterima','Selesai','Dibatalkan','Reviewed') NOT NULL,
  `noresi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_order`
--

INSERT INTO `tbl_order` (`idorder`, `idkonsumen`, `idtoko`, `tglorder`, `total`, `statusorder`, `noresi`) VALUES
(76, 1, 3, '2022-07-11 03:07:50', 1007000, 'Diterima', 'sfghdtr12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `idproduk` int(5) NOT NULL,
  `idkategori` int(5) NOT NULL,
  `idtoko` int(5) NOT NULL,
  `namaproduk` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL,
  `stok` int(5) NOT NULL,
  `berat` int(5) NOT NULL,
  `deskripsiproduk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`idproduk`, `idkategori`, `idtoko`, `namaproduk`, `foto`, `harga`, `stok`, `berat`, `deskripsiproduk`) VALUES
(3, 4, 2, 'Headphone Xcooser Multi Functional', 'Xcooser_cyberpunk_technology_headphone_functional.jpg', 900000, 2, 600, 'Xcooser cyberpunk technology headphone functional'),
(10, 2, 1, 'Hoodie Streetwear - Etsy', 'japanese_cyberpunk_hoodie_streetwear1.jpg', 600000, 12, 300, 'Swetear wibu hijemete kudasaia western onion'),
(11, 3, 1, 'Grenades Concepts - Cyberpunk 2077', 'Grenades_Original__Concepts_Cyberpunk_2077_Filippo_Ubertino1.jpg', 230000, 20, 900, 'grenade accesories cyberpunk 2077 octopus colombus '),
(12, 4, 3, 'cybercollar ', 'cybercollar1.jpg', 500000, 3, 200, 'cybercollar accesories in winghole cyber');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_report`
--

CREATE TABLE `tbl_report` (
  `idreport` int(5) NOT NULL,
  `idtoko` int(5) NOT NULL,
  `idorder` int(5) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `jenisreport` enum('Penipuan','Rusak','Tidak Sesuai','Other') NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_report`
--

INSERT INTO `tbl_report` (`idreport`, `idtoko`, `idorder`, `idproduk`, `jenisreport`, `komentar`) VALUES
(22, 3, 76, 12, 'Penipuan', 'nipu ne bang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_saldo`
--

CREATE TABLE `tbl_saldo` (
  `idsaldo` int(5) NOT NULL,
  `idtoko` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_toko`
--

CREATE TABLE `tbl_toko` (
  `idtoko` int(5) NOT NULL,
  `idkonsumen` int(5) NOT NULL,
  `namatoko` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `statusaktif` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_toko`
--

INSERT INTO `tbl_toko` (`idtoko`, `idkonsumen`, `namatoko`, `logo`, `deskripsi`, `statusaktif`) VALUES
(1, 1, 'Basiclopedia', 'Vector_Birly-modified.png', 'toko baju\r\n', 'Y'),
(2, 2, 'Cybershop', 'Spray-modified_(1)1.png', 'Tempatnya techwear', 'Y'),
(3, 2, 'ZARA', 'product-4.jpg', 'branded fashion ', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indeks untuk tabel `tbl_biaya_kirim`
--
ALTER TABLE `tbl_biaya_kirim`
  ADD PRIMARY KEY (`idbiayakirim`),
  ADD KEY `idkurir` (`idkurir`),
  ADD KEY `idkotaasal` (`idkotaasal`),
  ADD KEY `idkotatujuan` (`idkotatujuan`);

--
-- Indeks untuk tabel `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD PRIMARY KEY (`iddetailorder`),
  ADD KEY `idproduk` (`idproduk`),
  ADD KEY `idorder` (`idorder`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indeks untuk tabel `tbl_kesehatantoko`
--
ALTER TABLE `tbl_kesehatantoko`
  ADD PRIMARY KEY (`idkesehatantoko`),
  ADD KEY `idtoko` (`idtoko`);

--
-- Indeks untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD PRIMARY KEY (`idkomentar`),
  ADD KEY `id_detail_order` (`iddetailorder`);

--
-- Indeks untuk tabel `tbl_konfirmasi`
--
ALTER TABLE `tbl_konfirmasi`
  ADD PRIMARY KEY (`idkonfirmasi`),
  ADD KEY `idorder` (`idorder`);

--
-- Indeks untuk tabel `tbl_kota`
--
ALTER TABLE `tbl_kota`
  ADD PRIMARY KEY (`idkota`);

--
-- Indeks untuk tabel `tbl_kurir`
--
ALTER TABLE `tbl_kurir`
  ADD PRIMARY KEY (`idkurir`);

--
-- Indeks untuk tabel `tbl_liked`
--
ALTER TABLE `tbl_liked`
  ADD PRIMARY KEY (`idlike`),
  ADD KEY `idproduk` (`idproduk`),
  ADD KEY `idkonsumen` (`idkonsumen`);

--
-- Indeks untuk tabel `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`idkonsumen`),
  ADD KEY `idkota` (`idkota`);

--
-- Indeks untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`idorder`),
  ADD KEY `idkonsumen` (`idkonsumen`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `idkategori` (`idkategori`),
  ADD KEY `idtoko` (`idtoko`);

--
-- Indeks untuk tabel `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD PRIMARY KEY (`idreport`),
  ADD KEY `idorder` (`idorder`),
  ADD KEY `idproduk` (`idproduk`),
  ADD KEY `idtoko` (`idtoko`);

--
-- Indeks untuk tabel `tbl_saldo`
--
ALTER TABLE `tbl_saldo`
  ADD PRIMARY KEY (`idsaldo`),
  ADD KEY `idtoko` (`idtoko`);

--
-- Indeks untuk tabel `tbl_toko`
--
ALTER TABLE `tbl_toko`
  ADD PRIMARY KEY (`idtoko`),
  ADD KEY `idkonsumen` (`idkonsumen`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `idadmin` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_biaya_kirim`
--
ALTER TABLE `tbl_biaya_kirim`
  MODIFY `idbiayakirim` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  MODIFY `iddetailorder` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `idkategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_kesehatantoko`
--
ALTER TABLE `tbl_kesehatantoko`
  MODIFY `idkesehatantoko` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  MODIFY `idkomentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_konfirmasi`
--
ALTER TABLE `tbl_konfirmasi`
  MODIFY `idkonfirmasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT untuk tabel `tbl_kota`
--
ALTER TABLE `tbl_kota`
  MODIFY `idkota` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_kurir`
--
ALTER TABLE `tbl_kurir`
  MODIFY `idkurir` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_liked`
--
ALTER TABLE `tbl_liked`
  MODIFY `idlike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `idkonsumen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `idorder` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `idproduk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_report`
--
ALTER TABLE `tbl_report`
  MODIFY `idreport` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tbl_saldo`
--
ALTER TABLE `tbl_saldo`
  MODIFY `idsaldo` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_toko`
--
ALTER TABLE `tbl_toko`
  MODIFY `idtoko` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_biaya_kirim`
--
ALTER TABLE `tbl_biaya_kirim`
  ADD CONSTRAINT `tbl_biaya_kirim_ibfk_1` FOREIGN KEY (`idkurir`) REFERENCES `tbl_kurir` (`idkurir`),
  ADD CONSTRAINT `tbl_biaya_kirim_ibfk_2` FOREIGN KEY (`idkotaasal`) REFERENCES `tbl_kota` (`idkota`),
  ADD CONSTRAINT `tbl_biaya_kirim_ibfk_3` FOREIGN KEY (`idkotatujuan`) REFERENCES `tbl_kota` (`idkota`);

--
-- Ketidakleluasaan untuk tabel `tbl_detail_order`
--
ALTER TABLE `tbl_detail_order`
  ADD CONSTRAINT `tbl_detail_order_ibfk_1` FOREIGN KEY (`idorder`) REFERENCES `tbl_order` (`idorder`),
  ADD CONSTRAINT `tbl_detail_order_ibfk_2` FOREIGN KEY (`idproduk`) REFERENCES `tbl_produk` (`idproduk`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_kesehatantoko`
--
ALTER TABLE `tbl_kesehatantoko`
  ADD CONSTRAINT `tbl_kesehatantoko_ibfk_1` FOREIGN KEY (`idtoko`) REFERENCES `tbl_toko` (`idtoko`);

--
-- Ketidakleluasaan untuk tabel `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
  ADD CONSTRAINT `tbl_komentar_ibfk_1` FOREIGN KEY (`iddetailorder`) REFERENCES `tbl_detail_order` (`iddetailorder`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_konfirmasi`
--
ALTER TABLE `tbl_konfirmasi`
  ADD CONSTRAINT `tbl_konfirmasi_ibfk_1` FOREIGN KEY (`idorder`) REFERENCES `tbl_order` (`idorder`);

--
-- Ketidakleluasaan untuk tabel `tbl_liked`
--
ALTER TABLE `tbl_liked`
  ADD CONSTRAINT `tbl_liked_ibfk_1` FOREIGN KEY (`idproduk`) REFERENCES `tbl_produk` (`idproduk`),
  ADD CONSTRAINT `tbl_liked_ibfk_2` FOREIGN KEY (`idkonsumen`) REFERENCES `tbl_member` (`idkonsumen`);

--
-- Ketidakleluasaan untuk tabel `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD CONSTRAINT `tbl_member_ibfk_1` FOREIGN KEY (`idkota`) REFERENCES `tbl_kota` (`idkota`);

--
-- Ketidakleluasaan untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`idkonsumen`) REFERENCES `tbl_member` (`idkonsumen`);

--
-- Ketidakleluasaan untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `tbl_produk_ibfk_1` FOREIGN KEY (`idtoko`) REFERENCES `tbl_toko` (`idtoko`) ON DELETE NO ACTION,
  ADD CONSTRAINT `tbl_produk_ibfk_2` FOREIGN KEY (`idkategori`) REFERENCES `tbl_kategori` (`idkategori`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tbl_report`
--
ALTER TABLE `tbl_report`
  ADD CONSTRAINT `tbl_report_ibfk_1` FOREIGN KEY (`idorder`) REFERENCES `tbl_order` (`idorder`),
  ADD CONSTRAINT `tbl_report_ibfk_2` FOREIGN KEY (`idproduk`) REFERENCES `tbl_produk` (`idproduk`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_report_ibfk_3` FOREIGN KEY (`idtoko`) REFERENCES `tbl_toko` (`idtoko`);

--
-- Ketidakleluasaan untuk tabel `tbl_saldo`
--
ALTER TABLE `tbl_saldo`
  ADD CONSTRAINT `tbl_saldo_ibfk_1` FOREIGN KEY (`idtoko`) REFERENCES `tbl_toko` (`idtoko`);

--
-- Ketidakleluasaan untuk tabel `tbl_toko`
--
ALTER TABLE `tbl_toko`
  ADD CONSTRAINT `tbl_toko_ibfk_1` FOREIGN KEY (`idkonsumen`) REFERENCES `tbl_member` (`idkonsumen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

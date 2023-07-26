<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Welcome to Book-nation</title>

	<style type="text/css">
		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
			text-decoration: none;
		}

		a:hover {
			color: #97310e;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
			min-height: 96px;
		}

		p {
			margin: 0 0 10px;
			padding: 0;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}
	</style>
</head>

<body>

	<div id="container">
		<h1>Welcome to Book-nation!</h1>

		<div id="body">
			<p>Berikut ini contoh fitur pencarian dan rekomendasi item menggunakan content-based filtering dengan algoritma TF-IDF dan Cosine Similarity</p>
			<h3>Pencarian Buku</h3>
			<form action="<?php echo site_url('recommendation') ?>" method="post">
				<input type="text" name="key" />
				<input type="submit" value="Cari" />
			</form>
			<?php if (!empty($buku)) : ?>
				<h4>Hasil Pencarian: </h4>
				<ul type="1">
					<?php foreach ($buku as $item) : ?>
						<li><a href="<?php echo site_url('recommendation/detail/' . $item['id']); ?>">
								<?php echo $item['title'] . " (" . $item['score'] . ")" ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if (!empty($top_n)) : ?>
				<br />
				<p>
					<img src="https://via.placeholder.com/100" /><br />
					<strong>Judul buku: <?php echo $item['namaProduk'] ?></strong><br />
					Harga: <?php echo "Rp " . number_format($item['harga']) ?><br />
					Berat: <?php echo $item['berat'] . "gr" ?><br />
					Stok: <?php echo $item['stok'] ?><br />
				</p>
				<br />
				<strong>Buku yang mungkin anda suka</strong>
				<ul type="1">
					<?php foreach ($top_n as $item) : ?>
						<li><a href="<?php echo site_url('recommendation/detail/' . $item['id']); ?>">
								<?php echo $item['title'] . " (" . $item['score'] . ")" ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

		</div>

		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
	</div>

</body>

</html>
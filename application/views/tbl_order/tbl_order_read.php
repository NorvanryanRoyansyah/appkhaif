        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-ui/themes/base/minified/jquery-ui.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
<div class="content-wrapper">	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title text-center">Fotocopy Al Khaif</h3>
				<p class="text-center">Jl. Seroja No. 91 Kuala Kapuas</p>
				<h5 class="text-center">NOTA TRANSAKSI</h5>
			</div>
		
		<table class='table table-bordered'>        

			<tr>
				<td>Tanggal</td>
				<td><?php echo $tanggal; ?></td>
			</tr>
	
			<tr>
				<td>Nama Customer</td>
				<td><?php echo $full_name; ?></td>
			</tr>
	
			<tr>
				<td>Status</td>
				<td><?php echo $status; ?></td>
			</tr>

			<?php if($ongkir == 1) {
                $jenis = "Diambil Sendiri";
                $ongk = 0;
            } else {
                $jenis = "Diantar (+ Ongkir 20.000)";
                $ongk = 0;
            }
                ?>

			<tr>
				<td>Jenis Pengiriman</td>
				<td><?php echo $jenis; ?></td>
			</tr>

			<tr>
				<td>Detail Barang dan Total</td>
				<td>
				<?php
                    $sum = 0;
                    if($ongkir == 1) {
                        $ongk = 0;
                    } else {
                        $ongk = 20000;
                    }
                    $query   = $this->db->query('SELECT nama_produk,tbl_detail_order.harga as hrg,tbl_detail_order.qty as qt FROM tbl_detail_order 
                    INNER JOIN tbl_produk on tbl_produk.id_produk = tbl_detail_order.id_produk 
                    WHERE tbl_detail_order.id_order = '.$id_order.'');
                    $results = $query->result();
                        foreach ($results as $trx)
                    {
                    ?>    
                    <p><?php echo $trx->nama_produk ?> (x<?php echo $trx->qt ?>) (Rp <?php echo $trx->hrg*$trx->qt ?>)</p>
                    <?php $sum +=  ($trx->hrg*$trx->qt) + $ongk; ?>
                    
                    <?php } ?>
            		<p><b>TOTAL : </b> Rp <?php echo $sum?></p>
				</td>
			</tr>

			<tr>
				<td>Karyawan</td>
				<?php
				$query   = $this->db->query('SELECT * FROM tbl_order LEFT JOIN tbl_user on tbl_order.id_karyawan = tbl_user.id_users WHERE id_order = '.$id_order.'');
				$hasil = $query->result();
				foreach ($hasil as $namakar) {
					if(is_null($namakar->id_karyawan))
					echo '<td>Karyawan Belum Memproses</td>';
					else 
					echo '<td>'.$namakar->full_name.'</td>';
				?>
				<?php } ?>
			</tr>
		
		</table>
		<p class="text-right">Hormat Kami.</p>
		<br>
		<br>
		<br>
		<br>
		<p class="text-right">Fotocopy Al Khaif</p>			

		</div>
	</section>
</div>
<script>
	window.print();
</script>

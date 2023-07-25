
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_JASA</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Nama Produk</td>
				<td><?php echo $nama_produk; ?></td>
			</tr>
	
			<tr>
				<td>Harga</td>
				<td><?php echo $harga; ?></td>
			</tr>
	
			<tr>
				<td>Foto</td>
				<td><img src="<?php echo base_url() ?>assets/produk/<?php echo $foto; ?>" alt=""></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('tbl_jasa') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>
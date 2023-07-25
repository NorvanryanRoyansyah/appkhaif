
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA PRODUK</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Supplier</td>
				<td><?php echo $nama_supplier; ?></td>
			</tr>
	
			<tr>
				<td>Nama Produk</td>
				<td><?php echo $nama_produk; ?></td>
			</tr>
	
			<tr>
				<td>Qty</td>
				<td><?php echo $qty; ?></td>
			</tr>
	
			<tr>
				<td>Harga</td>
				<td><?php echo $harga; ?></td>
			</tr>
	
			<tr>
				<td>Jenis Produk</td>
				<td><?php echo $jenis_produk; ?></td>
			</tr>
	
			<tr>
				<td>Foto</td>
				<td><img src="<?php echo base_url() ?>assets/produk/<?php echo $foto; ?>" class="user-image" alt="User Image" width="50%" height="50%"></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('tbl_produk') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>
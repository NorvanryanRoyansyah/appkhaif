
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_BARANGMASUK</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Id Barang</td>
				<td><?php echo $id_barang; ?></td>
			</tr>
	
			<tr>
				<td>Tanggal Masuk</td>
				<td><?php echo $tanggal_masuk; ?></td>
			</tr>
	
			<tr>
				<td>Jumlah Masuk</td>
				<td><?php echo $jumlah_masuk; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('tbl_barangmasuk') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>
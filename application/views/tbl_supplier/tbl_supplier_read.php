
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA SUPPLIER</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Nama Supplier</td>
				<td><?php echo $nama_supplier; ?></td>
			</tr>
	
			<tr>
				<td>Alamat Supplier</td>
				<td><?php echo $alamat_supplier; ?></td>
			</tr>
	
			<tr>
				<td>No Hp</td>
				<td><?php echo $no_hp; ?></td>
			</tr>
	
			<tr>
				<td>Email</td>
				<td><?php echo $email; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('tbl_supplier') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>
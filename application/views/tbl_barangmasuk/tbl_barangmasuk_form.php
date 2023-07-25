<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA TBL_BARANGMASUK</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Id Barang <?php echo form_error('id_barang') ?></td><td><input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="Id Barang" value="<?php echo $id_barang; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Tanggal Masuk <?php echo form_error('tanggal_masuk') ?></td>
						<td><input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" placeholder="Tanggal Masuk" value="<?php echo $tanggal_masuk; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Jumlah Masuk <?php echo form_error('jumlah_masuk') ?></td><td><input type="text" class="form-control" name="jumlah_masuk" id="jumlah_masuk" placeholder="Jumlah Masuk" value="<?php echo $jumlah_masuk; ?>" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_masuk" value="<?php echo $id_masuk; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_barangmasuk') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>
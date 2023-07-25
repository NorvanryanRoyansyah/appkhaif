<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA SUPPLIER</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Nama Supplier <?php echo form_error('nama_supplier') ?></td><td><input type="text" class="form-control" name="nama_supplier" id="nama_supplier" placeholder="Nama Supplier" value="<?php echo $nama_supplier; ?>" /></td>
					</tr>
	    
					<tr>
						<td width='200'>Alamat Supplier <?php echo form_error('alamat_supplier') ?></td>
						<td> <textarea class="form-control" rows="3" name="alamat_supplier" id="alamat_supplier" placeholder="Alamat Supplier"><?php echo $alamat_supplier; ?></textarea></td>
					</tr>
	
					<tr>
						<td width='200'>No Hp <?php echo form_error('no_hp') ?></td><td><input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Email <?php echo form_error('email') ?></td><td><input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_supplier" value="<?php echo $id_supplier; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_supplier') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>
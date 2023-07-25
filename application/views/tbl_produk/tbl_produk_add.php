<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">TAMBAH STOK</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
			
				<table class='table table-bordered'>
	
					
					<tr>
						<td width='200'>Stok Awal <?php echo form_error('qty') ?></td><td><input type="number" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" readonly/></td>
					</tr>

                    <tr>
						<td width='200'>Penambahan Stok</td><td><input type="number" class="form-control" name="qty_baru" id="qty_baru" placeholder="Qty" required/></td>
					</tr>
	
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_produk') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>
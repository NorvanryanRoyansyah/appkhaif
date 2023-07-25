<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA PRODUK</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Supplier <?php echo form_error('id_supplier') ?></td><td> <?php echo cmb_dinamis('id_supplier','tbl_supplier','nama_supplier','id_supplier',$id_supplier);?></td>
					</tr>
	
					<tr>
						<td width='200'>Nama Produk <?php echo form_error('nama_produk') ?></td><td><input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama Produk" value="<?php echo $nama_produk; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Qty <?php echo form_error('qty') ?></td><td><input type="text" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Harga <?php echo form_error('harga') ?></td><td><input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Jenis Produk <?php echo form_error('jenis_produk') ?></td><td>
						<select name="jenis_produk" id="jenis_produk" class="form-control">
						<option value="Barang">Barang</option>
						</select>
						</td>
					</tr>
	    
					<tr>
						<td width='200'>Foto <?php echo form_error('foto') ?></td>
						<td> <input type="file" class="form-control" rows="3" name="foto" id="foto" placeholder="Foto"/><?php echo $foto; ?></td>
					</tr>

					<tr>
						<td width='200'>Tanggal Masuk <?php echo form_error('tanggal_masuk') ?></td><td><input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" placeholder="Tanggal Masuk" value="<?php echo $tanggal_masuk; ?>" required/></td>
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
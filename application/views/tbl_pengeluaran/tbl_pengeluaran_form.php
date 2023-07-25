<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA TBL_PENGELUARAN</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Tanggal <?php echo form_error('tanggal') ?></td>
						<td><input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo $tanggal; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Nominal <?php echo form_error('nominal') ?></td><td><input type="text" class="form-control" name="nominal" id="nominal" placeholder="Nominal" value="<?php echo $nominal; ?>" /></td>
					</tr>

					<tr>
						<td width='200'>Kategori <?php echo form_error('kategori') ?></td>
						<td>
						<select name="kategori" id="kategori" class="form-control">
							<option value="Tagihan">Tagihan</option>
							<option value="Gaji">Gaji</option>
							<option value="Konsumsi">Konsumsi</option>
							<option value="Bahan Bakar">Bahan Bakar</option>
							<option value="Maintenance">Maintenance</option>
							<option value="Lainnya">Lainnya</option>
						</select>
						</td>
					</tr>
	    
					<tr>
						<td width='200'>Keterangan <?php echo form_error('keterangan') ?></td>
						<td> <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea></td>
					</tr>
	
					<tr hidden>
						<td width='200'>Id Users <?php echo form_error('id_users') ?></td><td><input type="text" class="form-control" name="id_users" id="id_users" placeholder="Id Users" value="<?php echo $this->session->userdata('id_users'); ?>"/></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_pengeluaran" value="<?php echo $id_pengeluaran; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_pengeluaran') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>
<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">UPLOAD BUKTI PEMBAYARAN</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Bukti Pembayaran </td><td><input type="file" class="form-control" name="bukti_pembayaran" id="bukti_pembayaran" placeholder="Bukti" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_order" value="<?php echo $id_order; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_order/jasa') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>
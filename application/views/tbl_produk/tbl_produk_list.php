<?php 
function separateThousands($number) {
    // Menggunakan number_format dengan parameter ribuan (tanda koma) dan desimal (titik).
    // Jika angka desimal tidak dibutuhkan, set parameter desimal menjadi 0.
    return number_format($number, 0, '.', '.');
}
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA PRODUK</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('tbl_produk/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('tbl_produk/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
            <th width="30px">No</th>
		    <th>Supplier</th>
		    <th>Nama Produk</th>
		    <th>Qty</th>
		    <th>Harga</th>
		    <th>Jenis Produk</th>
            <th>Tanggal Masuk</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
            <?php
            $start = 0;
            foreach ($tbl_produk_data as $tbl_produk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tbl_produk->nama_supplier ?></td>
		      <td><?php echo $tbl_produk->nama_produk ?></td>
		      <td><?php echo $tbl_produk->qty ?></td>
		      <td>Rp <?php echo separateThousands($tbl_produk->harga) ?></td>
		      <td><?php echo $tbl_produk->jenis_produk ?></td>
		      <td><?php echo $tbl_produk->tanggal_masuk ?></td>	
              <td>
                <?php 
                echo anchor(site_url('tbl_produk/add_stok/'.$tbl_produk->id_produk.''),'<i class="fa fa-plus" aria-hidden="true"></i>', array('class' => 'btn btn-primary btn-sm'));
                echo ' ';
                echo anchor(site_url('tbl_produk/read/'.$tbl_produk->id_produk.''),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'));
                echo ' ';
                echo anchor(site_url('tbl_produk/update/'.$tbl_produk->id_produk.''),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'));
                echo ' ';
                echo anchor(site_url('tbl_produk/delete/'.$tbl_produk->id_produk.''),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                ?>
              </td>
                </tr>
                <?php
            }
            ?>
	    
        </table>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
       
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
                        <h3 class="box-title">KELOLA DATA JENIS JASA</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('tbl_jasa/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('tbl_jasa/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Nama Produk</th>
		    <th>Harga</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
            <?php
            foreach ($tbl_jasa_data as $tbl_jasa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tbl_jasa->nama_produk ?></td>
		      <td>Rp <?php echo separateThousands($tbl_jasa->harga) ?></td>	
              <td>
                <?php 
                echo anchor(site_url('tbl_jasa/read/'.$tbl_jasa->id_produk.''),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'));
                echo ' ';
                echo anchor(site_url('tbl_jasa/update/'.$tbl_jasa->id_produk.''),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'));
                echo ' ';
                echo anchor(site_url('tbl_jasa/delete/'.$tbl_jasa->id_produk.''),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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

        
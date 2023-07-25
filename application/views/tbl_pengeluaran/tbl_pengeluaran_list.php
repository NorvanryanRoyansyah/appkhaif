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
                        <h3 class="box-title">KELOLA DATA PENGELUARAN</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'>
        <?php echo anchor(site_url('tbl_pengeluaran/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('tbl_pengeluaran/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
            <th width="30px">No</th>
		    <th>Tanggal</th>
		    <th>Nominal</th>
            <th>Ketegori</th>
		    <th>Keterangan</th>
		    <th>Karyawan</th>
		    <th width="200px">Action</th>
                </tr>
            </thead>
            <?php
            $start = 0;
            $sum = 0;
            foreach ($tbl_pengeluaran_data as $tbl_pengeluaran)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tbl_pengeluaran->tanggal ?></td>
		      <td>Rp <?php echo separateThousands($tbl_pengeluaran->nominal) ?></td>
              <td><?php echo $tbl_pengeluaran->kategori ?></td>
		      <td><?php echo $tbl_pengeluaran->keterangan ?></td>
		      <td><?php echo $tbl_pengeluaran->full_name ?></td>	
              <td>
                <?php 
                echo anchor(site_url('tbl_pengeluaran/update/'.$tbl_pengeluaran->id_pengeluaran.''),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'));
                echo ' ';
                echo anchor(site_url('tbl_pengeluaran/delete/'.$tbl_pengeluaran->id_pengeluaran.''),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                ?>
              </td>
              <?php
              $sum += $tbl_pengeluaran->nominal; ?>
                </tr>
                <?php } ?>
	    
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
        
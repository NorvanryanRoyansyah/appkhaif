<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA USER</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        <?php echo anchor(site_url('user/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
		<!-- <?php echo anchor(site_url('user/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
		<?php echo anchor(site_url('user/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?>--></div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="30px">No</th>
		    <th>Full Name</th>
		    <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>No HP</th>
		    <th>Nama Level</th>
		    <th>Status</th>
		    <th width="200px">Action</th>
                </tr>
                <?php 
                $no = 0;
                foreach ($data as $user)
            { ?>
            <tr>
                <td><?php echo ++$no; ?></td>
                <td><?php echo $user->full_name; ?></td>
                <td><?php echo $user->email; ?></td>
                <td><?php echo $user->jenis_kelamin; ?></td>
                <td><?php echo $user->no_hp; ?></td>
                <td><?php echo $user->nama_level; ?></td>
                <?php 
                if($user->is_aktif =='n') {
                    $sts = "Tidak Aktif";
                } elseif($user->is_aktif =='y')  {
                    $sts = "Aktif";
                }
                ?>
                <td><?php echo $sts; ?></td>
                <td style="text-align:center" width="200px">
				<?php
                    if($user->is_aktif =='n') {
                        echo anchor(site_url('user/acc/'.$user->id_users),'<i class="fa fa-check-square-o" aria-hidden="true"></i>','class="btn btn-primary btn-sm"'); 
                        echo ' ';
                    }
                        echo anchor(site_url('user/update/'.$user->id_users),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-success btn-sm"'); 
                        echo ' ';
                        echo anchor(site_url('user/delete/'.$user->id_users),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
            </tr>
            <?php }?>
            </thead>
	    
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
        <?php if(@$_SESSION['sukses']){ ?>
        <script>
            swal("Good job!", "<?php echo $_SESSION['sukses']; ?>", "success");
        </script>
        <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
        <?php unset($_SESSION['sukses']); } ?>
        
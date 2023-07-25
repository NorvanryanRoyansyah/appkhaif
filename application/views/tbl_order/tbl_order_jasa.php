<?php
function separateThousands($number) {
    // Menggunakan number_format dengan parameter ribuan (tanda koma) dan desimal (titik).
    // Jika angka desimal tidak dibutuhkan, set parameter desimal menjadi 0.
    return number_format($number, 0, '.', '.');
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA RIWAYAT TRANSAKSI JASA</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
        <!-- <?php echo anchor(site_url('tbl_order/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?> -->
		<?php echo anchor(site_url('tbl_order/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('tbl_order/jasa'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tbl_order/jasa'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            </div>
        
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Tanggal</th>
		<th>Customer</th>
        <th>File</th>
        <th>Jenis Pengiriman</th>
        <th>Detail Barang dan Total</th>
        <th>Jenis Pembayaran</th>
        <th>Status Pembayaran</th>
        <th>Bukti Pembayaran</th>
		<th>Status</th>
        <th>Karyawan</th>
		<th>Action</th>
            </tr><?php
              if ($this->session->userdata('id_user_level') == 2) {
                $to = $tbl_order_data_id;
              } else {
                $to = $tbl_order_data;
              }
            foreach ($to as $tbl_order)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $tbl_order->tanggal ?></td>
			<td><?php echo $tbl_order->full_name ?></td>
            <td><a href="<?php echo base_url() . 'assets/produk/' . $tbl_order->file ?>" target="_blank" rel="nofollow">Lihat</a></td>
            <?php if($tbl_order->ongkir == 1) {
                $jenis = "Diambil Sendiri";
                $ongk = 0;
            } else {
                $jenis = "Diantar (+ Ongkir 20.000)";
                $ongk = 0;
            }
                ?>
            <td><?php echo $jenis ?></td>
            <td>
            <?php
                    $sum = 0;
                    if($tbl_order->ongkir == 1) {
                        $ongk = 0;
                    } else {
                        $ongk = 20000;
                    }
                    $query   = $this->db->query('SELECT nama_produk,tbl_detail_order_jasa.harga as hrg,tbl_detail_order_jasa.qty as qt FROM tbl_detail_order_jasa
                    INNER JOIN tbl_jasa on tbl_jasa.id_produk = tbl_detail_order_jasa.id_produk 
                    WHERE tbl_detail_order_jasa.id_order = '.$tbl_order->id_order.'');
                    $results = $query->result();
                        foreach ($results as $trx)
                    {
                    ?>    
                    <p><?php echo $trx->nama_produk ?> (x<?php echo $trx->qt ?>) (Rp <?php echo separateThousands($trx->hrg*$trx->qt) ?>)</p>
                    <?php $sum +=  ($trx->hrg*$trx->qt); ?>
                    
                    <?php } ?>
            <p><b>TOTAL : </b> Rp <?php echo separateThousands($sum + $ongk) ?></p>
            <td><?php echo $tbl_order->jenis_pembayaran ?></td>
            <td><?php echo $tbl_order->status_pembayaran ?></td>
            <td><?php if($tbl_order->bukti_pembayaran == NULL) {
                echo 'Tidak Ada Bukti Pembayaran';
            } else {
                echo '<a href="'.base_url().'assets/bukti/'.$tbl_order->bukti_pembayaran.'"> Lihat </a>';
            } 
            ?></td>
            </td>
			<td><?php echo $tbl_order->status ?></td>
            <?php
            $query   = $this->db->query('SELECT * FROM tbl_order_jasa LEFT JOIN tbl_user on tbl_order_jasa.id_karyawan = tbl_user.id_users WHERE id_order = '.$tbl_order->id_order.'');
            $hasil = $query->result();
            foreach ($hasil as $namakar) {
                if(is_null($namakar->id_karyawan))
                echo '<td>Karyawan Belum Memproses</td>';
                else 
                echo '<td>'.$namakar->full_name.'</td>';
            ?>
            <?php } ?>
            
			<td style="text-align:center" width="200px">
				<?php
                if ($this->session->userdata('id_user_level') == 2) {
                    if ($tbl_order->status == "Sedang Diproses") {
                        echo '  '; 
                    } else {
                        echo anchor(site_url('tbl_order/read_jasa/'.$tbl_order->id_order),'<i class="fa fa-print" aria-hidden="true"></i>','class="btn btn-warning btn-sm"'); 
                    }
                    if($tbl_order->status_pembayaran == "Belum Dibayar") {
                        echo anchor(site_url('tbl_order/form_bayar_jasa/'.$tbl_order->id_order),'<i class="fa fa-upload" aria-hidden="true"></i>','class="btn btn-primary btn-sm"');  
                    }
                } else {
                    if ($tbl_order->status == "Sedang Diproses" && $tbl_order->status_pembayaran == "Sudah Dibayar") {
                        echo anchor(site_url('tbl_order/acc_jasa/'.$tbl_order->id_order),'<i class="fa fa-check-square" aria-hidden="true"></i>','class="btn btn-success btn-sm"','onclick="javasciprt: return confirm(\'Pesanan sudah diselesaikan ?\')"'); 
                        echo '  '; 
                        echo anchor(site_url('tbl_order/delete_jasa/'.$tbl_order->id_order),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                    } elseif($tbl_order->status == "Selesai") {
                        echo anchor(site_url('tbl_order/read_jasa/'.$tbl_order->id_order),'<i class="fa fa-print" aria-hidden="true"></i>','class="btn btn-warning btn-sm"'); 
                        echo '  '; 
                        echo anchor(site_url('tbl_order/delete_jasa/'.$tbl_order->id_order),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                    } else {
                        echo '  '; 
                        echo anchor(site_url('tbl_order/delete_jasa/'.$tbl_order->id_order),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                    }
                }
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
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
            swal("Mantap !", "<?php echo $_SESSION['sukses']; ?>", "success");
        </script>
        <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
<?php unset($_SESSION['sukses']); } ?>
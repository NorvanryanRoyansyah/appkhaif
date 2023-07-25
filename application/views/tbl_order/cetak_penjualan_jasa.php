<!doctype html>
<?php
function separateThousands($number) {
    // Menggunakan number_format dengan parameter ribuan (tanda koma) dan desimal (titik).
    // Jika angka desimal tidak dibutuhkan, set parameter desimal menjadi 0.
    return number_format($number, 0, '.', '.');
}
?>
<html>
    <head>
        <title>LAPORAN PENJUALAN JASA</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2 class="text-center">Fotocopy Al Khaif</h2>
        <p class="text-center">Jl. Seroja No. 91 Kuala Kapuas</p>
        <h4 class="text-center">LAPORAN PENJUALAN JASA</h4>
        <p class="text-center"><?php echo $label ?></p>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
        <th>No</th>
		<th>Tanggal</th>
		<th>Customer</th>
        <th>Jenis Pengiriman</th>
        <th>Ongkir</th>
        <th>Detail Barang dan Total</th>
		<th>Status</th>
        <th>Karyawan</th>
		
            </tr><?php
            $start = 0;
            $totalongkir = 0;
            foreach ($tbl_order_data as $tbl_order)
            {
                ?>
                <tr>
                <td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $tbl_order->tanggal ?></td>
			<td><?php echo $tbl_order->full_name ?></td>
            <?php 
            if($tbl_order->ongkir == 1) {
                $jenis = "Diambil Sendiri";
                $ongkos = 0;
            } else {
                $jenis = "Diantar (+ Ongkir 20.000)";
                $ongkos = 20000;
            }
            ?>
            <?php 
            $totalongkir += $ongkos;           
            ?>
            <td><?php echo $jenis ?></td>
            <td>Rp <?php echo separateThousands($ongkos) ?></td>
            <td>
            <?php
                    
                    
                    if($tbl_order->ongkir == 1) {
                        $ongk = 0;
                    } else {
                        $ongk = 20000;
                    }
                    
                    $query   = $this->db->query('SELECT nama_produk,tbl_detail_order_jasa.harga as hrg,tbl_detail_order_jasa.qty as qt FROM tbl_detail_order_jasa 
                    INNER JOIN tbl_produk on tbl_produk.id_produk = tbl_detail_order_jasa.id_produk 
                    WHERE tbl_detail_order_jasa.id_order = '.$tbl_order->id_order.'');
                    $sum = 0;
                    $results = $query->result();
                        foreach ($results as $trx)
                    {
                    ?>    
                    <p><?php echo $trx->nama_produk ?> (x<?php echo $trx->qt ?>) (Rp <?php echo separateThousands($trx->hrg*$trx->qt) ?>)</p>
                    <?php 
                    $sum +=  ($trx->hrg*$trx->qt); 
                    ?>
                    
                    <?php } ?>
            <p><b>TOTAL : </b> Rp <?php echo separateThousands($sum + $ongk); ?></p>
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
            
		</tr>
                <?php
            }
            ?>
        </table>
        <?php
            $tgl_awal = $_GET['tanggal_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
            $tgl_akhir =  $_GET['tanggal_akhir'];
            if((!empty($tgl_awal)) && (!empty($tgl_akhir))) {
                $query1   = $this->db->query("SELECT sum(qty*harga) as tot FROM tbl_detail_order_jasa WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir'");
            } else {
                $query1   = $this->db->query("SELECT sum(qty*harga) as tot FROM tbl_detail_order_jasa");
            }
            
            $results1 = $query1->result();
                foreach ($results1 as $trix)
            {
                $hgj = ($trix->tot) + $totalongkir;
        ?>
        <p><b>Total Pendapatan :</b> Rp <?php echo number_format($hgj, 0, ',', '.') ?></p>
        <?php } ?>
    </body>
</html>
<script>
    window.print();
</script>
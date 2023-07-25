<!doctype html>
<html>
    <head>
        <title>LAPORAN KINERJA</title>
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
        <h4 class="text-center">LAPORAN KINERJA KARYAWAN (BARANG)</h4>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
        <th>No</th>
		<th>Nama Karyawan</th>
        <th>Barang Diproses</th>
		
            </tr><?php
            $start = 0;
            foreach ($kinerja_data as $tbl_order)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tbl_order->full_name ?></td>
              <?php
            $query   = $this->db->query('SELECT full_name, count(full_name) as hitung FROM tbl_order LEFT JOIN tbl_user on tbl_order.id_karyawan = tbl_user.id_users WHERE id_karyawan='.$tbl_order->id_karyawan.'');
            $hasil = $query->result();
            foreach ($hasil as $namakar) {
            echo '<td>'.$namakar->hitung.'</td>';
            ?>
            <?php } ?>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
<script>
    window.print();
</script>
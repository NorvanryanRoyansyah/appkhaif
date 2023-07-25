<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
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
        <h4 class="text-center">LAPORAN RIWAYAT BARANG MASUK</h4>
        <p class="text-center"><?php echo $label ?></p>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Barang</th>
		<th>Tanggal Masuk</th>
		<th>Jumlah Masuk</th>
		
            </tr><?php
            $start = 0;
            foreach ($tbl_barangmasuk_data as $tbl_barangmasuk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tbl_barangmasuk->nama_produk ?></td>
		      <td><?php echo $tbl_barangmasuk->tanggal_masuk ?></td>
		      <td><?php echo $tbl_barangmasuk->jumlah_masuk ?></td>	
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

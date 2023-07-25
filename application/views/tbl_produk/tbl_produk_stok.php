<!doctype html>
<html>
    <head>
        <title><?php echo $judul ?></title>
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
        <h4 class="text-center"><?php echo $judul ?></h4>
         <br>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Produk</th>
		<th>Sisa Stok</th>
		
            </tr><?php
            $start = 0;
            foreach ($tbl_produk_data as $tbl_produk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tbl_produk->nama_produk ?></td>
		      <td><?php echo $tbl_produk->qty ?></td>	
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
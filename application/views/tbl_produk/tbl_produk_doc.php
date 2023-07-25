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
        <title>LAPORAN BARANG MASUK</title>
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
        <h4 class="text-center">LAPORAN BARANG MASUK</h4>
        <p class="text-center"><?php echo $label ?></p>
        <br>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
        <th>No</th>
		<th>Nama Supplier</th>
		<th>Nama Produk</th>
		<th>Qty</th>
		<th>Harga</th>
		<th>Jenis Produk</th>
		<th>Tanggal Masuk</th>
		
            </tr><?php
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
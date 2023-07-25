<?php
function separateThousands($number) {
    // Menggunakan number_format dengan parameter ribuan (tanda koma) dan desimal (titik).
    // Jika angka desimal tidak dibutuhkan, set parameter desimal menjadi 0.
    return number_format($number, 0, '.', '.');
}
?>
<!doctype html>
<html>
    <head>
        <title>LAPORAN DATA PENGELUARAN</title>
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
        <h4 class="text-center">LAPORAN DATA PENGELUARAN</h4>
        <p class="text-center"><?php echo $label ?></p>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
        <th>No</th>
		<th>Tanggal</th>
		<th>Nominal</th>
        <th>Kategori</th>
		<th>Keterangan</th>
		<th>Karyawan</th>
		
            </tr><?php
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
              <?php
              $sum += $tbl_pengeluaran->nominal; ?>
                </tr>
            <?php
            }
            ?>
        </table>
        <p class="text-left"><b>TOTAL PENGELUARAN : </b>Rp <?php echo separateThousands($sum);?></p>
    </body>
</html>
<script>
    window.print();
</script>
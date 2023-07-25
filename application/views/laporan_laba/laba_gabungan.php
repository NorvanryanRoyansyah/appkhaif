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
        <title>LAPORAN LABA</title>
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
        <h4 class="text-center">LAPORAN REKAP LABA KOTOR</h4>
        <h5 class="text-center">BARANG + JASA</h5>
        <p class="text-center"><?php echo $label ?></p>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
            <th width="20px">Tanggal</th>
		    <th>Penghasilan Penjualan</th>
            <th>Penghasilan Ongkir</th>
            <th>Total Penghasilan</th>
		
            </tr>
            <?php $this->load->model('Tbl_order_model');?>
            <?php
                    $total = 0; // Variabel untuk menyimpan total jumlah

                    for ($i = 1; $i <= 31; $i++) {
                        echo "<tr>";
                        echo "<td>$i</td>";
                        echo "<td>Rp ";
                    
                        $users = $this->Tbl_order_model->get_penghasilan($i, $bln, $thn);
                        $usersjasa = $this->Tbl_order_model->get_penghasilan_jasa($i, $bln, $thn);
                        
                        foreach ($users as $user) {
                            if ($user->hasil == NULL) {
                                $hsl = 0;
                            } else {
                                $hsl = $user->hasil;
                            }
                        }
                        foreach ($usersjasa as $userjasa) {
                            if ($userjasa->hasil == NULL) {
                                $hsljasa = 0;
                            } else {
                                $hsljasa = $userjasa->hasil;
                            }
                        }
                        echo separateThousands($hsl + $hsljasa);
                    
                        echo "</td>";
                        echo "<td>Rp ";
                    
                        $users = $this->Tbl_order_model->get_penghasilan_ongkir($i, $bln, $thn);
                        $usersjasa = $this->Tbl_order_model->get_penghasilan_ongkir_jasa($i, $bln, $thn);
                        
                        foreach ($users as $user) {
                            if ($user->hasilongkir == NULL) {
                                $hslongkir = 0;
                            } else {
                                $hslongkir = $user->hasilongkir * 20000;
                            }
                        }

                        foreach ($usersjasa as $userjasa) {
                            if ($userjasa->hasilongkir == NULL) {
                                $hslongkirjasa = 0;
                            } else {
                                $hslongkirjasa = $userjasa->hasilongkir * 20000;
                            }
                        }
                        echo separateThousands($hslongkir + $hslongkirjasa);
                    
                        echo "</td>";
                        echo "<td>Rp ";
                        echo separateThousands($hsl + $hslongkir);
                        $total += ($hsl+$hslongkir) + ($hsljasa + $hslongkirjasa);
                        echo "</td>";
                        

                        echo "</tr>";
                    }
                    
                    echo "<b>Total Penghasilan Perbulan </b>: Rp ".separateThousands($total).""; // Menampilkan total jumlah di luar loop
            ?>

          
            
        </table>
       
    </body>
</html>
<script>
    window.print();
</script>

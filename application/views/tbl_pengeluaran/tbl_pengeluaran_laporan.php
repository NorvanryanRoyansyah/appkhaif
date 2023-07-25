<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">CETAK LAPORAN PENGELUARAN</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        <form method="get" action="<?php echo site_url('cetak_laporan/cetak_pengeluaran') ?>">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                
                        <label>Laporan Filter Tanggal</label>
                            <div class="form-group">
                        <input type="date" name="tanggal_awal" value="<?= @$_GET['tanggal_awal'] ?>" class="form-control tanggal_awal" placeholder="Tanggal Awal" autocomplete="off" required>
                            </div>
                                <div class="form-group">
                                <input type="date" name="tanggal_akhir" value="<?= @$_GET['tanggal_akhir'] ?>" class="form-control tanggal_akhir" placeholder="Tanggal Akhir" autocomplete="off" required>
                                </div>
                                    <div class="form-group">
                                        <select name="kategori" id="kategori" class="form-control">
                                            <option value="SEMUA">Semua Kategori</option>
                                            <option value="Tagihan">Tagihan</option>
                                            <option value="Gaji">Gaji</option>
                                            <option value="Konsumsi">Konsumsi</option>
                                            <option value="Bahan Bakar">Bahan Bakar</option>
                                            <option value="Maintenance">Maintenance</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>       
                        </div>
                            <div class="form-group">
                            <button type="submit" name="filter" value="true" class="btn btn-primary">CETAK</button>
                            </div>
                        </div>
                </div>        
            </div>
        </form>
        <form method="get" action="<?php echo site_url('cetak_laporan/cetak_rekap_pengeluaran') ?>">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                
                        <label>Laporan Rekap PENGELUARAN</label>
                            <div class="form-group">
                            <select name="bulan" id="bulan" class="form-control">
                                <?php
                                // Array dengan nama-nama bulan
                                $bulan = array(
                                    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                );

                                // Loop untuk menampilkan pilihan bulan
                                foreach ($bulan as $angka => $nama) {
                                    echo "<option value=\"$angka\">$nama</option>";
                                }
                                ?>
                            </select>

                            </div>
                                <div class="form-group">
                                <select name="tahun" id="tahun" class="form-control">
                                    <?php
                                    // Mendapatkan tahun saat ini
                                    $tahun_sekarang = date('Y');

                                    // Jumlah tahun yang ingin ditampilkan dalam dropdown
                                    $jumlah_tahun = 10;

                                    // Loop untuk menampilkan pilihan tahun
                                    for ($i = 0; $i < $jumlah_tahun; $i++) {
                                        $tahun = $tahun_sekarang - $i;
                                        echo "<option value=\"$tahun\">$tahun</option>";
                                    }
                                    ?>
                                </select>

                                </div>
    
                            <div class="form-group">
                            <button type="submit" name="filter" value="true" class="btn btn-primary">CETAK</button>
                            </div>
                        </div>
                </div>        
            </div>
        </form>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

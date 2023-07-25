<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">CETAK LAPORAN REKAP LABA KOTOR</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        <!-- <form method="get" action="<?php echo site_url('cetak_laporan/cetak_laba') ?>">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label>Laporan Filter Tanggal</label>
                        <div class="input-group">
                            <input type="date" name="tanggal_awal" value="<?= @$_GET['tanggal_awal'] ?>" class="form-control tanggal_awal" placeholder="Tanggal Awal" autocomplete="off">
                            <p>s/d</p>
                            <input type="date" name="tanggal_akhir" value="<?= @$_GET['tanggal_akhir'] ?>" class="form-control tanggal_akhir" placeholder="Tanggal Akhir" autocomplete="off">
                            <button type="submit" name="filter" value="true" class="btn btn-primary">CETAK</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </form> -->

        <form method="get" action="<?php echo site_url('cetak_laporan/cetak_laba_barang') ?>">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label><b><i>[KHUSUS BARANG]</i></b> Laporan Filter Periode</label>
                        <div class="form-group">
                        <select class="form-control" name="bulan">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        </div>
                        <div class="form-group">
                        <select class="form-control" name="tahun">
                            <?php
                            $startYear = 2000; // Tahun awal
                            $endYear = date("Y"); // Tahun sekarang

                            for ($year = $endYear; $year >= $startYear; $year--) {
                                echo "<option value=\"$year\">$year</option>";
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
        <form method="get" action="<?php echo site_url('cetak_laporan/cetak_laba_jasa') ?>">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label><b><i>[KHUSUS JASA]</i></b> Laporan Filter Periode</label>
                        <div class="form-group">
                        <select class="form-control" name="bulan">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        </div>
                        <div class="form-group">
                        <select class="form-control" name="tahun">
                            <?php
                            $startYear = 2000; // Tahun awal
                            $endYear = date("Y"); // Tahun sekarang

                            for ($year = $endYear; $year >= $startYear; $year--) {
                                echo "<option value=\"$year\">$year</option>";
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
        <form method="get" action="<?php echo site_url('cetak_laporan/cetak_laba_gabungan') ?>">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label><b><i>[JASA+BARANG]</i></b> Laporan Filter Periode</label>
                        <div class="form-group">
                        
                        <select class="form-control" name="bulan">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        </div>
                        <div class="form-group">
                        <select class="form-control" name="tahun">
                            <?php
                            $startYear = 2000; // Tahun awal
                            $endYear = date("Y"); // Tahun sekarang

                            for ($year = $endYear; $year >= $startYear; $year--) {
                                echo "<option value=\"$year\">$year</option>";
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
        
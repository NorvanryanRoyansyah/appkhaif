<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">CETAK LAPORAN BARANG MASUK</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        <form method="get" action="<?php echo site_url('cetak_laporan/cetak_barang_masuk') ?>">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label><b><i>[RIWAYAT BARANG BARU MASUK]</i></b> Laporan Filter Tanggal</label>
                        
                        <div class="form-group">
                            <input type="date" name="tanggal_awal" value="<?= @$_GET['tanggal_awal'] ?>" class="form-control tanggal_awal" placeholder="Tanggal Awal" autocomplete="off">
                        </div>
                        <div class="form-group">    
                            <input type="date" name="tanggal_akhir" value="<?= @$_GET['tanggal_akhir'] ?>" class="form-control tanggal_akhir" placeholder="Tanggal Akhir" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="filter" value="true" class="btn btn-primary">CETAK</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>

        <form method="get" action="<?php echo site_url('cetak_laporan/cetak_riwayat_barang') ?>">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label><b><i>[RIWAYAT PENAMBAHAN STOK BARANG]</i></b> Laporan Filter Tanggal</label>
                        <div class="form-group">
                            <input type="date" name="tanggal_awal" value="<?= @$_GET['tanggal_awal'] ?>" class="form-control tanggal_awal" placeholder="Tanggal Awal" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="date" name="tanggal_akhir" value="<?= @$_GET['tanggal_akhir'] ?>" class="form-control tanggal_akhir" placeholder="Tanggal Akhir" autocomplete="off">
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
        
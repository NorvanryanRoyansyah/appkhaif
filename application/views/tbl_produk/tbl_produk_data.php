<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">DATA PRODUK</h3>   
                    </div>
                <div class="box-body">
                
                <!-- Data Table -->
                <table class="table table-bordered table-striped" id="myTable">
            <thead>
              <tr>
               
                <th>Nama</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($data as $row) : ?>
                <tr>
                    <td><?php echo $row->nama_produk ?> </td>
                    <td><?php echo $row->qty ?> </td>
                    <td>Rp <?php echo number_format($row->harga, 0, ',', '.') ?></td>
                    <td><a href="<?php echo base_url() . 'assets/produk/' . $row->foto ?>" target="_blank" rel="nofollow">Lihat</a></td>
                    <td>
                        <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row->id_produk ?>">
                        Beli
                        </button>
                    </form>
                    </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <!-- End Data Table -->
            
                
                
            <!-- CART -->
<?php $items = $this->cart->contents(); ?>
    <div class="container">
      <div class="card mt-3">
        <div class="card-header">
          <h2><i class="fa fa-shopping-cart"></i> Belanjaan</h2>
        </div>
        <div class="card-body">

          <!-- Data Table -->
          <table id="datatables" class="table">
            <thead>
              <tr>
                <!-- <th>ID</th> -->
                <th>Nama</th>
                <th>QTY</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($items as $items) : ?>
                <tr>
               <!-- <td><?php echo $items['id'] ?></td> -->
                  <td><?php echo $items['name'] ?></td>
                  <td><?php echo $items['qty'] ?> </td>
                  <td><?php echo $items['price'] ?> </td>
                  <td>
                    Rp <?php echo number_format($items['subtotal'], 0, ',', '.') ?>

                  </td>
                  <td>
                    <a href="<?php echo base_url() ?>index.php/List_produk/hapus_keranjang/<?php echo $items['rowid']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <!-- End Data Table -->
          <div class="p-3 mb-2 bg-success text-white">
            <h2> TOTAL : Rp <?php echo number_format($this->cart->total(), 0, ',', '.') ?></h2>
            <!-- <h6 id="biaya" name="biaya"> + Ongkir Rp 20.000</h6> -->
          </div>
          <form class="form-validate" action="<?php echo base_url() ?>index.php/List_produk/proses_order" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id_users">Customer</label>
                <select name="id_users" id="id_users" class="form-control" required>
                <?php
                if ($this->session->userdata('id_user_level') == 2) {
                  $dc = $data_customer_id;
                } else {
                  $dc = $data_customer;
                }
                foreach ($dc as $cust) :
                ?>
                <option value="<?=$cust->id_users ?>"><?=$cust->full_name ?></option> 
                <?php
                endforeach;
                ?>
                </select>
            <div class="form-group">
                <label for="ongkir">Jenis Pengiriman</label>
                <select name="ongkir" id="ongkir" class="form-control" required onchange="changebutton()">
                <option value=""> Pilih </option>
                <option value="1">Diambil Sendiri</option>
                <option value="2">Diantar (+ Ongkir 20.000)</option>
                </select>
            </div>
            <div class="form-group" hidden id="divBayar">
                <label for="ongkir">Jenis Pembayaran</label>
                <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control" disabled >
                <option value="Pembayaran Online">Pembayaran Online</option>
                <option value="Bayar Ditempat">Bayar Ditempat</option>
                </select>
            </div>
            <div class="form-group" id="divQRIS" hidden>
              <label>DANA No 0852 4937 3788 a/n Norvanryan Royansyah</label>
              <p> atau <a href="<?php echo base_url()?>assets/images/qris.jpg"> Lihat QRIS</a></p>
            </div>
            <div class="form-group">
              <input type="date" name="tgl" class="form-control" placeholder="Tanggal Transaksi"value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Submit</button>
          </form>
        </div>
      </div>
    </div>
    <!-- END CARD -->
            </div> 
                       
        </div>
        
</div>
    </section>
</div>

 <!-- Modal BELI-->
 <?php
    foreach ($data as $row) : ?>
      <div class="modal fade" id="exampleModalCenter<?php echo $row->id_produk ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Belanja</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- FORM -->
              <form class="form-validate" action="<?php echo base_url() . 'index.php/list_produk/tambah'; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="hidden" name="id_produk" class="form-control" value="<?php echo $row->id_produk ?>">
                  <input type="text" name="nama_produk" class="form-control" value="<?php echo $row->nama_produk ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="date">Harga satuan</label>
                  <input type="text" name="harga" class="form-control" value="<?php echo $row->harga ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="name">Qty</label>
                  <input type="number" name="qty" class="form-control">
                </div>
                <!-- <div class="form-group">
                <label for="name">jenis</label>
                <select class="custom-select" name="jenis">
                  <option selected>Category</option>
                  <option value="tablet">tablet</option>
                  <option value="kapsul">kapsul</option>
                </select>
              </div> -->

                <!-- <div class="form-group">
                  <label for="cost">Foto</label>
                  <input type="file" name="gambar" class="form-control">
                </div> -->
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
        <?php if(@$_SESSION['sukses']){ ?>
        <script>
            swal("Good job!", "<?php echo $_SESSION['sukses']; ?>", "success");
        </script>
        <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
        <?php unset($_SESSION['sukses']); } ?>
        <?php if(@$_SESSION['gagal']){ ?>
        <script>
            swal("TRANSAKSI GAGAL !", "<?php echo $_SESSION['gagal']; ?>", "error");
        </script>
        <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
        <?php unset($_SESSION['gagal']); } ?>
        <script>
          function changebutton(){
            var ongkir = document.getElementById('ongkir')
            var qris = document.getElementById('divQRIS')
            var jenis_pembayaran = document.getElementById('jenis_pembayaran') //Removed additional space after level
            if(ongkir.value == '1') //Changed AND (&&) operator to OR (||) operator 
            {
              //gets executed if language or level has empty value
              jenis_pembayaran.disabled = false;
              divBayar.hidden = false;
              qris.hidden = true;
            }
            else
            {
              jenis_pembayaran.disabled = true;
              divBayar.hidden = true;
              qris.hidden = false;
            }
            if(jenis_pembayaran.value === "Pembayaran Online") {
              qris.hidden = false;
            } else if (jenis_pembayaran.value === "Bayar Ditempat") {
              qris.hidden = true;
            }
          }
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
               $('#myTable').DataTable();
            });

            </script>

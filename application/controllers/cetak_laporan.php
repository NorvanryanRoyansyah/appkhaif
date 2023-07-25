<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class cetak_laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_produk_model');
        $this->load->model('Tbl_order_model');
        $this->load->model('Tbl_barangmasuk_model');
        $this->load->model('Tbl_pengeluaran_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');  
        $this->load->library('cart');      
	    $this->load->library('datatables');
    }

    public function index()
    {        
        $this->template->load('template','tbl_produk/tbl_produk_laporan');
    } 

    public function laba()
    {        
        $this->template->load('template','tbl_order/laporan_laba');
    } 

    public function pengeluaran()
    {        
        $this->template->load('template','tbl_pengeluaran/tbl_pengeluaran_laporan');
    } 

    public function penjualan_barang()
    {        
        $this->template->load('template','tbl_order/laporan_barang');
    } 

    public function laporan_kinerja()
    {        
        $transaksi = $this->Tbl_order_model->get_kinerja();  // Panggil fungsi view_all yang ada di TransaksiModel
        $data['kinerja_data'] = $transaksi;
        $this->load->view('tbl_kinerja/laporan_kinerja' , $data);
    } 

    public function kinerja_jasa()
    {
        $transaksi = $this->Tbl_order_model->get_kinerja_jasa();  // Panggil fungsi view_all yang ada di TransaksiModel
        $data['kinerja_data'] = $transaksi;
        $this->load->view('tbl_kinerja/laporan_kinerja_jasa',$data);
    } 

    public function cetak_barang_masuk()
    {        
        $tanggal_awal = $this->input->get('tanggal_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tanggal_akhir = $this->input->get('tanggal_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        if(empty($tanggal_awal) or empty($tanggal_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->Tbl_produk_model->get_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $label = 'Semua Tanggal Masuk';
        }else{ // Jika terisi    
            $transaksi = $this->Tbl_produk_model->get_all_tanggal($tanggal_awal, $tanggal_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $tanggal_awal = date('d-m-Y', strtotime($tanggal_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tanggal_akhir = date('d-m-Y', strtotime($tanggal_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tanggal_awal.' s/d '.$tanggal_akhir;
        }
        $data['label'] = $label;
        $data['tbl_produk_data'] = $transaksi;
        
        $this->load->view('tbl_produk/tbl_produk_doc', $data);
    } 

    
    public function cetak_riwayat_barang()
    {        
        $tanggal_awal = $this->input->get('tanggal_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tanggal_akhir = $this->input->get('tanggal_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        if(empty($tanggal_awal) or empty($tanggal_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->Tbl_barangmasuk_model->get_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $label = 'Semua Tanggal Masuk';
        }else{ // Jika terisi    
            $transaksi = $this->Tbl_barangmasuk_model->get_all_tanggal($tanggal_awal, $tanggal_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $tanggal_awal = date('d-m-Y', strtotime($tanggal_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tanggal_akhir = date('d-m-Y', strtotime($tanggal_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tanggal_awal.' s/d '.$tanggal_akhir;
        }
        $data['label'] = $label;
        $data['tbl_barangmasuk_data'] = $transaksi;
        
        $this->load->view('tbl_barangmasuk/tbl_barangmasuk_doc', $data);
    } 


    public function cetak_laba_barang()
    {        
        $bulan = $this->input->get('bulan'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tahun = $this->input->get('tahun'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        $label = 'Periode Bulan '.$bulan.' Tahun '.$tahun;
        
        $data['label'] = $label;
        $data['bln'] = $bulan;
        $data['thn'] = $tahun;
        
        $this->load->view('laporan_laba/laba_barang', $data);
    } 

    public function cetak_laba_gabungan()
    {        
        $bulan = $this->input->get('bulan'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tahun = $this->input->get('tahun'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        $label = 'Periode Bulan '.$bulan.' Tahun '.$tahun;
        
        $data['label'] = $label;
        $data['bln'] = $bulan;
        $data['thn'] = $tahun;
        
        $this->load->view('laporan_laba/laba_gabungan', $data);
    } 

    public function cetak_rekap_pengeluaran()
    {        
        $bulan = $this->input->get('bulan'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tahun = $this->input->get('tahun'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        $label = 'Periode Bulan '.$bulan.' Tahun '.$tahun;
        
        $data['label'] = $label;
        $data['bln'] = $bulan;
        $data['thn'] = $tahun;
        
        $this->load->view('laporan_laba/rekap_pengeluaran', $data);
    } 

    public function cetak_laba_jasa()
    {        
        $bulan = $this->input->get('bulan'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tahun = $this->input->get('tahun'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        $label = 'Periode Bulan '.$bulan.' Tahun '.$tahun;
        
        $data['label'] = $label;
        $data['bln'] = $bulan;
        $data['thn'] = $tahun;
        
        $this->load->view('laporan_laba/laba_jasa', $data);
    } 

    public function cetak_penjualan_barang()
    {        
        $tanggal_awal = $this->input->get('tanggal_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tanggal_akhir = $this->input->get('tanggal_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        if(empty($tanggal_awal) or empty($tanggal_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->Tbl_order_model->get_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $label = 'Semua Tanggal Penjualan';
        }else{ // Jika terisi    
            $transaksi = $this->Tbl_order_model->get_all_tanggal($tanggal_awal, $tanggal_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $tanggal_awal = date('d-m-Y', strtotime($tanggal_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tanggal_akhir = date('d-m-Y', strtotime($tanggal_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tanggal_awal.' s/d '.$tanggal_akhir;
        }
        
        $data['label'] = $label;
        $data['tbl_order_data'] = $transaksi;
        
        $this->load->view('tbl_order/cetak_penjualan', $data);
    } 

    public function cetak_laba()
    {        
        $tanggal_awal = $this->input->get('tanggal_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tanggal_akhir = $this->input->get('tanggal_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        if(empty($tanggal_awal) or empty($tanggal_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksibarang = $this->Tbl_order_model->get_all(); 
            $transaksijasa = $this->Tbl_order_model->get_all_jasa(); // Panggil fungsi view_all yang ada di TransaksiModel
            $label = 'Semua Tanggal Penjualan';
        }else{ // Jika terisi    
            $transaksibarang = $this->Tbl_order_model->get_all_tanggal($tanggal_awal, $tanggal_akhir);
            $transaksijasa = $this->Tbl_order_model->get_all_jasa_tanggal($tanggal_awal, $tanggal_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $tanggal_awal = date('d-m-Y', strtotime($tanggal_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tanggal_akhir = date('d-m-Y', strtotime($tanggal_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tanggal_awal.' s/d '.$tanggal_akhir;
        }
        
        $data['label'] = $label;
        $data['tbl_order_data'] = $transaksibarang;
        $data['tbl_order_jasa'] = $transaksijasa;
        
        $this->load->view('tbl_order/cetak_laba', $data);
    } 

    public function cetak_penjualan_jasa()
    {        
        $tanggal_awal = $this->input->get('tanggal_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tanggal_akhir = $this->input->get('tanggal_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        if(empty($tanggal_awal) or empty($tanggal_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->Tbl_order_model->get_all_jasa();  // Panggil fungsi view_all yang ada di TransaksiModel
            $label = 'Semua Tanggal Penjualan';
        }else{ // Jika terisi    
            $transaksi = $this->Tbl_order_model->get_all_jasa_tanggal($tanggal_awal, $tanggal_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $tanggal_awal = date('d-m-Y', strtotime($tanggal_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tanggal_akhir = date('d-m-Y', strtotime($tanggal_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tanggal_awal.' s/d '.$tanggal_akhir;
        }
        
        $data['label'] = $label;
        $data['tbl_order_data'] = $transaksi;
        
        $this->load->view('tbl_order/cetak_penjualan_jasa', $data);
    } 

    public function cetak_pengeluaran()
    {        
        $tanggal_awal = $this->input->get('tanggal_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tanggal_akhir = $this->input->get('tanggal_akhir');
        $kategori = $this->input->get('kategori'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        
        if($kategori === "SEMUA") {
            $transaksi = $this->Tbl_pengeluaran_model->get_all_tanggal_semua($tanggal_awal, $tanggal_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $tanggal_awal = date('d-m-Y', strtotime($tanggal_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tanggal_akhir = date('d-m-Y', strtotime($tanggal_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal '.$tanggal_awal.' s/d '.$tanggal_akhir;
        } else {
              // Jika terisi    
              $transaksi = $this->Tbl_pengeluaran_model->get_all_tanggal($tanggal_awal, $tanggal_akhir, $kategori);  // Panggil fungsi view_by_date yang ada di TransaksiModel
              $tanggal_awal = date('d-m-Y', strtotime($tanggal_awal)); // Ubah format tanggal jadi dd-mm-yyyy
              $tanggal_akhir = date('d-m-Y', strtotime($tanggal_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
              $label = 'Periode Tanggal '.$tanggal_awal.' s/d '.$tanggal_akhir;
        }
       
        $data['label'] = $label;
        $data['tbl_pengeluaran_data'] = $transaksi;
        
        $this->load->view('tbl_pengeluaran/tbl_pengeluaran_doc', $data);
    } 

    public function stok_barang()
    {        
        $transaksi = $this->Tbl_produk_model->get_all();  // Panggil fungsi view_all yang ada di TransaksiModel
        $judul = "LAPORAN STOK BARANG";
        $data['judul'] = $judul;
        $data['tbl_produk_data'] = $transaksi;
        
        $this->load->view('tbl_produk/tbl_produk_stok', $data);
    } 

    public function restok_barang()
    {        
        $transaksi = $this->Tbl_produk_model->get_all_restok(); // Panggil fungsi view_all yang ada di TransaksiModel
        $judul = "LAPORAN REKOMENDASI RESTOK BARANG";
        $data['judul'] = $judul;  
        $data['tbl_produk_data'] = $transaksi;
        
        $this->load->view('tbl_produk/tbl_produk_stok', $data);
    } 
   
}

/* End of file Tbl_produk.php */
/* Location: ./application/controllers/Tbl_produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-06-30 05:00:52 */
/* http://harviacode.com */
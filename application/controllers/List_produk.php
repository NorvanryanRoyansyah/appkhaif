<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class List_produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_produk_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');  
        $this->load->library('cart');      
	$this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'data' => $this->Tbl_produk_model->get_all(),
            'data_customer' => $this->User_model->get_customer(),
            'data_customer_id' => $this->User_model->get_customer_id(),
        );
        
        $this->template->load('template','tbl_produk/tbl_produk_data',$data);
    } 

    public function jasa()
    {
        $data = array(
            'data' => $this->Tbl_produk_model->get_jasa(),
            'data_customer' => $this->User_model->get_customer(),
            'data_customer_id' => $this->User_model->get_customer_id(),
        );
        
        $this->template->load('template','tbl_produk/tbl_produk_jasa',$data);
    } 
    

    public function tambah()
	{
		$data_produk= array('id' => $this->input->post('id_produk'),
							 'name' => $this->input->post('nama_produk'),
							 'price' => $this->input->post('harga'),
							 'qty' =>$this->input->post('qty')
							);
		$this->cart->insert($data_produk);
        
		redirect('List_produk');
	}

    public function tambahjasa()
	{
		$data_produk= array('id' => $this->input->post('id_produk'),
							 'name' => $this->input->post('nama_produk'),
							 'price' => $this->input->post('harga'),
							 'qty' =>$this->input->post('qty')
							);
		$this->cart->insert($data_produk);
        
		redirect('List_produk/jasa');
	}

    function hapus_keranjang($rowid)
	{
		if ($rowid == "all") {
			$this->cart->destroy();
		} else {
			$data = array(
				'rowid' => $rowid,
				'qty' => 0
			);
			$this->cart->update($data);
		}
		redirect('List_produk');
	}

    function hapus_keranjang_jasa($rowid)
	{
		if ($rowid == "all") {
			$this->cart->destroy();
		} else {
			$data = array(
				'rowid' => $rowid,
				'qty' => 0
			);
			$this->cart->update($data);
		}
		redirect('List_produk/jasa');
	}

	public function proses_order()
    {
        if ($this->session->userdata('id_user_level')==2) {
            $sts = 'Sedang Diproses';
            $idk = 0;
        } else {
            $sts = 'Sedang Diproses';
            $idk = $this->session->userdata('id_users');
        }
        //-------------------------Input data order------------------------------
        if($this->input->post('ongkir')==1) {
            $jenisbyr = $this->input->post('jenis_pembayaran');
        } elseif($this->input->post('ongkir')==2) {
            $jenisbyr = "Pembayaran Online";
        }

        if($this->input->post('jenis_pembayaran')=="Bayar Ditempat") {
            $statusbyr = "Sudah Dibayar";
        } else {
            $statusbyr = "Belum Dibayar";
        }
        $data_order = array('tanggal' => date('Y-m-d'),
							'status' => $sts,
                            'ongkir' => $this->input->post('ongkir'),
                            'jenis_pembayaran' => $jenisbyr,
                            'status_pembayaran' => $statusbyr,
                            'id_karyawan' => $idk,
                            'id_users' => $this->input->post('id_users'));
        $id_order = $this->Tbl_produk_model->tambah_order($data_order);
        //-------------------------Input data detail order-----------------------
        if ($cart = $this->cart->contents())
            {
                foreach ($cart as $item)
                    {
                        $data_detail = array('id_order' =>$id_order,
                                        'id_produk' => $item['id'],
                                        'tanggal' => date('Y-m-d'),
                                        'qty' => $item['qty'],
                                        'harga' => $item['price']);
                        $proses = $this->Tbl_produk_model->tambah_detail_order($data_detail);
                    }
			$_SESSION['sukses'] = 'Transaksi Berhasil !';
            } else {
			$_SESSION['gagal'] = 'Pilih item terlebih dahulu !';
			$this->Tbl_produk_model->delete_order($id_order);
			}
        //-------------------------Hapus shopping cart--------------------------
        $this->cart->destroy();
        redirect('List_produk');
    }

    public function proses_order_jasa()
    {
        if ($this->session->userdata('id_user_level')==2) {
            $sts = 'Sedang Diproses';
            $idk = 0;
        } else {
            $sts = 'Sedang Diproses';
            $idk = $this->session->userdata('id_users');
        }
        //-------------------------Input data order------------------------------
        if($this->input->post('ongkir')==1) {
            $jenisbyr = $this->input->post('jenis_pembayaran');
        } elseif($this->input->post('ongkir')==2) {
            $jenisbyr = "Pembayaran Online";
        }

        if($this->input->post('jenis_pembayaran')=="Bayar Ditempat") {
            $statusbyr = "Sudah Dibayar";
        } else {
            $statusbyr = "Belum Dibayar";
        }
        $foto = $this->upload_foto();
        $data_order = array('tanggal' => date('Y-m-d'),
							'status' => $sts,
                            'ongkir' => $this->input->post('ongkir'),
                            'jenis_pembayaran' => $jenisbyr,
                            'status_pembayaran' => $statusbyr,
                            'id_karyawan' => $idk,
                            'file' => $foto['file_name'],
                            'id_users' => $this->input->post('id_users'));
        $id_order = $this->Tbl_produk_model->tambah_order_jasa($data_order);
        //-------------------------Input data detail order-----------------------
        if ($cart = $this->cart->contents())
            {
                foreach ($cart as $item)
                    {
                        $data_detail = array('id_order' =>$id_order,
                                            'tanggal' => date('Y-m-d'),
                                        'id_produk' => $item['id'],
                                        'qty' => $item['qty'],
                                        'harga' => $item['price']);
                        $proses = $this->Tbl_produk_model->tambah_detail_order_jasa($data_detail);
                    }
			$_SESSION['sukses'] = 'Transaksi Berhasil !';
            } else {
			$_SESSION['gagal'] = 'Pilih item terlebih dahulu !';
			$this->Tbl_produk_model->delete_order($id_order);
			}
        //-------------------------Hapus shopping cart--------------------------
        $this->cart->destroy();
        redirect('List_produk/jasa');
    }

    function upload_foto(){
        $config['upload_path']          = './assets/produk';
        $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('file');
        return $this->upload->data();
    }

 

   
}

/* End of file Tbl_produk.php */
/* Location: ./application/controllers/Tbl_produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-06-30 05:00:52 */
/* http://harviacode.com */
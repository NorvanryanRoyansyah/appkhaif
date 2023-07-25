<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_produk_model');
        $this->load->model('Tbl_barangmasuk_model');
        $this->load->library('form_validation');  
        $this->load->library('cart');      
	$this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'tbl_produk_data' => $this->Tbl_produk_model->get_all(),
            'start' => 0
        );
        $this->template->load('template','tbl_produk/tbl_produk_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_produk_model->json();
    }
	

    public function read($id) 
    {
        $row = $this->Tbl_produk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_produk' => $row->id_produk,
		'nama_supplier' => $row->nama_supplier,
		'nama_produk' => $row->nama_produk,
		'qty' => $row->qty,
		'harga' => $row->harga,
		'jenis_produk' => $row->jenis_produk,
		'foto' => $row->foto,
	    );
            $this->template->load('template','tbl_produk/tbl_produk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_produk'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_produk/create_action'),
	    'id_produk' => set_value('id_produk'),
	    'id_supplier' => set_value('id_supplier'),
	    'nama_produk' => set_value('nama_produk'),
	    'qty' => set_value('qty'),
	    'harga' => set_value('harga'),
        'tanggal_masuk' => set_value('tanggal_masuk'),
	    'jenis_produk' => set_value('jenis_produk'),
	    'foto' => set_value('foto'),
	);
        $this->template->load('template','tbl_produk/tbl_produk_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_supplier' => $this->input->post('id_supplier',TRUE),
		'nama_produk' => $this->input->post('nama_produk',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'jenis_produk' => $this->input->post('jenis_produk',TRUE),
        'tanggal_masuk' => $this->input->post('tanggal_masuk',TRUE),
		'foto' => $foto['file_name'],
	    );

            $this->Tbl_produk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_produk'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_produk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_produk/update_action'),
		'id_produk' => set_value('id_produk', $row->id_produk),
		'id_supplier' => set_value('id_supplier', $row->id_supplier),
		'nama_produk' => set_value('nama_produk', $row->nama_produk),
		'qty' => set_value('qty', $row->qty),
		'harga' => set_value('harga', $row->harga),
		'jenis_produk' => set_value('jenis_produk', $row->jenis_produk),
        'tanggal_masuk' => set_value('tanggal_masuk', $row->tanggal_masuk),
		'foto' => set_value('foto', $row->foto),
	    );
            $this->template->load('template','tbl_produk/tbl_produk_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_produk'));
        }
    }

    public function add_stok($id) 
    {
        $row = $this->Tbl_produk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_produk/add_stok_action'),
		'id_produk' => set_value('id_produk', $row->id_produk),
		'qty' => set_value('qty', $row->qty),
	        );
            $this->template->load('template','tbl_produk/tbl_produk_add', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_produk'));
        }
    }

    public function add_stok_action() 
    {
       
            $qtyawal = $this->input->post('qty',TRUE);
            $qtybaru = $this->input->post('qty_baru',TRUE);
            $data = array(
		    'qty' => ($qtyawal+$qtybaru));
            $data2 = array(
            'jumlah_masuk' => ($qtybaru),
            'id_barang' => $this->input->post('id_produk',TRUE),
            'tanggal_masuk' => date('Y-m-d')
            );
            $this->Tbl_barangmasuk_model->insert($data2);
            $this->Tbl_produk_model->update($this->input->post('id_produk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_barangmasuk'));
    }
    
    
    public function update_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_produk', TRUE));
        } else {
            if($foto['file_name']==''){
            $data = array(
		'id_supplier' => $this->input->post('id_supplier',TRUE),
		'nama_produk' => $this->input->post('nama_produk',TRUE),
		'qty' => $this->input->post('qty',TRUE),
		'harga' => $this->input->post('harga',TRUE),
        'tanggal_masuk' => $this->input->post('tanggal_masuk',TRUE),
		'jenis_produk' => $this->input->post('jenis_produk',TRUE));
            } else {
                $data = array(
                    'id_supplier' => $this->input->post('id_supplier',TRUE),
                    'nama_produk' => $this->input->post('nama_produk',TRUE),
                    'qty' => $this->input->post('qty',TRUE),
                    'harga' => $this->input->post('harga',TRUE),
                    'tanggal_masuk' => $this->input->post('tanggal_masuk',TRUE),
                    'jenis_produk' => $this->input->post('jenis_produk',TRUE),
                    'foto' => $foto['file_name']);
            }

            $this->Tbl_produk_model->update($this->input->post('id_produk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_produk'));
        }
    }

    function upload_foto(){
        $config['upload_path']          = './assets/produk';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('foto');
        return $this->upload->data();
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_produk_model->get_by_id($id);

        if ($row) {
            $this->Tbl_produk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_produk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_produk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_supplier', 'id supplier', 'trim|required');
	$this->form_validation->set_rules('nama_produk', 'nama produk', 'trim|required');
	$this->form_validation->set_rules('qty', 'qty', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');
	$this->form_validation->set_rules('jenis_produk', 'jenis produk', 'trim|required');
    $this->form_validation->set_rules('tanggal_masuk', 'tanggal masuk', 'trim|required');
	//$this->form_validation->set_rules('foto', 'foto', 'trim|required');

	$this->form_validation->set_rules('id_produk', 'id_produk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_produk.doc");

        $data = array(
            'tbl_produk_data' => $this->Tbl_produk_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_produk/tbl_produk_doc',$data);
    }

}

/* End of file Tbl_produk.php */
/* Location: ./application/controllers/Tbl_produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-06-30 05:00:52 */
/* http://harviacode.com */
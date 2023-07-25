<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_jasa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_jasa_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'tbl_jasa_data' => $this->Tbl_jasa_model->get_all(),
            'start' => 0
        );
        $this->template->load('template','tbl_jasa/tbl_jasa_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_jasa_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_jasa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_produk' => $row->id_produk,
		'nama_produk' => $row->nama_produk,
		'harga' => $row->harga,
		'foto' => $row->foto,
	    );
            $this->template->load('template','tbl_jasa/tbl_jasa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_jasa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_jasa/create_action'),
	    'id_produk' => set_value('id_produk'),
	    'nama_produk' => set_value('nama_produk'),
	    'harga' => set_value('harga'),
	    'foto' => set_value('foto'),
	);
        $this->template->load('template','tbl_jasa/tbl_jasa_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();
        $foto = $this->upload_foto();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_produk' => $this->input->post('nama_produk',TRUE),
		'harga' => $this->input->post('harga',TRUE),
		'foto' => $foto['file_name'],
	    );

            $this->Tbl_jasa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_jasa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_jasa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_jasa/update_action'),
		'id_produk' => set_value('id_produk', $row->id_produk),
		'nama_produk' => set_value('nama_produk', $row->nama_produk),
		'harga' => set_value('harga', $row->harga),
		'foto' => set_value('foto', $row->foto),
	    );
            $this->template->load('template','tbl_jasa/tbl_jasa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_jasa'));
        }
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
		'nama_produk' => $this->input->post('nama_produk',TRUE),
		'harga' => $this->input->post('harga',TRUE));
    } else {
        $data = array(
            'nama_produk' => $this->input->post('nama_produk',TRUE),
            'harga' => $this->input->post('harga',TRUE),
            'foto' => $foto['file_name']);
    }
            $this->Tbl_jasa_model->update($this->input->post('id_produk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_jasa'));
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
        $row = $this->Tbl_jasa_model->get_by_id($id);

        if ($row) {
            $this->Tbl_jasa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_jasa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_jasa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_produk', 'nama produk', 'trim|required');
	$this->form_validation->set_rules('harga', 'harga', 'trim|required');

	$this->form_validation->set_rules('id_produk', 'id_produk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_jasa.doc");

        $data = array(
            'tbl_jasa_data' => $this->Tbl_jasa_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_jasa/tbl_jasa_doc',$data);
    }

}

/* End of file Tbl_jasa.php */
/* Location: ./application/controllers/Tbl_jasa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-07-05 16:30:29 */
/* http://harviacode.com */
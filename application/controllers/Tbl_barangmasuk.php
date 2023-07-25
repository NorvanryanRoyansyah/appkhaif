<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_barangmasuk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_barangmasuk_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','tbl_barangmasuk/tbl_barangmasuk_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_barangmasuk_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_barangmasuk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_masuk' => $row->id_masuk,
		'id_barang' => $row->id_barang,
		'tanggal_masuk' => $row->tanggal_masuk,
		'jumlah_masuk' => $row->jumlah_masuk,
	    );
            $this->template->load('template','tbl_barangmasuk/tbl_barangmasuk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_barangmasuk'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_barangmasuk/create_action'),
	    'id_masuk' => set_value('id_masuk'),
	    'id_barang' => set_value('id_barang'),
	    'tanggal_masuk' => set_value('tanggal_masuk'),
	    'jumlah_masuk' => set_value('jumlah_masuk'),
	);
        $this->template->load('template','tbl_barangmasuk/tbl_barangmasuk_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_barang' => $this->input->post('id_barang',TRUE),
		'tanggal_masuk' => $this->input->post('tanggal_masuk',TRUE),
		'jumlah_masuk' => $this->input->post('jumlah_masuk',TRUE),
	    );

            $this->Tbl_barangmasuk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_barangmasuk'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_barangmasuk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_barangmasuk/update_action'),
		'id_masuk' => set_value('id_masuk', $row->id_masuk),
		'id_barang' => set_value('id_barang', $row->id_barang),
		'tanggal_masuk' => set_value('tanggal_masuk', $row->tanggal_masuk),
		'jumlah_masuk' => set_value('jumlah_masuk', $row->jumlah_masuk),
	    );
            $this->template->load('template','tbl_barangmasuk/tbl_barangmasuk_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_barangmasuk'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_masuk', TRUE));
        } else {
            $data = array(
		'id_barang' => $this->input->post('id_barang',TRUE),
		'tanggal_masuk' => $this->input->post('tanggal_masuk',TRUE),
		'jumlah_masuk' => $this->input->post('jumlah_masuk',TRUE),
	    );

            $this->Tbl_barangmasuk_model->update($this->input->post('id_masuk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_barangmasuk'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_barangmasuk_model->get_by_id($id);

        if ($row) {
            $this->Tbl_barangmasuk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_barangmasuk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_barangmasuk'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_barang', 'id barang', 'trim|required');
	$this->form_validation->set_rules('tanggal_masuk', 'tanggal masuk', 'trim|required');
	$this->form_validation->set_rules('jumlah_masuk', 'jumlah masuk', 'trim|required');

	$this->form_validation->set_rules('id_masuk', 'id_masuk', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_barangmasuk.doc");

        $data = array(
            'tbl_barangmasuk_data' => $this->Tbl_barangmasuk_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_barangmasuk/tbl_barangmasuk_doc',$data);
    }

}

/* End of file Tbl_barangmasuk.php */
/* Location: ./application/controllers/Tbl_barangmasuk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-07-18 02:30:54 */
/* http://harviacode.com */
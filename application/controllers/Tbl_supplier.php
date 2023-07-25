<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_supplier_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','tbl_supplier/tbl_supplier_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_supplier_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_supplier_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_supplier' => $row->id_supplier,
		'nama_supplier' => $row->nama_supplier,
		'alamat_supplier' => $row->alamat_supplier,
		'no_hp' => $row->no_hp,
		'email' => $row->email,
	    );
            $this->template->load('template','tbl_supplier/tbl_supplier_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_supplier'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_supplier/create_action'),
	    'id_supplier' => set_value('id_supplier'),
	    'nama_supplier' => set_value('nama_supplier'),
	    'alamat_supplier' => set_value('alamat_supplier'),
	    'no_hp' => set_value('no_hp'),
	    'email' => set_value('email'),
	);
        $this->template->load('template','tbl_supplier/tbl_supplier_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_supplier' => $this->input->post('nama_supplier',TRUE),
		'alamat_supplier' => $this->input->post('alamat_supplier',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Tbl_supplier_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_supplier'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_supplier_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_supplier/update_action'),
		'id_supplier' => set_value('id_supplier', $row->id_supplier),
		'nama_supplier' => set_value('nama_supplier', $row->nama_supplier),
		'alamat_supplier' => set_value('alamat_supplier', $row->alamat_supplier),
		'no_hp' => set_value('no_hp', $row->no_hp),
		'email' => set_value('email', $row->email),
	    );
            $this->template->load('template','tbl_supplier/tbl_supplier_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_supplier'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_supplier', TRUE));
        } else {
            $data = array(
		'nama_supplier' => $this->input->post('nama_supplier',TRUE),
		'alamat_supplier' => $this->input->post('alamat_supplier',TRUE),
		'no_hp' => $this->input->post('no_hp',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Tbl_supplier_model->update($this->input->post('id_supplier', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_supplier'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_supplier_model->get_by_id($id);

        if ($row) {
            $this->Tbl_supplier_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_supplier'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_supplier'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_supplier', 'nama supplier', 'trim|required');
	$this->form_validation->set_rules('alamat_supplier', 'alamat supplier', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');

	$this->form_validation->set_rules('id_supplier', 'id_supplier', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_supplier.doc");

        $data = array(
            'tbl_supplier_data' => $this->Tbl_supplier_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_supplier/tbl_supplier_doc',$data);
    }

}

/* End of file Tbl_supplier.php */
/* Location: ./application/controllers/Tbl_supplier.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-06-30 04:37:23 */
/* http://harviacode.com */
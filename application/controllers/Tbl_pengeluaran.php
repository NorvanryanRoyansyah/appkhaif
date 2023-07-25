<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_pengeluaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_pengeluaran_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'tbl_pengeluaran_data' => $this->Tbl_pengeluaran_model->get_all(),
            'start' => 0
        );
        $this->template->load('template','tbl_pengeluaran/tbl_pengeluaran_list', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_pengeluaran_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_pengeluaran_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_pengeluaran' => $row->id_pengeluaran,
		'tanggal' => $row->tanggal,
		'nominal' => $row->nominal,
		'keterangan' => $row->keterangan,
		'id_users' => $row->id_users,
        'kategori' => $row->kategori,
	    );
            $this->template->load('template','tbl_pengeluaran/tbl_pengeluaran_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengeluaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_pengeluaran/create_action'),
	    'id_pengeluaran' => set_value('id_pengeluaran'),
	    'tanggal' => set_value('tanggal'),
	    'nominal' => set_value('nominal'),
	    'keterangan' => set_value('keterangan'),
        'kategori' => set_value('kategori'),
	    'id_users' => set_value('id_users'),
	);
        $this->template->load('template','tbl_pengeluaran/tbl_pengeluaran_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tanggal' => $this->input->post('tanggal',TRUE),
		'nominal' => $this->input->post('nominal',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
        'kategori' => $this->input->post('kategori',TRUE),
		'id_users' => $this->input->post('id_users',TRUE),
	    );

            $this->Tbl_pengeluaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_pengeluaran'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_pengeluaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_pengeluaran/update_action'),
		'id_pengeluaran' => set_value('id_pengeluaran', $row->id_pengeluaran),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'nominal' => set_value('nominal', $row->nominal),
        'kategori' => set_value('kategori', $row->kategori),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'id_users' => set_value('id_users', $row->id_users),
	    );
            $this->template->load('template','tbl_pengeluaran/tbl_pengeluaran_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengeluaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pengeluaran', TRUE));
        } else {
            $data = array(
		'tanggal' => $this->input->post('tanggal',TRUE),
		'nominal' => $this->input->post('nominal',TRUE),
        'kategori' => $this->input->post('kategori',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'id_users' => $this->input->post('id_users',TRUE),
	    );

            $this->Tbl_pengeluaran_model->update($this->input->post('id_pengeluaran', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_pengeluaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_pengeluaran_model->get_by_id($id);

        if ($row) {
            $this->Tbl_pengeluaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_pengeluaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengeluaran'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('nominal', 'nominal', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
    $this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
	$this->form_validation->set_rules('id_users', 'id users', 'trim|required');

	$this->form_validation->set_rules('id_pengeluaran', 'id_pengeluaran', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        
        $data = array(
            'tbl_pengeluaran_data' => $this->Tbl_pengeluaran_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_pengeluaran/tbl_pengeluaran_doc',$data);
    }

}

/* End of file Tbl_pengeluaran.php */
/* Location: ./application/controllers/Tbl_pengeluaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-07-05 17:32:59 */
/* http://harviacode.com */
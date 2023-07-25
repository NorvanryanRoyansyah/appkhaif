<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_order_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_order/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_order/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_order/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_order_model->total_rows($q);
        $tbl_order = $this->Tbl_order_model->get_all();
        $tbl_order_id = $this->Tbl_order_model->get_all_id();
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_order_data' => $tbl_order,
            'tbl_order_data_id' => $tbl_order_id,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_order/tbl_order_list', $data);
    }

    public function jasa()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_order/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_order/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_order/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_order_model->total_rows_jasa($q);
        $tbl_order = $this->Tbl_order_model->get_all_jasa();
        $tbl_order_id = $this->Tbl_order_model->get_all_id_jasa();
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_order_data' => $tbl_order,
            'tbl_order_data_id' => $tbl_order_id,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_order/tbl_order_jasa', $data);
    }


 

    public function read($id) 
    {
        $row = $this->Tbl_order_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_order' => $row->id_order,
		'tanggal' => $row->tanggal,
		'id_users' => $row->id_users,
        'full_name' => $row->full_name,
		'status' => $row->status,
        'ongkir' => $row->ongkir,
	    );
            $this->load->view('tbl_order/tbl_order_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_order'));
        }
    }

    
    public function read_jasa($id) 
    {
        $row = $this->Tbl_order_model->get_by_id_jasa($id);
        if ($row) {
            $data = array(
		'id_order' => $row->id_order,
		'tanggal' => $row->tanggal,
		'id_users' => $row->id_users,
        'full_name' => $row->full_name,
		'status' => $row->status,
        'ongkir' => $row->ongkir,
	    );
            $this->load->view('tbl_order/tbl_order_read_jasa', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_order'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_order/create_action'),
	    'id_order' => set_value('id_order'),
	    'tanggal' => set_value('tanggal'),
	    'id_users' => set_value('id_users'),
	    'status' => set_value('status'),
	);
        $this->template->load('template','tbl_order/tbl_order_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tanggal' => $this->input->post('tanggal',TRUE),
		'id_users' => $this->input->post('id_users',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Tbl_order_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_order'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_order_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_order/update_action'),
		'id_order' => set_value('id_order', $row->id_order),
		'tanggal' => set_value('tanggal', $row->tanggal),
		'id_users' => set_value('id_users', $row->id_users),
		'status' => set_value('status', $row->status),
	    );
            $this->template->load('template','tbl_order/tbl_order_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_order'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_order', TRUE));
        } else {
            $data = array(
		'tanggal' => $this->input->post('tanggal',TRUE),
		'id_users' => $this->input->post('id_users',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Tbl_order_model->update($this->input->post('id_order', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_order'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_order_model->get_by_id($id);

        if ($row) {
            $this->Tbl_order_model->delete($id);
            $this->Tbl_order_model->delete_do($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_order'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_order'));
        }
    }

    public function delete_jasa($id) 
    {
        $row = $this->Tbl_order_model->get_by_id_jasa($id);

        if ($row) {
            $this->Tbl_order_model->delete_jasa($id);
            $this->Tbl_order_model->delete_do_jasa($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_order/jasa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_order/jasa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('id_users', 'id users', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id_order', 'id_order', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_order.doc");

        $data = array(
            'tbl_order_data' => $this->Tbl_order_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbl_order/tbl_order_doc',$data);
    }

    public function acc($id) 
    {
        $row = $this->Tbl_order_model->get_by_id($id);

            $data = array(
		'status' => 'Selesai',
        'id_karyawan' => $this->session->userdata('id_users'),
	    );

            $this->Tbl_order_model->update($id, $data);
            $_SESSION['sukses'] = 'Pesanan Diselesaikan !';
            redirect(site_url('tbl_order'));
    }

        public function acc_jasa($id) 
        {
            $row = $this->Tbl_order_model->get_by_id_jasa($id);
    
                $data = array(
            'status' => 'Selesai',
            'id_karyawan' => $this->session->userdata('id_users'),
            );
    
                $this->Tbl_order_model->update_jasa($id, $data);
                $_SESSION['sukses'] = 'Pesanan Diselesaikan !';
                redirect(site_url('tbl_order/jasa'));
        }

        public function form_bayar($id) {
            $row = $this->Tbl_order_model->get_by_id($id);
    
            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('tbl_order/form_bayar_action'),
            'id_order' => set_value('id_order', $row->id_order),

            );
                $this->template->load('template','tbl_order/form_bayar', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('tbl_order'));
            }
        }

        function upload_foto(){
            $config['upload_path']          = './assets/bukti';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';
            //$config['max_size']             = 100;
            //$config['max_width']            = 1024;
            //$config['max_height']           = 768;
            $this->load->library('upload', $config);
            $this->upload->do_upload('bukti_pembayaran');
            return $this->upload->data();
        }
    
        public function form_bayar_action() 
        {
            $row = $this->Tbl_order_model->get_by_id($id);
            $foto = $this->upload_foto();
                $data = array(
            'status_pembayaran' => 'Sudah Dibayar',
            'bukti_pembayaran'        =>$foto['file_name']
            );
    
            $this->Tbl_order_model->update($this->input->post('id_order', TRUE), $data);
            $_SESSION['sukses'] = 'Sudah Dibayar !';
            redirect(site_url('tbl_order'));
        }

        public function form_bayar_jasa($id) {
            $row = $this->Tbl_order_model->get_by_id_jasa($id);
    
            if ($row) {
                $data = array(
                    'button' => 'Update',
                    'action' => site_url('tbl_order/form_bayar_action_jasa'),
            'id_order' => set_value('id_order', $row->id_order),

            );
                $this->template->load('template','tbl_order/form_bayar_jasa', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('tbl_order/jasa'));
            }
        }

        public function form_bayar_action_jasa() 
        {
            $row = $this->Tbl_order_model->get_by_id_jasa($id);
            $foto = $this->upload_foto();
                $data = array(
            'status_pembayaran' => 'Sudah Dibayar',
            'bukti_pembayaran'        =>$foto['file_name']
            );
    
            $this->Tbl_order_model->update_jasa($this->input->post('id_order', TRUE), $data);
            $_SESSION['sukses'] = 'Sudah Dibayar !';
            redirect(site_url('tbl_order/jasa'));
        }

}

    

/* End of file Tbl_order.php */
/* Location: ./application/controllers/Tbl_order.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-07-02 14:05:46 */
/* http://harviacode.com */
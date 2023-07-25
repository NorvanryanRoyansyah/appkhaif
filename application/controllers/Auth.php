<?php
Class Auth extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();
   
        $this->load->model('User_model');
    }
    
    function index(){
        $this->load->view('auth/login');
    }
    
    function cheklogin(){
        $email      = $this->input->post('email');
        //$password   = $this->input->post('password');
        $password = $this->input->post('password',TRUE);
        $hashPass = password_hash($password,PASSWORD_DEFAULT);
        $test     = password_verify($password, $hashPass);
        // query chek users
        $this->db->where('email',$email);
        $this->db->where('is_aktif', 'y');
        //$this->db->where('password',  $test);
        $users       = $this->db->get('tbl_user');
        if($users->num_rows()>0){
            $user = $users->row_array();
            if(password_verify($password,$user['password'])){
                // retrive user data to session
                $this->session->set_userdata($user);
                redirect('welcome');
            }else{
                $this->session->set_flashdata('status_login', 'Email / Password Salah');
                redirect('auth');
            }
        }else{
            $this->session->set_flashdata('status_login', 'Akun anda belum aktif, silakan hubungi fotocopy al Khaif');
            redirect('auth');
        }
    }
    
    function logout(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('status_login','Anda sudah berhasil keluar dari aplikasi');
        redirect('auth');
    }

    function register() {
        $this->load->view('auth/register');
    }

    public function register_action() 
    {
       
        $foto = $this->upload_foto();
        
            $password       = $this->input->post('password',TRUE);
            $options        = array("cost"=>4);
            $hashPassword   = password_hash($password,PASSWORD_BCRYPT,$options);
            
            $data = array(
		'full_name'     => $this->input->post('full_name',TRUE),
		'email'         => $this->input->post('email',TRUE),
        'no_hp'         => $this->input->post('no_hp',TRUE),
        'jenis_kelamin'         => $this->input->post('jenis_kelamin',TRUE),
		'password'      => $hashPassword,
		'images'        => $foto['file_name'],
		'id_user_level' => '2',
		'is_aktif'      => 'n',
	    );
            $this->User_model->insert($data);
            $_SESSION['sukses'] = 'Registrasi Berhasil ! Hubungi pihak fotocopy untuk aktifkan akun';
            redirect(site_url('auth'));
    }
    

    function upload_foto(){
        $config['upload_path']          = './assets/foto_profil';
        $config['allowed_types']        = 'gif|jpg|png';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('images');
        return $this->upload->data();
    }

}

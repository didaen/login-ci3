<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // Method contructor yaitu method default yang akan
    // otomatis terpanggil saat controller Auth dipanggil
    public function __construct()
    {
        // Memanggil method contructor CI_Controller
        parent::__construct();

        //Library form_validation tidak dapat disimpan
        // di application > config > autoload.php
        // harus disimpan di method atau controller
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->view('templates/auth_header');
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function registration()
    {
        // Kondisi form_validation
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Physics Yourself Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        }
    }
}

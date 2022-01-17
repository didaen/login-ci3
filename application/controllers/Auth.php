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
        //ATURAN-ATURAN TIAP FIELD
        // 1. Name, required (tidak boleh kosong)
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        // 2. Email, required (tidak boleh kosong)
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        // 3. Password, required (tidak boleh kosong)
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Passwords dont match!',
            'min_length' => 'Password is too short!'
        ]);
        // 3. Repeat Password Password, required (tidak boleh kosong)
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        // Kondisi form_validation
        // Jika data gagal ditambahkan lakukan
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Physics Yourself Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            // Jika data berhasil ditambahkan
            echo 'data berhasil ditambahakan!';
        }
    }
}

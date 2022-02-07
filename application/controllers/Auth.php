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
        $data['title'] = 'Login Page';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function registration()
    {
        //ATURAN-ATURAN TIAP FIELD
        // 1. Name, required (tidak boleh kosong)
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        // 2. Email, required (tidak boleh kosong)
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email has been used.'
        ]);
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
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
            ];

            $this->db->insert('user', $data);
            // Menampilkan pesan dulu sebelum redirect
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! Your account has been created. Please login.
            </div>');
            redirect('auth');
        }
    }
}

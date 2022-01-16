<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $this->load->view('templates/auth_header');
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function registration()
    {
        //Library form_validation tidak dapat disimpan
        // di application > config > autoload.php
        // harus disimpan di method atau controller
        $this->load->library('form_validation');

        $data['title'] = 'Physics Yourself Registration';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/registration');
        $this->load->view('templates/auth_footer');
    }
}

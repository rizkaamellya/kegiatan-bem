<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin');
    }

    public function login() {
        if ($this->session->userdata('is_login')) {
            redirect('root/kegiatan');
        }

        $this->load->view('LoginView');
    }

    public function authenticate() {
        $username = trim((string) $this->input->post('username', TRUE));
        $password = (string) $this->input->post('password');
        $admin = $this->Admin->verifikasiLogin($username, $password);

        if (!$admin) {
            $this->session->set_flashdata('login_error', 'Username atau password salah.');
            $this->session->set_flashdata('login_username', $username);
            redirect('login');
            return;
        }

        $this->session->sess_regenerate(TRUE);
        $this->session->set_userdata(array(
            'is_login' => TRUE,
            'admin_id' => $admin->id_admin,
            'admin_username' => $admin->username
        ));

        $destination = $this->session->userdata('redirect_after_login');
        $this->session->unset_userdata('redirect_after_login');
        redirect($destination ?: 'root/kegiatan');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}

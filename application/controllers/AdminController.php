<?php

class AdminController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin');
    }

    public function index() {
        // $session = $this->session->userdata('isLogin');

        // if ($session == false) {
        //     redirect('login');
        // } else {
            $data['admin'] = $this->Admin->ambilAdmin();
            $this->load->view('AdminView', $data);
        // }
    }
     public function newAdmin() {
        $data['admin'] = {};
        $this->load->view('AdminNewView', $data);
    public function tambahAdmin() {
        $val = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );
        $this->Admin->tambahAdmin($val);
        redirect('AdminController');
    }

    public function editAdmin($idAdmin) {
        $data['admin'] = $this->Admin->ambilAdminBerdasarkanId($idadmin);
        $this->load->view('AdminEditView', $data);
    }

    public function updateAdmin() {
        $val = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );
        $this->Admin->ubahAdmin($val, $this->input->post('id_admin'));
        redirect('AdminController');
    }

    public function hapusAdmin($idadmin) {
        $this->Admin->hapusadmin($idadmin);
        redirect('AdminController');
    }

}
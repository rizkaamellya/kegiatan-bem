<?php

class AdminController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin');
    }

    public function index() {
        $data['admin'] = $this->Admin->ambilAdmin();
        $this->load->view('AdminView', $data);
    }

    public function newAdmin() {
        $data['admin'] = null;
        $this->load->view('AdminNewView', $data);
    }

    public function tambahAdmin() {
        $val = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );
        $this->Admin->tambahAdmin($val);
        redirect('admin');
    }

    public function editAdmin($idAdmin) {
        $data['admin'] = $this->Admin->ambilAdminBerdasarkanId($idAdmin);
        $this->load->view('AdminEditView', $data);
    }

    public function updateAdmin() {
        $val = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );
        $this->Admin->ubahAdmin($val, $this->input->post('id_admin'));
        redirect('admin');
    }

    public function hapusAdmin($idAdmin) {
        $this->Admin->hapusAdmin($idAdmin);
        redirect('admin');
    }

}

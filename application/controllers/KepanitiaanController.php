<?php

class KepanitiaanController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kepanitiaan');
    }

    public function index() {
        // $session = $this->session->userdata('isLogin');

        // if ($session == false) {
        //     redirect('login');
        // } else {
            $data['kepanitiaan'] = $this->Kepanitiaan->ambilKepanitiaan();
            $this->load->view('KepanitiaanView', $data);
        // }
    }
    public function newKepanitiaan() {
        $data['kepanitiaan'] = null;
        $this->load->view('KepanitiaanNewView', $data);
    }    
    public function tambahKepanitiaan() {
        $val = array(
            'id_kegiatan' => $this->input->post('id_kegiatan'),
            'nama_panitia' => $this->input->post('nama_panitia'),
            'jabatan' => $this->input->post('jabatan')
           
         );    
        $this->Kepanitiaan->tambahKepanitiaan($val);
        redirect('KepanitiaanController');
    }

    public function editKepanitiaan($idKepanitiaan) {
        $data['kepanitiaan'] = $this->Kepanitiaan->ambilKepanitiaanBerdasarkanId($idKepanitiaan);
        $this->load->view('KepanitiaanEditView', $data);
    }

    public function updateKepanitiaan() {
        $val = array(
           'id_kegiatan' => $this->input->post('id_kegiatan'),
            'nama_panitia' => $this->input->post('nama_panitia'),
            'jabatan' => $this->input->post('jabatan')
        );
        $this->Kepanitiaan->ubahKepanitiaan($val, $this->input->post('id_kepanitiaan'));
        redirect('KepanitiaanController');
    }

    public function hapusKepanitiaan($idKepanitiaan) {
        $this->Kepanitiaan->hapuskepanitiaan($idKepanitiaan);
        redirect('KepanitiaanController');
    }

}
<?php

class KegiatanController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kegiatan');
    }
     
    public function index() {
        // $session = $this->session->userdata('isLogin');

        // if ($session == false) {
        //     redirect('login');
        // } else {
            $data['kegiatan'] = $this->Kegiatan->ambilKegiatan();
            $this->load->view('KegiatanView', $data);
        // }
    }
      public function newKegiatan() {
        $data['kegiatan'] = null;
        $this->load->view('KegiatanNewView', $data);
    }
    public function tambahKegiatan() {
        $val = array(
            'nama_kegiatan' => $this->input->post('nama_kegiatan'),
            'tanggal' => $this->input->post('tanggal'),
            'lokasi' => $this->input->post('lokasi'),
            'deskripsi' => $this->input->post('deskripsi')
         );    
        $this->Kegiatan->tambahKegiatan($val);
        redirect('KegiatanController');
    }

    public function editKegiatan($idKegiatan) {
        $data['kegiatan'] = $this->Kegiatan->ambilKegiatanBerdasarkanId($idKegiatan);
        $this->load->view('KegiatanEditView', $data);
    }

    public function updateKegiatan() {
        $val = array(
            'nama_kegiatan' => $this->input->post('nama_kegiatan'),
            'tanggal' => $this->input->post('tanggal'),
            'lokasi' => $this->input->post('lokasi'),
            'deskripsi' => $this->input->post('deskripsi'),
            'id_admin' => $this->input->post('id_admin')
        );
        $this->Kegiatan->ubahKegiatan($val, $this->input->post('id_kegiatan'));
        redirect('KegiatanController');
    }

    public function hapusKegiatan($idKegiatan) {
        $this->Kegiatan->hapuskegiatan($idKegiatan);
        redirect('KegiatanController');
    }

}
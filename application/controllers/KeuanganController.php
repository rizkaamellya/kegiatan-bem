<?php

class KeuanganController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Keuangan');
    }

    public function index() {
        // $session = $this->session->userdata('isLogin');

        // if ($session == false) {
        //     redirect('login');
        // } else {
            $data['keuangan'] = $this->Keuangan->ambilKeuangan();
            $this->load->view('KeuanganView', $data);
        // }
    }
    public function newKeuangan() {
        $data['keuangan'] = null;
        $this->load->view('KeuanganNewView', $data);
    }    
    public function tambahKeuangan() {
        $val = array(
            'keterangan' => $this->input->post('keterangan'),
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga'),
            'tanggal' => $this->input->post('tanggal')
           
         );    
        $this->Keuangan->tambahKeuangan($val);
        redirect('KeuanganController');
    }

    public function editKeuangan($idKeuangan) {
        $data['keuangan'] = $this->Keuangan->ambilKeuanganBerdasarkanId($idKeuangan);
        $this->load->view('KeuanganEditView', $data);
    }

    public function updateKeuangan() {
        $val = array(
           'keterangan' => $this->input->post('keterangan'),
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga'),
            'tanggal' => $this->input->post('tanggal')
        );
        $this->Keuangan->ubahKeuangan($val, $this->input->post('id_keuangan'));
        redirect('KeuanganController');
    }

    public function hapusKeuangan($idKeuangan) {
        $this->Keuangan->hapuskeuangan($idkeuangan);
        redirect('KeuanganController');
    }

}
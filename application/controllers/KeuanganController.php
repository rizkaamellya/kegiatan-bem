<?php

class KeuanganController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Keuangan');
        $this->load->model('Kegiatan');
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
        $data['kegiatan'] = $this->Kegiatan->ambilKegiatan();
        $this->load->view('KeuanganNewView', $data);
    }    
    public function tambahKeuangan() {
        $val = array(
            'id_kegiatan' => $this->input->post('id_kegiatan'),
            'keterangan' => $this->input->post('keterangan'),
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga'),
            'tanggal' => $this->input->post('tanggal')
           
         );    
        $this->Keuangan->tambahKeuangan($val);
        redirect('root/keuangan');
    }

    public function editKeuangan($idKeuangan) {
        $data['keuangan'] = $this->Keuangan->ambilKeuanganBerdasarkanId($idKeuangan);
        $data['kegiatan'] = $this->Kegiatan->ambilKegiatan();
        $this->load->view('KeuanganEditView', $data);
    }

    public function updateKeuangan() {
        $val = array(
            'id_kegiatan' => $this->input->post('id_kegiatan'),
            'keterangan' => $this->input->post('keterangan'),
            'jumlah' => $this->input->post('jumlah'),
            'harga' => $this->input->post('harga'),
            'tanggal' => $this->input->post('tanggal')
        );
        $this->Keuangan->ubahKeuangan($val, $this->input->post('id_keuangan'));
        redirect('root/keuangan');
    }

    public function hapusKeuangan($idKeuangan) {
        $this->Keuangan->hapusKeuangan($idKeuangan);
        redirect('root/keuangan');
    }

}

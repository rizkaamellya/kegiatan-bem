<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KegiatanPublikController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kegiatan');
    }

    public function index() {
        $data['kegiatan'] = $this->Kegiatan->ambilKegiatan();
        $this->load->view('KegiatanPublikView', $data);
    }

    public function detail($idKegiatan) {
        $kegiatan = $this->Kegiatan->ambilKegiatanBerdasarkanId($idKegiatan);
        if (empty($kegiatan)) {
            show_404();
        }

        $data['kegiatan'] = $kegiatan[0];
        $this->load->view('KegiatanDetailView', $data);
    }
}

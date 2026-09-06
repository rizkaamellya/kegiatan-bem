<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CetakController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kegiatan');
        $this->load->model('Kepanitiaan');
        $this->load->model('Keuangan');
    }

    private function checkAuth() {
        if (!$this->session->userdata('is_login')) {
            $this->session->set_userdata('redirect_after_login', current_url());
            redirect('login');
        }
    }

    public function index() {
        $this->checkAuth();
        $data['kegiatan'] = $this->Kegiatan->ambilKegiatan();
        $data['daftar_periode'] = $this->Kegiatan->ambilDaftarPeriodeTahun();
        $this->load->view('CetakMenuView', $data);
    }

    public function cetakRekapKeseluruhan() {
        $this->checkAuth();
        $periode_tahun = $this->input->get('periode_tahun');
        $semester = $this->input->get('semester');

        $rekap = $this->Kegiatan->ambilRekapKegiatan($periode_tahun, $semester);
        
        $total_panitia = 0;
        $total_biaya = 0;
        foreach ($rekap as $r) {
            $total_panitia += (int)$r->total_panitia;
            $total_biaya += (float)$r->total_biaya;
        }

        $data['rekap'] = $rekap;
        $data['periode_tahun'] = $periode_tahun;
        $data['semester'] = $semester;
        $data['total_panitia'] = $total_panitia;
        $data['total_biaya'] = $total_biaya;
        $data['title'] = 'Laporan Rekapitulasi Keseluruhan Kegiatan BEM';
        $this->load->view('cetak/CetakRekapKeseluruhanView', $data);
    }

    public function cetakKegiatan() {
        $this->checkAuth();
        $periode_tahun = $this->input->get('periode_tahun');
        $semester = $this->input->get('semester');

        $data['kegiatan'] = $this->Kegiatan->ambilKegiatan($periode_tahun, $semester);
        $data['periode_tahun'] = $periode_tahun;
        $data['semester'] = $semester;
        $data['title'] = 'Laporan Data Kegiatan BEM';
        $this->load->view('cetak/CetakKegiatanView', $data);
    }

    public function cetakKegiatanDetail($idKegiatan) {
        $this->checkAuth();
        $this->renderDetail($idKegiatan);
    }

    public function cetakKegiatanDetailPublik($idKegiatan) {
        $this->renderDetail($idKegiatan);
    }

    private function renderDetail($idKegiatan) {
        $kegiatan = $this->Kegiatan->ambilKegiatanBerdasarkanId($idKegiatan);
        if (empty($kegiatan)) {
            show_404();
        }

        $data['kegiatan'] = $kegiatan[0];
        $data['kepanitiaan'] = $this->Kepanitiaan->ambilKepanitiaanBerdasarkanKegiatan($idKegiatan);
        $data['keuangan'] = $this->Keuangan->ambilKeuanganBerdasarkanKegiatan($idKegiatan);
        $data['title'] = 'Laporan Pertanggungjawaban (LPJ) - ' . $kegiatan[0]->nama_kegiatan;

        $this->load->view('cetak/CetakKegiatanDetailView', $data);
    }

    public function cetakKeuangan() {
        $this->checkAuth();
        $idKegiatan = $this->input->get('id_kegiatan');

        if (!empty($idKegiatan)) {
            $data['keuangan'] = $this->Keuangan->ambilKeuanganBerdasarkanKegiatan($idKegiatan);
            $kegiatan = $this->Kegiatan->ambilKegiatanBerdasarkanId($idKegiatan);
            $data['nama_filter_kegiatan'] = !empty($kegiatan) ? $kegiatan[0]->nama_kegiatan : 'Kegiatan Specified';
        } else {
            $data['keuangan'] = $this->Keuangan->ambilKeuangan();
            $data['nama_filter_kegiatan'] = 'Semua Kegiatan';
        }

        $data['kegiatan_list'] = $this->Kegiatan->ambilKegiatan();
        $data['selected_kegiatan'] = $idKegiatan;
        $data['title'] = 'Laporan Keuangan BEM';
        $this->load->view('cetak/CetakKeuanganView', $data);
    }

    public function cetakKepanitiaan() {
        $this->checkAuth();
        $idKegiatan = $this->input->get('id_kegiatan');

        if (!empty($idKegiatan)) {
            $data['kepanitiaan'] = $this->Kepanitiaan->ambilKepanitiaanBerdasarkanKegiatan($idKegiatan);
            $kegiatan = $this->Kegiatan->ambilKegiatanBerdasarkanId($idKegiatan);
            $data['nama_filter_kegiatan'] = !empty($kegiatan) ? $kegiatan[0]->nama_kegiatan : 'Kegiatan Specified';
        } else {
            $data['kepanitiaan'] = $this->Kepanitiaan->ambilKepanitiaan();
            $data['nama_filter_kegiatan'] = 'Semua Kegiatan';
        }

        $data['kegiatan_list'] = $this->Kegiatan->ambilKegiatan();
        $data['selected_kegiatan'] = $idKegiatan;
        $data['title'] = 'Laporan Kepanitiaan BEM';
        $this->load->view('cetak/CetakKepanitiaanView', $data);
    }
}

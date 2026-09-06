<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RekapController extends MY_Controller {

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

        $periode_tahun = $this->input->get('periode_tahun');
        $semester = $this->input->get('semester');

        $rekap = $this->Kegiatan->ambilRekapKegiatan($periode_tahun, $semester);
        $daftar_periode = $this->Kegiatan->ambilDaftarPeriodeTahun();

        $total_kegiatan = count($rekap);
        $total_panitia = 0;
        $total_biaya = 0;

        foreach ($rekap as $r) {
            $total_panitia += (int)$r->total_panitia;
            $total_biaya += (float)$r->total_biaya;
        }

        $data['rekap'] = $rekap;
        $data['daftar_periode'] = $daftar_periode;
        $data['selected_periode'] = $periode_tahun;
        $data['selected_semester'] = $semester;
        $data['total_kegiatan'] = $total_kegiatan;
        $data['total_panitia'] = $total_panitia;
        $data['total_biaya'] = $total_biaya;

        $this->load->view('RekapView', $data);
    }

    public function detail($idKegiatan) {
        $this->checkAuth();

        $kegiatan = $this->Kegiatan->ambilKegiatanBerdasarkanId($idKegiatan);
        if (empty($kegiatan)) {
            show_404();
        }

        $data['kegiatan'] = $kegiatan[0];
        $data['kepanitiaan'] = $this->Kepanitiaan->ambilKepanitiaanBerdasarkanKegiatan($idKegiatan);
        $data['keuangan'] = $this->Keuangan->ambilKeuanganBerdasarkanKegiatan($idKegiatan);

        $total_biaya = 0;
        foreach ($data['keuangan'] as $k) {
            $total_biaya += ($k->jumlah * $k->harga);
        }
        $data['total_biaya'] = $total_biaya;

        // If AJAX request, return JSON
        if ($this->input->is_ajax_request()) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));
            return;
        }

        // Otherwise render or redirect
        redirect('root/cetak/kegiatan-detail/' . $idKegiatan);
    }
}

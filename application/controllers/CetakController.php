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
        $data['logo_bem'] = $this->imageDataUri(FCPATH . 'assets/images/logo-bem.png');
        $data['logo_inar'] = $this->imageDataUri(FCPATH . 'assets/images/logo-inar.png');

        $html = $this->load->view('cetak/CetakKegiatanDetailView', $data, TRUE);

        require_once APPPATH . 'third_party/dompdf/dompdf/autoload.inc.php';

        $options = new Dompdf\Options();
        $options->set('isRemoteEnabled', FALSE);
        $options->set('isHtml5ParserEnabled', TRUE);
        $options->set('defaultFont', 'Times-Roman');
        $options->setChroot(FCPATH);

        $filename = 'LPJ-' . $this->safeFilename($kegiatan[0]->nama_kegiatan) . '.pdf';
        if (class_exists('DOMImplementation')) {
            $pdf = new Dompdf\Dompdf($options);
            $pdf->loadHtml($html, 'UTF-8');
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();
            $pdf->stream($filename, array('Attachment' => FALSE));
            return;
        }

        $this->streamPdfWithChrome($html, $filename);
    }

    private function imageDataUri($path) {
        if (!is_file($path) || !is_readable($path)) {
            return '';
        }

        $mime = function_exists('mime_content_type') ? mime_content_type($path) : 'image/png';
        return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($path));
    }

    private function safeFilename($name) {
        $name = preg_replace('/[^A-Za-z0-9_-]+/', '-', strip_tags($name));
        $name = trim($name, '-');
        return $name !== '' ? $name : 'Kegiatan';
    }

    private function streamPdfWithChrome($html, $filename) {
        $chrome = is_executable('/usr/bin/google-chrome') ? '/usr/bin/google-chrome' : '';
        if ($chrome === '') {
            show_error('Generator PDF membutuhkan ekstensi PHP DOM/XML atau Google Chrome.', 500);
        }

        $htmlFile = tempnam(sys_get_temp_dir(), 'lpj-html-');
        $pdfFile = tempnam(sys_get_temp_dir(), 'lpj-pdf-');
        $profileDir = tempnam(sys_get_temp_dir(), 'lpj-chrome-');
        if ($profileDir !== FALSE) {
            @unlink($profileDir);
            @mkdir($profileDir, 0700);
        }
        if ($htmlFile === FALSE || $pdfFile === FALSE || !is_dir($profileDir)) {
            show_error('Gagal menyiapkan file sementara untuk PDF.', 500);
        }

        file_put_contents($htmlFile, $html);
        $command = escapeshellarg($chrome)
            . ' --headless=new --no-sandbox --disable-gpu --disable-dev-shm-usage'
            . ' --user-data-dir=' . escapeshellarg($profileDir)
            . ' --allow-file-access-from-files --print-to-pdf-no-header'
            . ' --print-to-pdf=' . escapeshellarg($pdfFile)
            . ' ' . escapeshellarg('file://' . $htmlFile) . ' 2>&1';

        exec($command, $output, $status);
        if ($status !== 0 || !is_file($pdfFile) || filesize($pdfFile) === 0) {
            @unlink($htmlFile);
            @unlink($pdfFile);
            $this->removeDirectory($profileDir);
            log_message('error', 'Chrome PDF gagal: ' . implode("\n", $output));
            show_error('Gagal membuat dokumen PDF.', 500);
        }

        $pdfData = file_get_contents($pdfFile);
        @unlink($htmlFile);
        @unlink($pdfFile);
        $this->removeDirectory($profileDir);

        $this->output
            ->set_content_type('application/pdf')
            ->set_header('Content-Disposition: inline; filename="' . $filename . '"')
            ->set_header('Content-Length: ' . strlen($pdfData))
            ->set_output($pdfData);
    }

    private function removeDirectory($directory) {
        if (!is_dir($directory)) {
            return;
        }

        $items = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($items as $item) {
            if ($item->isDir()) {
                @rmdir($item->getPathname());
            } else {
                @unlink($item->getPathname());
            }
        }
        @rmdir($directory);
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

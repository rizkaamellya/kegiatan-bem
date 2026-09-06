<?php

class KegiatanController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kegiatan');
    }
     
    public function index() {
        $periode_tahun = $this->input->get('periode_tahun');
        $semester = $this->input->get('semester');

        $data['kegiatan'] = $this->Kegiatan->ambilKegiatan($periode_tahun, $semester);
        $data['daftar_periode'] = $this->Kegiatan->ambilDaftarPeriodeTahun();
        $data['selected_periode'] = $periode_tahun;
        $data['selected_semester'] = $semester;
        $this->load->view('KegiatanView', $data);
    }
    public function newKegiatan() {
        $data['kegiatan'] = null;
        $data['daftar_periode'] = $this->Kegiatan->ambilDaftarPeriodeTahun();
        $this->load->view('KegiatanNewView', $data);
    }

    private function uploadFileKegiatan($field, $allowedTypes) {
        $config['upload_path'] = './uploads/kegiatan/';
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }
        $config['allowed_types'] = $allowedTypes;
        $config['max_size'] = 2048;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            return null;
        }

        $uploadData = $this->upload->data();
        return $uploadData['file_name'];
    }

    public function uploadEditor() {
        $uploadPath = './uploads/kegiatan/editor/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size'] = 5120;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file')) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => $this->upload->display_errors('', ''))));
            return;
        }

        $uploadData = $this->upload->data();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'location' => base_url() . 'uploads/kegiatan/editor/' . $uploadData['file_name']
            )));
    }

    public function tambahKegiatan() {
        $tanggal = $this->input->post('tanggal');
        $periode_tahun = $this->input->post('periode_tahun');
        $semester = $this->input->post('semester');

        // Jika periode kosong, buat otomatis dari tanggal
        if (empty($periode_tahun) && !empty($tanggal)) {
            $thn = (int)date('Y', strtotime($tanggal));
            $bln = (int)date('n', strtotime($tanggal));
            $periode_tahun = ($bln >= 7) ? ($thn . '/' . ($thn + 1)) : (($thn - 1) . '/' . $thn);
        }
        if (empty($semester) && !empty($tanggal)) {
            $bln = (int)date('n', strtotime($tanggal));
            $semester = ($bln >= 7 && $bln <= 12) ? 'Ganjil' : 'Genap';
        }

        $val = array(
            'nama_kegiatan' => $this->input->post('nama_kegiatan'),
            'tanggal' => $tanggal,
            'periode_tahun' => $periode_tahun,
            'semester' => $semester,
            'lokasi' => $this->input->post('lokasi'),
            'deskripsi' => $this->input->post('deskripsi')
        );

        if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
            $foto = $this->uploadFileKegiatan('foto', 'jpg|jpeg|png');
            if ($foto) {
                $val['foto'] = $foto;
            }
        }

        $this->Kegiatan->tambahKegiatan($val);
        redirect('root/kegiatan');
    }

    public function editKegiatan($idKegiatan) {
        $data['kegiatan'] = $this->Kegiatan->ambilKegiatanBerdasarkanId($idKegiatan);
        $data['daftar_periode'] = $this->Kegiatan->ambilDaftarPeriodeTahun();
        $this->load->view('KegiatanEditView', $data);
    }

    public function updateKegiatan() {
        $idKegiatan = $this->input->post('id_kegiatan');
        $tanggal = $this->input->post('tanggal');
        $periode_tahun = $this->input->post('periode_tahun');
        $semester = $this->input->post('semester');

        if (empty($periode_tahun) && !empty($tanggal)) {
            $thn = (int)date('Y', strtotime($tanggal));
            $bln = (int)date('n', strtotime($tanggal));
            $periode_tahun = ($bln >= 7) ? ($thn . '/' . ($thn + 1)) : (($thn - 1) . '/' . $thn);
        }
        if (empty($semester) && !empty($tanggal)) {
            $bln = (int)date('n', strtotime($tanggal));
            $semester = ($bln >= 7 && $bln <= 12) ? 'Ganjil' : 'Genap';
        }

        $val = array(
            'nama_kegiatan' => $this->input->post('nama_kegiatan'),
            'tanggal' => $tanggal,
            'periode_tahun' => $periode_tahun,
            'semester' => $semester,
            'lokasi' => $this->input->post('lokasi'),
            'deskripsi' => $this->input->post('deskripsi')
        );

        if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
            $foto = $this->uploadFileKegiatan('foto', 'jpg|jpeg|png');
            if ($foto) {
                $val['foto'] = $foto;
                $old = $this->Kegiatan->ambilKegiatanBerdasarkanId($idKegiatan);
                if (!empty($old) && !empty($old[0]->foto)) {
                    $oldPath = FCPATH . 'uploads/kegiatan/' . $old[0]->foto;
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
            }
        }

        if (isset($_FILES['file_pdf']) && $_FILES['file_pdf']['size'] > 0) {
            $filePdf = $this->uploadFileKegiatan('file_pdf', 'pdf');
            if ($filePdf) {
                $val['file_pdf'] = $filePdf;
                $old = $this->Kegiatan->ambilKegiatanBerdasarkanId($idKegiatan);
                if (!empty($old) && !empty($old[0]->file_pdf)) {
                    $oldPath = FCPATH . 'uploads/kegiatan/' . $old[0]->file_pdf;
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
            }
        }

        $this->Kegiatan->ubahKegiatan($val, $idKegiatan);
        redirect('root/kegiatan');
    }

    public function hapusKegiatan($idKegiatan) {
        $record = $this->Kegiatan->ambilKegiatanBerdasarkanId($idKegiatan);
        if (!empty($record) && !empty($record[0]->foto)) {
            $path = FCPATH . 'uploads/kegiatan/' . $record[0]->foto;
            if (file_exists($path)) {
                @unlink($path);
            }
        }
        if (!empty($record) && !empty($record[0]->file_pdf)) {
            $path = FCPATH . 'uploads/kegiatan/' . $record[0]->file_pdf;
            if (file_exists($path)) {
                @unlink($path);
            }
        }
        $this->Kegiatan->hapusKegiatan($idKegiatan);
        redirect('root/kegiatan');
    }

}

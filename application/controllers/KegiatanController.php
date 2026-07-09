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

    private function uploadFileKegiatan($field, $allowedTypes) {
        $config['upload_path'] = './uploads/kegiatan/';
        $config['allowed_types'] = $allowedTypes;
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            return null;
        }

        $uploadData = $this->upload->data();
        return $uploadData['file_name'];
    }

    public function tambahKegiatan() {
        $foto = $this->uploadFileKegiatan('foto', 'jpg|jpeg|png');
        $filePdf = $this->uploadFileKegiatan('file_pdf', 'pdf');
        $val = array(
            'nama_kegiatan' => $this->input->post('nama_kegiatan'),
            'tanggal' => $this->input->post('tanggal'),
            'lokasi' => $this->input->post('lokasi'),
            'deskripsi' => $this->input->post('deskripsi'),
            'foto' => $foto,
            'file_pdf' => $filePdf
        );    
        $this->Kegiatan->tambahKegiatan($val);
        redirect('kegiatan');
    }

    public function editKegiatan($idKegiatan) {
        $data['kegiatan'] = $this->Kegiatan->ambilKegiatanBerdasarkanId($idKegiatan);
        $this->load->view('KegiatanEditView', $data);
    }

    public function updateKegiatan() {
        $idKegiatan = $this->input->post('id_kegiatan');
        $val = array(
            'nama_kegiatan' => $this->input->post('nama_kegiatan'),
            'tanggal' => $this->input->post('tanggal'),
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
        redirect('kegiatan');
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
        redirect('kegiatan');
    }

}

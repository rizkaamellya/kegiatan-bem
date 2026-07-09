<?php
class DokumenController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Dokumen');
    }

    // List all documents
    public function index() {
        $data['dokumen'] = $this->Dokumen->ambilDokumen();
        $this->load->view('DokumenView', $data);
    }

    // Show form to add a new document
    public function newDokumen() {
        $this->load->view('DokumenNewView');
    }

    // Handle creation of a new document with file upload
    public function tambahDokumen() {
        $config['upload_path']   = './uploads/dokumen/';
        $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|png|jpg|jpeg';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('nama_file')) {
            redirect('dokumen');
            return;
        }
        $uploadData = $this->upload->data();
        $val = array(
            'id_kegiatan' => $this->input->post('id_kegiatan'),
            'nama_file' => $uploadData['file_name'],
            'jenis_dokumen' => $this->input->post('jenis_dokumen')
        );
        $this->Dokumen->tambahDokumen($val);
        redirect('dokumen');
    }

    // Show edit form for a document
    public function edit($idDokumen) {
        $data['dokumen'] = $this->Dokumen->ambilDokumenBerdasarkanId($idDokumen);
        $this->load->view('DokumenEditView', $data);
    }

    // Update document data, optionally handling a new file upload
    public function update() {
        $idDokumen = $this->input->post('id_dokumen');
        $val = array(
            'id_kegiatan' => $this->input->post('id_kegiatan'),
            'jenis_dokumen' => $this->input->post('jenis_dokumen')
        );
        if (isset($_FILES['nama_file']) && $_FILES['nama_file']['size'] > 0) {
            $config['upload_path']   = './uploads/dokumen/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|png|jpg|jpeg';
            $config['max_size']      = 2048;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('nama_file')) {
                $uploadData = $this->upload->data();
                $val['nama_file'] = $uploadData['file_name'];
                // Delete old file
                $old = $this->Dokumen->ambilDokumenBerdasarkanId($idDokumen);
                if (!empty($old)) {
                    $oldFile = $old[0]->nama_file;
                    $oldPath = FCPATH . 'uploads/dokumen/' . $oldFile;
                    if (file_exists($oldPath)) { @unlink($oldPath); }
                }
            }
        }
        $this->Dokumen->ubahDokumen($val, $idDokumen);
        redirect('dokumen');
    }

    // Delete a document and its file
    public function delete($idDokumen) {
        $record = $this->Dokumen->ambilDokumenBerdasarkanId($idDokumen);
        if (!empty($record)) {
            $file = $record[0]->nama_file;
            $path = FCPATH . 'uploads/dokumen/' . $file;
            if (file_exists($path)) { @unlink($path); }
        }
        $this->Dokumen->hapusDokumen($idDokumen);
        redirect('dokumen');
    }
}
?>
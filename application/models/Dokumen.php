<?php

class Dokumen extends CI_Model {

    public function tambahDokumen($dokumen) {
        $this->db->insert('dokumen', $dokumen);
    }

    public function ambilDokumen() {
        return $this->db->get('dokumen')->result();
    }

    public function ambilDokumenBerdasarkanId($idDokumen) {
        $this->db->where('id_dokumen', $idDokumen);

        return $this->db->get('dokumen')->result();
    }

    public function ubahDokumen($dokumen, $idDokumen) {
        $this->db->where('id_dokumen', $idDokumen);
        $this->db->update('dokumen', $idDokumen);
    }

    public function hapusDokumen($idDokumen) {
        $dokumen = array(
            'id_dokumen' => $idDokumen
        );
        $this->db->delete('dokumen', $dokumen);
    }

}
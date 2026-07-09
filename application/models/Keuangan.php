<?php

class Keuangan extends CI_Model {

    public function tambahKeuangan($keuangan) {
        $this->db->insert('keuangan', $keuangan);
    }

    public function ambilKeuangan() {
        return $this->db->get('keuangan')->result();
    }

    public function ambilKeuanganBerdasarkanId($idKeuangan) {
        $this->db->where('id_keuangan', $idKeuangan);

        return $this->db->get('keuangan')->result();
    }

    public function ubahKeuangan($keuangan, $idKeuangan) {
        $this->db->where('id_keuangan', $idKeuangan);
        $this->db->update('keuangan', $idKeuangan);
    }

    public function hapusKeuangan($idKeuangan) {
        $keuangan = array(
            'id_keuangan' => $idKeuangan,
        );
        $this->db->delete('keuangan', $keuangan);
    }

}
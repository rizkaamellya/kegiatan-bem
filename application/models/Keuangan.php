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

    public function ambilKeuanganBerdasarkanKegiatan($idKegiatan) {
        $this->db->where('id_kegiatan', $idKegiatan);
        $this->db->order_by('tanggal', 'ASC');
        $this->db->order_by('id_keuangan', 'ASC');

        return $this->db->get('keuangan')->result();
    }

    public function ubahKeuangan($keuangan, $idKeuangan) {
        $this->db->where('id_keuangan', $idKeuangan);
        $this->db->update('keuangan', $keuangan);
    }

    public function hapusKeuangan($idKeuangan) {
        $keuangan = array(
            'id_keuangan' => $idKeuangan,
        );
        $this->db->delete('keuangan', $keuangan);
    }

}

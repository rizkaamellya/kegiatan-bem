<?php

class Kegiatan extends CI_Model {

    public function tambahKegiatan($kegiatan) {
        $this->db->insert('kegiatan', $kegiatan);
    }

    public function ambilKegiatan() {
        return $this->db->get('kegiatan')->result();
    }

    public function ambilKegiatanBerdasarkanId($idKegiatan) {
        $this->db->where('id_kegiatan', $idKegiatan);

        return $this->db->get('kegiatan')->result();
    }

    public function ubahKegiatan($kegiatan, $idKegiatan) {
        $this->db->where('id_kegiatan', $idKegiatan);
        $this->db->update('kegiatan', $kegiatan);
    }

    public function hapusKegiatan($idKegiatan) {
        $kegiatan = array(
            'id_kegiatan' => $idKegiatan,
        );
        $this->db->delete('kegiatan', $kegiatan);
    }

}

<?php

class Kepanitiaan extends CI_Model {

    public function tambahKepanitiaan($kepanitiaan) {
        $this->db->insert('kepanitiaan', $kepanitiaan);
    }

    public function ambilKepanitiaan() {
        return $this->db->get('kepanitiaan')->result();
    }

    public function ambilKepanitiaanBerdasarkanId($idKepanitiaan) {
        $this->db->where('id_kepanitiaan', $idKepanitiaan);

        return $this->db->get('kepanitiaan')->result();
    }

    public function ubahKepanitiaan($kepanitiaan, $idKepanitiaan) {
        $this->db->where('id_kepanitiaan', $idKepanitiaan);
        $this->db->update('kepanitiaan', $kepanitiaan);
    }

    public function hapusKepanitiaan($idKepanitiaan) {
        $kepanitiaan = array(
            'id_kepanitiaan' => $idKepanitiaan,
        );
        $this->db->delete('kepanitiaan', $kepanitiaan);
    }

}
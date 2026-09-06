<?php

class Kegiatan extends CI_Model {

    public function tambahKegiatan($kegiatan) {
        $this->db->insert('kegiatan', $kegiatan);
    }

    public function ambilKegiatan($periode_tahun = null, $semester = null) {
        if (!empty($periode_tahun)) {
            $this->db->where('periode_tahun', $periode_tahun);
        }
        if (!empty($semester)) {
            $this->db->where('semester', $semester);
        }
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('id_kegiatan', 'DESC');
        return $this->db->get('kegiatan')->result();
    }

    public function ambilDaftarPeriodeTahun() {
        $this->db->select('DISTINCT(periode_tahun) as periode_tahun');
        $this->db->where('periode_tahun IS NOT NULL');
        $this->db->where('periode_tahun !=', '');
        $this->db->order_by('periode_tahun', 'DESC');
        $result = $this->db->get('kegiatan')->result();
        
        $list = array();
        foreach ($result as $r) {
            $list[] = $r->periode_tahun;
        }
        return $list;
    }

    public function ambilRekapKegiatan($periode_tahun = null, $semester = null) {
        $this->db->select('kegiatan.*, 
            COUNT(DISTINCT kepanitiaan.id_kepanitiaan) AS total_panitia, 
            COALESCE(SUM(keuangan.jumlah * keuangan.harga), 0) AS total_biaya,
            COUNT(DISTINCT keuangan.id_keuangan) AS total_transaksi_keuangan');
        $this->db->from('kegiatan');
        $this->db->join('kepanitiaan', 'kepanitiaan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        $this->db->join('keuangan', 'keuangan.id_kegiatan = kegiatan.id_kegiatan', 'left');
        
        if (!empty($periode_tahun)) {
            $this->db->where('kegiatan.periode_tahun', $periode_tahun);
        }
        if (!empty($semester)) {
            $this->db->where('kegiatan.semester', $semester);
        }

        $this->db->group_by('kegiatan.id_kegiatan');
        $this->db->order_by('kegiatan.tanggal', 'DESC');
        $this->db->order_by('kegiatan.id_kegiatan', 'DESC');
        return $this->db->get()->result();
    }

    public function ambilKegiatanTerbaru($limit = 3) {
        $this->db->order_by('tanggal', 'DESC');
        $this->db->order_by('id_kegiatan', 'DESC');
        $this->db->limit($limit);

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


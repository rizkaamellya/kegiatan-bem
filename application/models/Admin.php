<?php

class Admin extends CI_Model {

    public function tambahAdmin($admin) {
        $this->db->insert('admin', $admin);
    }

    public function ambilAdmin() {
        return $this->db->get('admin')->result();
    }

    public function ambilAdminBerdasarkanId($idAdmin) {
        $this->db->where('id_admin', $idAdmin);

        return $this->db->get('admin')->result();
    }

    public function ubahAdmin($admin, $idAdmin) {
        $this->db->where('id_admin', $idAdmin);
        $this->db->update('admin', $admin);
    }

    public function hapusAdmin($idAdmin) {
        $admin = array(
            'id_admin' => $idAdmin,
        );
        $this->db->delete('admin', $admin);
    }

}
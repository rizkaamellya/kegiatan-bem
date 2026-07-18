<?php

class Admin extends CI_Model {

    public function verifikasiLogin($username, $password) {
        $admin = $this->db->get_where('admin', array('username' => $username), 1)->row();
        if (!$admin) {
            return null;
        }

        $passwordValid = password_verify($password, $admin->password);

        // Tetap menerima data lama yang belum memakai password_hash.
        if (!$passwordValid && hash_equals((string) $admin->password, $password)) {
            $passwordValid = true;
            $this->ubahAdmin(
                array('password' => password_hash($password, PASSWORD_DEFAULT)),
                $admin->id_admin
            );
        }

        return $passwordValid ? $admin : null;
    }

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

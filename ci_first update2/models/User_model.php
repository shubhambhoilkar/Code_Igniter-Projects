<?php
class User_model extends CI_Model {
    public function get_users() {
        return $this->db->get('users')->result();
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function get_user($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function update_user($id, $data) {
        return $this->db->update('users', $data, ['id' => $id]);
    }

    public function delete_user($id) {
        return $this->db->delete('users', ['id' => $id]);
    }
}
?>
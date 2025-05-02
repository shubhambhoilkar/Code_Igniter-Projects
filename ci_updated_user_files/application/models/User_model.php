<?php
class User_model extends CI_Model {

    public function get_users() {
        return $this->db->get('users')->result();
    }

    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function get_user_by_id($id) {
        return $this->db->get_where('users', array('id' => $id))->row();
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}

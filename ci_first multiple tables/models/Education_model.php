<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education_model extends CI_Model {

    public function insert_education($data) {
        return $this->db->insert('education', $data);
    }

    public function update_education($user_id, $data) {
        return $this->db->update('education', $data, ['user_id' => $user_id]);
    }

    public function update_education_by_user($user_id, $data) {
    $this->db->where('user_id', $user_id);
    return $this->db->update('education', $data);
    }

    public function delete_education($user_id) {
        return $this->db->delete('education', ['user_id' => $user_id]);
    }

    public function get_education_by_user($user_id) {
        return $this->db->get_where('education', ['user_id' => $user_id])->row_array();
    }
}
?>

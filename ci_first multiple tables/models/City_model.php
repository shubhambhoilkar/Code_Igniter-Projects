<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City_model extends CI_Model {

    public function insert_city($data) {
        return $this->db->insert('cities', $data);
    }

    public function update_city($user_id, $data) {
        return $this->db->where('user_id', $user_id)->update('cities', $data);
    }

    public function delete_city($user_id) {
        return $this->db->delete('cities', ['user_id' => $user_id]);
    }

    public function get_city_by_user($user_id) {
        return $this->db->get_where('cities', ['user_id' => $user_id])->row_array();
    }
}
?>

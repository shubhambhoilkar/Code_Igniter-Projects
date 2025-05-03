<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address_model extends CI_Model {

	public function get_addresses_by_user($user_id) {
	    return $this->db->get_where('addresses', ['user_id' => $user_id])->result();
	}

    public function insert_address($data) {
        return $this->db->insert('addresses', $data);
    }

    public function get_address($id) {
        return $this->db->get_where('addresses', ['id' => $id])->row();
    }

    public function update_address($id, $data) {
        return $this->db->where('id', $id)->update('addresses', $data);
    }	

    public function delete_address($id) {
        return $this->db->delete('addresses', ['id' => $id]);
    }
}
?>
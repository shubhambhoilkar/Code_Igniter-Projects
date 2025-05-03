<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

// Get single user by ID
    public function get_user_by_id($id) {
    $this->db->select('
        users.*,
        education.education_level,
        education.institute,
        cities.city_name as city
    ');
    $this->db->from('users');
    $this->db->join('education', 'education.user_id = users.id', 'left');
    $this->db->join('cities', 'cities.user_id = users.id', 'left');
    $this->db->where('users.id', $id);
    $query = $this->db->get();
    return $query->row(); // For single user (edit)
}

//
    public function get_all_users() {
        $this->db->select('
            users.*,
            education.education_level,
            education.institute,
            cities.city_name as city
        ');
        $this->db->from('users');
        $this->db->join('education', 'education.user_id = users.id', 'left');
        $this->db->join('cities', 'cities.user_id = users.id', 'left');
        $this->db->order_by('users.id', 'ASC');
        $query = $this->db->get();
        return $query->result(); // For listing all users
    }

// Insert into users table
    public function insert_user($data) {
        $this->db->insert('users', $data);
        $this->db->insert('education',$data);
        $this->db->insert('cities',$data);
        return $this->db->insert_id(); // returns user_id for inserting related data
    }

// Update user
    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

// Delete user
    public function delete_user($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}


/*
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
*/
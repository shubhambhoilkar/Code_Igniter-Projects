<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->helper(['form','url']);
    }

    public function index() {
        $data['users'] = $this->User_model->get_users();
        $this->load->view('user_list', $data);

    }

    public function create() {
        $this->load->view('user_form');
    }

    public function store() {
    // First, insert the user data
    $user_data = [
        'name'  => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'education' => $this->input->post('education'),
        'city' => $this->input->post('city'),
        'gender' => $this->input->post('gender')
    ];

    $this->User_model->insert_user($user_data);
    $user_id = $this->db->insert_id(); // Get the inserted user's ID

    // Then insert address data (if provided)
    $this->load->model('Address_model');
    $address_data = [
        'user_id' => $user_id,
        'address_line' => $this->input->post('address_line'),
        'city' => $this->input->post('address_city'),
        'state' => $this->input->post('state'),
        'postal_code' => $this->input->post('zipcode')
    ];

    // Optional: Add basic validation to prevent empty inserts
    if (!empty($address_data['address_line'])) {
        $this->Address_model->insert_address($address_data);
    }

    redirect('user');
}



    public function edit($id) {
    $data['user'] = $this->User_model->get_user($id);
    
    // Load the address model and get user's first address (if any)
    $this->load->model('Address_model');
    $address = $this->Address_model->get_addresses_by_user($id);
    $data['address'] = !empty($address) ? $address[0] : null; // Pick the first address

    $this->load->view('user_form', $data);
}



    public function update($id) {
    $userData  = [
        'name'      => $this->input->post('name'),
        'email'     => $this->input->post('email'),
        'education' => $this->input->post('education'),
        'city'      => $this->input->post('city'),
        'gender'    => $this->input->post('gender'),
    ];

    $config['upload_path']   = './uploads/';
    $config['allowed_types'] = '*';
    $config['max_size']      = 2048;

    $this->load->library('upload', $config);

    for ($i = 1; $i <= 4; $i++) {
        $field_name = 'image_' . $i;
        if (!empty($_FILES[$field_name]['name'])) {
            if ($this->upload->do_upload($field_name)) {
                $upload_data = $this->upload->data();
                $data[$field_name] = $upload_data['file_name'];
            } else {
                echo $this->upload->display_errors();
                return;
            }
        }
    }

    $this->User_model->update_user($id, $userData );

    //loading address data;
    $this->load->model('Address_model');
    // Prepare address data
    $addressData  = [
        'user_id' => $id,
        'address_line' => $this->input->post('address_line'),
        'city' => $this->input->post('address_city'),
        'state' => $this->input->post('address_state'),
        'postal_code' => $this->input->post('address_postal_code')
    ];

    // Check if user already has address
    $existingAddress = $this->Address_model->get_addresses_by_user($id);
    if (!empty($existingAddress)) {
        // Update (assumes one address per user)
        $addressId = $existingAddress[0]->id;
        $this->Address_model->update_address($addressId, $addressData);
    } else {
        // Insert new
        $this->Address_model->insert_address($addressData);
    }
    
    redirect('user');
}


    public function delete($id) {
        $this->User_model->delete_user($id);
        redirect('user');
    }
}
?>

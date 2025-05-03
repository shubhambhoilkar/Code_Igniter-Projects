<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Address_model');
        $this->load->model('User_model'); // In case you need user info
    }

    // Show all addresses for a user
    public function index($user_id) {
    $data['addresses'] = $this->Address_model->get_addresses_by_user($user_id);
    $data['user_id'] = $user_id; // 🔑 Pass this for view to use
    $this->load->view('address_list', $data);
}


    // Show form to add a new address
    public function create($user_id) {
        $data['user_id'] = $user_id;
        $this->load->view('address_form', $data);
    }

    // Store the address in DB
    public function store($user_id) {
        $data = [
            'user_id' => $user_id,
            'address_line' => $this->input->post('address_line'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'postal_code' => $this->input->post('postal_code'),
        ];
        $this->Address_model->insert_address($data);
        redirect('address/index/'.$user_id);
    }

    // Edit a specific address
    public function edit($id) {
        $address = $this->Address_model->get_address($id);
        $data['address'] = $address;
        $this->load->view('address_form', $data);
    }

    // Update the address
    public function update($id) {
        $address = $this->Address_model->get_address($id);

        $data = [
            'address_line' => $this->input->post('address_line'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'postal_code' => $this->input->post('postal_code'),
        ];
        $this->Address_model->update_address($id, $data);
        redirect('address/index/'.$address->user_id);
    }

    // Delete an address
    public function delete($id) {
        $address = $this->Address_model->get_address($id);
        $this->Address_model->delete_address($id);
        redirect('address/index/'.$address->user_id);
    }
}
?>
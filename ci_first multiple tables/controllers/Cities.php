<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('City_model');
        $this->load->helper(['form', 'url']);
    }

    public function index() {
        $data['cities'] = $this->City_model->get_all_cities();
        $this->load->view('city_list', $data); // Create this view
    }

    public function create() {
        $this->load->view('city_form'); // Create this view
    }

    public function store() {
        $data = [
            'user_id' => $this->input->post('user_id'),
            'city_name' => $this->input->post('city_name'),
            'state' => $this->input->post('state')
        ];
        $this->City_model->insert_city($data);
        redirect('cities');
    }

    public function edit($id) {
        $data['city'] = $this->City_model->get_city_by_id($id);
        $this->load->view('city_form', $data);
    }

    public function update($id) {
        $data = [
            'city_name' => $this->input->post('city_name'),
            'state' => $this->input->post('state')
        ];
        $this->City_model->update_city($id, $data);
        redirect('cities');
    }

    public function delete($id) {
        $this->City_model->delete_city($id);
        redirect('cities');
    }
}

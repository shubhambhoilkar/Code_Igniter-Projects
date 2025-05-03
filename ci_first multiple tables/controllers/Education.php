<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Education_model');
        $this->load->helper(['form', 'url']);
    }

    public function index() {
        $data['educations'] = $this->Education_model->get_all_education();
        $this->load->view('education_list', $data); // Create this view
    }

    public function create() {
        $this->load->view('education_form'); // Create this view
    }

/*
    public function store() {

        $data = [
            'user_id' => $this->input->post('user_id'),
            'education_level' => $this->input->post('education_level'),
            'institute' => $this->input->post('institute')
        ];
        $this->Education_model->insert_education($data);
        redirect('education');
    }
// 2. Insert education
        $education_data = [
            'user_id'         => $user_id,
            'education_level' => $this->input->post('education_level'),
            'institute'       => $this->input->post('institute'),
            'education'       => $this->input->post('education')
        ];
        $this->Education_model->insert_education($education_data);
        $edu_data= $this->db->insert_education();

    public function update($id) {
        $data = [
            'education' => $this->input->post('education'),
            'education_level' => $this->input->post('education_level'),
            'institute' => $this->input->post('institute')
        ];
        $this->Education_model->update_education($id, $data);
        redirect('education');
    }


*/

    public function edit($id) {
        $data['education'] = $this->Education_model->get_education_by_id($id);
        $this->load->view('education_form', $data);
    }


    public function delete($id) {
        $this->Education_model->delete_education($id);
        redirect('education');
    }
}

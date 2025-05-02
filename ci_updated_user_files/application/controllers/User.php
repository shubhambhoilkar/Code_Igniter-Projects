<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
        $data['users'] = $this->User_model->get_users();
        $this->load->view('user_list', $data);
    }

    public function create() {
        $this->load->view('user_form');
    }

    public function store() {
        $this->load->library('upload');

        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'education' => $this->input->post('education'),
            'city' => $this->input->post('city'),
            'gender' => $this->input->post('gender')
        );

        // handle uploads
        for ($i = 1; $i <= 4; $i++) {
            $filename = 'image_' . $i;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time() . '_' . $_FILES[$filename]['name'];
            $this->upload->initialize($config);

            if ($this->upload->do_upload($filename)) {
                $uploadData = $this->upload->data();
                $data[$filename] = $uploadData['file_name'];
            }
        }

        $this->User_model->insert_user($data);
        redirect('user');
    }

    public function edit($id) {
        $data['user'] = $this->User_model->get_user_by_id($id);
        $this->load->view('user_form', $data);
    }

    public function update($id) {
        $this->load->library('upload');

        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'education' => $this->input->post('education'),
            'city' => $this->input->post('city'),
            'gender' => $this->input->post('gender')
        );

        for ($i = 1; $i <= 4; $i++) {
            $filename = 'image_' . $i;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = time() . '_' . $_FILES[$filename]['name'];
            $this->upload->initialize($config);

            if ($this->upload->do_upload($filename)) {
                $uploadData = $this->upload->data();
                $data[$filename] = $uploadData['file_name'];
            }
        }

        $this->User_model->update_user($id, $data);
        redirect('user');
    }

    public function delete($id) {
        $this->User_model->delete_user($id);
        redirect('user');
    }
}

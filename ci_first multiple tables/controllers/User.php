<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('City_model');
        $this->load->model('Address_model');
        $this->load->model('Education_model');
        $this->load->helper(['form', 'url']);
    }

    public function index() {
        $data['users'] = $this->User_model->get_all_users();
        $this->load->view('user_list', $data);
    }


    public function create() {
        $this->load->view('user_form');
    }

    public function store() {
        // 1. Insert user data
        $user_data = [
            'name'  => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'gender'=> $this->input->post('gender')
        ];
        $this->User_model->insert_user($user_data);
        $user_id = $this->db->insert_id();

        // 2. Insert education
        $education_data = [
        'user_id'         => $user_id,
        'education'       => $this->input->post('education'),
        'education_level' => $this->input->post('education_level'),
        'institution'     => $this->input->post('institution')
            ];
        $this->Education_model->insert_education($education_data);

                // 3. Insert city
        $city_data = [
            'user_id'   => $user_id,
            'city_name' => $this->input->post('city'),
        ];
        $this->City_model->insert_city($city_data);

        // 4. Insert address
        $address_data = [
            'user_id'      => $user_id,
            'address_line' => $this->input->post('address_line'),
            'city'         => $this->input->post('address_city'),
            'postal_code'  => $this->input->post('zipcode')
        ];
        if (!empty($address_data['address_line'])) {
            $this->Address_model->insert_address($address_data);
        }

        redirect('user');
    }

    public function edit($id) {
        $data['user'] = $this->User_model->get_user_by_id($id);

        // Load related data as objects
        $education = $this->Education_model->get_education_by_user($id);
        $data['education'] = !empty($education) ? (object) $education : null;

        $city = $this->City_model->get_city_by_user($id);
        $data['city'] = !empty($city) ? (object) $city : null;

        $address = $this->Address_model->get_addresses_by_user($id);
        $data['address'] = !empty($address) ? $address[0] : null;

        $this->load->view('user_form', $data);
    }

    public function update($id) {
        $userData  = [
            'name'   => $this->input->post('name'),
            'email'  => $this->input->post('email'),
            'gender' => $this->input->post('gender'),
        ];

        // Handle image uploads
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size']      = 2048;
        $this->load->library('upload', $config);

        for ($i = 1; $i <= 4; $i++) {
            $field_name = 'image_' . $i;
            if (!empty($_FILES[$field_name]['name'])) {
                if ($this->upload->do_upload($field_name)) {
                    $upload_data = $this->upload->data();
                    $userData[$field_name] = $upload_data['file_name'];
                } else {
                    echo $this->upload->display_errors();
                    return;
                }
            }
        }

        $this->User_model->update_user($id, $userData);
/*
        $education_data = [
        'education_level' => $this->input->post('education_level'),
        'institution' => $this->input->post('institution')
    ];
    $this->Education_model->update_education_by_user($id, $education_data);
*/
        // Update education
        $education_data = [
            'education'       => $this->input->post('education'),
            'education_level' => $this->input->post('education_level'),
            'institute'       => $this->input->post('institute')
        ];
        $this->Education_model->update_education_by_user($id, $education_data);

        // Update city
        $city_data = [
            'city_name' => $this->input->post('city')        ];
        $this->City_model->update_city($id, $city_data);

        // Update address
        $address_data = [
            'user_id'      => $id,
            'address_line' => $this->input->post('address_line'),
            'city'         => $this->input->post('address_city'),
            'postal_code'  => $this->input->post('zipcode')
        ];
        $existingAddress = $this->Address_model->get_addresses_by_user($id);
        if (!empty($existingAddress)) {
            $addressId = $existingAddress[0]->id;
            $this->Address_model->update_address($addressId, $address_data);
        } else {
            $this->Address_model->insert_address($address_data);
        }

        redirect('user');
    }

    public function delete($id) {
        $this->User_model->delete_user($id);
        redirect('user');
    }
}

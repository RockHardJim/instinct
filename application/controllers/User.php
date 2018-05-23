<?php

Class User Extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library('authentication');
        $this->load->library('sanity');
        $this->load->library('Hub');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('User_model');
        $this->load->library('recaptcha');
        $this->load->library('session');
        $this->load->model('Vehicle_model');
        $this->sanity->secure_requests();
        $this->sanity->secure_headers();
        if(!$this->authentication->loggedin())
        {
            redirect('auth/login');
        }
    }


    public function panel()
    {
        $token = $this->authentication->gettoken($this->encrypt->decode($this->session->userdata('token')));

        if(!$this->User_model->bounty_hunter($token))
        {
            $data['token'] = $token;
            $data['admin'] = $this->User_model->user($token);
            $data['bounty_hunters'] = $this->User_model->bounty_hunters();
            $data['bountyhunters'] = $this->User_model->bountyhunters();
            $data['vehicles'] = $this->Vehicle_model->vehicles();
            $data['deliveries'] = $this->Vehicle_model->delivery();
            $this->load->view('partials/global/header', $data);
            $this->load->view('panel/admin');
            $this->load->view('partials/global/footer');
        }
        else
        {
            $data['token'] = $token;
            $data['bounty_profile'] = $this->User_model->bounty_profile($token);
            $data['bounty_hunter'] = $this->User_model->user($token);
            $this->load->view('partials/global/header');
            $this->load->view('panel/bounty-hunter');
            $this->load->view('partials/global/footer');
        }
    }

    public function add_vehicle()
    {
        $token = $this->authentication->gettoken($this->encrypt->decode($this->session->userdata('token')));

        if(!$this->User_model->bounty_hunter($token))
        {
            $data['token'] = $token;
            $data['admin'] = $this->User_model->user($token);
            $data['bounty_hunters'] = $this->User_model->bounty_hunters();
            $data['bountyhunters'] = $this->User_model->bountyhunters();
            $data['vehicles'] = $this->Vehicle_model->vehicles();
            $data['deliveries'] = $this->Vehicle_model->delivery();
            $this->load->view('partials/global/header', $data);
            $this->load->view('panel/vehicle/register-vehicle');
            $this->load->view('partials/global/footer');
        }
        else
        {
            redirect('user/panel');
        }
    }

    public function do_add_vehicle()
    {
        $this->form_validation->set_rules('vehicle_code', 'Serial Number', 'required');
        $this->form_validation->set_rules('armour_level', 'Armour Level', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('license_plate', 'License Plate', 'required');

        if($this->form_validation->run() == FALSE)
        {
            $response = array(
                'status' => 'error',
                'message' => 'Hi, please insure you have properly filled in your textboxes'
            );

            echo json_encode($response, JSON_PRETTY_PRINT);
        }
        else
        {
            $vehicle_code = 'ITWeb18-'.Hub::string_clean($this->security->xss_clean($this->input->post('vehicle_code')));
            $armour_level = Hub::string_clean($this->security->xss_clean($this->input->post('armour_level')));
            $name = Hub::string_clean($this->security->xss_clean($this->input->post('name')));
            $license_plate = Hub::string_clean($this->security->xss_clean($this->input->post('license_plate')));
            $this->Vehicle_model->register_vehicle($vehicle_code, $armour_level, $name, $license_plate);

            $response = array(
                'status' => 'success',
                'message' => 'Hi, you have succesfully registered a new vehicle you may now add  deliveries and bounties'
            );

            echo json_encode($response, JSON_PRETTY_PRINT);
        }
        
    }
}
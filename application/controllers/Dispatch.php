<?php

Class Dispatch Extends CI_Controller
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
        if (!$this->authentication->loggedin()) {
            redirect('auth/login');
        }
    }

    public function schedule()
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
            $data['bounties'] = $this->Vehicle_model->getbounties();
            $this->load->view('partials/global/header', $data);
            $this->load->view('panel/dispatch/create-delivery');
            $this->load->view('partials/global/footer');
        }
        else
        {
            redirect('user/panel');
        }
    }

    public function bounty()
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
            $this->load->view('panel/dispatch/create-bounty');
            $this->load->view('partials/global/footer');
        }
        else
        {
            redirect('user/panel');
        }
    }

    public function dobounty()
    {
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

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
            $amount = Hub::string_clean($this->security->xss_clean($this->input->post('amount')));
            $level = Hub::string_clean($this->security->xss_clean($this->input->post('level')));
            $this->Vehicle_model->create_bounty($amount, $level);

            $response = array(
                'status' => 'success',
                'message' => 'Hi, you have succesfully put forward a bounty'
            );

            echo json_encode($response, JSON_PRETTY_PRINT);
        }

    }

    public function doschedule()
    {
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('vehicle', 'Vehicle', 'required');
        $this->form_validation->set_rules('bounty', 'Bounty', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');

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
            $level = Hub::string_clean($this->security->xss_clean($this->input->post('level')));
            $amount = Hub::string_clean($this->security->xss_clean($this->input->post('amount')));
            $vehicle_token = Hub::string_clean($this->security->xss_clean($this->input->post('vehicle')));
            $bounty_token = Hub::string_clean($this->security->xss_clean($this->input->post('bounty')));
            $destination_longitude = Hub::string_clean($this->security->xss_clean($this->input->post('longitude')));
            $destination_latitude = Hub::string_clean($this->security->xss_clean($this->input->post('latitude')));

            $token = $this->Vehicle_model->create_delivery($level, $amount, $vehicle_token, $bounty_token, $destination_latitude, $destination_longitude);
            $users = $this->User_model->bounty_hunters();

            foreach($users as $user)
            {
                $this->email->from('info@instict.co', 'QR CODE');
                $this->email->to($this->encrypt->decode($user->email));
                $this->email->subject('Instinct QR CODE');
                $this->email->message('Hi you have been selected as a guardian for a delivery please click the following link to generate your access code '.site_url('dispatch/qr'.$token));
                $this->email->send();
            }


        }
    }
}
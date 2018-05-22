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
}
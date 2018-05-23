<?php

Class Overview Extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library('authentication');
        $this->load->library('sanity');
        $this->load->library('email');
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


    public function overview($token)
    {
        $data['token'] = $token;
        $data['admin'] = $this->User_model->user($token);
        $data['bounty_hunters'] = $this->User_model->bounty_hunters();
        $data['bountyhunters'] = $this->User_model->bountyhunters();
        $data['vehicles'] = $this->Vehicle_model->vehicles();
        $data['deliveries'] = $this->Vehicle_model->delivery();
        $data['bounties'] = $this->Vehicle_model->getbounties();
        $this->load->view('partials/global/header', $data);
        $this->load->view('panel/overview');
        $this->load->view('partials/global/footer');
    }
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller
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
        $this->load->library('session');
        $this->sanity->secure_requests();
        $this->sanity->secure_headers();
    }

    public function index()
    {
        $this->load->view('partials/global/header');
        $this->load->view('default/index');
        $this->load->view('partials/global/footer');
    }

    public function error($code)
    {
        switch($code)
        {
            case "ole":
                $this->load->view('partials/global/header');
                $this->load->view('custom-errors/ole');
                $this->load->view('partials/global/footer');
        }
    }
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
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
        $this->load->library('recaptcha');
        $this->load->library('session');
        $this->sanity->secure_requests();
        $this->sanity->secure_headers();
        if($this->authentication->loggedin())
        {
            redirect('user/panel');
        }
    }

    public function login()
    {
        $this->load->view('partials/global/header');
        $this->load->view('auth/login');
        $this->load->view('partials/global/footer');
    }

    public function register()
    {
        $this->load->view('partials/global/header');
        $this->load->view('auth/register');
        $this->load->view('partials/global/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/landing/index');
    }

    public function doregister()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('surname', 'Surname', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

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

                $name = Hub::string_clean($this->security->xss_clean($this->input->post('name')));
                $surname = Hub::string_clean($this->security->xss_clean($this->input->post('surname')));
                $username = Hub::string_clean($this->security->xss_clean($this->input->post('username')));
                $email = Hub::string_clean($this->security->xss_clean($this->input->post('email')));
                $password = Hub::string_clean($this->security->xss_clean($this->input->post('password')));
                echo $this->authentication->register($name, $surname, $username, $email, $password);
        }
    }

    public function dologin()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


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

                $username = Hub::string_clean($this->security->xss_clean($this->input->post('username')));
                $password = Hub::string_clean($this->security->xss_clean($this->input->post('password')));
                echo $this->authentication->login($username, $password);


        }
    }
}
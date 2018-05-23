<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;

Class Authentication
{
    private $ci;


    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();
        $this->ci->load->library('encrypt');
        $this->ci->load->library('email');
        $this->ci->load->library('Hub');
        $this->ci->load->library('session');
        $this->ci->load->library('BountyHunter');
        $this->ci->load->helper('url');

    }

    //Login function gets details from Auth Controller
    public function login($username, $password)
    {
        $username = trim(Hub::string_clean($username));


        $account = $this->lookup($username);

        if(!$account)
        {
            $response = array(
                'status' => 'error',
                'message' => 'Hi, you have entered a non-existant account please try again'
            );

            return json_encode($response, JSON_PRETTY_PRINT);
        }
        else
        {
            if($account[0]->attempts >= 5)
            {
                $response = array(
                    'status' => 'error',
                    'message' => 'Hi, your account has been locked due to too many invalid login attempts'
                );
                return json_encode($response, JSON_PRETTY_PRINTY);
            }
            else
            {
                if ($this->password_compare($password, $account[0]->password))
                {
                   $key = $this->generate_token($account[0]->token);

                    $this->ci->session->set_userdata('token', $this->ci->encrypt->encode($key));

                    $response = array(
                        'status' => 'success',
                        'message' => 'Hi, we have succesfully authenticated you we are redirecting you to the user panel'
                    );

                    return json_encode($response, JSON_PRETTY_PRINT);
                    return true;
                }
                else
                {
                    $this->log_attempt($username);

                    $response = array(
                        'status' => 'error',
                        'message' => 'Hi, you have entered the wrong password as such you have ' . 5 - $account[0]->attempts . ' left to try and login to your account'
                    );
                    return json_encode($response, JSON_PRETTY_PRINTY);
                }
            }
        }
    }

    public function register($name, $surname, $username, $email, $password, $access_level = 0)
    {
        if($this->lookup(trim($username)))
        {
            $response = array(
                'status' => 'error',
                'message' => 'Hi, this account already exists'
            );

            return json_encode($response, JSON_PRETTY_PRINT);
        }
        else
        {
            if(!Hub::check_email($email, true))
            {
                $response = array(
                    'status' => 'error',
                    'message' => 'Hi, you have submitted an invalid email'
                );

                return json_encode($response, JSON_PRETTY_PRINT);
                return false;
            }
            if(Hub::email_is_disposable($email))
            {
                $response = array(
                    'status' => 'error',
                    'message' => 'Hi, you have submitted a disposable email address'
                );

                return json_encode($response, JSON_PRETTY_PRINT);
                return false;
            }

            if($this->password_strength($password))
            {
                $data = array(
                    'token' => md5($name.$surname.$username.$email),
                    'email' => $this->ci->encrypt->encode($email),
                    'name' => $this->ci->encrypt->encode($name),
                    'surname' => $this->ci->encrypt->encode($surname),
                    'username' => $username,
                    'password' => $this->hash($password),
                    'access_level' => $access_level
                );

                $this->ci->bountyhunter->register($data['token']);
                $this->ci->bountyhunter->register_profile($data['token']);
                $this->ci->db->insert('user', $data);

                $response = array(
                    'status' => 'success',
                    'message' => 'Hi, you have successfully registered your account'
                );

                return json_encode($response, JSON_PRETTY_PRINT);
                return true;
            }
            else
            {
                $response = array(
                    'status' => 'error',
                    'message' => 'Hi, your password does not meet the site requirements please choose something stronger'
                );

                return json_encode($response, JSON_PRETTY_PRINT);
                return false;
            }
        }
    }

    public function loggedin()
    {
        $token = $this->ci->session->userdata('token');

        if(empty($token))
        {
            return false;
        }
        else
        {
            if($this->validate_token($this->ci->encrypt->decode($token)))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }

    private function validate_token($token)
    {

        $token = (new Parser())->parse((string) $token); // Parses from a string
        $token->getHeaders(); // Retrieves the token header
        $token->getClaims(); // Retrieves the token claims

        $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
        $data->setIssuer('http://instict.test');
        $data->setAudience('http://instict.test');
        $data->setId('instinct', true);

        if($token->validate($data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function gettoken($token)
    {
        $token = (new Parser())->parse((string) $token); // Parses from a string
        $token->getHeaders(); // Retrieves the token header
        $token->getClaims(); // Retrieves the token claims

        return $token->getClaim('token');
    }

    public function generate_token($user_token)
    {
        $signer = new Sha256();
        $token = (new Builder())->setIssuer('http://instict.test') // Configures the issuer (iss claim)
        ->setAudience('http://instict.test') // Configures the audience (aud claim)
        ->setId('instinct', true) // Configures the id (jti claim), replicating as a header item
        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
        ->setNotBefore(time()) // Configures the time that the token can be used (nbf claim)
        ->setExpiration(time() + 7200) // Configures the expiration time of the token (exp claim)
        ->set('token', $user_token) // Configures a new claim, called "uid"
        ->sign($signer, 'Chubanka+-F33l!nGV3rYfreeKY') // creates a signature using "testing" as key
        ->getToken(); // Retrieves the generated token
        return $token;
    }

    //Anti bruteforce feature might even add request throttling for ip's
    private function log_attempt($username)
    {
            $username = trim(Hub::string_clean($username));
            $this->ci->db->set('attempts', '+1');
            $this->ci->db->from('user');
            $this->ci->db->where('username', $username);
            $this->ci->db->update('user');
    }

    private function password_compare($password, $hash)
    {
        $adapter = new \Phpass\Hash\Adapter\Pbkdf2(array (
            'iterationCount' => 15000
        ));

        $phpassHash = new \Phpass\Hash($adapter);

        if($phpassHash->checkPassword($password, $hash))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    private function lookup($username)
    {
        $this->ci->db->select('*');
        $this->ci->db->from('user');
        $this->ci->db->where('username', $username);
        $query = $this->ci->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
            return true;
        }
        else
        {
            return false;
        }
    }

    private function save_user($data)
    {
        $this->ci->db->insert('user', $data);
    }

    //Password hashing using the PHPASS Library
    public function hash($password)
    {
        $adapter = new \Phpass\Hash\Adapter\Pbkdf2(array (
            'iterationCount' => 15000
        ));

        $phpassHash = new \Phpass\Hash($adapter);
        $pass = $phpassHash->hashPassword($password);

        return $pass;
    }

    //Password entropy calculator for password security also using PHPASS
    private function password_strength($password)
    {
        $adapter = new \Phpass\Strength\Adapter\Wolfram;
        $phpassStrength = new \Phpass\Strength($adapter);

        $passwordEntropy = $phpassStrength->calculate($password);

        if($passwordEntropy >= 40)
        {
            return true;
        }
        elseif($passwordEntropy < 35)
        {
            return false;
        }
    }

}
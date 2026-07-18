<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('is_login')) {
            $method = strtoupper($this->input->method());
            if ($method === 'GET') {
                $this->session->set_userdata('redirect_after_login', current_url());
            }

            redirect('login');
        }
    }
}

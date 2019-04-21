<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logout extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->session->sess_destroy();
    }

    function index() {

        ob_start();
        echo '<h3>Sess&atilde;o Encerrada</h3>';
        header('Refresh:2;url=Login');
        ob_end_flush();
        
        
    }

}

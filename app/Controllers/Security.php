<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;

class Security extends BaseController
{
    public $session;

    public function __construct()
    {
        $this->session = session();;
       
    }

    public function verifySession()
    {
        if(empty($this->session->get('id')))
            return 0;
        else
            return 1;
    }
}
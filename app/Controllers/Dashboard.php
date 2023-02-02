<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;
use App\Controllers\Security;

class Dashboard extends BaseController
{
    public $session;
    public $security;

    public function __construct()
    {
        $this->session = session();
        $this->security = new Security;
        $this->request = \Config\Services::request();
    }

    public function index()
    {
        $verifySession = $this->security->verifySession();
        
        if($verifySession == 0)
            return view('app/logout');

        $locale = (string)$this->session->get('lang');

        switch($locale)
        {
            case 'en':
                $this->request->setLocale('en');
            break;

            case 'es':
                $this->request->setLocale('es');
            break;
        }
        
        return view('app/index');
    }

}
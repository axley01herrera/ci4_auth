<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Request;
use App\Models\ModelAuthentication;

class Authentication extends BaseController
{
    public $session;
    public $request;
    public $modelAuthentication;
    public $email;

    public function __construct()
    {
        $this->session = session();
        $this->request = \Config\Services::request();
        $this->email = \Config\Services::email();
        $this->modelAuthentication = new ModelAuthentication;

        $this->session->set('id', '');
        $this->session->set('email', '');
        $this->session->set('status', '');
    }

    public function index()
    {
        if(empty($this->request->getPostGet('lang')))
        {
            $browserLang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

            if($browserLang == 'es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3')
                $this->request->setLocale('es');
            else
                $this->request->setLocale('en');
        }
        else
            $this->request->setLocale($this->request->getPostGet('lang'));

        $data = array();
        $data['locale'] = $this->request->getLocale();
        
        return view('authentication/index', $data);
    }

    public function returnView()
    {
        $formData = $this->request->getPost('post');

        if(empty($formData['lang']))
            $this->request->setLocale('es');
        else
            $this->request->setLocale($formData['lang']);

        $data = array();
        $data['locale'] = $this->request->getLocale();
        
        return view($formData['view'], $data);
    }

    public function login()
    {
        $response = array();
        $formData = $this->request->getPost('post');

        if(empty($formData['lang']))
            $this->request->setLocale('es');
        else
            $this->request->setLocale($formData['lang']);

        $resultVerifyCredentials = $this->modelAuthentication->verifyCredentials($formData['email'], $formData['password']);

        if($resultVerifyCredentials['error'] == 0)
        {
            $today = getdate();

            $update = array();
            $update['token'] = '';
            $update['lastSession'] = date('Y-m-d g:i a', $today[0]);

            $this->modelAuthentication->updateClient($resultVerifyCredentials['data'][0]['id'], $update);

            $this->session->set('id', $resultVerifyCredentials['data'][0]['id']);
            $this->session->set('email', $resultVerifyCredentials['data'][0]['email']);
            $this->session->set('status', $resultVerifyCredentials['data'][0]['status']);
            $this->session->set('lang', $resultVerifyCredentials['data'][0]['lang']);

            $response['error'] = 0;
        }
        else
        {
            $response['error'] = 1;
            if($resultVerifyCredentials['msg'] == 'INVALID_PASSWORD')
                $response['msg'] = lang('Error.invalidPassword');
            elseif($resultVerifyCredentials['msg'] == 'EMAIL_NOT_FOUND')
                $response['msg'] = lang('Error.emailNotExist');
            elseif($resultVerifyCredentials['msg'] == 'EMAIL_NOT_VERIFIED')
                $response['msg'] = lang('Error.emailNotVerified');
        }

        return json_encode($response);
    }

    public function signup()
    {
        $response = array();
        $formData = $this->request->getPost('post');

        if(empty($formData['lang']))
            $this->request->setLocale('es');
        else
            $this->request->setLocale($formData['lang']);

        $resultCheckClientEmailExist = $this->modelAuthentication->checkClientEmailExist($formData['email']);

        if(empty($resultCheckClientEmailExist))
        {
            $today = getdate();

            $data = array();
            $data['email'] = $formData['email'];
            $data['password'] = password_hash($formData['password'], PASSWORD_DEFAULT);
            $data['token'] = md5(uniqid().$formData['email']);
            $data['lang'] = $formData['lang'];
            $data['registrationDate'] = date('Y-m-d', $today[0]);

            $resultCreateClient = $this->modelAuthentication->createClient($data);

            if($resultCreateClient['error'] == 0)
            {
                $dataEmail = array();
                $dataEmail['pageTitle'] = lang('Email.signupPageTitle');
                $dataEmail['barnerTop'] = lang('Email.signupBarnerTop');
                $dataEmail['p1'] = lang('Email.signupP1');
                $dataEmail['p2'] = lang('Email.signupP2');
                $dataEmail['buttonText'] = lang('Email.signupButtonText');
                $dataEmail['link'] = base_url('Authentication/activateAccount').'?token='.$data['token'].'&lang='.$data['lang'];

                $this->email->setFrom('info@grupoahvsolucionesinformaticas.es', lang('Email.signupSubject'));
                $this->email->setTo($formData['email']);
                $this->email->setSubject(lang('Email.signupSubject'));
                $this->email->setMessage(view('email/activateAccount', $dataEmail));
                $this->email->send();

                $response = array();
                $response['error'] = 0;
                $response['msg'] = lang('Success.successSignup');
            }
        }
        else
        {
            $response = array();
            $response['error'] = 1;
            $response['msg'] = lang('Error.emailExist');
        }

        return json_encode($response);
    }

    public function modalTerm()
    {
        $formData = $this->request->getPost('post');

        if(empty($formData['lang']))
            $this->request->setLocale('es');
        else
            $this->request->setLocale($formData['lang']);

        $data = array();
        $data['locale'] = $this->request->getLocale();

        return view('authentication/signup/modalTerms', $data);
    }

    public function modalPrivacyPolicy()
    {
        $formData = $this->request->getPost('post');

        if(empty($formData['lang']))
            $this->request->setLocale('es');
        else
            $this->request->setLocale($formData['lang']);

        $data = array();
        $data['locale'] = $this->request->getLocale();

        return view('authentication/signup/modalPrivacyPolicy', $data);
    }

    public function activateAccount()
    {
        $data = array();
        $token = $this->request->getPostGet('token');
        $lang = $this->request->getPostGet('lang');

        if(empty($lang))
            $this->request->setLocale('es');
        else
            $this->request->setLocale($lang);

        if(!empty($token))
        {
            $resultGetClientByToken = $this->modelAuthentication->getClientByToken($token);

            if(!empty($resultGetClientByToken))
            {
                $update = array();
                $update['token'] = '';
                $update['emailVerified'] = 1;

                $resultClearClientToken = $this->modelAuthentication->updateClient($resultGetClientByToken[0]['id'], $update);

                if($resultClearClientToken['error'] == 0)
                {
                    $data['lang'] = $lang;
                    return view('authentication/signup/activatedAccount', $data);
                }
                else
                {
                    $data['error'] = lang('Error.title');
                    return view('errorPage/error', $data);
                }
            }
            else
            {
                $data['error'] = lang('Error.token');
                return view('errorPage/error', $data);
            }
        }
        else
        {
            $data['error'] = lang('Error.title');
            return view('errorPage/error', $data);
        }
    }

    public function recoverPassword()
    {
        $response = array();
        $formData = $this->request->getPost('post');

        if(empty($formData['lang']))
            $this->request->setLocale('es');
        else
            $this->request->setLocale($formData['lang']);
        
        $resultCheckClientEmailExist = $this->modelAuthentication->checkClientEmailExist($formData['email']);

        if(!empty($resultCheckClientEmailExist))
        {
            $update = array();
            $update['token'] = md5(uniqid().$formData['email']);

            $resultSetToken = $this->modelAuthentication->updateClient($resultCheckClientEmailExist[0]['id'], $update);

            if($resultSetToken['error'] == 0)
            {
                $dataEmail = array();
                $dataEmail['pageTitle'] = lang('Email.recoverPasswordPageTitle');
                $dataEmail['barnerTop'] = lang('Email.recoverPasswordPageTitle');
                $dataEmail['p1'] = lang('Email.recoverPasswordP1');
                $dataEmail['p2'] = lang('Email.recoverPasswordP2');
                $dataEmail['buttonText'] = lang('Email.recoverPasswordButtonText');
                $dataEmail['link'] = base_url('Authentication/formRecoverPassword').'?token='.$update['token'].'&lang='.$formData['lang'];

                $this->email->setFrom('info@grupoahvsolucionesinformaticas.es', lang('Email.recoverPasswordSubject'));
                $this->email->setTo($formData['email']);
                $this->email->setSubject(lang('Email.recoverPasswordSubject'));
                $this->email->setMessage(view('email/recoverPassword', $dataEmail));
                $this->email->send();

                $response = array();
                $response['error'] = 0;
                $response['msg'] = lang('Success.successRecoverPassword');
            }
            else
            {
                $response['error'] = 1;
                $response['msg'] = lang('Error.title');
            }
        }
        else
        {
            $response = array();
            $response['error'] = 1;
            $response['msg'] = lang('Error.emailNotExist');
        }

        return json_encode($response);
    }

    public function formRecoverPassword()
    {
        $data = array();
        $token = $this->request->getPostGet('token');
        $lang = $this->request->getPostGet('lang');

        if(empty($lang))
            $this->request->setLocale('es');
        else
            $this->request->setLocale($lang);

        if(!empty($token))
        {
            $resultGetClientByToken = $this->modelAuthentication->getClientByToken($token);

            if(!empty($resultGetClientByToken))
            {
                $update = array();
                $update['token'] = '';

                $resultClearClientToken = $this->modelAuthentication->updateClient($resultGetClientByToken[0]['id'], $update);

                if($resultClearClientToken['error'] == 0)
                {
                    $data = array();
                    $data['pageTitle'] = lang('RecoverPassword.formPageTitle');
                    $data['email'] = $resultGetClientByToken[0]['email'];
                    $data['clientID'] = $resultGetClientByToken[0]['id'];
                    $data['locale'] = $lang;

                    return view('authentication/recoverPassword/formRecoverPassword', $data);
                }
                else
                {
                    $data['error'] = lang('Error.title');
                    return view('errorPage/error', $data);
                }
            }
            else
            {
                $data['error'] = lang('Error.token');
                return view('errorPage/error', $data);
            }
        }
        else
        {
            $data['error'] = lang('Error.title');
            return view('errorPage/error', $data);
        }
    }

    public function newPassword()
    {
        $response = array();
        $formData = $this->request->getPost('post');

        if(empty($formData['lang']))
            $this->request->setLocale('es');
        else
            $this->request->setLocale($formData['lang']);

        $update = array();
        $update['password'] = password_hash($formData['password'], PASSWORD_DEFAULT);

        $resultUpdateClient = $this->modelAuthentication->updateClient($formData['clientID'], $update);

        if($resultUpdateClient['error'] == 0)
        {
            $response['error'] = 0;
            $response['msg'] = lang('Success.successNewPassword');
        }
        else
        {
            $response['error'] = 1;
            $response['msg'] = lang('Error.title');
        }

        return json_encode($response);
    }
}

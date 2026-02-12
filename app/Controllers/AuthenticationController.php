<?php

    declare(strict_types=1);

    namespace App\Controllers;

use Framework\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthenticationController extends Controller
{
    
    public function register():ResponseInterface
    {
       
        return $this->render("Auth/registration");
       
    }
    public function login():ResponseInterface{
        
        return $this->render("Auth/login");;
        
    }
    public function recover():ResponseInterface{
        
        return $this->render("Auth/passwordRecovery");;
        
    }
    public function emailverification():ResponseInterface{
        
        return $this->render("Auth/verifyemail");;
        
    }


}
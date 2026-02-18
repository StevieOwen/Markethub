<?php

    declare(strict_types=1);

    namespace App\Controllers;

use Exception;
use Framework\Controller;
use Framework\DB;
use Framework\CRUD;
use Services\EmailService;
use GuzzleHttp\Psr7\Header;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use PDO;

class AuthenticationController extends Controller
{
    public $errors=[];
    public $customer=[];
    
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
    public function registration_handling():ResponseInterface
    { 
        $pdo = \App\Framework\DB::getConnection();
        
        $field=["cust_firstname","cust_lastname","cust_email","cust_password"];
        $customer=$customer=["cust_id"=>"","cust_firstname"=>"","cust_lastname"=>"",
                     "cust_email"=>"","cust_password"=>""];
                     
        $errors=[];
        $crud=new \App\Framework\CRUD($field,$customer,$errors,$_POST);

        if(isset($_POST['register'])){
            $crud->formvalidation();
            $error=0;
            foreach($crud->geterrors() as $err){
                if(!empty($err)){
                    $error+=1;
                }
            }

            if($error==0){
                $stm="INSERT INTO customer(cust_id,cust_firstname, cust_lastname, cust_email, cust_password,cust_createdat) VALUES(:cust_id,:cust_firstname, :cust_lastname, :cust_email, :cust_password,Now())";
                $stmt=$pdo->prepare($stm);    
                try{
                    $stmt->execute($crud->getcustomer());

                    $emailService = new \App\Services\EmailService();
                    $emailService->sendWelcomeEmail($crud->getcustomerparam("cust_email"),$crud->getcustomerparam("cust_firstname"));
                       
                    return $this->render("Auth/verifyemail",["customer"=>$crud->getcustomer()]);
                    exit;
                }catch (\PDOException $e) {
                    $dber=   $e->getMessage();
                    return $this->render("Auth/registration",["errdb"=>$dber]);
                }  
            }else{
                return $this->render("Auth/registration",["errors"=>$crud->geterrors()]);
            }
        }

        return $this->render("Auth/registration");
       
    }

   
}
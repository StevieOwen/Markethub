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
use DateTime;

class AuthenticationController extends Controller
{
    public $errors=[];
    public $customer=[];

    public function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
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
    public function userindex():ResponseInterface{
        
        return $this->render("home/index1");;
        
    }

    //handle registration logic
    public function registration_handling():ResponseInterface
    { 
        $pdo = \App\Framework\DB::getConnection();
        session_start();
        $field=["cust_firstname","cust_lastname","cust_email","cust_password"];
        $customer=["cust_id"=>"","cust_firstname"=>"","cust_lastname"=>"",
                     "cust_email"=>"","cust_password"=>"", "cust_token"=>"","email_verified"=>""];
                     
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
                $stm="INSERT INTO customer(cust_id,cust_firstname, cust_lastname, cust_email, cust_password,cust_createdat,cust_token,token_createdat,token_expiresat,token_used,email_verified) 
                       VALUES(:cust_id,:cust_firstname, :cust_lastname, :cust_email, :cust_password,Now(),:cust_token,Now(),DATE_ADD(NOW(), INTERVAL 30 MINUTE), :token_used,:email_verified)";
                $stmt=$pdo->prepare($stm);    
                try{
                    $stmt->execute($crud->getcustomer());

                    $emailService = new \App\Services\EmailService();
                    $emailService->send($crud->getcustomerparam("cust_email"),'Welcome to Market Hub - Verify Your Account',
                     'welcome', ['name'=>$crud->getcustomerparam("cust_firstname"),'token'=>$crud->getcustomerparam("cust_token")]);
                    // return $this->render("Auth/verifyemail",["cust_reg"=>$crud->getcustomerparam("cust_id")]);
                    
                    $_SESSION['customer']=$crud->getcustomerparam("cust_id");
                    Header("Location:emailverify");
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
    //handle email verification logic 
    public function emailverificationhandling():ResponseInterface
    {
        $pdo = \App\Framework\DB::getConnection();
        $customer=["cust_id"=>"", "cust_email"=>"","cust_token"=>"","token"=>"","token_used"=>"","token_expiresat"=>"","email_verified"=>""];
        $token_error="";
        if(isset($_POST['confirm'])){

            $customer["cust_id"]=$_POST["cust_id"];
            $stmt = $pdo->prepare("SELECT cust_token, token_expiresat, token_used FROM customer WHERE cust_id = :id");
            try{
                $stmt->execute(['id' => $customer["cust_id"]]);
            }catch(\PDOException $e){
                $err=$e->getMessage();
                return $this->render("Auth/verifyemail",["err"=>$err]);
                exit;
            }
            

           $customer_db = $stmt->fetch(PDO::FETCH_ASSOC);
           if ($customer_db) {
                $customer["cust_token"]=$customer_db["cust_token"];
                $customer["token_used"]=$customer_db["token_used"];
                $customer["token_expiresat"]=$customer_db["token_expiresat"];
            } else {
             // Handle the case where the customer ID doesn't exist
                die("Error: Customer not found.");
            }    
           //generate date, to check if the token expired
           $now=new DateTime();
           $expiresat=new Datetime($customer["token_expiresat"]);
 
            if(empty($_POST['token'])){
                $token_error="The verification code is required";
            }else{
                $customer['token']=$this->test_input($_POST['token']);
            }

            if(empty($token_error)){
                if($customer["cust_token"]==$customer["token"] && $customer["token_used"]=="no" && $now<$expiresat){
                    //update token_used ccolumn to yes 
                    $stm="Update customer set token_used=:token_used, email_verified=:email_verified where cust_id=:cust_id";
                    $stmt=$pdo->prepare($stm);    
                    $customer["token_used"]="yes";
                    $customer["email_verified"]="yes";
                try{
                    $stmt->execute(["token_used"=>$customer["token_used"], "email_verified"=>$customer["email_verified"], "cust_id"=>$customer["cust_id"]]);
                    // move to login page
                    return $this->render("Auth/login");
                    exit;
                    }catch (\PDOException $e) {
                    $dber=   $e->getMessage();
                    return $this->render("Auth/verifyemail",["token_error"=>$dber]);
                    }
                    
                }
                elseif($customer["cust_token"]!=$customer["token"]){
                    $error="Verification code is not correct";
                    return $this->render("Auth/verifyemail",["token_error"=>$error]);
                }
                elseif($now>$expiresat || $customer["token_used"]=="yes"){
                     $error="The verification code expired!"."<br>"."Generate a new one by clicking the 'send code' button on the left side panel";
                     return $this->render("Auth/verifyemail",["token_error"=>$error]);   
                }    
            }
            else{
                return $this->render("Auth/verifyemail",["token_error"=>$token_error]);
            }
            return $this->render("Auth/verifyemail");

        }
    //resend token if expired
        if(isset($_POST['send_code'])){
        
            $pdo = \App\Framework\DB::getConnection();
            $customer=["cust_id"=>"","cust_token"=>"","token_used"=>"no","cust_email"=>"","cust_firstname"=>""];
            $customer["cust_id"]=$_POST["cust_id1"];
            //fetch email and first name from DB
            $stmt = $pdo->prepare("SELECT cust_email, cust_firstname FROM customer WHERE cust_id = :id");
            $stmt->execute(['id' => $customer["cust_id"]]);

            $customer_db = $stmt->fetch(PDO::FETCH_ASSOC);
            if($customer_db){
                $customer["cust_email"]=$customer_db["cust_email"];
                $customer["cust_firstname"]=$customer_db["cust_firstname"];
            }else {
             // Handle the case where the customer ID doesn't exist
                die("Error: Customer not found.");
            }       
            $customer["cust_token"]=random_int(100000,999999);
            //Update token and relative infos
            $stm="UPDATE customer set cust_token=:cust_token,token_createdat=Now(),
                  token_expiresat=DATE_ADD(NOW(),INTERVAL 30 MINUTE),token_used=:token_used where cust_id=:cust_id"; 
            $stmt=$pdo->prepare($stm);    
                try{
                    $stmt->execute(["cust_token"=>$customer['cust_token'],"token_used"=>$customer['token_used'],"cust_id"=>$customer["cust_id"]]);
                    //send email with new token
                    $emailService = new \App\Services\EmailService();
                    try{
                        $emailService->send($customer['cust_email'],'Welcome to Market Hub - Verify Your Account',
                     'welcome', ['name'=>$customer['cust_firstname'],'token'=>$customer['cust_token']]);
                     $success="We sent a new verification code to ".$customer['cust_email'];
                    return $this->render("Auth/verifyemail",["customer"=>$customer['cust_id'],"success"=>""]);
                    exit;
                     }catch(Exception $e){
                     return $this->render("Auth/verifyemail",["error"=>$e]);
                    }
        
                }catch (\PDOException $e) {
                    $dber=   $e->getMessage();
                    return $this->render("Auth/verifyemail",["errdb"=>$dber]);
                }      

            return $this->render("Auth/verifyemail") ;
        }

        return $this->render("Auth/verifyemail") ;
    }

    //handle login
    public function loginhandling():ResponseInterface
    {
        $pdo = \App\Framework\DB::getConnection();

        $customer=["cust_email"=>"","cust_passwordd"=>""];
        $customerdb=["cust_id"=>"", "cust_password"=>"", "email_verified"=>""];
        $errors=['cust_email','cust_pwd'];
        if(isset($_POST["login"])){
            
            if(empty($_POST['cust_email'])){
                $errors['cust_email']="Email is required";
            }else{
                $customer['cust_email']=$this->test_input($_POST['cust_email']);
            }
            
            if(empty($_POST['cust_password'])){
                $errors['cust_pwd']="Password is required";
            }else{
                $customer['cust_password']=$this->test_input($_POST['cust_password']);
            }
        
            $error=0;
            foreach($errors as $err){
                if(!empty($err)){
                    $error+=1;
                }
            }

            if($error==0){
                $stmt = $pdo->prepare("SELECT cust_id, cust_password,email_verified FROM customer WHERE cust_email = :email");
                $stmt->execute(['email' => $customer["cust_email"]]);

                $customer_db = $stmt->fetch(PDO::FETCH_ASSOC);
                if($customer_db){
                    $customerdb["cust_id"]=$customer_db["cust_id"];
                    $customerdb["cust_password"]=$customer_db["cust_password"];
                    $customerdb['email_verified']=$customer_db["email_verified"];
                }else {
                // Handle the case where the customer ID doesn't exist
                    return $this->render("Auth/login",["error"=>"User not found, please register first"]);
                    exit;
                }       

                //login logic
                if($customerdb['email_verified']=="yes" && password_verify($customer["cust_password"], $customerdb['cust_password'])){
                    session_start();
                    $_SESSION['cust_id']=$customerdb["cust_id"];
                    Header("Location:user_home");   
                }elseif(!password_verify($customer["cust_password"], $customerdb['cust_password'])){
                    return $this->render("Auth/login",["error"=>"Password is incorrect"]);
                    exit;
                }elseif($customerdb['email_verified']=="no"){
                    return $this->render("Auth/emailverify",["erremail"=>"Verify your email first"]);
                    exit;
                }
                
            }else{
                return $this->render("Auth/login",["errors"=>$errors]);
                exit;
            }
        }    

        if(isset($_POST[''])){
            
        }

        return $this->render("Auth/login");
    }
}


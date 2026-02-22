<?php

namespace app\Framework;
use PDO;
use Framework\DB;

class CRUD{
    private $field=["cust_firstname","cust_lastname","cust_email","cust_password"];
    private $customer=["cust_id"=>"","cust_firstname"=>"","cust_lastname"=>"",
                     "cust_email"=>"","cust_password"=>"","cust_token"=>"","token_used"=>""];

    private $errors=[];
    private $input=["cust_id"=>"","cust_firstname"=>"","cust_lastname"=>"","cust_email"=>"","cust_password"=>""];

    public function __construct($field, $customer,$errors,$input)
    {
       $this->field=$field;
       $this->customer=$customer;
       $this->errors=$errors;
       $this->input=$input;
    }
    public function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    public  function geterrors(){
        return $this->errors;
    }
    public function formvalidation(){
        $pdo = \App\Framework\DB::getConnection();
        // check data entered by the user
        for($i=0;$i<count($this->field);$i++){
                if(empty($this->input[$this->field[$i]])){
                    $this->errors[$this->field[$i]]=str_replace("cust_", "", $this->field[$i]) . " is required";;      
                }else{
                    $this->customer[$this->field[$i]]=$this->test_input($this->input[$this->field[$i]]);
                }  
        }
        // Check password strenght
        $pattern = '/^(?=.*[A-Z])(?=.*[*@&%!#$^()_+=<>?]).{8,}$/';
        if (!preg_match($pattern, $this->customer["cust_password"]) && empty($this->errors["cust_password"])) {
                    $this->errors['cust_password'] = "Password must be at least 8 characters long, 1 capital letter, and 1 special character (*, @, &, %, !).";
        }
        //check if the email exists
        $checkEmail = $pdo->prepare("SELECT COUNT(*) FROM customer WHERE cust_email = :email");
        $checkEmail->execute(['email' => $this->customer['cust_email']]);
        
        // 2. Fetch the count
        $emailExists = $checkEmail->fetchColumn();

        if ($emailExists > 0) {
            $this->errors["cust_email"]="This email address is already registered.";
            // 3. If exists, add to our errors array     
        }

        //Generate ID
        $this->customer["cust_id"]="cust_".random_int(100000,999999);
        //Generate token 
        $this->customer["cust_token"] =random_int(100000,999999) ;
        
        $this->customer["token_used"]="no";
        // hashing password
        if(empty($this->errors["cust_password"])){
            $this->customer['cust_password'] = password_hash($this->customer['cust_password'], PASSWORD_DEFAULT);
        }
        
    }
    public function getcustomer(){
        return $this->customer;
    }
    public function getcustomerparam($param){
        return $this->customer[$param];
    }
    public function setemailerror($emailerror){
        $this->errors["cust_email"]=$emailerror;
    }

    public function insert(){
        
    }
     public function retrieve(){
        
    }
    public function update(){

    }
    public function delete(){

    }
   

}
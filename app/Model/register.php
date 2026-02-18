<?php

    private $field=["cust_firstname","cust_lastname","cust_email","cust_password"];
    private $customer=["cust_id"=>"","cust_firstname"=>"","cust_lastname"=>"","cust_email"=>"","cust_password"=>""];
    private $errors=[];
    private $input="";
    public function formvalidation(){
        
        for($i=0;$i<count($this->field);$i++){
                if(empty($input)){
                    $errors[$this->field[$i]]=str_replace("cust_", "", $this->field[$i]) . " is required";;      
                }else{
                    $customer[$this->field[$i]]=$input;
                }  
        }

    }
    
    
     $field=["cust_firstname","cust_lastname","cust_email","cust_password"];
        $customer=["cust_id"=>"","cust_firstname"=>"","cust_lastname"=>"","cust_email"=>"","cust_password"=>""];
        $errors=[];
        $pattern = '/^(?=.*[A-Z])(?=.*[*@&%!#$^()_+=<>?]).{8,}$/';
        if(isset($_POST['register'])){
            
            for($i=0;$i<count($field);$i++){
                if(empty($_POST[$field[$i]])){
                    $errors[$field[$i]]=str_replace("cust_", "", $field[$i]) . " is required";;      
                }else{
                    $customer[$field[$i]]=$_POST[$field[$i]];
                }  
            }
            if (!preg_match($pattern, $customer["cust_password"]) && empty($errors["cust_password"])) {
                    $errors['cust_password'] = "Password must be at least 8 characters long, 1 capital letter, and 1 special character (*, @, &, %, !).";
            }
            //check if the email exists
            $checkEmail = $pdo->prepare("SELECT COUNT(*) FROM customer WHERE cust_email = :email");
            $checkEmail->execute(['email' => $customer['cust_email']]);
            
            // 2. Fetch the count
            $emailExists = $checkEmail->fetchColumn();

            if ($emailExists > 0) {
                // 3. If exists, add to our errors array
                $errors['cust_email'] = "This email address is already registered.";
            }
            $customer["cust_id"]="cust_".random_int(100000,999999);

            $error=0;
            foreach($errors as $err){
                if(!empty($err)){
                    $error+=1;
                }
            }
            if($error==0){
                $customer['cust_password'] = password_hash($customer['cust_password'], PASSWORD_DEFAULT);
                $stm="INSERT INTO customer(cust_id,cust_firstname, cust_lastname, cust_email, cust_password) VALUES(:cust_id,:cust_firstname, :cust_lastname, :cust_email, :cust_password)";
                $stmt=$pdo->prepare($stm);    
                try{
                    $stmt->execute($customer);
                    return $this->render("Auth/verifyemail",["customer"=>$customer]);
                    exit;
                }catch (\PDOException $e) {
                    $errors["database_error"] =   $e->getMessage();
                    return $this->render("Auth/registration",["errors"=>$errors["database_error"]]);
                }  
            }else{
                return $this->render("Auth/registration",["errors"=>$errors]);
            }
        }

        return $this->render("Auth/registration");
       
    

?>
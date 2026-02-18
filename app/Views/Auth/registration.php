
<?php $this->layout("/Auth/layout",["title"=>"Registration","stylename"=>"registration"]) ?>
<!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/registration.css"> -->
<?php $errors = $errors ?? []; 
function check_error ($errors,$key){
     if(array_key_exists($key, $errors)){ 
        echo $errors[$key];
     
     }else{$errors[$key]="";
     
     }
}

echo $errdb;
?>

<body>
    <div class="container text-center">
        <div class="row ">
            <div class="container col-sm-5 signin " >
                <div class="row">
                    <div class="col align-self-center" style="padding:1rem;">
                    <h3>Welcome!</h3>
                    <h4>Glad to see you again.</h4>
                    <p> Already have an account?</p> <br>
                    <a href="login">SIGN IN</a>
                    </div>
                </div>  
                <p style="font-size: 0.7rem">Don't want to create an account now?</p>
                <p><a style="color: var(--white-color);text-decoration:none;font-size: 0.7rem" href="/">Continue without registering</a></p>
                
            </div>
            
            <div class="col-sm-7 signup">
                <h3>Create an Account</h3><br>
                 <form action="registration_process" method="POST"> 
                    <!-- First name -->
                     <div class=" form-floating mb-3">
                        <input style="border: 1px solid #641314; border-radius:50px;" type="text" name="cust_firstname" value="" id="firstname" class="form-control" placeholder="First Name" aria-label="firstname" aria-describedby="firstname"  >
                        <label for="firstname">First Name</label>
                        <p class="error"><?php check_error($errors,"cust_firstname") ?></p>
                    </div>
                    <!-- Last name -->
                     <div class=" form-floating mb-3">
                        <input style="border: 1px solid #641314;border-radius:50px;"type="text" id="lastname" name="cust_lastname" value="" class="form-control" placeholder="Last Name" aria-label="lastname" aria-describedby="lastname">
                        <label for="lastname">Last Name</label>  
                        <p class="error"><?php check_error($errors,"cust_lastname")?></p>
                    </div>
                    <!-- Email -->
                     <div class=" form-floating  mb-3">
                        <input style="border: 1px solid #641314;border-radius:50px;" type="email" id="email" name="cust_email" value="" class="form-control" placeholder="Email" aria-label="email" aria-describedby="email">
                        <label for="email">Email</label> 
                        <p class="error"><?php check_error($errors,"cust_email")?></p> 
                    </div>
                    
                        <!-- Password -->
                     <div class=" form-floating mb-3">
                        <input style="border: 1px solid #641314;border-radius:50px;" type="password" id="pwd" name="cust_password" value="" class="form-control" placeholder="Password" aria-label="pwd" aria-describedby="pwd">
                        <label for="pwd">Password</label>  
                        <p class="error"><?php check_error($errors,"cust_password")?></p>
                    </div>
                    
                     <div class="col-12">
                        <button name="register"  class="btn btn-primary" type="submit">Create Account</button>
                    </div>
                </form> 
                
            </div>

            
        </div>
    </div>

</body>

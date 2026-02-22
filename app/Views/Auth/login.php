
<?php $this->layout("/Auth/layout",["title"=>"Registration","stylename"=>"registration"]) ?>
<!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/registration.css"> -->
<?php
// var_dump($customer);
$error=$error ?? "";
$errors['cust_email']=$errors['cust_email'] ?? "";
$errors['cust_password']=$errors['cust_pwd'] ?? "";
?>
<body>

    <div class="container text-center">
        <div class="row ">
            
            
            <div class="col-sm-7 signup">
                <h3>Login Here</h3><br>
                <form action="loginprocess" method="POST"> 
                    <p class="error"><?php echo $error ?></p>
                    <p class="error"><?php echo $errors['cust_email'] ?></p>
                    <!-- Email -->
                     <div class=" form-floating  mb-3">
                        <input style="border: 1px solid #641314;border-radius:50px;" type="email" id="email" name="cust_email" value="" class="form-control" placeholder="Email" aria-label="email" aria-describedby="email">
                        <label for="email">Email</label>  
                    </div>
                    
                     <p class="error"><?php echo $errors['cust_password'] ?></p>
                        <!-- Password -->
                     <div class=" form-floating mb-3">
                        <input style="border: 1px solid #641314;border-radius:50px;" type="password" id="pwd" name="cust_password" value="" class="form-control" placeholder="Password" aria-label="pwd" aria-describedby="pwd">
                        <label for="pwd">Password</label>  
                    </div>
                    
                     <div class="col-12">
                        <button  class="btn btn-primary" name="login" type="submit">SIGN IN</button>
                    </div> <br>
                    <p>Forgot your Password? <a href="recover">Recover it!</a></p>
                </form> 
                
            </div>

            <div class="container col-sm-5 signin " >
                <div class="row">
                    <div class="col align-self-center" style="padding:1rem;">
                    <h3>New Here!</h3>
                    <h4>Glad to see you.</h4>
                    <p> Join our community of shoppers and never miss a drop.</p> <br>
                    <a href="register">Create an Account</a>
                    </div>
                </div>  
                
            </div>
        </div>
    </div>

</body>


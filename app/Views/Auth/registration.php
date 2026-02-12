
<?php $this->layout("/Auth/layout",["title"=>"Registration","stylename"=>"registration"]) ?>
<!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/registration.css"> -->

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
                
            </div>
            
            <div class="col-sm-7 signup">
                <h3>Create an Account</h3><br>
                 <form action=""> 
                    <!-- First name -->
                     <div class=" form-floating mb-3">
                        <input style="border: 1px solid #641314; border-radius:50px;" type="text" name="firstname" value="" id="firstname" class="form-control" placeholder="First Name" aria-label="firstname" aria-describedby="firstname"  >
                        <label for="firstname">First Name</label> 
                    </div>
                    <!-- Last name -->
                     <div class=" form-floating mb-3">
                        <input style="border: 1px solid #641314;border-radius:50px;"type="text" id="lastname" name="lastname" value="" class="form-control" placeholder="Last Name" aria-label="lastname" aria-describedby="lastname">
                        <label for="lastname">Last Name</label>  
                    </div>
                    <!-- Email -->
                     <div class=" form-floating  mb-3">
                        <input style="border: 1px solid #641314;border-radius:50px;" type="email" id="email" name="email" value="" class="form-control" placeholder="Email" aria-label="email" aria-describedby="email">
                        <label for="email">Email</label>  
                    </div>
                    
                        <!-- Password -->
                     <div class=" form-floating mb-3">
                        <input style="border: 1px solid #641314;border-radius:50px;" type="pwd" id="pwd" name="pwd" value="" class="form-control" placeholder="Password" aria-label="pwd" aria-describedby="pwd">
                        <label for="pwd">Password</label>  
                    </div>
                    
                     <div class="col-12">
                        <button  class="btn btn-primary" type="submit">Create Account</button>
                    </div>
                </form> 
                
            </div>

            
        </div>
    </div>

</body>

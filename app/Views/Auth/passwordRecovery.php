
<?php $this->layout("/Auth/layout",["title"=>"Registration","stylename"=>"registration"]) ?>
<!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/registration.css"> -->

<body>

    <div class="container text-center">
        <div class="row ">
            
            
            <div class="container col-sm-7 signup">
                <div class="row">
                    <div class="col align-self-center">
                        <h3>Recover Your password</h3><br>
                        <form action=""> 
                            <!-- Email -->
                            <div class=" form-floating  mb-3">
                                <input style="border: 1px solid #641314;border-radius:50px;" type="email" id="email" name="email" value="" class="form-control" placeholder="Email" aria-label="email" aria-describedby="email">
                                <label for="email">Email</label>  
                            </div> <br>
                            
                            <div class="col-12">
                                <button  class="btn btn-primary" type="submit">Verify Email</button>
                            </div> <br>
                        </form> 
                    </div>
                </div>
            </div>

            <div class="container col-sm-5 signin " >
                <div class="row">
                    <div class="col align-self-center" style="padding:1rem;">
                    
                    <h4>Don't worry, we've got you covered.</h4>
                    <p> Enter your email and we'll send a secure link to reset your password so you can get back to shopping.</p> <br>
                    <p>Already remembered your password? No problem.</p>
                    <a href="login">Sign In</a>
                    </div>
                </div>  
                
            </div>
        </div>
    </div>

</body>


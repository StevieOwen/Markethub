
<?php $this->layout("/Auth/layout",["title"=>"Registration","stylename"=>"registration"]) ?>
<!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/registration.css"> -->

<body>

    <div class="container text-center">
        <div class="row ">
            <div class="container col-sm-5 signin " >
                <div class="row">
                    <div class="col align-self-center" style="padding:1rem;">
                    <h3>Just one last step</h3>
                    <p> Check your email box, and enter the 6 digits code provided on email</p> <br>
                    <p>Didn't receive the verification code?</p>
                    <a href="">Send Code </a>
                    </div>
                </div>  
                
            </div>
            
            <div class="col-sm-7 signup">
                <h3>Verify your email</h3><br>
                 <form action=""> 
                    <!-- First name -->
                     <div class=" form-floating mb-3">
                        <input style="border: 1px solid #641314; border-radius:50px;" type="text" name="token" value="" id="token" class="form-control" placeholder="Token" aria-label="firstname" aria-describedby="firstname"  >
                        <label for="token">Verification Code</label> 
                    </div>

                    <div class="col-12">
                        <button  class="btn btn-primary" type="submit">Confirm Code</button>
                    </div>
                </form> 
                
            </div>

            
        </div>
    </div>

</body>
 
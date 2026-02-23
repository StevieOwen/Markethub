
<?php $this->layout("/Auth/layout",["title"=>"Verify Email","stylename"=>"registration"]) ?>
<!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/registration.css"> -->
 <?php 
// $cust_id=$cust_id ?? "";
$token_error=$token_error ?? "";
session_start();

if(isset($_SESSION['cust_id'])){
    $cust_id=$_SESSION['cust_id'];
}
 ?>
<body>

    <div class="container text-center">
        <div class="row ">
            <div class="container col-sm-5 signin " >
                <div class="row">
                    <div class="col align-self-center" style="padding:1rem;">
                    <h3>Just one last step</h3>
                    <form action="verificationemail" method="POST">
                        <p> Check your email box, and enter the 6 digits code provided on email</p> <br>
                        <p>Didn't receive the verification code?</p>
                        <input type="hidden" value="<?php echo $cust_id?>" name="cust_id1">
                        <button type="submit" class="btn btn-primary" name="send_code" >Send Code</button>
                    </form>
                    </div>
                </div>  
                
            </div>
            
            <div class="col-sm-7 signup">
                <h3>Verify your email</h3><br>
                 <form action="verificationemail" method="POST"> 
                    <!-- First name -->
                     <p class="error"><?php echo $token_error ?></p>
                     <div class=" form-floating mb-3">
                        <input style="border: 1px solid #641314; border-radius:50px;" type="text" name="token" value="" id="token" class="form-control" placeholder="Token" aria-label="firstname" aria-describedby="firstname"  >
                        <label for="token">Verification Code</label> 
                        <input type="hidden" value="<?php echo $cust_id?>" name="cust_id">
                    </div>

                    <div class="col-12">
                        <button  class="btn btn-primary" name="confirm" type="submit">Confirm Code</button>
                    </div>
                </form> 
                
            </div>

            
        </div>
    </div>

</body>
 
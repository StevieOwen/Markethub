
<?php $this->layout("/Auth/layout",["title"=>"Reset password","stylename"=>"registration"]) ?>
<!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/registration.css"> -->
 <?php 
 $cust_id=$cust_id ?? "";
 $error=$error ?? "";

 ?>
<body>

    <div class="container text-center">
        <div class="row ">
            <div class="container col-sm-5 signin " >
                <div class="row">
                    <div class="col align-self-center" style="padding:1rem;">
                    <h3>Well done!</h3>
                        <p>You can now set a new password </p> <br>
                    </div>
                </div>  
                
            </div>

            <div class="col-sm-7 signup">
                <h3>Create a New Password</h3><br>
                 <form action="changepassword" method="POST"> 
                    <!-- New password -->
                     <p class="error"><?php echo $error; ?></p>
                     <div class=" form-floating mb-3">
                        <input style="border: 1px solid #641314; border-radius:50px;" type="password" name="password" value="" id="pwd" class="form-control" placeholder="password" aria-label="password" aria-describedby="password"  >
                        <label for="token">New Password</label> 
                        <input type="hidden" value="<?php echo $cust_id?>" name="cust_id">
                    </div>

                    <div class="col-12">
                        <button  class="btn btn-primary" name="reset" type="submit">Reset password</button>
                    </div>
                </form> 
                
            </div>

            
        </div>
    </div>

</body>
 
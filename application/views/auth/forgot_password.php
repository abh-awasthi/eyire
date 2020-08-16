<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <form class="card auth_form" action="<?php echo base_url(); ?>auth/forgot_password" method="POST">
                    <div class="header">
                        <img class="logo" src="<?php echo base_url(); ?>assets/aero/assets/images/logo.svg" alt="">
                        <h5>Forgot Password?</h5>
                        <span>Enter your e-mail address below to reset your password.</span>
                    </div>
					<div id="infoMessage"><?php echo $message;?></div>
                    <div class="body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="identity" placeholder="Enter Email">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">SUBMIT</button>                        
                        <div class="signin_with mt-3">
                            <a href="javascript:void(0);" class="link">Need Help?</a>
                        </div>
                    </div>
                </form>
                <div class="copyright text-center">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>,
                    
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <img src="<?php echo base_url(); ?>assets/aero/assets/images/logo2.svg" alt="Forgot Password"/>
                </div>
            </div>
        </div>
    </div>
</div>
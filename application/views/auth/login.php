<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <form class="card auth_form" action="<?php  echo base_url(); ?>auth/login" method="POST" >
                    <div class="header">
                        <img class="logo" src="<?php echo base_url(); ?>assets/images/logo.svg" alt="">
                        <h5>Log in</h5>
                    </div>
                    <div class="body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="identity" placeholder="Username/Email">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="password" placeholder="Password">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><a href="<?php echo base_url(); ?>auth/forgot_password" class="forgot" title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                            </div>                            
                        </div>
                        <div class="checkbox">
                            <input id="remember_me" name="remember" value="1" type="checkbox">
                            <label for="remember_me">Remember Me</label>
                        </div>
                        <button  type="submit" class="btn btn-primary btn-block waves-effect waves-light">SIGN IN</button>                        
                        
                    </div>
                </form>
                <div class="copyright text-center">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>,
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <img src="<?php echo base_url(); ?>assets/images/logo2.svg" alt="Sign In"/>
                </div>
            </div>
        </div>
    </div>
</div>

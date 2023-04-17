<div class="col-xxl-3 col-lg-4 col-md-5">
    <div class="auth-full-page-content d-flex p-sm-5 p-4">
        <div class="w-100">
            <div class="d-flex flex-column h-100">
                <div class="mb-4 mb-md-5 text-center">
                    <a href="#" class="d-block auth-logo">
                        <img src="<?= CUSTOMPATH ?>panelassets/images/logobbi.png" alt="" height="120">
                    </a>
                </div>
                <div class="auth-content my-auto">
                    <div class="text-center">
                        <h5 class="mb-0">Welcome Back !</h5>
                        <p class="text-muted mt-2">Sign in to continue to BBI.</p>
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                    <form class="mt-4 pt-2" action="" method="post" id="loginform" name="loginform">
                        <div class="mb-3 form-group">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?=isset($_COOKIE['dna-username']) ? $_COOKIE['dna-username'] : '';?>">
                        </div>
                        <div class="mb-3 form-group">
                            <div class="d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <label class="form-label">Password</label>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="">
                                        <a href="<?=ADMINPATH?>forgot-password" class="text-muted">Forgot password?</a>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" id="userpassword" name="userpassword" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" value="<?=isset($_COOKIE['dna-password']) ? $_COOKIE['dna-password'] : '';?>">
                                <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                            </div>

                        </div>
                        <div class="mb-3 form-group">
                            <div class="input-group">
                                <div class="g-recaptcha" data-sitekey="6LcdR7oZAAAAAARotdOhsAkkpayHvS3uGEgzNrUi" data-callback="correctCaptcha"></div>
                                <input type="hidden" name="validcaptcha" id="validcaptcha" value=""/>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember" <?=isset($_COOKIE['dna-username']) ? 'checked' : '';?>>
                                    <label class="form-check-label" for="remember-check">
                                        Remember me
                                    </label>
                                </div>  
                            </div>

                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </form>  

                </div>
                <div class="mt-4 mt-md-5 text-center">
                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> BBI. <?= getVersion(); ?> </p>
                </div>
            </div>
        </div>
    </div>
    <!-- end auth full page content -->
</div>
<div class="col-xl-4 col-lg-5 col-md-12 bg-color-6">
    <div class="form-section">
        <div class="logo">
            <a href="javascript:void()">
                <img src="<?= CUSTOMPATH ?>panelassets/images/logobbi.png" alt="" height="150">
            </a>
        </div>
        <h3>Sign Into Your Account</h3>
         <?= session()->getFlashdata('message'); ?>
        <div class="login-inner-form">
            <form name="loginform" id="loginform" action="" method="POST">
                <div class="form-group clearfix">
                    <label for="first_field" class="form-label">User Name</label>
                    <div class="form-box">
                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Email/Mobile/Code" aria-label="Email/Mobile/Code" value="<?=isset($_COOKIE['mbbi-username']) ? $_COOKIE['mbbi-username'] : '';?>">
                        <i class="flaticon-mail-2"></i>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label for="second_field" class="form-label">Password</label>
                    <div class="form-box">
                        <input name="userPassword" type="password" class="form-control" autocomplete="off" id="userPassword" placeholder="Password" aria-label="Password" value="<?=isset($_COOKIE['mbbi-password']) ? $_COOKIE['mbbi-password'] : '';?>">
                        <i class="flaticon-password"></i>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LcdR7oZAAAAAARotdOhsAkkpayHvS3uGEgzNrUi" data-callback="correctCaptcha"></div>
                        <input type="hidden" name="validcaptcha" id="validcaptcha" value=""/>
                    </div>
                </div>
                <div class="checkbox form-group clearfix">
                    <div class="form-check float-start">
                        <input class="form-check-input" type="checkbox" name="remember" <?=isset($_COOKIE['mbbi-username']) ? 'checked' : '';?>>
                        <label class="form-check-label" for="rememberme">
                            Remember me
                        </label>
                    </div>
                    <a href="forgot-password" class="link-light float-end forgot-password">Forgot your password?</a>
                </div>
                <div class="form-group clearfix mb-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-theme">Login</button>
                </div>
            </form>

        </div>
        <p class="text-center">Don't have an account?<a href="register-me"> Register here</a></p>
    </div>
</div>

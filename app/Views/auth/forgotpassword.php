<div class="col-xl-4 col-lg-5 col-md-12 bg-color-6">
    <div class="form-section">
        <div class="logo">
            <a href="javascript:void()">
                <img src="<?= CUSTOMPATH ?>panelassets/images/logobbi.png" alt="" height="150">
            </a>
        </div>
        <h3>Password Recovery</h3>
        <?= session()->getFlashdata('message'); ?>
        <div class="login-inner-form">
            <form name="forgotpasswordform" id="forgotpasswordform" action="" method="POST">
                <div class="form-group clearfix">
                    <label for="first_field" class="form-label">User Name</label>
                    <div class="form-box">
                        <input name="username" type="text" class="form-control" id="username" placeholder="Email/Mobile/Code" aria-label="Email/Mobile/Code">
                        <i class="flaticon-mail-2"></i>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LcdR7oZAAAAAARotdOhsAkkpayHvS3uGEgzNrUi" data-callback="correctCaptcha"></div>
                        <input type="hidden" name="validcaptcha" id="validcaptcha" value=""/>
                    </div>
                </div>
                <div class="form-group clearfix mb-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-theme">Recover My Password</button>
                </div>
            </form>

        </div>
        <p class="text-center">Remember your password?<a href="login"> Login</a></p>
    </div>
</div>

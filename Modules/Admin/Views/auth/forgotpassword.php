<div class="col-xxl-3 col-lg-4 col-md-5">
    <div class="auth-full-page-content d-flex p-sm-5 p-4">
        <div class="w-100">
            <div class="d-flex flex-column h-100">
                <div class="mb-4 mb-md-5 text-center">
                    <a href="#" class="d-block auth-logo">
                        <img src="/panelassets/images/logobbi.png" alt="" height="120">
                    </a>
                </div>
                <div class="auth-content my-auto">
                    <div class="text-center">
                        <h5 class="mb-0">Reset Password</h5>                        
                    </div>
                    <div class="alert alert-info text-center my-4" role="alert">
                        Enter your user name/Membership code and instructions will be sent to your registered email Id!
                    </div>
                    <?= session()->getFlashdata('message'); ?>
                    <form class="mt-4" action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" id="usercode" name="usercode" placeholder="Enter User name/Membershipid">
                        </div>
                        <div class="mb-3 form-group">
                            <div class="input-group">
                                <div class="g-recaptcha" data-sitekey="6LcdR7oZAAAAAARotdOhsAkkpayHvS3uGEgzNrUi" data-callback="correctCaptcha"></div>
                                <input type="hidden" name="validcaptcha" id="validcaptcha" value=""/>
                            </div>
                        </div>
                        <div class="mb-3 mt-4">
                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </form>

                    <div class="mt-5 text-center">
                        <p class="text-muted mb-0">Remember It ?  <a href="<?=ADMINPATH?>login"
                                                                     class="text-primary fw-semibold"> Sign In </a> </p>
                    </div>
                </div>
                <div class="mt-4 mt-md-5 text-center">
                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> BBI. <?= getVersion(); ?> </p>
                </div>
            </div>
        </div>
    </div>
    <!-- end auth full page content -->
</div>
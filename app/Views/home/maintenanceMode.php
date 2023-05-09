<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title><?= $title ?> | <?= COMPANYNAME ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= CUSTOMPATH ?>panelassets/images/favicon.ico">

        <!-- preloader css -->
        <link rel="stylesheet" href="<?= CUSTOMPATH ?>panelassets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="<?= CUSTOMPATH ?>panelassets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?= CUSTOMPATH ?>panelassets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?= CUSTOMPATH ?>panelassets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <!-- <body data-layout="horizontal"> -->

        <div class="bg-soft-light min-vh-100 py-5">
            <div class="py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <div class="mb-5">
                                    <a href="index.html">
                                        <img src="<?= CUSTOMPATH ?>panelassets/images/logo.png" alt="" height="60" class="me-1">
                                    </a>
                                </div>

                                <div class="maintenance-cog-icon text-primary pt-4">
                                    <i class="mdi mdi-cog spin-right display-3"></i>
                                    <i class="mdi mdi-cog spin-left display-4 cog-icon"></i>
                                </div>
                                <h3 class="mt-4">Site is Under Maintenance</h3>
                                <p>Please check back in sometime.</p>

                                <div class="mt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mt-4 maintenance-box">
                                                <div class="p-4">
                                                    <div class="avatar-md mx-auto">
                                                        <span class="avatar-title bg-soft-primary rounded-circle">
                                                            <i class="mdi mdi-access-point-network font-size-24 text-primary"></i>
                                                        </span>
                                                    </div>

                                                    <h5 class="font-size-15 text-uppercase mt-4">Why is the Site Down?</h5>
                                                    <p class="text-muted mb-0">To improve the sites performance and security, We are upgrading some services. </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4 maintenance-box">
                                                <div class="p-4">
                                                    <div class="avatar-md mx-auto">
                                                        <span class="avatar-title bg-soft-primary rounded-circle">
                                                            <i class="mdi mdi-clock-outline font-size-24 text-primary"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-15 text-uppercase mt-4">
                                                        What is the Downtime?</h5>
                                                    <p class="text-muted mb-0">The site will be active by <?= date('d-m-Y h:i:s', strtotime('+30 minutes', strtotime(date('Y-m-d h:i:s')))); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4 maintenance-box">
                                                <div class="p-4">
                                                    <div class="avatar-md mx-auto">
                                                        <span class="avatar-title bg-soft-primary rounded-circle">
                                                            <i class="mdi mdi-email-outline font-size-24 text-primary"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-15 text-uppercase mt-4">
                                                        Do you need Support?</h5>
                                                    <p class="text-muted mb-0">If you have any concern regarding the usage, please do drop an email to the support email <a
                                                            href="javascript:void();"
                                                            class="text-decoration-underline">support@windna.com</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
        </div>
        <!-- end  -->

        <!-- JAVASCRIPT -->
        <script src="<?= CUSTOMPATH ?>panelassets/libs/jquery/jquery.min.js"></script>
        <script src="<?= CUSTOMPATH ?>panelassets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= CUSTOMPATH ?>panelassets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?= CUSTOMPATH ?>panelassets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?= CUSTOMPATH ?>panelassets/libs/node-waves/waves.min.js"></script>
        <script src="<?= CUSTOMPATH ?>panelassets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="<?= CUSTOMPATH ?>panelassets/libs/pace-js/pace.min.js"></script>

    </body>
</html>

<?php if ($js == 'login') { ?>
    <script src="<?= CUSTOMPATH ?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap Core JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/popper.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap.min.js"></script>
    <!-- Custom JS -->

    <script src="<?= CUSTOMPATH ?>assets/js/script.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">
        $("form").each(function () {
            $(this).find(':input[type="submit"]').prop('disabled', true);
        });
        function correctCaptcha() {
            var response = grecaptcha.getResponse();
            $('#validcaptcha').val(response);
            $('#forgotpasswordform').formValidation("revalidateField", "validcaptcha");
            $('#loginform').formValidation("revalidateField", "validcaptcha");
            $('#registrationform').formValidation("revalidateField", "validcaptcha");


    //            $("form").each(function () {
    //                
    //                $(this).find(':input[type="submit"]').prop('disabled', false);
    //            });
        }
    </script>
<?php } ?>
<?php if ($js == 'default') { ?>
    <script src="<?= CUSTOMPATH ?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap Core JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/popper.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap.min.js"></script>
    <!-- Custom JS -->

    <script src="<?= CUSTOMPATH ?>assets/js/script.js"></script>
<?php } ?>
<?php if ($js == 'dd') { ?>
    <!-- jQuery -->
    <script src="<?= CUSTOMPATH ?>assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/popper.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap.min.js"></script>

    <!-- Sticky Sidebar JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

    <!-- Circle Progress JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/circle-progress.min.js"></script>

    <!-- Custom JS -->

    <script src="<?= CUSTOMPATH ?>assets/js/script.js"></script>
<?php } ?>
<?php if ($js == 'stickyleft') { ?>
    <!-- jQuery -->
    <script src="<?= CUSTOMPATH ?>assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/popper.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap.min.js"></script>

    <!-- Sticky Sidebar JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

    <!-- Custom JS -->

    <script src="<?= CUSTOMPATH ?>assets/js/script.js"></script>
<?php } ?>
<?php if ($js == 'withselect2') { ?>
    <!-- jQuery -->
    <script src="<?= CUSTOMPATH ?>assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/popper.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap.min.js"></script>

    <!-- Sticky Sidebar JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

    <!-- Select2 JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/select2/js/select2.min.js"></script>

    <!-- Custom JS -->

    <script src="<?= CUSTOMPATH ?>assets/js/script.js"></script>
<?php } ?>
<?php if ($js == 'docprofile') { ?>
    <!-- jQuery -->
    <script src="<?= CUSTOMPATH ?>assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/popper.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap.min.js"></script>

    <!-- Sticky Sidebar JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

    <!-- Select2 JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/select2/js/select2.min.js"></script>

    <!-- Dropzone JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/dropzone/dropzone.min.js"></script>

    <!-- Bootstrap Tagsinput JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>

    <!-- Profile Settings JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/profile-settings.js"></script>

    <!-- Custom JS -->

    <script src="<?= CUSTOMPATH ?>assets/js/script.js"></script>
<?php } ?>
<?php if ($js == 'slick') { ?>
    <!-- jQuery -->
    <script src="<?= CUSTOMPATH ?>assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/popper.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap.min.js"></script>

    <!-- Slick JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/slick.js"></script>

    <!-- Custom JS -->

    <script src="<?= CUSTOMPATH ?>assets/js/script.js"></script>
<?php } ?>
<?php if ($js == 'fancybox') { ?>
    <!-- jQuery -->
    <script src="<?= CUSTOMPATH ?>assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/popper.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap.min.js"></script>

    <!-- Sticky Sidebar JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

    <!-- Select2 JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/select2/js/select2.min.js"></script>

    <!-- Datetimepicker JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/moment.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Fancybox JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/fancybox/jquery.fancybox.min.js"></script>

    <!-- Custom JS -->

    <script src="<?= CUSTOMPATH ?>assets/js/script.js"></script>
<?php } ?>
<?php if ($css == 'patientprofile') { ?>

    <script src="<?= CUSTOMPATH ?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap Core JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/popper.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap.min.js"></script>
    <!-- Select2 JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/select2/js/select2.min.js"></script>
    <!-- Datetimepicker JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/moment.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Sticky Sidebar JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
    <!-- Custom JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/script.js"></script>
<?php } ?>

<?php if ($css == 'daterangepicker') { ?>

    <!-- jQuery -->
    <script src="<?= CUSTOMPATH ?>assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/popper.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap.min.js"></script>

    <!-- Daterangepikcer JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/moment.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Custom JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/script.js"></script>
<?php } ?>

<?php if ($js == 'stickyleftdoc') { ?>
    <!-- jQuery -->
    <script src="<?= CUSTOMPATH ?>assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?= CUSTOMPATH ?>assets/js/popper.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/js/bootstrap.min.js"></script>

    <!-- Sticky Sidebar JS -->
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

    <!-- Daterangepikcer JS -->
    <<script src="<?= CUSTOMPATH ?>assets/js/moment.min.js"></script>
    <script src="<?= CUSTOMPATH ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Custom JS -->

    <script src="<?= CUSTOMPATH ?>assets/js/script.js"></script>
<?php } ?>

</div>
</div>
</div>
<!-- Login 6 end -->

<!-- External JS libraries -->
<script src="<?= CUSTOMPATH ?>loginassets/js/jquery-3.6.0.min.js"></script>
<script src="<?= CUSTOMPATH ?>loginassets/js/bootstrap.bundle.min.js"></script>
<script src="<?= CUSTOMPATH ?>loginassets/js/jquery.validate.min.js"></script>
<script src="<?= CUSTOMPATH ?>panelassets/libs/formvalidation/formValidation.min.js"></script>
<script src="<?= CUSTOMPATH ?>panelassets/libs/formvalidation/framework/bootstrap.js"></script>
<script src="<?= CUSTOMPATH ?>panelassets/libs/sweetalert2/sweetalert2.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php
if ($includefile) {
    $files = explode(',', $includefile);
    for ($x = 0; $x < count($files); $x++) {
        require_once __DIR__ . '/../uservalidation/' . $files[$x];
    }
}
?>
<script type="text/javascript">
    $("form").each(function () {
        $(this).find(':button[type="submit"]').prop('disabled', true);
    });
    function correctCaptcha() {
        var response = grecaptcha.getResponse();
        $('#validcaptcha').val(response);
        // $('#forgotpasswordform').formValidation("revalidateField", "validcaptcha");
        $('#loginform').formValidation("revalidateField", "validcaptcha");


        $("form").each(function () {
            $(this).find(':button[type="submit"]').prop('disabled', false);
        });
    }
</script>
</body>
</html>

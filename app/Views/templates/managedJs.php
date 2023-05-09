<?php
$ajs = explode(',', $js);
if (in_array('dashboard', $ajs)) {
    ?>
    <!-- apexcharts -->
    <script src="<?= CUSTOMPATH ?>panelassets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- Plugins js-->
    <script src="<?= CUSTOMPATH ?>panelassets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<?php }if (in_array('datatable', $ajs)) { ?>    
    <!-- Required datatable js -->
    <script src="<?= CUSTOMPATH ?>panelassets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<?php }if (in_array('form', $ajs)) { ?>    
    <!--choices js-->
    <script src = "<?= CUSTOMPATH ?>panelassets/libs/choices.js/public/assets/scripts/choices.min.js"></script>    
    <script src="<?= CUSTOMPATH ?>panelassets/js/pages/form-advanced.init.js"></script>
<?php } if (in_array('sweetalert', $ajs)) { ?>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/sweetalert2/sweetalert2.min.js"></script>
<?php } if (in_array('alertify', $ajs)) { ?>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/alertifyjs/build/alertify.min.js"></script>
<?php }if (in_array('flatpickr', $ajs)) { ?>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/flatpickr/flatpickr.min.js"></script>
<?php } if (in_array('choices', $ajs)) { ?>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<?php } if (in_array('wizard', $ajs)) { ?>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/twitter-bootstrap-wizard/prettify.js"></script>
<?php } if (in_array('validation', $ajs)) { ?>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/formvalidation/formValidation.min.js"></script>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/formvalidation/framework/bootstrap.js"></script>
<?php } if (in_array('lightbox', $ajs)) { ?>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/glightbox/js/glightbox.min.js"></script>
<?php } if (in_array('tooltips', $ajs)) { ?>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/tooltips/stickytooltip.js"></script>
<?php } if (in_array('ckeditor', $ajs)) { ?>
    <script src="<?= CUSTOMPATH ?>panelassets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<?php } ?>

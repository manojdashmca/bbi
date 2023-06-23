<?php
$acss = explode(',', $css);
if (in_array('dashboard', $acss)) {
    ?>

<?php } ?>
<?php if (in_array('datatable', $acss)) { ?>    
    <!-- DataTables -->
    <link href="<?= CUSTOMPATH ?>panelassets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= CUSTOMPATH ?>panelassets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<?php } ?>
<?php if (in_array('form', $acss)) { ?>
    <!-- choices css -->
    <link href="<?= CUSTOMPATH ?>panelassets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
<?php } if (in_array('sweetalert', $acss)) { ?>
    <link href="<?= CUSTOMPATH ?>panelassets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?php } if (in_array('alertify', $acss)) { ?>
    <link href="<?= CUSTOMPATH ?>panelassets/libs/alertifyjs/build/css/alertify.min.css" rel="stylesheet" type="text/css" />
<?php } if (in_array('flatpickr', $acss)) { ?>
    <link rel="stylesheet" href="<?= CUSTOMPATH ?>panelassets/libs/flatpickr/flatpickr.min.css">
<?php } if (in_array('choices', $acss)) { ?>
    <link href="<?= CUSTOMPATH ?>panelassets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
<?php } if (in_array('wizard', $acss)) { ?>
    <link rel="stylesheet" href="<?= CUSTOMPATH ?>panelassets/libs/twitter-bootstrap-wizard/prettify.css">
<?php
}
if (in_array('validation', $acss)) {
    ?>
    <link rel="stylesheet" href="<?= CUSTOMPATH ?>panelassets/libs/formvalidation/formValidation.min.css">
<?php } if (in_array('lightbox', $acss)) { ?>
    <link rel="stylesheet" href="<?= CUSTOMPATH ?>panelassets/libs/glightbox/css/glightbox.min.css">
<?php } if (in_array('tooltips', $acss)) { ?>   
    <link rel="stylesheet" href="<?= CUSTOMPATH ?>panelassets/libs/tooltips/stickytooltip.css">
<?php }if (in_array('dropzone', $acss)) { ?>
    <!-- dropzone css -->
    <link href="<?= CUSTOMPATH ?>panelassets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
<?php } ?>



<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © WinDNA.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    <?= getVersion(); ?>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- end main content-->
</div>
<!-- END layout-wrapper -->


<!-- JAVASCRIPT -->
<!--mandatory Javascript-->
<script src="<?= CUSTOMPATH ?>panelassets/libs/jquery/jquery.min.js"></script>
<script src="<?= CUSTOMPATH ?>panelassets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= CUSTOMPATH ?>panelassets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= CUSTOMPATH ?>panelassets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= CUSTOMPATH ?>panelassets/libs/node-waves/waves.min.js"></script>
<script src="<?= CUSTOMPATH ?>panelassets/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="<?= CUSTOMPATH ?>panelassets/libs/pace-js/pace.min.js"></script>
<!--mandatory Javascript-->
<?php
require_once __DIR__ . '/managedJs.php';
?>
<script src="<?= CUSTOMPATH ?>panelassets/js/app.js"></script>
<?php
if ($includefile) {
    $files = explode(',', $includefile);
    for ($x = 0; $x < count($files); $x++) {
        require_once __DIR__ . '/../formvalidation/' . $files[$x];
    }
}
?>
</body>



</html>
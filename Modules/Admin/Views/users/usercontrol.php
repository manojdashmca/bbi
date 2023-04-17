<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Control Management</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                            <li class="breadcrumb-item active">User Control</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User Controls</h4>
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                    <!-- end card header -->

                    <div class="card-body">
                        <form name="useradd" id="useradd" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <?php for ($a = 0; $a < count($controldata); $a++) { ?>
                                    <div class="col-md-3"> 
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" name="module[]" value="<?= $controldata[$a]->module_id; ?>" class="flat-red" <?php
                                                if (in_array($controldata[$a]->module_id, $usermodule)) {
                                                    echo "checked";
                                                }
                                                ?>> <?= $controldata[$a]->module_name ?>
                                            </label> 
                                        </div>
                                        <?php
                                        if (isset($controldata[$a]->module_control) && !empty($controldata[$a]->module_control)) {
                                            for ($y = 0; $y < count($controldata[$a]->module_control); $y++) {
                                                $subcontrol = $controldata[$a]->module_control;
                                                ?>
                                                <div class="col-md-11" style="float: right !important;">
                                                    <label>
                                                        <input type="checkbox" name="module_control[]" value="<?= $subcontrol[$y]->id_mc; ?>" class="flat-red" <?php
                                                        if (in_array($subcontrol[$y]->id_mc, $usermodulecontrol)) {
                                                            echo "checked";
                                                        }
                                                        ?>> <?= $subcontrol[$y]->mc_display_name ?>
                                                    </label> 
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                <?php } ?> 
                            </div>

                            <div class="text-center mt-4">
                                <input type="hidden" name="encuser" id="encuser" value="<?= $encuserid ?>"/>                                
                                <input type="submit" class="btn btn-success waves-effect waves-light" value="Submit"/>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->   

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->



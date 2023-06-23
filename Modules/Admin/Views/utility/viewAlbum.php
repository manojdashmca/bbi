<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Upload Image to Album</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Utility</a></li>
                            <li class="breadcrumb-item active">Upload Image</li>
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
                        <h4 class="card-title">Images Of the album <strong>"<?= $albumname ?>"</strong></h4>
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                    <!-- end card header -->

                    <div class="card-body">
                        <div class="row">
                            <?php for ($x = 0; $x < count($albumimages); $x++) { ?>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="mt-4">
                                        <a href="/uploads/images/gallery/<?= $albumimages[$x]->photo_path ?>" class="image-popup">
                                            <img src="/uploads/images/gallery/<?= $albumimages[$x]->photo_path ?>" class="img-fluid" alt="<?= $albumname ?> Image">
                                        </a>
                                        <div style="text-align: center;">
                                            <?php if ($albumimages[$x]->photo_status == 1) { ?>
                                                <a class="blue" title="Block Album" href="#" onclick="return updateStatus('<?= base64_encode($albumimages[$x]->ahp_id) ?>', 2);"><i class="fas fa-lock"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php } if ($albumimages[$x]->photo_status == 2) { ?>
                                                <a class="blue"  title="Unblock Album" href="#" onclick="return updateStatus('<?= base64_encode($albumimages[$x]->ahp_id) ?>', 1);"><i class="fas fa-lock-open"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php } ?>
                                            <a class="blue"  title="Delete User" href="#" onclick="return updateStatus('<?= base64_encode($albumimages[$x]->ahp_id) ?>', 3);"><i class="fas fa-trash"></i></a>

                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
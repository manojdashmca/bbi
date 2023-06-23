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
                        <h4 class="card-title">Upload Image to the album <strong>"<?=$albumname?>"</strong></h4>
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                    <!-- end card header -->

                    <div class="card-body">
                        <form class="dropzone" name="galleryadd" action="<?=ADMINPATH?>upload-picture" id="galleryadd" method="post" enctype="multipart/form-data">
                            <div class="fallback">
                                <input name="picture" id="picture" type="file" multiple="multiple">
                            </div>
                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                </div>

                                <h5>Drop files here or click to upload.</h5>
                            </div>
                            <!-- end row -->
                            <div class="text-center mt-4">                                
                                <input type="hidden" name="albumid" id="albumid" value="<?= $albumid ?>"/> 
<!--                                <input type="reset" class="btn btn-primary waves-effect waves-light" value="Cancel"/>
                                <input type="submit" class="btn btn-success waves-effect waves-light" value="Cretae Member"/>-->
                            </div>
                        </form>
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
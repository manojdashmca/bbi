<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">One-To-One Slip</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">One-To-One Slip</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"></h4>

                        <div class="flex-shrink-0">
                            <ul class="nav justify-content-end nav-pills card-header-pills" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#givenreferral" role="tab">
                                        <span class="d-none d-sm-block">Initiate By Me</span> 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#receivedreferral" role="tab">
                                        <span class="d-none d-sm-block">Meet With Me</span> 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#give" role="tab">                                        
                                        <span class="d-none d-sm-block"><i class=" fas fa-plus-circle"></i> Add a One To One </span> 
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- end card header -->
                    <!-- end card header -->

                    <div class="card-body">
                        <?= session()->getFlashdata('message'); ?>
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="givenreferral" role="tabpanel">

                                <div class="table-responsive">
                                    <table id="given" class="table table-bordered dt-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Date</th>
                                                <th>Meet With</th> 
                                                <th>Initiate By</th>                                                
                                                <th>Location</th>                                                
                                                <th>Topic</th>                                                
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <?php for ($x = 0; $x < count($given); $x++) { ?>
                                            <tr>
                                                <td><?= ($x + 1) ?></td>
                                                <td><?= $given[$x]->date ?></td>
                                                <td><?= $given[$x]->meetwith ?></td>
                                                <td><?= $given[$x]->initiateby ?></td>
                                                <td><?= $given[$x]->location ?></td>
                                                <td><?= $given[$x]->topic ?></td>                                                
                                                <td><?= $given[$x]->status ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane" id="receivedreferral" role="tabpanel">

                                <div class="table-responsive">
                                    <table id="received" class="table table-bordered dt-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Date</th>
                                                <th>Meet With</th> 
                                                <th>Initiate By</th>                                                
                                                <th>Location</th>                                                
                                                <th>Topic</th>                                                
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <?php for ($x = 0; $x < count($receive); $x++) { ?>
                                            <tr>
                                                <td><?= ($x + 1) ?></td>
                                                <td><?= $receive[$x]->date ?></td>
                                                <td><?= $receive[$x]->meetwith ?></td>
                                                <td><?= $receive[$x]->initiateby ?></td>
                                                <td><?= $receive[$x]->location ?></td>
                                                <td><?= $receive[$x]->topic ?></td>                                                
                                                <td><?= $receive[$x]->status ?></td>
                                            </tr>
                                        <?php } ?>

                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane" id="give" role="tabpanel">

                                <h5 class="font-size-14 mb-3">Create One To One</h5>
                                <form name="onetooneadd" id="onetooneadd" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">                                    
                                                <div class="form-group  mb-3">
                                                    <label class="form-label">Meet With</label>
                                                    <select name="meetwith" id="meetwith" class="form-control form-select">
                                                        <option  value="">Select A member</option>
                                                        <?php for ($a = 0; $a < count($member); $a++) { ?>
                                                            <option value="<?= $member[$a]->id_user ?>"><?= ucwords(strtolower($member[$a]->user_name)) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group  mb-3">
                                                    <label class="form-label">Location</label>
                                                    <input type="text" class="form-control" id="location" name="location">
                                                </div>
                                            </div>
                                        </div>                                        


                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group  mb-3">
                                                    <label class="form-label">Topic Discussed</label>
                                                    <input type="text" class="form-control" id="topic" name="topic">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group  mb-3">
                                                    <label class="form-label">Meet Date</label>
                                                    <input type="text" class="form-control" id="date" name="date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            <input type="reset" class="btn btn-primary waves-effect waves-light" value="Reset"/>
                                            <input type="submit" class="btn btn-success waves-effect waves-light" value="Submit"/>
                                        </div>

                                    </div>
                                </form>


                            </div>
                        </div>

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
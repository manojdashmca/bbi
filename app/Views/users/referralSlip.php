<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Referral Slip</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Referral Slip</li>
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
                                        <span class="d-none d-sm-block">Given Referral Slip</span> 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#receivedreferral" role="tab">
                                        <span class="d-none d-sm-block">Received Referral Slip</span> 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#give" role="tab">                                        
                                        <span class="d-none d-sm-block"><i class=" fas fa-plus-circle"></i> Give A Referral </span> 
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
                                                <th>To</th> 
                                                <th>Referral</th>                                                
                                                <th>Inside/Outside</th>                                                
                                                <th>Referral Status</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Comment</th>                                                
                                                <th>Tracking Sheet Status</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <?php for ($x = 0; $x < count($given); $x++) { ?>
                                            <tr>
                                                <td><?= ($x + 1) ?></td>
                                                <td><?= $given[$x]->date ?></td>
                                                <td><?= $given[$x]->user_name ?></td>
                                                <td><?= $given[$x]->referral_name ?></td>
                                                <td><?= $given[$x]->referraltype ?></td>
                                                <td><?= $given[$x]->ref_status_one ?></td>
                                                <td><?= $given[$x]->ref_telephone ?></td>
                                                <td><?= $given[$x]->ref_email ?></td>
                                                <td><?= $given[$x]->ref_comment ?></td>
                                                <td><?= $given[$x]->trackstatus ?></td>
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
                                                <th>From</th> 
                                                <th>Referral</th>                                                
                                                <th>Inside/Outside</th>                                                
                                                <th>Referral Status</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Comment</th>                                                
                                                <th>Tracking Sheet Status</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <?php for ($x = 0; $x < count($receive); $x++) { ?>
                                            <tr>
                                                <td><?= ($x + 1) ?></td>
                                                <td><?= $receive[$x]->date ?></td>
                                                <td><?= $receive[$x]->user_name ?></td>
                                                <td><?= $receive[$x]->referral_name ?></td>
                                                <td><?= $receive[$x]->referraltype ?></td>
                                                <td><?= $receive[$x]->ref_status_one ?></td>
                                                <td><?= $receive[$x]->ref_telephone ?></td>
                                                <td><?= $receive[$x]->ref_email ?></td>
                                                <td><?= $receive[$x]->ref_comment ?></td>
                                                <td><?= $receive[$x]->trackstatus ?></td>
                                                <td><?= $receive[$x]->status ?></td>
                                            </tr>
                                        <?php } ?>

                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane" id="give" role="tabpanel">

                                <h5 class="font-size-14 mb-3">Give a thank you</h5>
                                <form name="referraladd" id="referraladd" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">                                    
                                                <div class="form-group  mb-3">
                                                    <label class="form-label">Referral To</label>
                                                    <select name="referralto" id="referralto" class="form-control form-select">
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
                                                    <label class="form-label">Referral Name</label>
                                                    <input type="text" class="form-control" id="referralname" name="referralname">
                                                </div>
                                            </div>
                                        </div>                                        
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Referral Type</label>
                                                    <select class="form-control form-select" name="reftype" id="reftype">
                                                        <option value="">Select Referral Type</option>
                                                        <option value="1">Inside</option>
                                                        <option value="2">Outside</option>                                                                                                  
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Referral Status</label>
                                                    <select class="form-control form-select" name="refstatus" id="refstatus">
                                                        <option value="">Select Referral Status</option>
                                                        <option value="Card Given">Given your card</option>
                                                        <option value="Told them you would call">Told them you would call</option>   
                                                        <option value="Card Given,Told them you would call">Given your card and Told them you would call</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group  mb-3">
                                                    <label class="form-label">Address</label>
                                                    <input type="text" class="form-control" id="address" name="address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group  mb-3">
                                                    <label class="form-label">Telephone</label>
                                                    <input type="text" class="form-control" id="telephone" name="telephone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group  mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="email" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">                                    
                                                <div class="form-group  mb-3">
                                                    <label class="form-label">Comments</label>
                                                    <input type="text" class="form-control" id="comment" name="comment">
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
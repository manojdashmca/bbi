<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Thank You Slip</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Thank You Slip</li>
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
                                    <a class="nav-link active" data-bs-toggle="tab" href="#giventhankyou" role="tab">
                                        <span class="d-none d-sm-block">Given Thank You Slip</span> 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#receivedthankyou" role="tab">
                                        <span class="d-none d-sm-block">Received Thank You Slip</span> 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#give" role="tab">                                        
                                        <span class="d-none d-sm-block"><i class=" fas fa-plus-circle"></i> Give A Thank You </span> 
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- end card header -->
                    <!-- end card header -->

                    <div class="card-body">
                        <?= session()->getFlashdata('message'); ?>
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="giventhankyou" role="tabpanel">

                                <div class="table-responsive">
                                    <table id="given" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Date</th>
                                                <th>Thank You To</th> 
                                                <th>Amount</th>
                                                <th>New/Repeat</th>
                                                <th>Inside/Outside</th>
                                                <th>Comment</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <?php for ($x = 0; $x < count($given); $x++) { ?>
                                            <tr>
                                                <td><?= ($x + 1) ?></td>
                                                <td><?= $given[$x]->date ?></td>
                                                <td><?= $given[$x]->user_name ?></td>
                                                <td><?= $given[$x]->tys_amount ?></td>
                                                <td><?= $given[$x]->businesstype ?></td>
                                                <td><?= $given[$x]->referraltype ?></td>
                                                <td><?= $given[$x]->tys_comment ?></td>
                                                <td><?= $given[$x]->status ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane" id="receivedthankyou" role="tabpanel">

                                <div class="table-responsive">
                                    <table id="received" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Sl No</th>
                                                <th>Date</th>
                                                <th>Thank You From</th> 
                                                <th>Amount</th>
                                                <th>New/Repeat</th>
                                                <th>Inside/Outside</th>
                                                <th>Comment</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        <?php for ($x = 0; $x < count($receive); $x++) { ?>
                                            <tr>
                                                <td><?= ($x + 1) ?></td>
                                                <td><?= $receive[$x]->date ?></td>
                                                <td><?= $receive[$x]->user_name ?></td>
                                                <td><?= $receive[$x]->tys_amount ?></td>
                                                <td><?= $receive[$x]->businesstype ?></td>
                                                <td><?= $receive[$x]->referraltype ?></td>
                                                <td><?= $receive[$x]->tys_comment ?></td>
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
                                <form name="thankyouadd" id="thankyouadd" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">                                    
                                                <div class="form-group  mb-3">
                                                    <label class="form-label">Thank You To</label>
                                                    <select name="thankyouto" id="thankyouto" class="form-control form-select">
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
                                                    <label class="form-label">For a referral in the amount of</label>
                                                    <input type="number" class="form-control" id="amount" name="amount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Business Type</label>
                                                    <select class="form-control form-select" name="bustype" id="bustype">
                                                        <option value="">Select Business Type</option>
                                                        <option value="1">New</option>
                                                        <option value="2">Repeat</option>                                                                                                  
                                                    </select>
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
<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Profile Settings</h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                <?php
                require_once __DIR__ . '/profile-sidebar.php';
                ?>

            </div>
            <div class="col-md-7 col-lg-8 col-xl-9">
                <?= session()->getFlashdata('message'); ?>
                <form name="doctorprofile" id="doctorprofile" method="post" enctype='multipart/form-data'>
                    <!-- Basic Information -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Basic Information</h4>
                            <div class="row form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="change-avatar">
                                            <div class="profile-img">
                                                <img src="<?= session()->get('img') ?>" alt="User Image">
                                            </div>
                                            <div class="upload-img">
                                                <div class="change-photo-btn">
                                                    <span><i class="fa fa-upload"></i> Upload Photo</span>
                                                    <input type="file" name="userfile" id="userfile" class="upload">
                                                </div>
                                                <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Usercode </label>
                                        <input name="usercode" id="usercode" value="<?= $doctordata->user_code ?>" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input name="email" id="email" value="<?= $doctordata->user_email ?>" type="email" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input name="name" id="name" value="<?= $doctordata->user_name ?>" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input name="mobile" id="mobile" value="<?= $doctordata->user_mobile ?>" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender <span class="text-danger">*</span></label>
                                        <select name="gender" id="gender"  class="form-control select">
                                            <option>Select</option>
                                            <option value="Male" <?= ($doctordata->user_gender == 'Male') ? 'selected="selected"' : '' ?>>Male</option>
                                            <option value="Female" <?= ($doctordata->user_gender == 'Female') ? 'selected="selected"' : '' ?>>Female</option>
                                            <option value="Other" <?= ($doctordata->user_gender == 'Other') ? 'selected="selected"' : '' ?>>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <label>Date of Birth</label>
                                        <input name="dob" id="dob" placeholder="DD/MM/YYYY" value="<?= !empty($doctordata->user_dob) ? makeDate($doctordata->user_dob, 'd/m/Y') : '' ?>" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Blood Group</label>
                                        <select class="form-control select" name="bloodgroup" id="bloodgroup">
                                            <option value="">Select</option>
                                            <option value="A-" <?= ($doctordata->user_bloog_group == 'A-') ? 'selected="selected"' : '' ?>>A-</option>
                                            <option value="A+" <?= ($doctordata->user_bloog_group == 'A+') ? 'selected="selected"' : '' ?>>A+</option>
                                            <option value="B-" <?= ($doctordata->user_bloog_group == 'B-') ? 'selected="selected"' : '' ?>>B-</option>
                                            <option value="B+" <?= ($doctordata->user_bloog_group == 'B+') ? 'selected="selected"' : '' ?>>B+</option>
                                            <option value="AB-" <?= ($doctordata->user_bloog_group == 'AB-') ? 'selected="selected"' : '' ?>>AB-</option>
                                            <option value="AB+" <?= ($doctordata->user_bloog_group == 'AB+') ? 'selected="selected"' : '' ?>>AB+</option>
                                            <option value="O-" <?= ($doctordata->user_bloog_group == 'O-') ? 'selected="selected"' : '' ?>>O-</option>
                                            <option value="O+" <?= ($doctordata->user_bloog_group == 'O+') ? 'selected="selected"' : '' ?>>O+</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Registration No <span class="text-danger">*</span></label>
                                        <input name="regdno" id="regdno" value="<?= $doctordata->regd_no ?>" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Basic Information -->

                    <!-- About Me -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">About Me</h4>
                            <div class="form-group mb-0">
                                <label>Biography</label>
                                <textarea class="form-control" rows="5" name="aboutme" id="aboutme"><?= $doctordata->about_doctor ?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /About Me -->               

                    <!-- Contact Details -->
                    <div class="card contact-card">
                        <div class="card-body">
                            <h4 class="card-title">Contact Details</h4>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input name="useraddress" id="useraddress" value="<?= $doctordata->user_address ?>" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">City</label>
                                        <input name="city" id="city" value="<?= $doctordata->user_district ?>" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">State / Province</label>
                                        <input name="state" id="state" value="<?= $doctordata->user_state ?>" type="text" class="form-control">
                                    </div>
                                </div>                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Postal Code</label>
                                        <input name="zip" id="zip" value="<?= $doctordata->user_pincode ?>" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Contact Details -->


                    <!-- Services and Specialization -->
                    <div class="card services-card">
                        <div class="card-body">
                            <h4 class="card-title">Services and Specialization</h4>
                            <div class="form-group">

                                <label>Department <span class="text-danger">*</span></label>
                                <select name="department" id="department"  class="form-control select">
                                    <option>Select</option>
                                    <?php foreach($specialities as $spl){?>
                                    <option value="<?=$spl->sp_id?>" <?= ($spl->sp_id == $doctordata->doctor_specialities) ? 'selected="selected"' : '' ?>><?=$spl->sp_name?></option>
                                    <?php }?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label>Services</label>
                                <input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Enter Services" name="services" value="<?= $doctordata->doctor_has_services ?>" id="services">
                                <small class="form-text text-muted">Note : Type & Press enter to add new services</small>
                            </div> 
                            <div class="form-group mb-0">
                                <label>Specialization </label>
                                <input class="input-tags form-control" type="text" data-role="tagsinput" placeholder="Enter Specialization" name="specialist" value="<?= $doctordata->doctor_has_specialization ?>" id="specialist">
                                <small class="form-text text-muted">Note : Type & Press  enter to add new specialization</small>
                            </div> 
                        </div>              
                    </div>
                    <!-- /Services and Specialization -->

                    <!-- Education -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Education</h4>
                            <div class="education-info">
                                <?php
                                $ded = 0;
                                foreach ($docteducation as $education) {
                                   
                                    ?>
                                    <div class="row form-row education-cont">                                
                                        <div class="col-12 col-md-10 col-lg-11">
                                            <div class="row form-row">
                                                <div class="col-12 col-md-6 col-lg-3">
                                                    <div class="form-group">
                                                        <label>Degree</label>
                                                        <input type="hidden" name="edu_id[]" value="<?= $education->dhe_id ?>"/>
                                                        <input name="degree[]" type="text" value="<?= $education->education ?>" class="form-control">
                                                    </div> 
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>College/Institute</label>
                                                        <input name="college[]" type="text" value="<?= $education->college_university ?>" class="form-control">
                                                    </div> 
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-2">
                                                    <div class="form-group">
                                                        <label>Year of Joining</label>
                                                        <input name="join[]" type="text" value="<?= $education->edu_start_year ?>" class="form-control">
                                                    </div> 
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-2">
                                                    <div class="form-group">
                                                        <label>Year of Completion</label>
                                                        <input name="exit[]" type="text" value="<?= $education->edu_end_year ?>" class="form-control">
                                                    </div> 
                                                </div>                                            
                                            </div>
                                        </div>
                                        <?php if ($ded > 0) { ?>
                                            <div class="col-12 col-md-2 col-lg-1">
                                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                                <a href="#" class="btn btn-danger trash">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $ded++;
                                }
                                ?>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-education"><i class="fa fa-plus-circle"></i> Add More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Education -->

                    <!-- Experience -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Experience</h4>
                            <div class="experience-info">
                                <?php
                                $de = 0;
                                foreach ($doctexperience as $experience) {
                                    ?>
                                    <div class="row form-row experience-cont">
                                        <div class="col-12 col-md-10 col-lg-11">

                                            <div class="row form-row">
                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Hospital Name</label>
                                                        <input type="hidden" name="exp_id[]" value="<?= $experience->dhex_id ?>"/>
                                                        <input name="hospital[]" value="<?= $experience->institution_name ?>" type="text" class="form-control">
                                                    </div> 
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-2">
                                                    <div class="form-group">
                                                        <label>From Month Year</label>
                                                        <input name="fromyr[]" value="<?= $experience->join_month_year ?>" type="text" class="form-control" placeholder="MM-YYYY">
                                                    </div> 
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-2">
                                                    <div class="form-group">
                                                        <label>To Month Year</label>
                                                        <input name="toyr[]" value="<?= $experience->exit_month_year ?>" type="text" class="form-control" placeholder="MM-YYYY">
                                                    </div> 
                                                </div>
                                                <div class="col-12 col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label>Designation</label>
                                                        <input name="designation[]" value="<?= $experience->designation ?>" type="text" class="form-control">
                                                    </div> 
                                                </div>
                                            </div>

                                        </div>
                                        <?php if ($de > 0) { ?>
                                            <div class="col-12 col-md-2 col-lg-1">
                                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                                <a href="#" class="btn btn-danger trash">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $de++;
                                }
                                ?>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-experience"><i class="fa fa-plus-circle"></i> Add More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Experience -->

                    <!-- Awards -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Awards</h4>
                            <div class="awards-info">
                                <?php
                                $aw = 0;
                                foreach ($doctaward as $awards) {
                                    ?>
                                    <div class="row form-row awards-cont">
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label>Award Name</label>
                                                <input type="hidden" name="award_id[]" value="<?= $awards->dha_id ?>"/>
                                                <input name="awardname[]" value="<?= $awards->award_name ?>" type="text" class="form-control">
                                            </div> 
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <div class="form-group">
                                                <label>Month Year</label>
                                                <input name="awardmonthyear[]" value="<?= $awards->award_month_year ?>" type="text" class="form-control" placeholder="MM-YYYY">
                                            </div> 
                                        </div>
                                        <div class="col-12 col-md-5">
                                            <div class="form-group">
                                                <label>Award Detail</label>
                                                <input name="awarddetail[]" value="<?= $awards->award_detail ?>" type="text" class="form-control">
                                            </div> 
                                        </div>
                                        <?php if ($aw > 0) { ?>
                                            <div class="col-12 col-md-1">
                                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>
                                                <a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php
                                    $aw++;
                                }
                                ?>
                            </div>
                            <div class="add-more">
                                <a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i> Add More</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Awards -->

                    <div class="submit-section submit-btn-bottom">
                        <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>		
<!-- /Page Content -->
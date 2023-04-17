<style>
    .treeuser{
        height:40px;
        width: 40px;
        font-size:50px;
    }
    .treename{
        height: 30px;
    }
    @media only screen and (max-width: 768px) {
        /* For mobile phones: */
        .treeuser{
            height:8px;
            width: 8px;
            font-size:20px;
        }
        .xs-lastrow{
            padding-left:8px !important;
            padding-right: 8px !important;
        }
        .mrg-left-66{
            margin-left: 66px !important;
        }
        .treename{
            height: 20px;
            font-size: 8px !important;
        }
    }
</style>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Binary Tree View</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Genealogy</a></li>
                            <li class="breadcrumb-item active">Binary View</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="validationCustom01">IBO Id/User Name</label>
                                        <input type="hidden" name="jsession" value="<?= createEpin(33) ?>"/>
                                        <input type="hidden" name="trnid" value="<?= $transactionid ?>"/>
                                        <input type="text" name="usercode" id="usercode" class="form-control" placeholder="Search..." value="<?= $ibo ?>">

                                    </div>
                                </div>

                                <div class="col-md-2 col-lg-2 col-sm-6 col-xs-12">
                                    <div class="mt-4">                                        
                                        <button class="btn btn-primary" type="submit"><i class="bx bx-search-alt align-middle"></i></button>
                                    </div>                                        
                                </div>
                            </div> 
                        </form>
                    </div>

                    <!-- end card header -->

                    <div class="card-body">
                        <div> 
                            <div class="row">
                                <div class="col-lg-12 col-md-12 text-center">
                                    <div class="mb-3">
                                        <span class="treeuser" id="node1">
                                            <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                        </span>
                                        <div data-tooltip="tip1" id="node1name" class="treename"></div>
                                        <div class="col-xs-7 col-lg-12 text-center mrg-left-66"><img src="<?= CUSTOMPATH ?>panelassets/images/treeline.GIF" style="max-width:100%;"/></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                        <div class="mb-3">
                                            <span class="treeuser"  id="node2">
                                                <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                            </span>
                                            <div data-tooltip="tip2" id="node2name" class="treename"></div>
                                            <div class="col-xs-12"><img src="<?= CUSTOMPATH ?>panelassets/images/treeline.GIF" style="max-width:100%;"/></div>

                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                        <div class="mb-3">
                                            <span class="treeuser"  id="node3">
                                                <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                            </span>
                                            <div data-tooltip="tip3" id="node3name" class="treename"></div>
                                            <div class="col-xs-12"><img src="<?= CUSTOMPATH ?>panelassets/images/treeline.GIF" style="max-width:100%;"/></div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 text-center">
                                        <div class="mb-3">
                                            <span class="treeuser"  id="node4">
                                                <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                            </span>
                                            <div data-tooltip="tip4" id="node4name" class="treename"></div>
                                            <div class="col-xs-12"><img src="<?= CUSTOMPATH ?>panelassets/images/treeline1.GIF" style="max-width:100%;"/></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 text-center">
                                        <div class="mb-3">
                                            <span class="treeuser"  id="node5">
                                                <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                            </span>
                                            <div data-tooltip="tip5" id="node5name" class="treename"></div>
                                            <div class="col-xs-12"><img src="<?= CUSTOMPATH ?>panelassets/images/treeline1.GIF" style="max-width:100%;"/></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 text-center">
                                        <div class="mb-3">
                                            <span class="treeuser"  id="node6">
                                                <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                            </span>
                                            <div data-tooltip="tip6" id="node6name" class="treename"></div>
                                            <div class="col-xs-12"><img src="<?= CUSTOMPATH ?>panelassets/images/treeline1.GIF" style="max-width:100%;"/></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 text-center">
                                        <div class="mb-3">
                                            <span class="treeuser"  id="node7">
                                                <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                            </span>
                                            <div data-tooltip="tip7" id="node7name" class="treename"></div>
                                            <div class="col-xs-12"><img src="<?= CUSTOMPATH ?>panelassets/images/treeline1.GIF" style="max-width:100%;"/></div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center xs-lastrow">
                                        <span class="treeuser"  id="node8">
                                            <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                        </span>
                                        <div data-tooltip="tip8" id="node8name" class="treename"></div>                                  
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 xs-lastrow"></div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center xs-lastrow">
                                        <span class="treeuser"  id="node9">
                                            <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                        </span>
                                        <div data-tooltip="tip9" id="node9name" class="treename"></div>                                      
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center xs-lastrow">
                                        <span class="treeuser"  id="node10">
                                            <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                        </span>
                                        <div data-tooltip="tip10" id="node10name" class="treename"></div>                                      
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 xs-lastrow"></div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center xs-lastrow">
                                        <span class="treeuser"  id="node11">
                                            <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                        </span>
                                        <div data-tooltip="tip11" id="node11name" class="treename"></div>                                     
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center xs-lastrow">
                                        <span class="treeuser"  id="node12">
                                            <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                        </span>
                                        <div data-tooltip="tip12" id="node12name" class="treename"></div>                                     
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 xs-lastrow"></div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center xs-lastrow">
                                        <span class="treeuser"  id="node13">
                                            <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                        </span>
                                        <div data-tooltip="tip13" id="node13name" class="treename"></div>                                     
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center xs-lastrow">
                                        <span class="treeuser"  id="node14">
                                            <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                        </span>
                                        <div data-tooltip="tip14" id="node14name" class="treename"></div>                                     
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 xs-lastrow"></div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center xs-lastrow">
                                        <span class="treeuser"  id="node15">
                                            <span class="text-gray"><i class="fas fa-user-circle"></i></span>
                                        </span>
                                        <div data-tooltip="tip15"  id="node15name" class="treename"></div>                                     
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- Single select input Example -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        <!-- end page title -->       

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->
<div id="mystickytooltip" class="stickytooltip">
    <div style="padding:5px">
        <?php for ($x = 1; $x < 16; $x++) { ?>
            <div id="tip<?= $x ?>" class="atip" style="width:400px"></div>            
        <?php } ?>
    </div>
    <div class="stickystatus"></div>
</div>
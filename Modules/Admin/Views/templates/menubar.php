<?php
$sessionmodules = session()->get('accessmodules');
$sessioncontroll = session()->get('accesscontrols');
?>
<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" data-key="t-menu">Menu</li>

        <li>
            <a href="<?= ADMINPATH ?>dashboard">
                <i data-feather="home"></i>
                <span data-key="t-dashboard">Dashboard</span>
            </a>
        </li>
        <?php if (in_array(1, $sessionmodules)) { ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow" aria-expanded="true">
                    <i data-feather="users"></i>
                    <span data-key="t-admins">Admin Users</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?= ADMINPATH ?>users-list" data-key="t-allibo">All Admin Users</a></li>
                    <?php if (in_array(1, $sessioncontroll)) { ?>
                        <li><a href="<?= ADMINPATH ?>user-add" data-key="t-addibo">Add Admin User</a></li>      
                    <?php } ?>
                </ul>
            </li>            
        <?php } ?>
        <?php if (in_array(2, $sessionmodules)) { ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow" aria-expanded="true">
                    <i class="dripicons-user-group"></i>
                    <span data-key="t-member">Members</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?= ADMINPATH ?>ibo-list" data-key="t-allibo">All Members</a></li>
                    <?php if (in_array(5, $sessioncontroll)) { ?>
                    <li><a href="<?= ADMINPATH ?>ibo-add" data-key="t-addibo">Add Member</a></li>    
                    <?php } ?>
                </ul>
            </li>       
        <?php } ?>
        <?php if (in_array(3, $sessionmodules)) { ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="dripicons-network-3"></i>
                    <span data-key="t-treeview">Genealogy</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">                
                    <li><a href="<?= ADMINPATH ?>sponsor-view" data-key="t-sponsorview">Sponsor View</a></li>                                              
                </ul>
            </li> 
        <?php } ?>
        <?php if (in_array(4, $sessionmodules)) { ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="dripicons-shopping-bag"></i>
                    <span data-key="t-payments">Payments</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?= ADMINPATH ?>payment-list" data-key="t-paymentlist">List Payments</a></li>                        
    <!--                        <li><a href="<?= ADMINPATH ?>monthly-tax" data-key="t-monthlytax">Monthly Tax Report</a></li>-->
                </ul>
            </li>
        <?php } ?>
        <?php if (in_array(5, $sessionmodules)) { ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="bx bx-location-plus"></i>
                    <span data-key="t-modules">Module Management</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?= ADMINPATH ?>module-list" data-key="t-modulelist">Module List</a></li>   
                    <?php if (in_array(9, $sessioncontroll)) { ?>
                    <li><a href="<?= ADMINPATH ?>module-add" data-key="t-moduleadd">Add New Module</a></li>  
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php if (in_array(6, $sessionmodules)) { ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="fas fa-road"></i>
                    <span data-key="t-segments">Segment Management</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">                                
                    <li><a href="<?= ADMINPATH ?>segment-list" data-key="t-segmentlist">Segment List</a></li>
                    <?php if (in_array(15, $sessioncontroll)) { ?>
                    <li><a href="<?= ADMINPATH ?>segment-add" data-key="t-segmentadd">Add Segment</a></li>
                    <?php } ?>
                    <li><a href="<?= ADMINPATH ?>category-list" data-key="t-categorylist">Category List</a></li>
                    <?php if (in_array(18, $sessioncontroll)) { ?>
                    <li><a href="<?= ADMINPATH ?>category-add" data-key="t-categoryadd">Add Category</a></li>
                    <?php } ?>
                    <li><a href="<?= ADMINPATH ?>subcategory-list" data-key="t-subcategory">Sub-Category List</a></li>
                    <?php if (in_array(21, $sessioncontroll)) { ?>
                    <li><a href="<?= ADMINPATH ?>subcategory-add" data-key="t-subcategory">Add Sub-Category</a></li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php if (in_array(7, $sessionmodules)) { ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow" aria-expanded="true">
                    <i class="fas fa-layer-group"></i>
                    <span data-key="t-ibo">Teams</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?= ADMINPATH ?>sr_consulting_board" data-key="t-allibo">Sr C & A Board</a></li>
                    <?php if (in_array(24, $sessioncontroll)) { ?>
                    <li><a href="<?= ADMINPATH ?>sr_consulting_board" data-key="t-allibo">Add Sr C&A Board Member</a></li>
                    <?php } ?>
                    <li><a href="<?= ADMINPATH ?>consulting_board" data-key="t-addibo">C & A Board</a></li> 
                    <?php if (in_array(26, $sessioncontroll)) { ?>
                    <li><a href="<?= ADMINPATH ?>consulting_board" data-key="t-addibo">Add C&A Board Member</a></li> 
                    <?php } ?>
                    <li><a href="<?= ADMINPATH ?>state_team" data-key="t-addibo">State Team</a></li> 
                    <?php if (in_array(28, $sessioncontroll)) { ?>
                    <li><a href="<?= ADMINPATH ?>state_team" data-key="t-addibo">Add State Team Member</a></li> 
                    <?php } ?>
                    <li><a href="<?= ADMINPATH ?>national_team" data-key="t-addibo">National Team</a></li> 
                    <?php if (in_array(30, $sessioncontroll)) { ?>
                    <li><a href="<?= ADMINPATH ?>national_team" data-key="t-addibo">Add National Team Member</a></li> 
                    <?php } ?>
                    <li><a href="<?= ADMINPATH ?>zone_team" data-key="t-addibo">Zone Team</a></li> 
                    <?php if (in_array(32, $sessioncontroll)) { ?>
                    <li><a href="<?= ADMINPATH ?>zone_team" data-key="t-addibo">Add state Team Member</a></li> 
                    <?php } ?>
                </ul>
            </li> 
        <?php } ?>

        <!--        <li>
                    <a href="<?= ADMINPATH ?>coupon-list">
                        <i class="bx bx-money"></i>
                        <span data-key="t-coupons">Coupons</span>
                    </a>
                </li>        -->
        <!--        <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-wallet-alt"></i>
                        <span data-key="t-ewallet">E-wallet</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= ADMINPATH ?>e-wallet-balance" data-key="t-ewalletbalance">E-Wallet Balance</a></li>
                        <li><a href="<?= ADMINPATH ?>e-wallet-request" data-key="t-ewalletrequest">E-wallet Request</a></li>
                        <li><a href="<?= ADMINPATH ?>e-wallet-transaction" data-key="t-ewallettransaction">E-Wallet Transaction</a></li>                
                    </ul>
                </li>-->

        <?php if (in_array(8, $sessionmodules)) { ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="bx bx-rupee"></i>
                    <span data-key="t-payout">Payout</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?= ADMINPATH ?>payout-dates" data-key="t-dailypayout">Payout Dates</a></li>
                    <li><a href="<?= ADMINPATH ?>payout-member" data-key="t-weeklypayout">Member Payout</a></li>                        
                </ul>
            </li>
        <?php } ?>

        <li class="menu-title mt-2" data-key="t-components">Mislanious</li>

        <!--        <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="dripicons-article"></i>
                        <span data-key="t-reports">Reports</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= ADMINPATH ?>business-report" data-key="t-businessreport">Business Report</a></li>
                        <li><a href="<?= ADMINPATH ?>company-performance" data-key="t-companyperformance">Company Performance</a></li>                
                    </ul>
                </li>-->

        <?php if (in_array(9, $sessionmodules)) { ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="dripicons-document"></i>
                    <span data-key="t-utility">Utility</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?= ADMINPATH ?>webcontact" data-key="t-grivancereport">Web Contact</a></li>
                    <li><a href="<?= ADMINPATH ?>startamodule" data-key="t-newslist">Start A Module</a></li>
                </ul>
            </li>
        <?php } ?>

        <!--        <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-certification"></i>                
                        <span data-key="t-verification">Verification</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?= ADMINPATH ?>kyc-verification" data-key="t-kycverification">KYC Verification</a></li>
                        <li><a href="<?= ADMINPATH ?>kyc-user" data-key="t-kycuser">KYC User</a></li>
                        <li><a href="<?= ADMINPATH ?>proficpic-verification" data-key="t-profilepicverification">Profilepic Verification</a></li>
                        <li><a href="<?= ADMINPATH ?>kyc-franchise" data-key="t-kycfranchise">KYC Franchise</a></li>
                    </ul>
                </li> -->

        <?php if (in_array(10, $sessionmodules)) { ?>
            <li>
                <a href="<?= ADMINPATH ?>configuration">
                    <i class="dripicons-gear"></i>
                    <span data-key="t-configuration">Configuration</span>
                </a>
            </li>
        <?php } ?>
        <li>
            <a href="<?= ADMINPATH ?>change-password">
                <i class=" fas fa-key"></i>
                <span data-key="t-logout">Change Password</span>
            </a>
        </li>    
        <li>
            <a href="<?= ADMINPATH ?>logout">
                <i class="mdi mdi-logout"></i>
                <span data-key="t-logout">Logout</span>
            </a>
        </li>



    </ul>    
</div>
<!-- Sidebar -->
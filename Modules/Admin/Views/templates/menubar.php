<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" data-key="t-menu">Menu</li>

<!--        <li>
            <a href="<?=ADMINPATH?>dashboard">
                <i data-feather="home"></i>
                <span data-key="t-dashboard">Dashboard</span>
            </a>
        </li>-->
        <li>
            <a href="<?=ADMINPATH?>users-list">
                <i data-feather="users"></i>
                <span data-key="t-horizontal">Admin Users</span>
            </a>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow" aria-expanded="true">
                <i class="dripicons-user-group"></i>
                <span data-key="t-ibo">Members</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="<?=ADMINPATH?>ibo-list" data-key="t-allibo">All Members</a></li>
                <li><a href="<?=ADMINPATH?>ibo-add" data-key="t-addibo">Add Member</a></li>                             
            </ul>
        </li>       

<!--        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="dripicons-network-3"></i>
                <span data-key="t-treeview">Genealogy</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">                
                <li><a href="<?=ADMINPATH?>sponsor-view" data-key="t-sponsorview">Sponsor View</a></li>
                <li><a href="<?=ADMINPATH?>downline-view" data-key="t-downlineview">Down-line view</a></li>                               
            </ul>
        </li>        -->
<!--        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="dripicons-shopping-bag"></i>
                <span data-key="t-orderandbilling">Order & Billing</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="<?=ADMINPATH?>order-list" data-key="t-listorder">List Orders</a></li>
                <li><a href="<?=ADMINPATH?>order-add" data-key="t-addibo">Add New Order</a></li>
                <li><a href="<?=ADMINPATH?>order-manage-shipping" data-key="t-addibo">Manage Shipping</a></li>
                <li><a href="<?=ADMINPATH?>monthly-tax" data-key="t-monthlytax">Monthly Tax Report</a></li>
            </ul>
        </li>-->
        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="bx bx-location-plus"></i>
                <span data-key="t-products">Module Management</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="<?=ADMINPATH?>module-list" data-key="t-businessreport">Module List</a></li>                  
                <li><a href="<?=ADMINPATH?>segment-list" data-key="t-companyperformance">Segment List</a></li>
<!--                <li><a href="<?=ADMINPATH?>category-list" data-key="t-companyperformance">Category List</a></li>
                <li><a href="<?=ADMINPATH?>subcategory-list" data-key="t-companyperformance">Sub-Category List</a></li>-->
            </ul>
        </li>
<!--        <li>
            <a href="<?=ADMINPATH?>coupon-list">
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
                <li><a href="<?=ADMINPATH?>e-wallet-balance" data-key="t-ewalletbalance">E-Wallet Balance</a></li>
                <li><a href="<?=ADMINPATH?>e-wallet-request" data-key="t-ewalletrequest">E-wallet Request</a></li>
                <li><a href="<?=ADMINPATH?>e-wallet-transaction" data-key="t-ewallettransaction">E-Wallet Transaction</a></li>                
            </ul>
        </li>-->
<!--        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="bx bx-rupee"></i>
                <span data-key="t-payout">Payout</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="<?=ADMINPATH?>daily-payout" data-key="t-dailypayout">Daily Payout</a></li>
                <li><a href="<?=ADMINPATH?>weekly-payout" data-key="t-weeklypayout">Weekly Payout</a></li>
                <li><a href="<?=ADMINPATH?>rank-report" data-key="t-rankreport">Rank Report</a></li>
                <li><a href="<?=ADMINPATH?>reward-report" data-key="t-rewordreport">Reward Report</a></li>
                <li><a href="<?=ADMINPATH?>franchise-income" data-key="t-franchiseincome">Franchise Income</a></li>
                <li><a href="<?=ADMINPATH?>monthly-franchise-payout" data-key="t-monthlyfranchiseincome">Monthly Franchise Payout</a></li>
            </ul>
        </li>-->
        <li class="menu-title mt-2" data-key="t-components">Mislanious</li>

<!--        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="dripicons-article"></i>
                <span data-key="t-reports">Reports</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="<?=ADMINPATH?>business-report" data-key="t-businessreport">Business Report</a></li>
                <li><a href="<?=ADMINPATH?>company-performance" data-key="t-companyperformance">Company Performance</a></li>                
            </ul>
        </li>-->

<!--        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="dripicons-document"></i>
                <span data-key="t-utility">Utility</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="<?=ADMINPATH?>grievances-list" data-key="t-grivancereport">Grievances Report</a></li>
                <li><a href="<?=ADMINPATH?>news-list" data-key="t-newslist">News List</a></li>
            </ul>
        </li>-->

<!--        <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="bx bx-certification"></i>                
                <span data-key="t-verification">Verification</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="<?=ADMINPATH?>kyc-verification" data-key="t-kycverification">KYC Verification</a></li>
                <li><a href="<?=ADMINPATH?>kyc-user" data-key="t-kycuser">KYC User</a></li>
                <li><a href="<?=ADMINPATH?>proficpic-verification" data-key="t-profilepicverification">Profilepic Verification</a></li>
                <li><a href="<?=ADMINPATH?>kyc-franchise" data-key="t-kycfranchise">KYC Franchise</a></li>
            </ul>
        </li> -->
        <li>
            <a href="<?=ADMINPATH?>configuration">
                <i class="dripicons-gear"></i>
                <span data-key="t-configuration">Configuration</span>
            </a>
        </li>

    </ul>    
</div>
<!-- Sidebar -->
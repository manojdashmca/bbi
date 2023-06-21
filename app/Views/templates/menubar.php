<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" data-key="t-menu">Menu</li>

        <li>
            <a href="<?= CUSTOMPATH ?>user-dashboard">
                <i data-feather="home"></i>
                <span data-key="t-dashboard">Dashboard</span>
            </a>
        </li>        
        <li>
            <a href="<?= CUSTOMPATH ?>my-sponsor">
                <i class="dripicons-network-3"></i>
                <span data-key="t-treeview">My Sponsor</span>
            </a>
        </li>
        <li>
            <a href="<?= CUSTOMPATH ?>my-payout">
                <i class="bx bx-rupee"></i>
                <span data-key="t-payout">My Payout</span>
            </a>
        </li>
        <li>
            <a href="<?= CUSTOMPATH ?>members-in-my-module">
                <i class=" fas fa-users"></i>
                <span data-key="t-member">Members In My Module</span>
            </a>
        </li>
        <li>
            <a href="javascript:">
                <i class=" fas fa-chart-line"></i>
                <span data-key="t-performance">My Performance</span>
            </a>
        </li>
        <li>
            <a href="<?= CUSTOMPATH ?>payments">
                <i class="fas fa-money-bill-alt"></i>
                <span data-key="t-payments">Payment</span>
            </a>
        </li>
        <li>
                <a href="javascript: void(0);" class="has-arrow" aria-expanded="true">
                    <i class="bx bx-receipt"></i>
                    <span data-key="t-receipt">Slips</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="<?= CUSTOMPATH ?>thank-you-slip" data-key="t-allibo">Thank You Slip</a></li>
                    <li><a href="<?= CUSTOMPATH ?>referral-slip" data-key="t-addibo">Referral Slip</a></li> 
<!--                    <li><a href="<?= CUSTOMPATH ?>one-to-one-slip" data-key="t-addibo">One To One Slip</a></li> -->
                    
                </ul>
            </li> 
        <li>
            <a href="<?= CUSTOMPATH ?>meeting-schedule">
                <i class="far fa-calendar-alt"></i>
                <span data-key="t-meeting">Meeting Schedule</span>
            </a>
        </li>
        <li>
            <a href="javascript:">
                <i class="fas fa-certificate"></i>
                <span data-key="t-events">Events</span>
            </a>
        </li>
        <li>
            <a href="<?= CUSTOMPATH ?>change-password">
                <i class="bx bx-key"></i>
                <span data-key="t-password">Change Password</span>
            </a>
        </li>

    </ul>    
</div>
<!-- Sidebar -->
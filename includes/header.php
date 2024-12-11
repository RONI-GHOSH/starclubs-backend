        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <b><a href="index.php">Home</a></b>
                    </button>


                </div>

                <div class="d-flex">


                    <div class="dropdown d-none d-lg-inline-block ml-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>


                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <<img class="rounded-circle header-profile-user" src="images/adminicon.png">
                                <span class="d-none d-xl-inline-block ml-1" key="t-henry">Admin</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item d-block" href="main-settings.php"><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> <span key="t-settings">Settings</span></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="includes/logout.php"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                        </div>
                    </div>



                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li>
                            <a href="dashboard.php" class="waves-effect mm-active">
                                <i class="bx bx-home-circle"></i>
                                <span>Dashboards</span>
                            </a>
                        </li>



<!-- <li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-file"></i>
        <span>Color Management</span>
    </a>
    <ul class="sub-menu mm-collapse" aria-expanded="false">
        <li><a href="color-game-name.php">Game Name</a></li>
        <li><a href="show-color-bet-history.php">Bet History</a></li>
        <li><a href="color-user-bid-history.php">Bid History</a></li>
        <li><a href="color-decleare-result.php">Declare Color Result</a></li>
        <li><a href="lottery-number-decleare-result.php">Declare Lottery Number Result</a></li>
        <li><a href="color-betting.php">Game Rates</a></li>
    </ul>
</li> -->



                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-file"></i>
                                <span>Message</span>
                            </a>
                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                <li><a href="chat.php">Chat</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="user-management-new.php" class="waves-effect">
                                <i class="bx bxs-user-detail"></i>
                                <span>User Management</span>
                            </a>
                        </li>

                   <!-- <li>
    <a href="register.php" class="waves-effect">
        <i class="bx bxs-user-detail"></i>
        <span>Register New User</span>
    </a>
</li> -->

                        <li>
                            <a href="un-approved-users-list.php" class="waves-effect">
                                <i class="bx bxs-user-detail"></i>
                                <span>Unapproved User Management</span>
                            </a>
                        </li>

<!-- <li>
    <a href="declare-result.php" class="waves-effect">
        <i class="bx bx-bullseye"></i>
        <span>Declare Result</span>
    </a>
</li> -->

                        <li>
                            <a href="delhi-results.php" class="waves-effect">
                                <i class="bx bx-bullseye"></i>
                                <span>Delhi Declare Result</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-file"></i>
                                <span>Delhi Management</span>
                            </a>
                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                <li><a href="delhi-game-name.php">Game Name</a> </li>
                                <li><a href="delhi-game-rate.php">Game Rates</a></li>
                                <li><a href="delhi-onOffMarket.php">On/Off Market</a> </li>

                                <li><a href="delhi-user-bid-history.php">Users Bid History</a></li>
                                <li><a href="delhi-bet_allgame.php">Bid Date Wise</a></li>
                                <li><a href="delhi-betlist.php">Bet List</a></li>
                                <li><a href="show-delhi-bet-history.php">Bet History</a></li>
                                <!-- <li><a href="delhi-withdraw-report.php">Withdraw Report</a></li> -->
                                <!-- <li><a href="delhi-auto-deposite-history.php">Auto Deposit History</a> </li> -->
                                <li><a href="delhi-winning-report.php">Winning History</a> </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-file"></i>
                                <span>Report Management</span>
                            </a>
                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                <li><a href="all-transactions.php">All Transactions Report</a></li>

                                <li><a href="delhi_transaction_records.php">Delhi Transactions</a></li>
                                <li><a href="mumbai_transaction_records.php">Mumbai Transactions</a></li>
                                <li><a href="color_transaction_records.php">Color Transactions</a></li>
                                <li><a href="lottery_transaction_records.php">Lottery Transactions</a></li>
                                <li><a href="starline_transaction_records.php">StarLine Transactions</a></li>


                                <li><a href="user-bid-history.php">Users Bid History</a></li>
                                <li><a href="bet_allgame.php">Bid Date Wise</a></li>
                                <li><a href="betlist.php">Bet List</a></li>
                                <li><a href="withdraw-report.php">Withdraw Report</a></li>
                                <li><a href="auto-deposite-history.php">Auto Deposit History</a> </li>
                                <li><a href="winning-report.php">Winning History</a> </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-wallet"></i>
                                <span>Wallet Management</span>
                            </a>
                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                <li><a href="fund-request-management.php">Fund Request</a> </li>
                                 <li><a href="payment-proofs-admin.php">Payment Proofs</a> </li>
                                <li><a href="fund-request-management_qr.php">Fund Request via QR</a> </li>
                                <li><a href="withdraw-request-management.php">Withdraw Request</a> </li>
                                <li><a href="add-fund-user-wallet-management.php">Add Fund (User Wallet)</a> </li>
                                <li><a href="user-wallet-management.php">User Wallet List</a> </li>
                                <li><a href="deduct-money.php">Remove Money</a> </li>
                            </ul>
                        </li>

                        <li>

                   <!-- <li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-bullseye"></i>
        <span>Mumbai Management</span>
    </a>
    <ul class="sub-menu mm-collapse" aria-expanded="false">
        <li><a href="game-name.php">Game Name</a> </li>
        <li><a href="game-rate.php">Game Rates</a></li>
        <li><a href="onOffMarket.php">On/Off Market</a> </li>
        <li><a href="mumbai-user-bid-history.php">Users Bid History</a></li>
        <li><a href="mumbai-bet_allgame.php">Bid Date Wise</a></li>
        <li><a href="mumbai-betlist.php">Bet List</a></li>
        <li><a href="show-bet-history.php">Bet History</a></li>
        <li><a href="mumbai-winning-report.php">Winning History</a> </li>
    </ul>
</li> -->


                <!-- <li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-bullseye"></i>
        <span>Game & Numbers</span>
    </a>
    <ul class="sub-menu mm-collapse" aria-expanded="false">
        <li><a href="single-digit.php">Single Digit</a></li>

        <li><a href="jodi-digit.php">Jodi Digit</a> </li>

        <li><a href="single-pana.php">Single Pana</a> </li>

        <li><a href="double-pana.php">Double Pana</a> </li>

        <li><a href="tripple-pana.php">Tripple Pana</a> </li>

        <li><a href="half-sangam.php">Half Sangam</a> </li>

        <li><a href="full-sangam.php">Full Sangam</a> </li>
    </ul>
</li> -->

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-cog"></i>
                                <span>Settings</span>
                            </a>
                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                <li><a href="main-settings.php">Main Settings</a></li>
                                <li><a href="payment-methods.php">Payment UPIs</a></li>
                                <li><a href="status-settings.php">Change Imp Status</a></li>
                                <li><a href="slider-management.php">Add Slider</a></li>
                                <li><a href="FunImage_management.php">Add Fun Images</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="notice-management.php" class=" waves-effect">
                                <i class="bx bx-cog"></i>
                                <span>Notice Management</span>
                            </a>
                        </li>

<!-- <li>
    <a href="javascript: void(0);" class="has-arrow waves-effect">
        <i class="bx bx-file"></i>
        <span>Starline Management</span>
    </a>
    <ul class="sub-menu mm-collapse" aria-expanded="false">
        <li><a href="starline-game-name.php">Game Name</a></li>
        <li><a href="show-starline-bet-history.php">Bet History</a></li>
        <li><a href="starline-user-bid-history.php">Bid History</a></li>
        <li><a href="starline-decleare-result.php">Declare Result</a></li>
        <li><a href="star-line-betting.php">Game Rates</a></li>
    </ul>
</li> -->

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->